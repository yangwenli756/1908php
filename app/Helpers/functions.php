<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}
//无限极分类
function CateInfo($res,$pid=0,$level=1){
    static $info=[];

    foreach($res as $k=>$v){
        if($v->pid==$pid){
            $v->level=$level;
            $info[]=$v;
            CateInfo($res,$v->cate_id,$v->level+1);
        }
    }
    return $info;
}
//单文件上传
 function upload($filename){
    if(request()->file($filename)->isValid()){
        $photo = request()->file($filename);
        $store_result = $photo->store('uploads');
        return $store_result;
    }
}

//多文件上传
 function up_do($filename)
{
    $data = request()->file($filename);
    //dd($data);die();
    $arr = [];
    foreach($data as $k => $v)
    {
        if ($v->isValid()) {
            $arr[] = $v->store('uploads');
        }

    }
    return $arr;
}
