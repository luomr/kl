<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //模型初始化
    protected $table = 'banner';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
}
