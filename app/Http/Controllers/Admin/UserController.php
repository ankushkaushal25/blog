<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\admin;
use App\Models\admin\role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('can:posts.user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = admin::all();
        return view('admin.user.show',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =  role::all(); //return $roles;
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email' => 'required| string| email| max:255| unique:admins',
            'phone'=>'required|numeric',
            'password' => 'required| string| min:8| confirmed',
        ]);
        $request['password'] = bcrypt($request->password);
        $user = admin::create($request->all()); // iske loye mass assignment feild dena hogi model me
        $user->roles()->sync($request->role);
        return redirect(route('user.index'));
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
        $user = admin::find($id);
        $roles =  role::all();
        return view('admin.user.edit',compact('user','roles'));
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
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email' => 'required| string| email| max:255',
            'phone'=>'required|numeric',
        ]);
        $request->status? : $request['status']=0; // if status is here give nothing otherwise give the status value 0
        $user = admin::where('id',$id)->update($request->except('_token','_method','role'));
        //  return $user;
        //$user->roles()->sync($request->role); // ye user ka instance nhi mil rha h isliye niche wali
        admin::find($id)->roles()->sync($request->role);
        return redirect(route('user.index'))->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        admin::where('id',$id)->delete();
        return redirect()->back()->with('message','User is Deleed Successfully');
    }
}