<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function shop(Request $request)
    {
        //分类的id
       $a = $request->a;
       //属性值的id
       $b = $request->b;
       // dd($a);
       // 与属性值相匹配的信息
       $goods = DB::table('goodsinfo')
                ->where('infoattr1',$b)
                ->orwhere('infoattr2',$b)
                ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
                ->join('goodslist', 'goodslist.id', '=', 'goodsinfo.infoname')
                ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
                ->select('goodsattrvalue.*','goodsinfo.*','goodslist.*','goodscate.*')
                ->paginate(12);
       // dd($goods);
        // 所有属性值
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

        // 对应id的pid分类信息
        $cate = DB::table('goodscate')
            ->where('catepid',$id)
            ->get();
        // 对应id的分类
        $nav = DB::table('goodscate')
            ->where('id',$id)
            ->get();
            // dd($cate);
            // dd($nav);
        $goods = array();
        $count=0;
        foreach($cate as $k=>$v){
            // dd($v->id);
            $goods[$k] = DB::table('goodslist')
                ->where('listcate',$v->id)
                ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
                ->join('goodsinfo', 'goodslist.id', '=', 'goodsinfo.infoname')
                ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
                ->join('goodsattr', 'goodsattr.id', '=', 'goodsattrvalue.valuepid')
                ->select('goodsinfo.*','goodslist.*','goodsattrvalue.*','goodscate.*','goodsattr.*')
                ->get();
        }
        foreach($goods as $k=>$v){
           $count+=count($v);
        }
        //相对应的分类属性值
        $attr = DB::table('cateattr')
            ->where('cateid',$id)
            ->join('goodsattr', 'goodsattr.id', '=', 'cateattr.attrid')
            ->select('cateattr.*','goodsattr.*')
            ->get();
        //属性值的信息
        $value = DB::table('goodsattrvalue')->get();
        //分类的信息
        $cate = DB::table('goodscate')->get();
        $id1 = $id;
        // dd($goods);
        return view('home\list',['goods'=>$goods,'attr'=>$attr,'value'=>$value,'nav'=>$nav,'cate'=>$cate,'id'=>$id,'id1'=>$id1,'count'=>$count]);
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
        // 对应id 的分类信息
        $nav = DB::table('goodscate')
            ->where('id',$id)
            ->get();
        $count=0;
            // dd($nav);
        // 此类商品的信息
        $goods = DB::table('goodslist')
            ->where('listcate',$id)
            ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
            ->join('goodsinfo', 'goodslist.id', '=', 'goodsinfo.infoname')
            ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
            ->select('goodsattrvalue.*','goodsinfo.*','goodslist.*','goodscate.*')
            ->paginate(12);
        //为了获取商品个数
         $goods1 = DB::table('goodslist')
            ->where('listcate',$id)
            ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
            ->join('goodsinfo', 'goodslist.id', '=', 'goodsinfo.infoname')
            ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
            ->select('goodsattrvalue.*','goodsinfo.*','goodslist.*','goodscate.*')
            ->get();
        foreach($goods1 as $k=>$v){
            $count+=count($v);
        }
        // 此类商品的属性
        $attr = DB::table('cateattr')
                ->where('cateid',$id)
                ->join('goodsattr', 'goodsattr.id', '=', 'cateattr.attrid')
                ->select('cateattr.*','goodsattr.*')
                ->get();
                // dd($attr);
        // 所有属性值
        $value = DB::table('goodsattrvalue')->get();
        // 所有分类
        $cate = DB::table('goodscate')->get();
        foreach($nav as $v){
                $id1 = DB::table('goodscate')->where('id',$v->catepid)->get();
                foreach($id1 as $d){
                    $id1 = $d->id;
                }
        }
            // dd($count);
        // dd($value);
            // dd($goods);
        return view('home\list1',['goods'=>$goods,'attr'=>$attr,'value'=>$value,'nav'=>$nav,'cate'=>$cate,'id'=>$id,'id1'=>$id1,'count'=>$count]);
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
