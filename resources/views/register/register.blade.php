<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center><h1>管理员的注册</h1></center>
<form  action="{{url('/register/registerdo')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

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
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员名字</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="username" id="firstname"
                   placeholder="请输入名字">
            <b style="color:red;">{{$errors->first('username')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="password" id="firstname"
                   placeholder="请输入密码">
            <b style="color:red;">{{$errors->first('password')}}</b>
        </div>
    </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="pass" id="firstname"
                       placeholder="请输入密码">
                <b style="color:red;">{{$errors->first('pass')}}</b>
            </div>
        </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="tel" id="firstname"
                   placeholder="请输入手机号">
            <b style="color:red;">{{$errors->first('tel')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-8">
            <input type="text" name="email" class="form-control"
            >
        </div>
    </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">头像</label>
            <div class="col-sm-8">
                <input type="file" name="head" class="form-control"
                >
            </div>
        </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">注册</button>
        </div>
    </div>
</form>

</body>
</html>
<script type="text/javascript">
    jquery = $;
    $(function(){
    $.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('input[name="username"]').blur(function(){
            $('input[name="username"]').next().html('');
           var username = $('input[name="username"]').val();
            if(!username){
                $('input[name="username"]').next().html('姓名必填');
            }

            $.ajax({
                type:'post',
                url:"/register/checkonly",
                data: {username:username},
                dataType: 'json',
                success: function (result) {
                    if(result.count > 0){
                        $('input[name="username"]').next().html('标题已存在' );
                    }else{
                        $('form').submit();
                    }
                }
            })
   });

        $('input[name="password"]').blur(function(){
            $('input[name="password"]').next().html('');
            var password = $('input[name="password"]').val();
            if(!password){
                $('input[name="password"]').next().html('密码必填');
            }
        });
        $('input[name="tel"]').blur(function(){
            $('input[name="tel"]').next().html('');
            var tel = $('input[name="tel"]').val();
            if(!tel){
                $('input[name="tel"]').next().html('手机号必填');
            }
        });

        $('input[name="pass"]').blur(function(){
            var password = $('input[name="password"]').val();
            var pass = $('input[name="pass"]').val();

            if(pass==password){
             $('input[name="pass"]').next().html('√');
            }else{
                $('input[name="pass"]').next().html('两次密码不一致');
            }
        });

    })
</script>