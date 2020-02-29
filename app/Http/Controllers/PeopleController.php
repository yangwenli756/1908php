<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\People;

use App\Http\Requests\StorePeoplePost;

use Validator;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = DB::table('people')->get();
        $username = request()->username;

        $where = [];

        if( $username ){
            $where[] = ['username','like',"%$username%"];
        }

        $pagesize = config('app.pagesize');
        $data = People::where($where)->orderby('p_id','desc')->paginate($pagesize);
        //dd($data);
        return view('people/index',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //public function  store(StorePeoplePost $request)
    {
        $data = $request->except('_token');
        //第一种验证

//        $request->validate([
//            'username' => 'required|unique:people|max:3|min:1',
//            'age'=>'required|min:1|max:3',
//            'card'=>'required|min:1|max:11'
//             ],[
//            'username.required'=>'名字必填',
//            'username.unique'=>'名字已存在',
//            'age.required'=>'年龄必填',
//            'card.required'=>'身份证号必填',
//            'card.min'=>'身份证不合法',
//            'card.max'=>'身份证不合法',
//            'age.min'=>'年龄不合法',
//            'age.max'=>'年龄不合法',
//        ]);

        //dd($data);
        //第三种验证
        $Validator = Validator::make($data,[
            'username' => 'required|unique:people|max:9|min:1',
            'age'=>'required|integer|between:1,130',
            'card'=>'required|between:1,11'
        ],[
            'username.required'=>'名字必填',
            'username.unique'=>'名字已存在',
            'age.required'=>'年龄必填',
            'card.required'=>'身份证号必填',
            'card.between'=>'身份证不合法',

            'age.between'=>'年龄不合法',
        ]);
        if($Validator->fails()){
         return redirect('people/create')
                 ->withErrors($Validator)
                 ->withInput();
        }
        //文件上传
        if($request->hasFile('head')){
           $data['head'] = $this->upload('head');
           
        }

        $data['add_time'] = time();

       // $res = DB::table('people')->insert($data);
       $res = People::create($data);

        if($res){
          return redirect('people/index');
        }
    }

    public function upload($filename){
        //判断接收过程是否有误
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
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$res = DB::table('people')->where('p_id',$id)->first();

        $res = People::where('p_id',$id)->first();
        //
        // $res =  People::find($id);

        return view('/people/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = $request->except('_token');

          $Validator = Validator::make($arr,[
            ['username' => "Rule::unique('people')->ignore($id,p_id)"],
            'age'=>'required|integer|between:1,130',
            'card'=>'required|between:1,11'
        ],[
            'username.required'=>'名字必填',
            'username.unique'=>'名字已存在',
            'age.required'=>'年龄必填',
            'card.required'=>'身份证号必填',
            'card.between'=>'身份证不合法',

            'age.between'=>'年龄不合法',
        ]);
        if($Validator->fails()){
         return redirect('people/edit')
                 ->withErrors($Validator)
                 ->withInput();
        }
          //dd($arr);
        if($request->hasFile('head')){
           $arr['head'] = $this->upload('head');
           
        }
        //$data = DB::table('people')->where('p_id',$id)->update($arr);
        $data = People::where('p_id',$id)->update($arr);

        if($data !==false){
         return redirect('people/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //$res = DB::table('people')->where('p_id',$id)->delete();
         //
         $res = People::destroy($id);

        if($res){
          return redirect('people/index');
        }
    }
}
