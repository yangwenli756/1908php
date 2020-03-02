@extends('layouts/shop')
@section('title', '首页')
@section('content')
<div class="head-top">
        <img src="/static/index/images/Slideshow-2800x1200-Xiao.jpg" />
        <dl>
            <dt><a href="user.html"><img src="/static/index/images/timg.jpg" /></a></dt>
            <dd>
                <h1 class="username">wh珠宝集团荣誉会员</h1>
                <ul>
                    <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
                    <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
                    <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
                    <div class="clearfix"></div>
                </ul>
            </dd>
            <div class="clearfix"></div>
        </dl>
    </div><!--head-top/-->
    <form action="#" method="get" class="search">
        <input type="text" class="seaText fl" />
        <input type="submit" value="搜索" class="seaSub fr" />
    </form><!--search/-->
    <ul class="reg-login-click">
        <li><a href="{{url('login')}}">登录</a></li>
        <li><a href="{{url('register')}}" class="rlbg">注册</a></li>
        <div class="clearfix"></div>
    </ul><!--reg-login-click/-->
    <div id="sliderA" class="slider">
        @foreach($res as $k=>$v11)
            <img src="{{env('UPLOAD_URL')}}{{$v11->goods_imgs}}">
            @endforeach
    </div><!--sliderA/-->
    <ul class="pronav">
        @foreach($data as $k=>$v2)
        <li><a href="{{url('prolist',$v2->b_id)}}">{{$v2->bname}}</a></li>
        @endforeach
        <div class="clearfix"></div>
    </ul><!--pronav/-->
    <div class="index-pro1">
        @foreach($res as $k=>$v)
        <div class="index-pro1-list">
            <dl>
                <dt><a href="{{url('proinfo',$v->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$v->goods_imgs}}" width="500"></a></dt>
                <dd class="ip-text"><a href="{{url('proinfo')}}">{{$v->goods_name}}</a><span>已售：488</span></dd>
                <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong> <span>¥19008</span></dd>

            </dl>
        </div>
        @endforeach
    </div><!--index-pro1/-->
    <div class="prolist">
        @foreach($res as $k=>$v1)
        <dl>
            <dt><a href="{{url('proinfo',$v1->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$v1->goods_imgs}}"></a></dt>
            <dd>
                <h3><a href="{{url('proinfo')}}">{{$v1->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v1->goods_price}}</strong> <span>¥599</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
            </dd>

            <div class="clearfix"></div>
        </dl>
            @endforeach

    </div><!--prolist/-->
    <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
    <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

@endsection