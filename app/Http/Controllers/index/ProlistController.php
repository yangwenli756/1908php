<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Goods;

use App\Brand;

class ProlistController extends Controller
{
    public function prolist($id){
        $data =Brand::where('b_id',$id)->get();
       // dd($data);
        //dump($res);die;
        foreach($data as $v){
            if($v->logo){
                $v->logo = explode('|',$v->logo);
            }
        }
        return view('index/prolist',['res'=>$data,'aa'=>$v->logo]);
    }
}
