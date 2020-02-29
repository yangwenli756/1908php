<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table="shop_cart";

    protected  $primaryKey = "cart_id";

    //时间戳

    public $timestamps = false;

    //黑名单

    protected  $guarded = [];
}
