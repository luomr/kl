<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\http\Model\Shopcart;
class ShopcartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //多表联查得到需要便利的各种信息
        $shopcart= DB::table('goodsinfo')->join('shopcart','goodsinfo.id','=','shopcart.goods_id')->join('goodslist','goodsinfo.name','=','goodslist.id')->join('goodsattrvalue','goodsinfo.attr','=','goodsattrvalue.id')->select('shopcart.num','shopcart.id','goodsinfo.img','goodslist.name','goodsattrvalue.value','goodsinfo.price')->get();//得到一个二维数组数据
        $username=DB::table('shopcart')->join('user','shopcart.user_id','=','user.id')->select('user.user_ph')->get();//得到一个二维数组
        //将得到的数据进行整理，防止一个数组
        $result=array_merge($shopcart,$username);
        static $data=array();
        foreach($result as $k=>$v){
            foreach($v as $k1=>$v1){
                $data[$k1]=$v1;
            }
        }
        // dd($data);
        //将得到的数据返回首页
        return view('admin.shopcart.index')->with('data',$data);
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
        //
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
