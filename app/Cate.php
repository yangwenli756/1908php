<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table="shop_category";

    protected  $primaryKey = "cate_id";

    //时间戳

    public $timestamps = false;

    //黑名单

    protected  $guarded = [];
}
