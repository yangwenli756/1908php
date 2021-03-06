<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Goods;

use App\Cart;

use DB;

class CarController extends Controller
{
    public function car(){
        if(session('admin.u_id')){


            $res = Cart::leftjoin('shop_goods','shop_cart.goods_id','=','shop_goods.goods_id')->where(['cart_del'=>1])->get();

        }else{
            $res = $this->getCookie();
        }
        return view('index/car',['res'=>$res]);
    }

    function changemoney(){
        $goods_id = request()->goods_id;
         //dd($goods_id);
        $money = $this->changemoneyDb($goods_id);

        echo $money;
    }
    function changemoneyDb($goods_id){
        $user_id = session('admin.u_id');
        $where = [
            ['u_id','=',$user_id],
            ['shop_goods.goods_id','in',$goods_id],
            ['cart_del','=',1]
        ];

        //dd($where);
        $res = Cart::leftjoin('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->where('shop_goods.goods_id',$goods_id)->get();
         //dd($res);
        $money = 0;

        foreach ($res as $k => $v) {
            $money+=$v['goods_price']*$v['buy_number'];
        }
       // dd($money);
        return $money;
    }
    //删除
    function cartDel(){

        $goods_id = request()->goods_id;

        //dd($goods_id);
        $res =  $this->cartDelDb($goods_id);

         //dd($res);
        if($res){
            json_encode(['code'=>1,'font'=>'删除成功']);
        }else{
            json_encode(['code'=>0,'font'=>'删除失败']);
        }
    }

    function cartDelDb($goods_id){
        $user_id = session('admin.u_id');
        $where = [
            ['goods_id','in',$goods_id],
            ['u_id','=',$user_id],
            ['cart_del','=',1]
        ];

       //dd($where);
        $res = Cart::where('goods_id',$goods_id)->update(['cart_del'=>2]);

         //dd($res);
        return $res;
    }
    //判断登录之前和之后的加入购物车
    public function addcar(){
       $id = request()->goods_id;
        $buy_number = request()->buy_number;

       if(!empty(session('admin'))){
           $res = $this->addcarDb($id,$buy_number);
       }else{
           $res = $this->addcarCookie($id,$buy_number);
       }

    }

    //登录后加入db

    public function addcarDb($id,$buy_number){
        $user_id = session('admin.u_id');

        $goods_num = Goods::where('goods_id',$id)->value('goods_num');

       $where  = [
           ['goods_id','=',$id],
           ['u_id','=',$user_id],
           ['cart_del','=',1]
       ];

        $cartinfo = Cart::where($where)->first();

        //判断数据库中是否已经加入过该商品
        if(!empty($cartinfo)){
          //检测库存
            if(($buy_number+$cartinfo['buy_number'])>$goods_num){
                $buy_number = $goods_num;
            }else{
                $buy_number = $buy_number+$cartinfo['buy_number'];
            }
            $info = ['buy_number'=>$buy_number,'add_time'=>time()];

            $res = Cart::where($where)->update($info);
        }else{
            if($buy_number>$goods_num){
                $buy_number=$goods_num;
            }
            $arr = ['goods_id'=>$id,'buy_number'=>$buy_number,'add_time'=>time(),'u_id'=>$user_id];

            $res = Cart::create($arr);

            //dump($res);
            return $res;
        }

    }

    //未登录加入cookie
    function addcarCookie($id,$buy_number){

        $cartinfo = cookie('cartinfo');

        if(empty($cartinfo)){
            $cartinfo = [];
        }

        $goods_num=Goods::where("goods_id",'=',$id)->value('goods_num');

        if(array_key_exists($id,$cartinfo)){
            if(($cartinfo['goods_id']['buy_number']+$buy_number)>$goods_num){
                $buy_number = $goods_num;
            }else{
                $buy_number = $cartinfo['goods_id']['buy_number']+$buy_number;
            }
            $cartinfo[$id]['buy_number'] = $buy_number;
            $cartinfo[$id]['add_time'] = time();
        }else{
            if($buy_number>$goods_num){
                $buy_number = $goods_num;
            }
            $cartinfo[$id] = ['goods_id'=>$id,'buy_number'=>$buy_number,'add_time'=>time()];
        }



        cookie('cartinfo',$cartinfo);

        return true;

    }

    public function getCookie(){

        $cartInfo = cookie('cartInfo');

        if( !empty($cartInfo) ) {

            $add_time = array_column($cartInfo, 'add_time');

            array_multisort($add_time, SORT_DESC, $cartInfo);

            foreach ($cartInfo as $k => $v) {
                $where = [
                    ['goods_id', '=', $v['goods_id']]
                ];


                $goodsInfo = Goods::where($where)
                    ->find()
                    ->toArray();

                $cartInfo[$k] = array_merge($v, $goodsInfo);
            }
            return $cartInfo;
        }


    }

    //解析下订单页面
    public function  pay(){

        $goods_id = request() ->goods_id;

        //dd($shoping_id);
        $res = Goods::leftjoin('shop_cart','shop_goods.goods_id','=','shop_cart.goods_id')->where('shop_goods.goods_id',$goods_id)->get();
        //dd($res);
        return view('index/pay',['res'=>$res]);
    }

    //解析地址页面
    public function address(){
        $provinceinfo = $this->getAreaInfo(0);
        return view('index/address',['province'=>$provinceinfo]);
    }
    //添加地址
    public function address_do(Request $request){
       $data = $request->except('_token');

        $res = DB::table('address')->insert($data);

        if($res){
            return redirect('pay');
        }
    }
    //收货地址的展示
    function address_list(){

        $addressinfo = $this->getaddress();
        return view('index/address_list',['addressinfo'=>$addressinfo]);
    }

    //查询表得到市城区的详细名字
    public function getaddress(){

        $addressinfo = DB::table('address')->get();

        foreach($addressinfo as $k=>$v){
            $addressinfo[$k]->province = DB::table('shop_area')->where('id',$v->province)->value('name');
            $addressinfo[$k]->city= DB::table('shop_area')->where('id',$v->city)->value('name');
            $addressinfo[$k]->area= DB::table('shop_area')->where('id',$v->area)->value('name');
        }

        return $addressinfo;
    }

    //市城区的展示
    function getArea(){
        $id = request()->id;
        //dd($id);
        $info = $this->getAreaInfo($id);
        //dd($info);
        echo json_encode($info);

    }
    function getAreaInfo($pid){


        $where = [
            ['pid','=',$pid]
        ];
         $res =  DB::table('shop_area')->where($where)->get();

        return $res;
    }
    //提交订单
    public function success(){
        return view('index/success');
    }


}
