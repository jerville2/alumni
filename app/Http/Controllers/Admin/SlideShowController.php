<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageRequest;
use App\SlideShow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlideShowController extends Controller
{
    public function allSlides() {
        $slides = SlideShow::all();
        return view('admin.slide.slides', compact('slides'));
    }
    public function upload(ImageRequest $request){
        $img = $request->image;

        $filename = sha1($img->getATime() . '_' . $img->getSize() . '_' . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        Storage::disk('public')->put('uploads/slides/'.$filename, File::get($img));
        $imgs = Image::make(storage_path('app/public/uploads/slides/'.$filename));
        $imgs->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imgs->save(storage_path('app/public/uploads/slides/'.$filename));

        $pic = new SlideShow;
        $pic->location = '/uploads/slides/' . $filename;
        $pic->save();

        $image = SlideShow::latest('id')->first();
        $id = $image->id;
        return redirect('admin/slides/jcrop/'.$id);
    }
    public function viewCrop($id){
        $image = SlideShow::find($id);
        return view('admin.slide.jcrop', compact('image'));
    }
    public function jcropUp($id) {
        $image = SlideShow::find($id);
        $quality = 100;
        $src  = substr($image->location,1);
        if (substr($src,56) == 'png') {
            $img = imagecreatefrompng(storage_path('app/public/'.$src));
        } else {
            $img = imagecreatefromjpeg(storage_path('app/public/'.$src));
        }

        $dest = ImageCreateTrueColor(Input::get('w'),
            Input::get('h'));

        imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
            Input::get('y'), Input::get('w'), Input::get('h'),
            Input::get('w'), Input::get('h'));
        imagejpeg($dest, storage_path('app/public/'.$src), $quality);

        return redirect('admin/slides/edit/'.$id);
    }
    public function edit($id) {
        $slide = SlideShow::find($id);
        return view('admin.slide.edit', compact('slide'));
    }
    public function update(Request $request, $id) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $slide = SlideShow::find($id);
        $slide->title = $request->title;
        $slide->description = $request->desc;
        $slide->published = $pubs;
        $slide->update();
        return redirect('admin/slides');
    }

    public function deleteSlide($id) {
        $img = SlideShow::find($id);
        Storage::disk('public')->delete($img->location);
        SlideShow::find($id)->delete();
        return redirect('admin/slides');
    }
}
