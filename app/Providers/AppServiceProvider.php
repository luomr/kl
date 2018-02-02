<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 将数据库中的分类进行重新组装，用于前台遍历
        //得到一级分类
        $cateres=DB::table('goodscate')->where(['catepid'=>0])->get();
        foreach($cateres as $k=>$v){
            //得到二级分类
            $children=DB::table('goodscate')->where('catepid',$v->id)->get();
            //将二级分类放在二维数组里面
            $cateres[$k]->children=$children;
            //判断是否有二级分类
            if($children){
                $cateres[$k]->children=$children;
                foreach($children as $k1=>$v1){
                    // 得到三级分类
                    $grandchildren=DB::table('goodscate')->where('catepid',$v1->id)->get();
                    // 判断是否有三级分类
                    if($grandchildren){
                        //将三级分类放在三维数组中
                        $cateres[$k]->children[$k1]->grandchildren=$grandchildren;
                    }else{
                        $cateres[$k]->children[$k1]->grandchildren=0;
                    }
                }
            }else{
                $cateres[$k]->children=0;
            }
        }
        //将组装好的数组分享给所有试图
        view()->share('cateres',$cateres);
        //导航栏的遍历
        $link = DB::table('nav')->take(9)->get();
        view()->share('link',$link);
        //搜索框下面的热词遍历，根据点击率，搜索排名前6的分类
        $sea = DB::table('goodscate')->orderBy('cateclick','desc')->take(6)->get();
        view()->share('sea',$sea);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
