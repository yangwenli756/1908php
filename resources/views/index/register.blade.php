@extends('layouts/shop')
@section('title', '注册')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <form  action="{{url('register_do')}}" method="post" class="reg-login">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <b style="color:red;">{{session('msg')}}</b>

        <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text"  name="u_tel" placeholder="输入手机号码或者邮箱号" /></div>
            <div class="lrList2"><input type="text" name="u_code" placeholder="输入短信验证码" /><button   type="button" class="hmac" >获取验证码</button> </div>
            <div class="lrList"><input type="password" name="u_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
            <div class="lrList"><input type="password" name="u_pwd1" placeholder="再次输入密码" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="立即注册" />
        </div>
    </form><!--reg-login/-->
@endsection
<script src="/static/js/jquery.min.js"></script>
<script >
    $(function(){
        $('.hmac').on('click',function(){
            var u_tel = $('input[name="u_tel"]').val();
            //alert(tel);
            $.get('/ajaxsend',{u_tel:u_tel},function(res){
                alert(res);
            });
            var that = $(this);
            var timeo = 60;
            var time1 = $('.hmac').html();
            if(time1){
                $('.hmac').html('60');
            }
            var timestop = setInterval(function(){

                if(timeo>0){
                    timeo--;
                    that.text('重新发送' + timeo +'s');
                    that.attr('disabled','disabled');
                }else{
                    timeo = 60;
                    that.text('获取验证码');
                    clearInterval(timestop);
                    that.removeAttr('disabled');
                }
            },1000)
        });
        $('input[name="u_pwd1"]').blur(function(){
            $('input[name="u_pwd1"]').next().html('');

            var u_pwd = $('input[name="u_pwd"]').val();
            var u_pwd1 = $('input[name="u_pwd1"]').val();

            if(u_pwd1==u_pwd){
                $('input[name="u_pwd1"]').next().html('√');
            }else{
                $('input[name="u_pwd1"]').next().html('两次密码必须一致');
            }

        });




    })

</script>