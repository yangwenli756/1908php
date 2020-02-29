<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Goods;

class ProlistController extends Controller
{
    public function prolist(){
        $data =Goods::get();
        //dump($res);die;
        return view('index/prolist',['res'=>$data]);
    }
}
