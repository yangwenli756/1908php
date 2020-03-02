@extends('layouts/shop')
@section('title', '首页')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>收货地址</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <form action="{{url('/address_do')}}" method="post" class="reg-login">
        @csrf
        <div class="lrBox">
            <div class="lrList"><input type="text" name="name" placeholder="收货人" /></div>
            <div class="lrList"><input type="text" name="address" placeholder="详细地址" /></div>
            <div class="lrList">
                <select class="area" name="province">
                     @foreach($province as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                         @endforeach
                </select>
            </div>
            <div class="lrList">
                <select class="area" name="city">
                    <option value="0" class="aa">请选择--</option>
                </select>
            </div>
            <div class="lrList">
                <select class="area" name="area">
                    <option value="0" class="aa">请选择--</option>
                </select>
            </div>
            <div class="lrList"><input type="text" name="tel" placeholder="手机" /></div>
            <div class="lrList2"><input type="text" placeholder="设为默认地址" /> <button type="button">设为默认</button></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="保存" />
        </div>
    </form><!--reg-login/-->
    <script src="/static/index/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $(document).on('click','.area',function(){
                var _this = $(this);
                _this.nextAll('select').html("<option value='0' selected>--请选择--</option>");
                var id = _this.val();
                //alert(id);
                $.ajax({
                    type:'post',
                    data:{id:id},
                    url:"/getArea",
                    dataType:'json',
                    success:function(res){
                        var _option ="<option value='0' selected>--请选择--</option>";

                        for(var i in res){
                            _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>"
                        }
                          _this.parent('div').next('div').children('select').html(_option);
                    }
                });
            });
        });
    </script>
@endsection

