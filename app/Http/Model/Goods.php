<?php

namespace App\Http\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //模型初始化
    protected $table = 'Goodslist';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    public function getStatusAttribute($value){
    	if($value == 1){
			return '在出售';
		}else{
			return '已下架';
		}
    }

    public function getListcateAttribute($value){
        $cate = DB::table('goodscate')->find($value);
        return $cate->catename;
    }

}
