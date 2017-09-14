<?php

namespace App\Http\Controllers\Auth;

use App\Alumni;
use App\College;
use App\Degree;
use App\Education;
use App\Educational;
use App\Employment;
use App\Picture;
use App\Profile;
use App\Province;
use App\Student;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'student_number' => 'required|unique:mmsu_alumni',
            'or_code' => 'required|string|max:30',
            'datePaid' => 'required|date|before:'.Carbon::tomorrow()->format('m/d/Y').'',
            'email' => 'required|string|email|max:255|unique:accounts',
            'password' => 'required|string|min:6|confirmed',
            'lname' => 'required|string|max:30',
            'fname' => 'required|string|max:30',
            'mname' => 'nullable|string|max:30',
            'degree' => 'required',
            'college' => 'required',

        ], [
            'student_number.unique' => 'The Student Number Provided is Already Registered in our System, please login your Account',
            'email.unique' => 'The Email is Already Registered in our System, please login using this Account',
            'datePaid.before' => 'The Date of Payment must be before '.Carbon::tomorrow()->format('m/d/Y').'.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email']),
        ]);

        $alumni = new Alumni;
        $profile = new Profile;
        $picture = new Picture;
        $education = new Education;
        $major = $data['major'];
        if ($major==null){
            $maj = 0;
        } else {
            $maj = $major;
        }

        $alumni->student_number = $data['student_number'];
        $alumni->surname = strtoupper($data['lname']);
        $alumni->firstname = strtoupper($data['fname']);
        $alumni->middlename = strtoupper($data['mname']);
        $alumni->reg_date = date('Y-m-d', strtotime($data['datePaid']));
        $alumni->year_graduated = $data['year_graduated'];
        $alumni->sem_graduated = $data['sem_graduated'];
        $alumni->college_code = $data['college'];
        $alumni->degree_code = $data['degree'];
        $alumni->major_code = $maj;
        $alumni->or_code = $data['or_code'];
        $alumni->user()->associate($user->id);
        $alumni->save();
        $profile->sex = $data['gender'];
        $profile->civil_status_id = $data['civilStatus'];
        $profile->provCode = $data['province'];
        $profile->citymunCode = $data['city'];
        $profile->brgyCode  =$data['brgy'];
        $profile->mobile = $data['contact'];
        $profile->birthdate = $data['dob'];
        $profile->birthplace = $data['pob'];
        $profile->user()->associate($user->id);
        $profile->save();
        $picture->location = '/uploads/imgs/default.png';
        $picture->user()->associate($user->id);
        $picture->save();
        $edu = array(
            ['school'=> $data['edu1'], 'level' => $data['l1'], 'date_graduated' => $data['ey1'], 'reg_id' => $user->id],
            ['school'=> $data['edu2'], 'level' => $data['l2'], 'date_graduated' => $data['ey2'], 'reg_id' => $user->id],
        );
        $education->insert($edu);
        return $user;
    }

    public function showRegistrationForm(){
        $colleges = College::all();
        $degrees = Degree::all();
        $provinces = Province::all();
        $cStatus = DB::table('civil_status')->get();

        return view('auth.register', compact('colleges', 'cStatus', 'provinces', 'degrees'));
    }

    public function register2(){
        $colleges = College::all();
        $degrees = Degree::all();
        $provinces = Province::all();
        $cStatus = DB::table('civil_status')->get();

        return view('auth.register2', compact('colleges', 'cStatus', 'provinces', 'degrees'));
    }

    public function studentMap() {
        $id = Input::get('term');
        $results = array();
        $queries = Student::where('student_number', 'like',  '%'.$id.'%')->take(10)->get();
        foreach ($queries as $query)
        {
            $queries2 = Educational::where('app_code', $query->app_code)->get();
            $results[] = [
                'value' => $query->student_number,
                'lname' => $query->lname,
                'fname' => $query->fname,
                'mname' => $query->mname,
                'prov' => $query->prov,
                'city' => $query->city,
                'house_number' => $query->house_number,
                'gender'=> $query->gender,
                'college' => $query->college,
                'degree' => $query->degree,
                'major' => $query->major,
                'ay' => $query->ay,
                'sem' => $query->sem,
                'dob' => $query->dob,
                'pob' => $query->pob,
                'contact_number' => $query->contact_number,
                'edu1' => $queries2[0]->name,
                'edu2' => $queries2[1]->name,
                'l1' => $queries2[0]->level,
                'l2' => $queries2[1]->level,
                'ey1' => $queries2[0]->e_year,
                'ey2' => $queries2[1]->e_year,
                ];
        }
        return Response::json($results);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        dispatch(new SendVerificationEmail($user));
        return view('verify.verification');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();
        $user->verified = 1;
        if($user->save()){
            return view('verify.emailconfirm',['user'=>$user]);
        }
    }
}
