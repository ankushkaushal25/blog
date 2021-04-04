<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\admin;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    use AuthenticatesUsers {
        logout as performLogout;
    }
    public function logout(Request $request)
{
    $this->performLogout($request);
    return redirect()->route('admin-login');
}
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';
  /*  protected function redirectTo()
    {
        if (auth()->user()->role_id == 1) {
            return '/admin/home';
        }
        return '/home';
    }*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $admin = admin::where('email',$request->email)->first();
        if (!is_null($admin)){
                if ($admin->status == 0) {
            return ['email'=>'inactive','password'=>'You are not an active person, please contact Admin'];
        }else{
        return ['email'=>$request->email,'password'=>$request->password,'status'=>1];
    }
        return $request->only($this->username(), 'password');
    }
    }
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
