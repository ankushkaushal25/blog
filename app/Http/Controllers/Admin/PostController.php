<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\post;
use App\Models\user\tag;
use App\Models\user\category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();

         return view('admin.post.show',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('posts.create')) { // this is for policy authorization

            $tags = tag::all();
            $categories = category::all();
           // $tags = tag::with('posts')->get(); // to create post with tag
            //$categories = category::with('posts')->get();  // to create post with category.... inse data fetch hokr ayega jb post create krnge tb
            return view('admin.post.post',compact('tags','categories'));
        }
        return redirect(route('admin.home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'title'=>'required',
            'subtitle'=>'required',
            'slug'=>'required',
            'body'=>'required',
            'image'=>'required',
        ]);
        if($request->hasFile('image')){
            //return $request->image->getClientOriginalName(); // to get orignal name of file
            $imageName = $request->image->store('public');                //  to store images in storage/app/public folder
         }

        $post = new post;
        $post->image = $imageName;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->save();   // phle new post save krenge fir tags or category assign krenge
        $post->tags()->sync($request->tags); // data will save with tags... tags is name of table
        $post->categories()->sync($request->categories);


        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('posts.update')) {
        $posts = post::with('tags','categories')->where('id',$id)->first(); //with('tags','categories') ka matlab jab bhi edit par click kre to tag or category jo phle se select he wo show ho jaye view me
        $tags = tag::all();
        $categories = category::all();
        return view('admin.post.edit',compact('tags','categories','posts'));
    }
        return redirect(route('admin.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        $this->validate($request,[
            'title'=>'required',
            'subtitle'=>'required',
            'slug'=>'required',
            'body'=>'required',
            'image'=>'required',
        ]);

        if($request->hasFile('image')){
           //return $request->image->getClientOriginalName(); // to get orignal name of file
           $imageName = $request->image->store('public');                //  to store images in storage/app/public folder
        }

        $post = post::find($id);
        $post->image = $imageName;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        $post->save();

        return redirect(route('post.index'));

       // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::where('id',$id)->delete();
        return redirect()->back();
    }
}
