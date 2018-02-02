<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cateattr extends Model{
	// 模型初始化
	protected $table = 'cateattr';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = [];

	public function getCateidAttribute($value){
    	$cate = DB::table('goodscate')->find($value);
    	return $cate->catename;
    }

    public function getAttridAttribute($value){
    	$attr = DB::table('goodsattr')->find($value);
    	return $attr->attrname;
    }
}
?>