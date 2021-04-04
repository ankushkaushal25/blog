<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\post;
use App\Models\User\category;
use App\Models\User\tag;

class HomeController extends Controller
{
    public function index()
    {
        //$posts = post::where('status',1)->get();   // get only post where status is 1 or published
        $posts = post::where('status',1)->orderBy('created_at','DESC')->paginate(3);
        return view('user.blog',compact('posts'));

    }

    public function tag(tag $tag)
    {
        $posts = $tag->posts();
        return view('user.blog',compact('posts'));

    }
    public function category(category $category) // category is model and %category is array
    {
       // return $category->posts;  // yaha phle getroutekeyname function banaya categorymodel me us se slug return kiya fr us slug se category aa gyi $category->posts mtlb category k sath post b show ho gayi
       //return $category->posts(); //posts ko function bna diya kyoki yaha paginate nhi kam kr rha paginate in relation ship kam krta h...... homecontrller k index me array koi b object return nahi karta to posts ko function bna diya... agr posts ko function nhi bnaye to error == category::posts must return a relationship instance error ayega

       $posts = $category->posts();   //$posts is array ... so $posts array is getting the post which is according to categoty
       return view('user.blog',compact('posts'));
    }

}
