<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <form  action="{{url('/student/update',$res->id)}}" method="post" >

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
       姓名：<input type="text" name="name" value="{{$res->name}}"><br>
       班级：<input type="text" name="class" value="{{$res->class}}">
       成绩：<input type="text" name="cj" value="{{$res->cj}}"><br>
       <input type="submit" name="" value="修改">
    </form>
</body>
</html>