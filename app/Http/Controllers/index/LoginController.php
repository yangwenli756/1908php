<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use App\Users;

class LoginController extends Controller
{
    public function setcookie(){
        //第一种设置cookie
        //return response('测试产生cookie')->cookie('name','杨文莉',2);
        //第二种设置cookie全局辅助函数

    }
    public function login(){
        echo request()->cookie('name');
        return view('index/login');
    }
    public function login_do(Request $request){
        $data =$request->except('_token');

        $admin = Users::where($data)->first();

        if($admin){
            session(['admin'=>$admin]);
            $request->session()->save();
            $res = session('admin');
            return redirect('index');
        }
        return redirect('login')->with('msg','没有此用户');
    }
}
