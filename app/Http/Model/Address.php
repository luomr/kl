<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性,为空表示数据表中的所有字段可以被赋值
}
