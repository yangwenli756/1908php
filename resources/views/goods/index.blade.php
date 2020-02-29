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
<center><h1>商品展示列表</h1></center>
  <table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>商品名称</th>
			<th>商品logo</th>
			<th>商品描述</th>
			<th>分类名称</th>
			<th>商品货号</th>
			<th>商品库存</th>
			<th>商品价格</th>
			<th>是否精品</th>
			<th>商品热卖</th>
			<th>商品相册</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->goods_name}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px"></td>
			<td>{{$v->goods_desc}}</td>
			<td>{{str_repeat("|-",$v->level*3)}}{{$v->cate_name}}</td>
			<th>{{$v->goods_score}}</th>
			<th>{{$v->goods_num}}</th>
			<th>{{$v->goods_price}}</th>
			<th>{{$v->is_best==1?'是':'否'}}</th>
			<th>{{$v->is_hot==1?'是':'否'}}</th>
			<th>

				@if(is_array($v->goods_imgs))

					@foreach($v->goods_imgs as $vv)
						<img src="{{env('UPLOAD_URL')}}{{$vv}}"width="30px;">
						@endforeach
					@endif

			</th>
			<td><a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>  <a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a></td>
		</tr>
		@endforeach
		
	</tbody>
</table>

</body>
</html>