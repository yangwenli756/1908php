<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CardController extends Controller
{
    public function login(){
        return view('card/login');
    }
    public function logindo(Request $request){
        $data = $request->except('_token');

        $res = DB::table('card')->where($data)->first();

        $ucard = $request->ucard;

        if($res){
            session(['ucard'=>$ucard]);
            $request->session()->save();
            return redirect('card/index');
        }
    }

    public function index(){

        $res = DB::table('card')->get();
        return view('card/index',['res'=>$res]);
    }

    public function destroy($id){
         $ucard = session('ucard');
        if($ucard==1){
            $data = DB::table('card')->where('uid',$id)->delete();
            if($data){
                return redirect('card/index');
            }
        }else{
            echo "抱歉,您没有此权限";

        }
    }
    public function edits($id){
        $ucard = session('ucard');
        if($ucard==1){
            $res = DB::table('card')->where('uid',$id)->first();

            return view('card/edits',['res'=>$res]);
        }else{
            echo "抱歉，您没有此权限";

        }

    }

    public function update(Request $request,$id){
        $data = $request->except('_token');

        $data = DB::table('card')->where('uid',$id)->update($data);

        if($data !==false){
            return redirect('card/index');
        }
    }

}
