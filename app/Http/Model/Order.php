<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
    protected $table = 'Order';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性

    public function getOrderstatusAttribute($value){
    	switch($value){
    		case 1:
    			return "待付款";
    		break;
    		case 2:
    			return "待发货";
    		break;
    		case 3:
    			return "待收货";
    		break;
    		case 4:
    			return "交易完成";
    		break;
    		case 5:
    			return "交易取消";
    		break;
            case 6:
                return "待评价";
            break;
            case 7:
                return "订单回收中";
            break;
    		default:
    		break;
    	}
    	return $res;
    }

    public function getOrdershopAttribute($value){
    	$res = DB::table('shopcart')->find($value);
    	return "商品名：".$res->goods_name." <br> "."数量：".$res->num." <br> ".'消费金额：'.$res->goods_price*$res->num;
    }

    
}
