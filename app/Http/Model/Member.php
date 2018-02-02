<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'user';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
    //访问器
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
}
