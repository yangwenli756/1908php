<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
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
        <img src="/static/index/images/head.jpg" />
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
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
            </tr>
            @foreach($res as $v)
            <tr>
                <td width="4%"><input type="checkbox" name="1" /></td>
                <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}"></td>
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
            <td width="100%" colspan="4"><a href="javascript:;"> 删除</a></td>
        </table>
    </div><!--dingdanlist/-->
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange">¥69.88</strong></td>
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
    })


</script>
</body>
</html>