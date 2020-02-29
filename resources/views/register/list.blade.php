<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>管理人员列表</h1></center>

<table class="table">

    <thead>
    <tr>
        <th>id</th>
        <th>姓名</th>
        <th>密码</th>
        <th>头像</th>
        <th>手机号</th>
        <th>邮箱</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($res as $k=>$v)
        <tr @if($k%2==0)class="active"@else class="success" @endif>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->password}}</td>
            <td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="30" height="30">@endif</td>
            <td>{{$v->tel}}</td>
            <td>{{$v->email}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td><a href="{{url('register/edit/'.$v->id)}}" class="btn btn-info">编辑</a>  <a href="{{url('register/destroy/'.$v->id)}}" class="btn btn-danger">删除</a></td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>