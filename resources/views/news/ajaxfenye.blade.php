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
        <td><a href="{{url('news/edit/'.$v->id)}}" class="btn btn-info">编辑</a>  <a href="javascript:;" del_id = "{{$v->id}}"class="btn btn-danger  del">删除</a></td>
    </tr>
@endforeach
<tr><td colspan="5">{{$data->appends([$query])->links()}}</td></tr>