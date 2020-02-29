<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    <style>
        .aa{
            width:20px;
        }
    </style>
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/timg11.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>

    <div class="dingdanlist">
        <table>

            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allcheck" name="1" /> 全选</a></td>
            </tr>
            @foreach($res as $v)
            <tr goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}" class="aa">
                <td width="4%"><input type="checkbox" class="check" name="1" /></td>
                <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_imgs}}"></td>
                <td width="50%">
                    <h3>{{$v->goods_name}}</h3>
                    <time>下单时间:{{$v->add_time}}</time>
                </td>
                <td align="right">
                    <input type="button"  value="-" class="less">
                    <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number aa"/>
                    <input type="button" value="+" class="add">
                </td>
            </tr>
            <tr>
                <th colspan="4"><strong class="orange">¥{{$v->buy_number*$v->goods_price}}</strong></th>
            </tr>

                @endforeach
            <tr>
            <td width="100%" colspan="4"><a href="javascript:;" id="delMoney"> 删除</a></td>
            </tr>
        </table>
    </div><!--dingdanlist/-->
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
                <td width="40%"><a href="pay.html" class="jiesuan">去结算</a></td>
            </tr>
        </table>
    </div><!--gwcpiao/-->
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/index/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/index/js/bootstrap.min.js"></script>
<script src="/static/index/js/style.js"></script>
<!--jq加减-->
<script>

    jquery = $;

    $(function(){
        $.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        function changecolor(_this){
            _this.parents('tr').css('background-color','#ddd');
        }

        //点击加号
        $(document).on('click', '.add', function () {

            //文本框的值+1
            var _this = $(this);

            var buy_number = parseInt(_this.prev('input').val());

            var goods_num = parseInt(_this.parents('tr').attr('goods_num'));

            if (buy_number >= goods_num) {

                _this.prev('input').val(goods_num);
            } else {
                buy_number = buy_number + 1;

                _this.prev('input').val(buy_number);
            }

        })

        //点击减号
        $(document).on('click', '.less', function () {

            var _this = $(this);

            //文本框的值-1
            var buy_number = parseInt(_this.next('input').val());

            if (buy_number <= 1) {

                _this.next('input').val(1);

            } else {

                buy_number = buy_number - 1;

                _this.next('input').val(buy_number);
            }
        })
        //点击复选框
        $(document).on('click','.check',function(){
            var _this = $(this);

            var status = _this.prop('checked');

            if(status){
                changecolor(_this)

            }else{
                _this.parents('tr').css('background-color','white');
            }

            getmoney(_this);

        });
        //点击全选
        $(document).on('click','#allcheck',function(){
            var _this = $(this);

            var status = $('#allcheck').prop('checked');

            var aa = $('.check').prop('checked',status);

            _this.parent('tr').siblings("td").css('background-color','#ddd');

            getmoney(_this);
        });

        //统计总价
        function getmoney(_this){
            var check= $('.check:checked');

            if(check.length<1){
                $('#money').text('￥0');
                return false;
            }
            var goods_id="";
            check.each(function(index){
                goods_id+=$(this).parents('tr').attr('goods_id')+',';
            });
            goods_id = goods_id.substr(0,goods_id.length-1);

            $.ajax({
                type:'post',
                url:"/changemoney",
                data:{goods_id:goods_id},
                success:function(res){
                    $('#money').text('￥'+res);
                }
            });
        }
        //点击删除

        $(document).on('click','#delMoney',function(){

            var _this = $(this);
            var check = $('.check:checked');

            if(check.length<1){
                alert("请至少选择一件商品进行删除");
                return false;
            }
            var goods_id = '';
            check.each(function(index){
                goods_id += $(this).parents("tr").attr('goods_id')+',';
            })
            goods_id = goods_id.substr(0,goods_id.length-1);

            $.ajax({
                type:'post',
                url:"/cartdel",
                data:{goods_id:goods_id},
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        check.each(function(index){
                            alery($('.aa').html());
                        })
                    }else{
                        alert(res.font);
                    }
                }
            });

            getmoney(_this)
        });
    })


</script>
</body>
</html>