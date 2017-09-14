<?php

namespace App\Http\Controllers;

use App\Events\PostLike;
use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LikeController extends Controller
{
    public function likePost($id, $owner)
    {
        // here you can check if product exists or is valid or whatever

        $this->handleLike('App\Post',$id, $owner);

        return Redirect::to('alumni/post/'.$id);
    }

    public function handleLike($type, $id, $owner)
    {
        $existing_like = Like::withTrashed()->whereLikeType($type)->wherePostId($id)->whereRegId(Auth::user()->id)->first();

        if (is_null($existing_like)) {
            Like::create([
                'reg_id'       => Auth::user()->id,
                'post_id'   => $id,
                'like_type' => $type,
                'owner' => $owner,
            ]);

            $poster_id = Post::find($id)->reg_id;
            $name = Auth::user()->alumni->firstname.' '.Auth::user()->alumni->middlename.' '.Auth::user()->alumni->surname;
            event(new PostLike($name,$id,$poster_id));
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }
}
