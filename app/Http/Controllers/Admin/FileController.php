<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Download;
use App\Http\Requests\Admin\AlbumRequest;
use App\Http\Requests\Admin\FileRequest;
use App\Http\Requests\Admin\ImgsRequest;
use App\Imgs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Alert;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class FileController extends Controller
{
    public function allAlbums() {
        $albums = Album::latest('id')->paginate(25);
        return view('admin.images.galleries', compact('albums'))->with(['tab' => 'gal']);
    }
    public function newAlbum() {
        return view('admin.images.new_album');
    }
    public function editAlbum($id) {
        $album = Album::find($id);
        return view('admin.images.edit_album', compact('album'));
    }
    public function album(AlbumRequest $request) {
        $pub = $request->pub;
        $sy = $request->sys;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        if ($sy == '1'){
            $sys = 1;
        } else {
            $sys = 0;
        }
        $album = new Album;
        $album->title = $request->title;
        $album->desc = $request->desc;
        $album->published = $pubs;
        $album->system = $sys;
        $album->save();

        $image = $request->images;
        if($image != null){
            foreach ($image as $img) {
                $albumName = $request->title;
                $imageName = time().$img->getClientOriginalName();
                Storage::disk('public')->put('uploads/galleries/'.$albumName.'/'.$imageName, File::get($img));

                $imgs = Image::make(storage_path('app/public/uploads/galleries/'.$albumName.'/'.$imageName));
                $imgs->resize(null, 1440, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imgs->insert(storage_path('app/public/uploads/galleries/water/water.png'), 'bottom-right', 75, 75);
                $imgs->save(storage_path('app/public/uploads/galleries/'.$albumName.'/'.$imageName));


                $images = new Imgs;
                $images->title = $img->getClientOriginalName();
                $images->location = '/uploads/galleries/'.$albumName.'/'.$imageName;
                $images->published = 1;
                $images->imgdate = Carbon::now()->format('Y-m-d h:i:s');
                $images->album()->associate($album);
                $images->save();
            }
        }
        Alert::success('Album has been saved.', 'Saved');
        return redirect('admin/galleries');
    }
    public function updateAlbum(Request $request, $id) {
        $pub = $request->pub;
        $sy = $request->sys;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        if ($sy == '1'){
            $sys = 1;
        } else {
            $sys = 0;
        }
        $album = Album::find($id);
        $album->title = $request->title;
        $album->desc = $request->desc;
        $album->published = $pubs;
        $album->system = $sys;
        $album->update();
        Alert::success('Album has been saved.', 'Saved');
        return redirect('admin/galleries');
    }
    public function deleteAlbum($id) {
        Album::find($id)->delete();
        $imgs = Imgs::where('album_id', $id)->get();
        foreach ($imgs as $img){
            Storage::disk('public')->delete($img->location);
        }
        Imgs::where('album_id', $id)->delete();
        Alert::success('Album successfully deleted!','Deleted!');
        return redirect('admin/galleries');
    }

    public function allImages($id) {
        $albums = Album::find($id);
        return view('admin.images.images', compact('albums'));
    }
    public function uploadImages($id) {
        $album = Album::find($id);
        return view('admin.images.upload', compact('album'));
    }
    public function saveImages(ImgsRequest $request, $id) {
        $image = $request->images;
        $albumName = Album::find($id)->title;

        foreach ($image as $img) {
            $imageName = time().$img->getClientOriginalName();
            Storage::disk('public')->put('uploads/galleries/'.$albumName.'/'.$imageName, File::get($img));
            //$img->move(public_path('uploads/galleries'),$imageName);

            $imgs = Image::make(storage_path('app/public/uploads/galleries/'.$albumName.'/'.$imageName));
            $imgs->resize(null, 1440, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imgs->insert(storage_path('app/public/uploads/galleries/water/water.png'), 'bottom-right', 75, 75);
            //Storage::disk('public')->put('uploads/galleries/'.$imageName, $imgs);
            $imgs->save(storage_path('app/public/uploads/galleries/'.$albumName.'/'.$imageName));

            $images = new Imgs;
            $images->title = $img->getClientOriginalName();
            $images->location = '/uploads/galleries/'.$albumName.'/'.$imageName;
            $images->album_id = $id;
            $images->published = 1;
            $images->imgdate = Carbon::now()->format('Y-m-d h:m:s');
            $images->save();
        }
        return redirect()->route('album', ['id'=>$id]);
    }
    public function deleteImage($a_id, $id) {
        $img = Imgs::find($id);
        Storage::disk('public')->delete($img->location);
        Imgs::find($id)->delete();
        return redirect()->route('album', ['id'=>$a_id]);
    }

    public function allFiles() {
        $files = Download::latest('dldate')->paginate(25);
        return view('admin.files.files', compact('files'));
    }
    public function newFile() {
        return view('admin.files.file_editor');
    }
    public function editFile($id) {
        $file = Download::where('dl_code', $id)->first();
        return view('admin.files.edit_file', compact('file'));
    }
    public function file(FileRequest $request)
    {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        echo $file = $request->file;
        $fileName = time().$file->getClientOriginalName();
        Storage::put('uploads/docs/dl/'.$fileName, File::get($file));
        //$file->move(public_path('uploads/docs/dl'),$fileName);

        $file = new Download;
        $file->title = $request->title;
        $file->src = '/uploads/docs/dl/'.$fileName;
        $file->published = $pubs;
        $file->dldate = date('Y-m-d', strtotime($request->pubDate));
        $file->save();
        return redirect('admin/files');
    }
    public function updateFile(Request $request, $id) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $file = Download::find($id);
        $file->title = $request->title;
        $file->published = $pubs;
        $file->dldate = date('Y-m-d', strtotime($request->pubDate));
        $file->update();
        return redirect('admin/files');
    }
    public function deleteFile($id) {
        $file = Download::find($id);
        File::delete(storage_path('app/'.$file->src));
        Download::find($id)->delete();
        return redirect('admin/files');
    }

    public function ckUpload() {

        $CKEditor = Input::get('CKEditor');
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename = sha1(time().$file->getClientOriginalName()).'.'.$file->getClientOriginalextension();
                Storage::disk('public')->put('uploads/articles/post/'.$filename, File::get($file));
                //$file->move(public_path('uploads/articles/new'), $filename);
                $imgs = Image::make(storage_path('app/public/uploads/articles/post/'.$filename));
                $imgs->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imgs->save(storage_path('app/public/uploads/articles/post/'.$filename));
                $url = asset(Storage::url('uploads/articles/post/'. $filename));

            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return  '<script>window.parent.CKEDITOR.tools.callFunction("'.$funcNum.'", "'.$url.'", "'.$message.'")</script>' ;
    }
}
