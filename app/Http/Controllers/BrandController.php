<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::get();

        return view('brand/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/create');
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

        if($request->hasFile('logo')){
           $data['logo'] = $this->upload('logo');
        }

        $res =  Brand::insert($data);

        if($res){
           return redirect('brand/index');
        }     
    }

    public function upload($filename){
      if(request()->file($filename)->isValid()){
          //接收值
          $photo = request()->file($filename);
          //上传
          $store_result = $photo->store('uploads');

          return $store_result;
        }
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
        $res = Brand::find($id);
        return view('brand/edit',['res'=>$res]);
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
        $data = $request->except('_token');

        if($request->hasFile('logo')){
           $data['logo'] = $this->upload('logo');
        }

        $res =  Brand::where('b_id',$id)->update($data);

        if($res!==false){
           return redirect('brand/index');
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
        $res = Brand::destroy($id);

        if($res){
        return redirect('brand/index');
        }
    }
}
