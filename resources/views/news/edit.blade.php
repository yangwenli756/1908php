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
<center><h1>文章添加</h1></center>
<form  action="{{url('/news/update',$res->id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

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
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" value="{{$res->title}}" name="title" id="firstname" 
				   placeholder="请输入文章标题">
			<b style="color:red;">{{$errors->first('title')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-4">
			<select name="cid">
               <option value="">--请选择--</option>
               @foreach($data as $k=>$v)
               <option value="{{$v->cid}}" @if($v->cid==$res->cid) selected="selected" @endif>{{$v->cname}}</option>
               @endforeach
			</select>
			<b style="color:red;">{{$errors->first('cid')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
			<div class="radio">
    <label>
        <input type="radio" name="zy" id="optionsRadios1" value="1" @if($res->zy==1) checked @endif>普通<br><br>
        <input type="radio" name="zy" id="optionsRadios1" value="2" @if($res->zy==2) checked @endif>置顶
        <b style="color:red;">{{$errors->first('zy')}}</b>
    </label>
</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="radio">
    <label>
        <input type="radio" name="xs" id="optionsRadios1" value="1" @if($res->xs==1) checked @endif>显示<br><br>
        <input type="radio" name="xs" id="optionsRadios1" value="2" @if($res->xs==2) checked @endif>不显示
        <b style="color:red;">{{$errors->first('xs')}}</b>
    </label>
</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="athor" value="{{$res->athor}}" id="firstname" 
				   >
		
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="email" value="{{$res->email}}" id="firstname" 
				   >
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="gjz" value="{{$res->gjz}}" id="firstname" 
				  >
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章描述</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="desc" value="{{$res->desc}}" id="firstname" 
				   placeholder="请输入文章标题">
			
		</div>
	</div>
	<div class="form-group">
		<img src="{{env('UPLOAD_URL')}}{{$res->head}}" width="30" height="30">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" name="head" class="form-control"  
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default add">修改</button>
		</div>
	</div>
</form>

</body>
</html>
<script type="text/javascript">
jquery = $;
$(function(){
	$.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	var n_id = {{$res->id}};
	$(document).on('click','.add',function(){
		var titleflag = true;
		$('input[name="title"]').next().html('');
        var title = $('input[name="title"]').val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
         //alert(reg.test(title));
		if(!reg.test(title)){
           $(this).next().html('标题必须有数字字母下划线组成且必填');
		   }
		

		$.ajax({
				type:'post',
				url:"/news/checkonly",
				data: {title:title,n_id:n_id},
				dataType: 'json',
				success: function (result) {
					if(result.count > 0){
						$( ' input[name="title"]' ).next(). html('标题已存在' );
						titleflag = false;
						}else{
							location.href="{{url('news/index')}}";
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
					}
					}
					});
		return;
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

