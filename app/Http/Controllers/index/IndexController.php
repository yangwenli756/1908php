<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;

class IndexController extends Controller
{
    public function index(){
        echo 123;
        $res = cache('goods');

        if(!$res){

            $res = Goods::get();
            cache(['goods'=>$res],60*60*24*30);
        }
         $data = Brand::get();
        return view('index/index',['res'=>$res,'data'=>$data]);
    }
}
