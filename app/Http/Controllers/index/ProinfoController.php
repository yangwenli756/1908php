<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

use Illuminate\Support\Facades\Redis;

class ProinfoController extends Controller
{
    public function proinfo($id){

        $data = Redis::get('data');

        $count = Redis::setnx('num_'.$id,1);
        if(!$count){
            Redis::incr('num_'.$id);
        }


        if(!$data){


            $data = Goods::where('goods_id',$id)->get();
             //dd($data);
            foreach($data as $v){
                if($v->goods_img){
                    $v->goods_img = explode('|',$v->goods_img);
                }
            }


        }


        //dd($data);
        return view('index/proinfo',['data'=>$data,'count'=>$count,'aa'=>$v->goods_img]);
    }
}
