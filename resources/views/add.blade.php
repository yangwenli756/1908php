<form method="post" action="{{url('/adddo')}}">
@csrf
<h1>商品添加</h1>
<input type="text" name="name">
<input type="text" name="age">
<input type="submit" name="" value="添加">
</form>