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
<center><h1>商品添加</h1></center>
<form  action="{{url('/goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

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
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="goods_name" id="firstname"
				   placeholder="请输入商品名称">
			<b style="color:red;">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-4">
			<select name="cate_id">
				<option value="">--请选择--</option>
				@foreach($data as $k=>$v)
					<option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level*2)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
			<b style="color:red;">{{$errors->first('cate_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-4">
			<textarea name="goods_desc"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" name="goods_img" class="form-control"
			>
		</div>
	</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">商品货号</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="goods_score" id="firstname"
					   placeholder="请输入商品货号">
				<b style="color:red;">{{$errors->first('goods_num')}}</b>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">商品价格</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="goods_price" id="firstname"
					   placeholder="请输入商品价格">
				<b style="color:red;">{{$errors->first('goods_price')}}</b>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">商品库存</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="goods_num" id="firstname"
					   placeholder="请输入商品库存">
				<b style="color:red;">{{$errors->first('goods_num')}}</b>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">是否精品</label>
			<div class="radio">
				<label>
					<input type="radio" name="is_best" id="optionsRadios1" value="1" >是<br><br>
					<input type="radio" name="is_best" id="optionsRadios1" value="2" checked>否

				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">是否热销</label>
			<div class="radio">
				<label>
					<input type="radio" name="is_hot" id="optionsRadios1" value="1" >是<br><br>
					<input type="radio" name="is_hot" id="optionsRadios1" value="2" checked>否

				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">商品相册</label>
			<div class="col-sm-8">
				<input type="file" multiple="multiple" name="goods_imgs[]" class="form-control"
				>
			</div>
		</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default add">添加</button>
		</div>
	</div>
</form>

</body>
</html>
{{--<script type="text/javascript">--}}
	{{--jquery = $;--}}
	{{--$(function(){--}}
		{{--$.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});--}}
		{{--$(document).on('click','.add',function(){--}}
			{{--var titleflag = true;--}}
			{{--$('input[name="title"]').next().html('');--}}
			{{--var title = $('input[name="title"]').val();--}}
			{{--var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;--}}
			{{--//alert(reg.test(title));--}}
			{{--if(!reg.test(title)){--}}
				{{--$(this).next().html('标题必须有数字字母下划线组成且必填');--}}
				{{--return;--}}
			{{--}--}}


			{{--$.ajax({--}}
				{{--type:'post',--}}
				{{--url:"/news/checkonly",--}}
				{{--data: {title:title},--}}
				{{--dataType: 'json',--}}
				{{--success: function (result) {--}}
					{{--if(result.count > 0){--}}
						{{--$( ' input[name="title"]' ).next(). html('标题已存在' );--}}
						{{--titleflag = false;--}}
					{{--}else{--}}
						{{--$('form').submit();--}}
					{{--}--}}
				{{--}--}}
			{{--})--}}

			{{--if(!titleflag){--}}
				{{--return;--}}
			{{--}--}}
		{{--});--}}
		{{--$('input[name="title"]').blur(function(){--}}
			{{--$(this).next().html('');--}}
			{{--var title = $(this).val();--}}

			{{--//正则验证标题必须由数字字母下划线组成--}}

			{{--var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;--}}

			{{--if(!reg.test(title)){--}}
				{{--$(this).next().html('标题必须有数字字母下划线组成且必填');--}}
			{{--}--}}
			{{--return;--}}

			{{--//唯一性验证中增加csrf命令牌--}}
			{{--$.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});--}}

			{{--//唯一性验证的ajax请求--}}
			{{--$.ajax({--}}
				{{--type:'post',--}}
				{{--url:"/news/checkonly",--}}
				{{--data: {title:title},--}}
				{{--dataType: 'json',--}}
				{{--success: function (result) {--}}
					{{--if(result.count > 0){--}}
						{{--$( ' input[name="title"]' ).next(). html('标题已存在' );--}}
					{{--}else{--}}
						{{--$('form').submit();--}}
					{{--}--}}
				{{--}--}}
			{{--});--}}
		{{--});--}}
		{{--$('input[name="athor"]').blur(function(){--}}

			{{--$(this).next().html('');--}}
			{{--var athor = $(this).val();--}}

			{{--//正则验证标题必须由数字字母下划线组成--}}

			{{--var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;--}}

			{{--if(!reg.test(athor)){--}}
				{{--$(this).next().html('作者必须有数字字母下划线组成且必填');--}}
			{{--}--}}

		{{--});--}}
	{{--});--}}

{{--</script>--}}

