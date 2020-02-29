<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<form>
    <input type="text" name="name">
    <input type="text" name="class">
    <input type="submit" value="搜索">
</form>
<body>
    <table border="1">
            <tr>
               <td>id</td>
               <td>姓名</td>
               <td>班级</td>
               <td>成绩</td>
               <td>头像</td>
               <td>操作</td>
            </tr>
            @foreach($data as $k=>$v)
            <tr>
               <td>{{$v->id}}</td>
               <td>{{$v->name}}</td>
               <td>{{$v->class}}</td>
               <td>{{$v->cj}}</td>
               <td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="30">@endif</td>
               <td><a href="{{url('student/edit/'.$v->id)}}" class="btn btn-info">编辑</a>  <a href="{{url('student/destroy/'.$v->id)}}" class="btn btn-danger">删除</a></td>
            </tr>
            @endforeach


    </table>

    <tr><td>{{$data->appends(['name'=>$name,'class'=>$class])->links()}}</td></tr>
</body>
</html>