<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
     protected $table="admin";

    protected  $primaryKey = "id";

    //时间戳

    public $timestamps = false;

    //黑名单
    protected  $guarded = [];
}
