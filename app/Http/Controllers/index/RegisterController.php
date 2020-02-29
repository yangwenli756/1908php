<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Users;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;


class RegisterController extends Controller
{
    public function register(){
        return view('index/register');
    }

    public function register_do(Request $request){


        $res = $request->except('_token');

        $code = session('u_code');

        //dd($code);

        //dd($res['u_code']);

        if($res['u_code']==$code['code']){
            return redirect('/register')->with('msg','验证码不正确');
        }

        if($res['u_pwd1'] != $res['u_pwd']){
            return redirect('/register')->with('msg','两次密码不一致');
        }
        $data = Users::create($res);

        if($data){
            return redirect('login');
        }
    }

    public function ajaxsend(Request $request){
        //接受注册页面的手机号
        //$moblie = '15100004146';
        $moblie = $request->u_tel;

        $code = rand(1000,9999);

        $res = $this->sendsms($moblie,$code);

        if( $res['Code']=='OK') {
            session(['u_code' => $code]);
             request()->session()->save();

            echo "发送成功";

        }else{
            echo "no";


        }

        }


    public function sendsms($moblie,$code){

        AlibabaCloud::accessKeyClient('LTAI4Fg7xPua1MvEazdskggD', 'mlKaootUy5s0qydZK71U6JYmhWVSFJ')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $moblie,
                        'SignName' => "乐柠",
                        'TemplateCode' => "SMS_184120240",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage();
        } catch (ServerException $e) {
            return $e->getErrorMessage();
        }
    }
}
