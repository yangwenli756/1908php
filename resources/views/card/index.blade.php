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
<center><h1>人口列表</h1></center>

<table class="table">
    <caption>上下文表格布局</caption>
    <thead>
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>用户身份</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($res as $k=>$v)
        <tr @if($k%2==0)class="active"@else class="success" @endif>
            <td>{{$v->uid}}</td>
            <td>{{$v->uname}}</td>
            <td>{{$v->ucard==1?'库管主管':'普通库管'}}</td>
            <td><a href="{{url('card/edits/'.$v->uid)}}" class="btn btn-info">编辑</a>  <a href="{{url('card/destroy/'.$v->uid)}}" class="btn btn-danger">删除</a></td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>