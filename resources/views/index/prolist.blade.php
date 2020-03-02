@extends('layouts/shop')
@section('title', '首页')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <form action="#" method="get" class="prosearch"><input type="text" /></form>
        </div>
    </header>
    <ul class="pro-select">
        <li class="pro-selCur"><a href="javascript:;">新品</a></li>
        <li><a href="javascript:;">销量</a></li>
        <li><a href="javascript:;">价格</a></li>
    </ul><!--pro-select/-->
    <div class="prolist">
        @foreach($res as $v)
        <dl>
            <dt><a href="{{url('proinfo')}}">
                    @if(is_array($aa))

                        @foreach($aa as $vv)
                            <img src="{{env('UPLOAD_URL')}}{{$vv}}"width="100px;" >
                        @endforeach
                    @endif
                </a></dt>
            <dd>
                <h3><a href="proinfo.html">{{$v->bname}}</a></h3>
                <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
            </dd>
            <div class="clearfix"></div>
        </dl>
            @endforeach
    </div><!--prolist/-->
    @endsection
