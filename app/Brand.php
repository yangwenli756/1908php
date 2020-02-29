<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brand";

    protected  $primaryKey = "b_id";

    //时间戳

    public $timestamps = false;

    //黑名单
    protected  $guarded = [];
}
