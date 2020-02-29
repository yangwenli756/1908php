<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Validation\Rule;

use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->name;

        $class=request()->class;

        $where = [];

        if($name){
            $where[] = ['name','like',"%$name%"];
        }
        if($class){
            $where[] = ['class','like',"%$class%"];
        }
        $data = DB::table('student')->where($where)->paginate(2);
        return view('student/index',['data'=>$data,'name'=>$name,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $res = DB::table('class')->get();
        return view('student/create',['res'=>$res]);
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

        $Validator = Validator::make($data,[
            'name' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u|unique:student',
            'sex'=>'required|numeric',
            'cj'=>'required|numeric|between:1,100',
        ],[
            'name.required'=>'名字必填',
            'name.unique'=>'名字已存在',
            'cj.required'=>'成绩必填',
            'sex.required'=>'性别必填',
            'name.regex'=>'名字必须由数字中文字母下划线组成',
             'sex.numeric'=>'必须是数字类型',
            'cj.between'=>'成绩不能超过100分',
        ]);
        if($Validator->fails()){
            return redirect('student/create')
                ->withErrors($Validator)
                ->withInput();
        }

        if($request->hasFile('head')){
            $data['head'] = $this->upload('head');
        }
        
        $res = DB::table('student')->insert($data);

        if($res){
            return redirect('student/index');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
          $photo = request()->file($filename);
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
        
        $res = DB::table('student')->where('id',$id)->first();
        $data = DB::table('class')->get();

        return view('/student/edit',['res'=>$res,'data'=>$data]);
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
           $validator = Validator::make($data, [
            'name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('student')->ignore($id, 'id'),
                ],
            'cj'=>'required|numeric|between:0,100',
        ], [
            'name.regex'=>'名称必须是中文由数字字母下划线组成且在2到12位',
            'name.required'=>'名称不能为空',
            'name.unique'=>'姓名已存在',
            'cj.between'=>'成绩不能超过100分',
            'cj.required'=>'成绩必填',
        
        ]);

        if($validator->fails()){
            return redirect('student/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $res = DB::table('student')->where('id',$id)->update($data);

        if($res!==false){
            return redirect('student/index');
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
        $res = DB::table('student')->where('id',$id)->delete();

         if($res){
            return redirect('student/index');
        }
    }
}
