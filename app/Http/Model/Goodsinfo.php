<?php

namespace App\Http\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Goodsinfo extends Model
{
    //模型初始化
    protected $table = 'Goodsinfo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    public function getInfoattr1Attribute($value){
    	$attr = DB::table('goodsattrvalue')->find($value);
    	return $attr->valueattr;
    }
    public function getInfoattr2Attribute($value){
        $attr = DB::table('goodsattrvalue')->find($value);
        return $attr->valueattr;
    }
    public function getInfonameAttribute($value){
        $goods = DB::table('goodslist')->find($value);
        return $goods->listname;
    }

}
