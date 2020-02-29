<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Goods;

use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name = request()->goods_name;
        $where = [];

        if($goods_name){
        $where[] = ['goods_name','like',"%$goods_name%"];
        }


        $aa = Goods::where($where)->get();

        $data = CateInfo($aa);
        return view('goods/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('shop_category')->get();
        $data =CateInfo($res);
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
        $data = $request->except('_token');

        //dd($data);

        $res = Goods::insert($data);

        if($res){
        return redirect('goods/index');
        }
    }

    public function checkonly(){
        $goods_name = request()->goods_name;
        $n_id = request()->n_id;
        //dd($goods_name);
        if($goods_name){
        $where[] = ['cate_name','=',$goods_name];
        }
        if($n_id){
            $where[] = ['cate_id','!=',$n_id];
        }
        
        $count = Goods::where($where)->count();
         
        echo json_encode(['code'=>'00000','font'=>'ok','count'=>$count]);
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
        $data = Goods::first();
        $aa = DB::table('shop_category')->get();
        $res =CateInfo($aa);
        return view('goods/edit',['data'=>$data,'res'=>$res]);
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
        $res = $request->except('_token');

        $data = Goods::where('cate_id',$id)->update($res);

        //dd($data);

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
        $count = Goods::where('pid',$id)->count();
        if($count>0){
          echo "次分类下的子id不能删除";die;
        }else{
            $res = Goods::where('cate_id',$id)->delete();

            if($res){
                return redirect('goods/index');
            }
        }

    }
}
