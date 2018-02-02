<?php

namespace App\Http\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Goodsattrvalue extends Model
{
    //模型初始化
    protected $table = 'Goodsattrvalue';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function getValuepidAttribute($value){
    	$attr = DB::table('goodsattr')->find($value);
    	return $attr->attrname;
    }
    public function getValuecateAttribute($value){
    	$cate = DB::table('goodscate')->find($value);
    	return $cate->catename;
    }
}
