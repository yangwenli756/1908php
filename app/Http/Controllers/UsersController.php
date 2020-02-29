<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
    	echo "这里是商品详情页";
    }
    public function add(){
    	return view('add');
    }
    public function adddo(Request $request){
      $res = $request->all();
      dd($res);
    }
    public function adds(){
    	return view('adds',['fid'=>'服装']);
    }
    public function addsdo(Request $request){
      $res = $request->all();
      dump($res);die;
    }
}
