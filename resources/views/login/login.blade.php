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
<center><h1>登录页面</h1></center>
<form  action="{{url('/login/logindo')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

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
		<b style="color:red;">{{session('msg')}}</b>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="username" id="firstname" 
				   placeholder="请输入用户名">
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="password" id="firstname" 
				   placeholder="请输入密码">
			
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" name="" class="btn btn-default" value="登录">
		</div>
	</div>
</form>

</body>
</html>
