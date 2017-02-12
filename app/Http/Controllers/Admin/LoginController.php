<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends CommonController
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin.login.index');
    }

    public function login(LoginRequest $request)
    {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        if (!Auth::attempt(['username' => $username, 'password' => $password])) {
            return ajaxResponse(1, '用户名或密码错误');
        }

        return ajaxResponse(0, 'success');
    }
}
