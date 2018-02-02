<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Address;
use App\Http\Model\Shopcart;
use App\Http\Model\Goodsinfo;
use Session;
use DB;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(session('data')){
            //对存储购物车信息的session进行处理,去掉库存字段，加入用户id字段
            if(!empty(session('shopcar'))){
                //dd(session('shopcar'));
                $shopcar =  $request->session()->pull('shopcar');
                $user_id=session('data')->id;
                //dd($user_id);
                $shopcart1=[];
                $shopcart2=[];
                foreach($shopcar as $v){
                    if(is_array($v)){
                        array_pop($v);
                    }
                   $shopcart1[]=$v;
                }
                //dd($shopcart1);
                foreach($shopcart1 as $v){
                    $v['user_id']=$user_id;
                    $shopcart2[]=$v;
                }
                // dd($shopcart2);
                //取得购物车数据库的goods_infotime字段,用模型查出来的是对象，而用DB查出来的数数组
                $goods_infotimelist=DB::table("shopcart")->lists('goods_infotime');
                //当购物车中存在此字段时候，那么不添加，否则，对数据库进行添加
                foreach($shopcart2 as $v){
                    if(!in_array($v['goods_infotime'],$goods_infotimelist)){
                        $res=Shopcart::create($v);
                    }
                }
            }
            //读取数据库数据
            $shopcartall=DB::table("shopcart")
                                ->get();
            // dd($shopcartall);
            $user_id=session('data')->id;
            //dd($user_id);
            //限制地址的个数为3个
            $address=Address::where('user_id',$user_id)->take(3)->get();
            return view('home.pay',compact('address','shopcartall'));
        }else{
            return redirect()->action('Home\LoginController@index');
        }
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
        dd($id);
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
