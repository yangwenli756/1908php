<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Login;

class LoginController extends Controller
{
    public function login(){
    	return view('login/login');
    }

    public function logindo(Request $request){
       $data = $request->except('_token');

       $data['password'] = md5(md5($data['password']));

       $admin = Login::where($data)->first();

       if(!$admin){
         session(['admin'=>$admin]);
         $request->session()->save();
         $res = session('admin');

         return redirect('news/create');
       }


    }
}
