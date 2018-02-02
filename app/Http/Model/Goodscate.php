<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goodscate extends Model
{
    //模型初始化
    protected $table = 'goodscate';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded = [];//不能被批量赋值的属性
    //无限极分类
    public function tree(){
        $goodscates=$this->orderBy('cateorder')->get();
        $data=$this->getTree($goodscates);
        // dd($data);
        return $data;
    }
    public function getTree($data,$pid=0,$level=0){
        // dd($data);
        static $arr=array();
        foreach($data as $k=>$v){
            if($v['catepid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                $this->getTree($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }
    //获得所有的子id
    public function getchildrenid($goods_id){
        $goodscates=$this->orderBy('cateorder','desc')->get();
        return $this->_getchildrenid($goodscates,$goods_id);
    }
    public function _getchildrenid($goodscates,$pid){
        static $arr=array();
        foreach($goodscates as $k=>$v){
            if($v['catepid']==$pid){
                $arr[]=$v['id'];
                $this->_getchildrenid($goodscates,$v['id']);
            }
        }
        return $arr;
    }
    // public function getpidAttribute($value)
    // {
    //     if ($value == 0) {
    //         return '顶级栏目';
    //     }else{
    //         $goodscate =$this->where('id', $value)->first();
    //         return $goodscate->name;
    //     }
    // }
}
