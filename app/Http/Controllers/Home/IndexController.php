<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取banner图，允许最多10条
        $banner = DB::table('banner')->take(10)->get();
        //获取banner图的个数，用于小图标上面的数字遍历
        $arr = count($banner);
        //分类中点击最高的前10条，只限于二级和三级分类,因为一级分类没有点击链接
        $cateclick=DB::table('goodscate')->orderBy('cateclick','desc')->take(10)->lists('id');
        // 每个专题的广告
        $ad = DB::table('ad')->get();
        // 商品
        $cate = DB::table('goodscate')->where('catepid',0)->get();
        // dd($cate);
        foreach($cate as $k=>$c){
            $cate1[$k] = DB::table('goodscate')->where('catepid',$c->id)->first();
            foreach($cate1 as $a=>$v){
                $cate2[$a] = DB::table('goodscate')->where('catepid',$v->id)->first();
                // dd($cate2[$a]->id);
                $shop[$a] = DB::table('goodslist')
                                    ->where('listcate',$cate2[$a]->id)
                                    ->join('goodsinfo','goodsinfo.infoname','=','goodslist.id')
                                    ->select('goodsinfo.*','goodslist.*')
                                    ->take(4)->get();
                // dd($shop);
            }
        }
        // dd($shop);
        return view('home\index',['banner'=>$banner,'arr'=>$arr,'cateclick'=>$cateclick,'ad'=>$ad,'shop'=>$shop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('home.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $keywords = $request->keywords;
        // dd($keywords);
        $goods = DB::table('goodslist')
            ->where('listname','like',"%{$keywords}%")
            ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
            ->join('goodsinfo', 'goodslist.id', '=', 'goodsinfo.infoname')
            ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
            ->select('goodsattrvalue.*','goodsinfo.*','goodslist.*','goodscate.*')
            ->paginate(12);
            // dd($goods);
         $value = DB::table('goodsattrvalue')->get();
        return view('home\list3',['goods'=>$goods,'value'=>$value]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
