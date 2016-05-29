<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use DB;

class UserController extends CommonController
{

    public function login(){
        if(Auth::check()){
            return redirect('/admin');
        }
        return view('admin.user.login');
    }

    /**
     * 处理登录认证
     */
    public function authenticate(Request $request){
        $username =  $request->input('username', '');
        $password =  $request->input('password', '');

        if(!$username){
            return $this->_return('1', '用户名称不能为空');
        }

        if(!$password){
            return $this->_return('1', '密码不能为空');
        }

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '用户名或密码错误');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin');
    }
}
