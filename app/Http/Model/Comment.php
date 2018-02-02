<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
    //访问器
    // public function getComshopAttribute($value)
    // {
    //     $shop = DB::table('goodslist')->find($value);
    //     return $shop->listname;
    // }
    public function getComnameAttribute($value)
    {
        $user = DB::table('user')->find($value);
        return $user->user_ph;
    }
     public function getComstateAttribute($value)
    {
        if ($value == 1) {
            return '审核';
        }else{
            return '未审核';
        }
    }
    //修改器
    public function setComstateAttribute($value)
    {
        $this->attributes['comstate']=$value;
    }
}
