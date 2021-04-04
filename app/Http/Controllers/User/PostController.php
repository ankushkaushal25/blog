<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\post;
class PostController extends Controller
{
    public function post(post $post)   // post is model.... we are getting post according to slug
    {

       // return $post;
        return view('user.post',compact('post'));
    }
}
