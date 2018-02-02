<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Shopcart extends Model
{
    protected $table ='shopcart';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
}
