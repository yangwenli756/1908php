<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cate;

use App\Goods;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "你好";
        //全局辅助函数的session的第一种方法
//        session(['name'=>'wenli']);
//        request()->session()->save();
//
//        session(['name'=>null]);
//        request()->session()->save();
//        echo session('name');

        $data= Goods::leftjoin('shop_category','shop_goods.cate_id','=','shop_category.cate_id')->get();

        //$data = CateInfo($ww);

//        foreach($data as $v){
//            if($v->goods_imgs){
//                $v->goods_imgs = explode('|',$v->goods_imgs);
//            }
//        }

        return view('goods/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $res = Cate::get();
        $data = CateInfo($res);
        return view('goods/create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $request->except('_token');

        if($request->hasFile('goods_img')) {
            $res['goods_img'] = upload('goods_img');
        }


            //多条件上传
            if(isset($res['goods_imgs'])) {
                $res['goods_imgs'] = up_do('goods_imgs');
                $res['goods_imgs'] = implode('|', $res['goods_imgs']);

            }
        $data = Goods::create($res);
        //dd($data);
        if($data){
            return redirect('goods/index');
        }

               //dd($res['goods_imgs']);



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = Cate::get();
        $data = CateInfo($res);
        $aa = Goods::where('goods_id',$id)->first();
        return view('goods/edit',['data'=>$data,'res'=>$aa]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = $request->except('_token');

        if($request->hasFile('goods_img')){
            $arr['goods_img'] = upload('goods_img');

        }
        if(isset($res['goods_imgs'])) {
            $res['goods_imgs'] = up_do('goods_imgs');
            $res['goods_imgs'] = implode('|', $res['goods_imgs']);
        }

        $data = Goods::where('goods_id',$id)->update($arr);

        if($data !==false){
            return redirect('goods/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $res = Goods::where('goods_id',$id)->delete();

        if($res){
            return redirect('goods/index');
        }
    }
}
