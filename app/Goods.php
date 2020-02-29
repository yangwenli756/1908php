<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table="shop_goods";

    protected  $primaryKey = "goods_id";

    //时间戳

    public $timestamps = false;

    //黑名单

    protected  $guarded = [];
}
