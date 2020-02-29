<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table="user";

    protected  $primaryKey = "u_id";

    //时间戳

    public $timestamps = false;

    //黑名单

    protected  $guarded = [];
}
