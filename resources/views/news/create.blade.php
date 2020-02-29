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
<center><h1>新闻添加</h1></center>
<form  action="{{url('/news/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

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
		<label for="firstname" class="col-sm-2 control-label">新闻标题</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="title" id="firstname" 
				   placeholder="请输入新闻标题">
			<b style="color:red;">{{$errors->first('title')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻分类</label>
		<div class="col-sm-4">
			<select name="cid">
               <option value="">--请选择--</option>
               @foreach($res as $k=>$v)
               <option value="{{$v->cid}}">{{$v->cname}}</option>
               @endforeach
			</select>
			<b style="color:red;">{{$errors->first('cid')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻重要性</label>
			<div class="radio">
    <label>
        <input type="radio" name="zy" id="optionsRadios1" value="1" >普通<br><br>
        <input type="radio" name="zy" id="optionsRadios1" value="2" checked>置顶
        <b style="color:red;">{{$errors->first('zy')}}</b>
    </label>
</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="radio">
    <label>
        <input type="radio" name="xs" id="optionsRadios1" value="1" >显示<br><br>
        <input type="radio" name="xs" id="optionsRadios1" value="2" checked>不显示
        <b style="color:red;">{{$errors->first('xs')}}</b>
    </label>
</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻作者</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="athor" id="firstname" 
				   >
		
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="email" id="firstname" 
				   >
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="gjz" id="firstname" 
				  >
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻描述</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="desc" id="firstname" 
				   placeholder="请输入新闻标题">
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" name="head" class="form-control"  
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default add">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script type="text/javascript">
jquery = $;
$(function(){
	$.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$(document).on('click','.add',function(){
		var titleflag = true;
		$('input[name="title"]').next().html('');
        var title = $('input[name="title"]').val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
         //alert(reg.test(title));
		if(!reg.test(title)){
         $(this).next().html('标题必须有数字字母下划线组成且必填');
         return;
		}
		

		$.ajax({
			type:'post',
			url:"/news/checkonly",
			data: {title:title},
			dataType: 'json',
			success: function (result) {
				if(result.count > 0){
					$( ' input[name="title"]' ).next(). html('标题已存在' );
					titleflag = false;
					}else{
						$('form').submit();
					}
					}
					})

		if(!titleflag){
           return;
		}
	});
	$('input[name="title"]').blur(function(){
        $(this).next().html('');
		var title = $(this).val();

		//正则验证标题必须由数字字母下划线组成

		var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

		if(!reg.test(title)){
         $(this).next().html('标题必须有数字字母下划线组成且必填');
		}
		return;
		
		//唯一性验证中增加csrf命令牌
		$.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        
		//唯一性验证的ajax请求
		$.ajax({
			type:'post',
			url:"/news/checkonly",
			data: {title:title},
			dataType: 'json',
			success: function (result) {
				if(result.count > 0){
					$( ' input[name="title"]' ).next(). html('标题已存在' );
					}else{
					$('form').submit();
				}
					}
					});
	});
	$('input[name="athor"]').blur(function(){

		$(this).next().html('');
		var athor = $(this).val();
        
		//正则验证标题必须由数字字母下划线组成

		var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

		if(!reg.test(athor)){
         $(this).next().html('作者必须有数字字母下划线组成且必填');
		}
		
	});
});

</script>

