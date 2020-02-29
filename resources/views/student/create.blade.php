<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <form action="{{url('student/store')}}" method="post" enctype="multipart/form-data">

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
       姓名：<input type="text" name="name"><br>
            <b style="color:red;">{{$errors->first('name')}}</b>
       班级：<input type="text" name="class">
      头像:<input type="file" name="head"><br>
       成绩：<input type="text" name="cj"><br>
            <b style="color:red;">{{$errors->first('cj')}}</b>
       性别：<input type="radio" name="sex" value="1" checked>男
             <input type="radio" name="sex" value="2">女
            <b style="color:red;">{{$errors->first('sex')}}</b>
       <input type="submit" name="" value="添加">
    </form>
</body>
</html>