<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     protected $table="news";

    protected  $primaryKey = "id";

    //时间戳

    public $timestamps = false;

    //黑名单
    protected  $guarded = [];
}
