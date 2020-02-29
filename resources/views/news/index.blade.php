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
<center><h1>文章列表</h1></center>
<form>
 <input type="text" name="title" >
 <select name="cid">
               <option value="">--请选择--</option>
               @foreach($res as $k=>$v)
               <option value="{{$v->cid}}">{{$v->cname}}</option>
               @endforeach
			</select>
			<input type="submit" name="" value="搜索">
</form>

  <table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>是否重要</th>
			<th>是否显示</th>
			<th>文章作者</th>
			<th>文章email</th>
			<th>关键字</th>
			<th>文章描述</th>
			<th>文件</th>
			<th>添加日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->cname}}</td>
			<td>{{$v->zy==1?'普通':'置顶'}}</td>
			<td>{{$v->xs==1?'√':'×'}}</td>
			<td>{{$v->athor}}</td>
			<td>{{$v->email}}</td>
			<td>{{$v->gjz}}</td>
			<td>{{$v->desc}}</td>
			<td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="30" height="30">@endif</td>
			<td>{{date('Y-m-d H:i:s',$v->time)}}</td>
			<td>
				<a href="{{url('news/show/'.$v->id)}}" class="btn btn-danger  del">预览</a>
				<a href="{{url('news/edit/'.$v->id)}}" class="btn btn-info">编辑</a>
				<a href="javascript:;" del_id = "{{$v->id}}"class="btn btn-danger  del">删除</a></td>
		</tr>
		@endforeach
		<tr><td colspan="5">{{$data->appends([$query])->links()}}</td></tr>
</table>
</body>
</html>
<script type="text/javascript">
jquery = $;


$(function(){
   $(document).on('click','.del',function(){
      var id = $(this).attr('del_id');
      $.ajax({ 
                url: "{{url('news/destroy')}}", 
                type: "get",
                data:{id:id},
                success:function(data){
                    if(data=='ok'){
                    	location.href="{{url('news/index')}}";
                    }
             }});
   
   });

	$(document).on('click','.pagination a',function(){
		var url = $(this).attr('href');
		if(!url){
			return;
		}
		$.get(url,function(result){
			$('tbody').html(result);
		});
		return false;
	});


});
</script>