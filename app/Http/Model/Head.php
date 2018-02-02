<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Head extends Model
{
    //
   
    public function cate(){
        $cateres=DB::table('goodscate')->where(['pid'=>0])->get();
        // $cateres->get()->toArray();
            //dump($cateres);die;
        // dd($cateres);
            foreach($cateres as $k=>$v){
                $children=DB::table('goodscate')->where('pid',$v->id)->get();//二级
                // dd($children);
                $cateres[$k]->children=$children;
                // dd($cateres);
                // dd($children);
                if($children){
                    // dd($k);
                    $cateres[$k]->children=$children;
                    // dd($children);
                    foreach($children as $k1=>$v1){
                        // dd($v1);
                        $grandchildren=DB::table('goodscate')->where('pid',$v1->id)->get();
                        // dd($grandchildren);
                        if($grandchildren){
                            // dump($grandchildren);die;
                            $cateres[$k]->children[$k1]->grandchildren=$grandchildren;
                        }else{
                            $cateres[$k]->children[$k1]->grandchildren=0;
                        }
                    }
                }else{
                    $cateres[$k]->children=0;
                }
            }
            return $cateres;
    }
}
