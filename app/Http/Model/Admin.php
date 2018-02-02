<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
    //访问器
    public function getroleAttribute($value)
    {
        if ($value == 1) {
            return '超级管理员';
        }else{
            return '普通管理员';
        }
    }
     public function getstateAttribute($value)
    {
        if ($value == 1) {
            return '启用';
        }else{
            return '禁用';
        }
    }
    //修改器
    public function setstateAttribute($value)
    {
        $this->attributes['state']=$value;
    }
    // public function setsroleAttribute($value)
    // {
    //     $this->attributes['role']=$value;
    // }
}
