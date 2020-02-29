@extends('layouts/shop')
@section('title', '首页')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        @foreach($data as $v)
            <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}">
            @endforeach
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            @foreach($data as $vvv)
            <th><strong class="orange">{{$vvv->goods_price}}</strong></th>
            @endforeach
            <td>
                <input type="text" class="spinnerExample aa" />
            </td>
        </tr>
        @foreach($data as $k=>$v1)
        <tr>
            <td>
                <strong>{{$v1->goods_name}}</strong>
                <p class="hui">{{$v1->goods_desc}}</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
            @endforeach
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <span>浏览量为：{{$count}}</span>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        @foreach($data as $v1)
        <img src="{{env('UPLOAD_URL')}}{{$v1->goods_img}}" width="636" height="822" />
            @endforeach
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        @foreach($data as $vv)
        <tr>
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a href="javascript:;" class="bb" goods_id="{{$vv->goods_id}}">加入购物车</a></td>
        </tr>
            @endforeach
    </table>
</div><!--maincont-->
@endsection
<script src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $(document).on('click','.bb',function(){
            var goods_id = $(this).attr('goods_id');
            var buy_number = $('.aa').val();
            $.ajax({
                type:'get',
                data:{goods_id:goods_id,buy_number:buy_number},
                url:"/addcar",
                success:function(res){
                    alert(res);
                    location.href="{{url('car')}}";
                }
            });

        });
    })
</script>
