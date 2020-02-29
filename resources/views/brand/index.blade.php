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
<center><h1>品牌列表</h1></center>
  <table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌logo</th>
			<th>品牌描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->b_id}}</td>
			<td>{{$v->bname}}</td>
			<td>{{$v->url}}</td>
			<td>@if($v->logo)<img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="30" height="30">@endif</td>
			<td>{{$v->desc}}</td>
			
			<td><a href="{{url('brand/edit/'.$v->b_id)}}" class="btn btn-info">编辑</a>  <a href="{{url('brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a></td>
		</tr>
		@endforeach
		
	</tbody>
</table>

</body>
</html>