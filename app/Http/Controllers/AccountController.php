<?php

namespace App\Http\Controllers;

use App\Address;
use App\Alumni;
use App\Award;
use App\Citizen;
use App\City;
use App\CivilStatus;
use App\College;
use App\Eligibility;
use App\Employment;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\EmpRequest;
use App\Http\Requests\ImageRequest;
use App\Organization;
use App\Picture;
use App\Post;
use App\Profile;
use App\Province;
use App\Publication;
use App\Religion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendVerificationEmail;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Alert;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    public function viewForm(){
        return view('Account.edit-user');
    }
    public function updateUsersEmail(Request $request) {
        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->email_token = base64_encode($request->email);
        $user->update();
        dispatch(new SendVerificationEmail($user));
        return redirect('email-sent');
    }

    public function cPassword() {
        return view('Account.change_pass');
    }
    public function updatePassword(ChangePassword $request) {
        $user = User::find(Auth::user()->id);
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            Alert::success('Your Password has been Updated!', 'Password Changed');
            return redirect('my_profile');
    }
    public function resend(){
        $user = User::find(Auth::user()->id);
        $user->email_token = base64_encode(Auth::user()->email);
        $user->update();
        $email = new EmailVerification(Auth::user());
        Mail::to(Auth::user()->email)->send($email);
        Alert::success('Please check your email to verify', 'Verification Sent')->persistent('OK');
        return redirect('verify');
    }
    public function myProfile() {
        $user = User::find(Auth::user()->id);
        $provinces = Province::all();
        $cStatus = CivilStatus::all();
        $citizens = Citizen::all();
        $religions = Religion::all();
        $colleges = College::all();

        return view('accountInfo.my_profile',
            compact('user', 'provinces', 'cStatus', 'citizens', 'religions', 'colleges'));
    }

    public function empUpdate(EmpRequest $request) {

        $employment = new Employment;
        $employment->employer = strtoupper($request->employer);
        $employment->position = strtoupper($request->position);
        $employment->address = strtoupper($request->employer_addrs);
        $employment->email = $request->employer_email;
        $employment->contact = $request->employer_contact;
        $employment->user()->associate(Auth::user()->id);
        $employment->save();

        Alert::success('Employment details Updated', 'Updated');
        return redirect('my_profile')->withInput(['tab'=>'employment']);
    }
    public function deleteEmp($id) {
        Employment::find($id)->delete();
        Alert::success('Deleted');
        return redirect('my_profile')->withInput(['tab'=>'employment']);
    }
    public function profileUpdate(Request $request) {

        $profile = Profile::where('reg_id', Auth::user()->id)->first();
        $profile->provCode = $request->province;
        $profile->citymunCode = $request->city;
        $profile->brgyCode = $request->brgy;
        $profile->civil_status_id = $request->civilStatus;
        $profile->mobile = $request->contact;
        $profile->guardian_telno = $request->gContact;
        $profile->citizenship_id = $request->citizen;
        $profile->religion_id = $request->religion;
        $profile->update();

        $addrs2 = $request->addrs;

        if($addrs2 != null){
            $addrs = Address::where('reg_id', Auth::user()->id);
            if($addrs->count() == 0){
                $address2 = new Address;
                $address2->address = strtoupper($addrs2);
                $address2->user()->associate(Auth::user()->id);
                $address2->save();
            } else {
                $addrs = Address::where('reg_id', Auth::user()->id)->first();
                $addrs->address = strtoupper($addrs2);
                $addrs->update();
            }

        }
            Alert::success('Personal Information Updated', 'Updated');
            return redirect('my_profile')->withInput(['tab'=>'personal']);
    }
    public function eligibility(Request $request) {
        $eligibility = new Eligibility;
        $eligibility->eligibility = $request->eligibility;
        $eligibility->examplace = $request->examplace;
        $eligibility->examdate = date('Y-m-d', strtotime($request->examdate));
        $eligibility->rating = $request->rating;
        $eligibility->user()->associate(Auth::user()->id);
        $eligibility->save();

        Alert::success('Eligibility details Added', 'Success');
        return redirect('my_profile')->withInput(['tab'=>'eligibility']);
    }
    public function organization(Request $request) {
        $organization = new Organization;
        $organization->organization = $request->organization;
        $organization->highpos = $request->position;
        $organization->period = $request->period;
        $organization->user()->associate(Auth::user()->id);
        $organization->save();

        Alert::success('Organization details Added', 'Success');
        return redirect('my_profile')->withInput(['tab'=>'org']);
    }
    public function publication(Request $request) {
        $publication = new Publication;
        $publication->publication = $request->publication;
        $publication->user()->associate(Auth::user()->id);
        $publication->save();

        Alert::success('Publication Added', 'Success');
        return redirect('my_profile')->withInput(['tab'=>'pub']);
    }
    public function award(Request $request) {
        $award = new Award;
        $award->award = $request->award;
        $award->dategiven = date('Y-m-d', strtotime($request->awarddate));
        $award->user()->associate(Auth::user()->id);
        $award->save();

        Alert::success('Award Details Added', 'Success');
        return redirect('my_profile')->withInput(['tab'=>'award']);
    }
    public function myPost(Request $request) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $post = new Post;
        $post->title = $request->title;
        $post->post = $request->contents;
        $post->published = $pubs;
        $post->date = Carbon::now();
        $post->user()->associate(Auth::user()->id);
        $post->save();

        return redirect($request->url)->withInput(['tab'=>'myPost']);
    }

    public function cityMap(){
        $id = Input::get('option');
        if($id==0){
            return 0;
        }
        $province = Province::find($id);
        $cities = $province->cities();

        return $cities->pluck('citymunDesc','citymunCode');
    }
    public function brgyMap(){
        $id = Input::get('option', '012820');
        if($id==0){
            return 0;
        }
        $city = City::find($id);
        $brgy = $city->barangays();

        return $brgy->pluck('brgyDesc','brgyCode');

    }

    public function imageUp(ImageRequest $request) {
        $img = $request->image;

        $filename = sha1($img->getATime() . '_' . $img->getSize() . '_' . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        Storage::disk('public')->put('uploads/imgs/users/'.$filename, File::get($img));
        //$img->move($destination, $filename);
        $imgs = Image::make(storage_path('app/public/uploads/imgs/users/'.$filename));
        $imgs->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imgs->save(storage_path('app/public/uploads/imgs/users/'.$filename));

        $picture = Picture::where('reg_id', Auth::user()->id)->first();
        if($picture != null){
        if($picture->location != '/uploads/imgs/default.png'){
        Storage::disk('public')->delete($picture->location);
        }
            $picture->location = '/uploads/imgs/users/' . $filename;
            $picture->update();
        } else
        {
            $pic = new Picture;
            $pic->location = '/uploads/imgs/users/' . $filename;
            $pic->user()->associate(Auth::user()->id);
            $pic->save();
        }


        return redirect('jcrop');
    }
    public function jcropUp() {
        $quality = 100;
        $src  = substr(Auth::user()->picture->location,1);
        if (substr($src,54) == 'png') {
            $img = imagecreatefrompng(storage_path('app/public'.Auth::user()->picture->location));
        } else {
            $img = imagecreatefromjpeg(storage_path('app/public'.Auth::user()->picture->location));
        }

        $dest = ImageCreateTrueColor(Input::get('w'),
            Input::get('h'));

        imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
            Input::get('y'), Input::get('w'), Input::get('h'),
            Input::get('w'), Input::get('h'));
        imagejpeg($dest, storage_path('app/public'.Auth::user()->picture->location), $quality);

        return redirect('watermark');
    }
    public function waterMark() {
        $img = Image::make(storage_path('app/public'.Auth::user()->picture->location));
        $img->resize(500, 500);
        $img->insert(storage_path('app/public/uploads/imgs/tag.png'), 'bottom', 5);
        $img->insert(storage_path('app/public/uploads/imgs/mmsu.png'), 'bottom-right', 10, 55);
        if (Auth::user()->alumni->middlename == null){
            $name = strtoupper(Auth::user()->alumni->firstname.' '.Auth::user()->alumni->surname);
        } else {
            $name = strtoupper(Auth::user()->alumni->firstname.' '.substr(Auth::user()->alumni->middlename, 0, 1).'. '.Auth::user()->alumni->surname);
        }
        $img->text($name, 250, 495,
            function($font) {
            $font->file(public_path('font/imageText.ttf'));
            $font->size(45);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(0);
        });
        $img->save(storage_path('app/public'.Auth::user()->picture->location));

        Alert::success('Profile Photo Updated', 'Updated');
        return redirect('my_profile');
    }

    public function myAccount() {
        return redirect('my_profile')->withInput(['tab' => 'account']);
    }

    public function deletePost($id) {
        Post::find($id)->delete();
        Alert::success('Deleted');
        return redirect('my_profile')->withInput(['tab' => 'myPost']);
    }
    public function deleteMyPost(Request $request) {
        $id = $request->postId;
        Post::find($id)->delete();
        Alert::success('Deleted');
        return redirect('my_profile')->withInput(['tab' => 'myPost']);
    }

    public function allMyPost(){
        $posts = Post::latest('date')->where('reg_id', Auth::user()->id)->paginate(3);
        $colleges = College::all();
        $report = \Illuminate\Support\Facades\DB::table('post_report')->get();
        $alumni = Alumni::orderBy(DB::raw('RAND()'))->take(3)->get();
        $value = Session::put(['sch' => '','col' => '','deg' => '','yr' => '','sem' => '', 'coln' => '', 'degn' => '', 'semn' => '']);
        return view('Account.myPost', compact('posts', 'colleges', 'value', 'alumni', 'report'));
    }
}
