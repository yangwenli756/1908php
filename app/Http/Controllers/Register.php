<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Login;

class Register extends Controller
{
    public function register(){
        return view('register/register');
    }
    public function registerdo(Request $request){
        $data = $request->except('_token');

        if($request->hasFile('head')){
            $data['head'] = upload('head');
        }

        $data['password'] =  encrypt($data['password']);
        $data['pass'] =  encrypt($data['pass']);
        $res = Login::insert($data);
        //dump($res);die;
        if($res){
            return redirect('register/index');
        }
    }
    public function checkonly(){
        $username = request()->username;

        //$n_id = request()->n_id;

        if($username){
            $where[] = ['username','=',$username];
        }
        // dd($title);
        //$count = News::where($where)->count();

        //\DB::connection()->enableQueryLog();
        $count = Login::where($where)->count();
        //$logs = \DB::getQueryLog();
        // dd($logs);


        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    public function index(){
        $res = Login::get();
        return view('register/list',['res'=>$res]);
    }
    public function edit(Request $request,$id){
        $data = Login::where('id',$id)->first();

      return view('register/edit',['data'=>$data]);
    }
    public function update(Request $request,$id){

        $res = $request->except('_token');

        if($request->hasFile('head')){
            $res['head'] = upload('head');
        }


        $data = Login::where('id',$id)->update($res);

        if($data!==false){
            return redirect('register/index');
        }

    }
    public function destroy(Request $request,$id){
      $res = Login::where('id',$id)->delete();
        if($res){
            return redirect('register/index');
        }
    }
}
