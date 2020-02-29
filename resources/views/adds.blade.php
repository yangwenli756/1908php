{{$fid}}
<form method="post" action="{{route('do')}}">
@csrf
<h1>分类添加</h1>
<input type="text" name="name">
<input type="text" name="age">
<input type="submit" name="" value="添加">
</form>