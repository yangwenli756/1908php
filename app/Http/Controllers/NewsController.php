<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\News;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\Cache ;

use Illuminate\Support\Facades\Redis;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $cid = $request->cid;
        $where = [];

        if($title){
        $where[] = ['title','like',"%$title%"];
        }
        if($cid){
         $where[] = ['news.cid','=',$cid];
        }
        //清缓冲数据
        //Cache::flush();
        $query = request()->all();
        $page = request()->page??1;
        echo 'news_'.$page.'_'.$title.'_'.$cid;
        //获取缓冲的值
        $data = Redis::get('news_'.$page.'_'.$title.'_'.$cid);
        dump($data);
        $res = cache('res');
        if(!$res){
            $res = DB::table('type')->get();
            cache(['res'=>$res],60*60*24);
        }
        //dump($data);
        if(!$data) {
            echo "走DB";
            $data = DB::table('news')
                ->leftjoin('type', 'type.cid', '=', 'news.cid')
                ->where($where)
                ->paginate(2);
            $data = serialize($data);
            Redis::setex('news_'.$page.'_'.$title.'_'.$cid, 20 ,$data);
        }
        //dd($data);

            $data = unserialize($data);


        if (request()->ajax()){
            return view('news/ajaxfenye',['data'=>$data,'res'=>$res,'title'=>$title,'cid'=>$cid,'query'=>$query]);
        }
            return view('news/index',['data'=>$data,'res'=>$res,'title'=>$title,'cid'=>$cid,'query'=>$query]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('type')->get();


        return view('news/create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        // $Validator = Validator::make($data,[
        //     'title' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]$/u|unique:news',
        //     'cid'=>'required',
        //     'xs'=>'required',
        //     'zy'=>'required',
        // ],[
        //     'title.required'=>'标题必填',
        //     'title.unique'=>'标题已存在',
        //     'title.regex'=>'标题必须有数字字母下划线组成',
        //     'cid.required'=>'分类必填',
        //     'xs.required'=>'是否显示必填',
        //     'zy.required'=>'是否重要必填',

        // ]);
        // if($Validator->fails()){
        //     return redirect('news/create')
        //         ->withErrors($Validator)
        //         ->withInput();
        // }

        if($request->hasFile('head')){
         $data['head'] = upload('head');

         $data['time'] = time();

         $res = News::create($data);

         if($res){
          return redirect('news/index');
         }
        }
        
    }

    public function checkonly(){
        $title = request()->title;

        $n_id = request()->n_id;

        if($n_id){
          $where[] = ['id','!=',$n_id];
        }

        if($title){
         $where[] = ['title','=',$title];
        }
       // dd($title);
        //$count = News::where($where)->count();

        //\DB::connection()->enableQueryLog();
        $count = News::where($where)->count();
         //$logs = \DB::getQueryLog();
        // dd($logs);


        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //redis实现浏览量的自增
        $count = Redis::setnx('num_'.$id,1);

        if(!$count){
           $count =  Redis::incr('num_'.$id);
        }

        $data = News::find($id);

        return view('news/show',['data'=>$data,'count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = News::where('id',$id)->first();
        $data = DB::table('type')->get();
        return view('news/edit',['res'=>$res,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
          

        $res = DB::table('news')->where('id',$id)->update($data);

        if($res!==false){
            return redirect('news/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->except('_token');
        
         $res = News::where('id',$id)->delete();

         if($res){
             echo "ok";
         }else{
            echo "no";
         }
        
    }
}

// 1.composer是一个命令行工具 他的作用是帮你为项目自动安装所依赖的开发包
// 2.命名空间的关键字namespace  目的是我们的代码可能和别人的代码使用相同的类名、函数或常量名，如果不使用命名空间，名称会起冲突，导致PHP出错
// 3.ORM是对象关系映射 ORM是为了解决面向对象和数据库不匹配的现象
// 4.创建php php artisan make:Controller
//   创建model php artisan make:model 
//   执行回滚 php artisan migrate:rollback
// 5.Route::get('/show', 'UsersController@index');
//   Route::get('/', function () {
 
//     return view('welcome',['name'=>$name]);
//   });
//   三种写法
// 6.route()　路由辅助函数，可以方便引用和使用路由
//   dd() 打印并直接终止
//   request() 接收数据
//   redirect() 跳转
//   action()  函数为指定的控制器动作生成一个 URL

// 7.写出linux下赋权限的命令是chmod  777代表有读、写、执行权限
// 8.路由分组是当路由前面的都是一样的， 可以省略，可以少写一些url路径

// 9.数组有array_key 获取数组的下标  array_val  获取数组的值 is_arrwy 是否是数组  in_array 是否在数组里  explode 将数组截成字符串

// 10.mkdir：创建目录的命令  vim 创建文件  打印出当前所在目录pwd  清屏  clear  切换目录  cd 目录名
