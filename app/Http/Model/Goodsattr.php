<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
class Goodsattr extends Model{
	// 模型初始化
	protected $table = 'goodsattr';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = [];


}
?>