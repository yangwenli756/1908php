<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table="people";

    protected  $primaryKey = "p_id";

    //时间戳

    public $timestamps = false;

    //黑名单
    protected  $guarded = [];
}
