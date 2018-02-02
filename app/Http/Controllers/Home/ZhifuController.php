<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Shopcart;
use App\Http\Model\Address;
use App\Http\Model\Goodsinfo;
use Session;
use DB;

class ZhifuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(session('data')){
            
            //读取数据库数据找出待付款的订单
            $shopcartall=DB::table("shopcart")->where('state',1)->get(); 
            // dd($shopcartall);
            if($shopcartall){
                    // 待付款的id
                $arrsum = [];
                foreach($shopcartall as $k=>$s){
                    // 新添加到购物车的购物车id
                    $ordershop[$k] = $s->id;
                    $arrsum[$k] = $s->num * $s->goods_price;
                }
                // 商品总价
                $sum = 0;
                foreach($arrsum as $v){
                    $sum += $v;
                }
                // dd($sum);
                // 用户的地址信息
                $address=Address::where('user_id',session('data')->id)->take(3)->get();
                
                foreach($address as $a){
                    if($a->default == 2){
                        // 收货人的地址id
                        $orderadd = $a->id;
                        // 收货人的信息
                        $orderad = "收货人姓名：".$a->name."<br>"."联系方式：".$a->telephone."<br>".'地址：'.$a->provimce.$a->city.$a->address;
                        // dd($orderad);
                    }
                }
                // dd($a);
                // 订单编号
                $ordernum = mt_rand(1000000000,99999999999);
                $res = [];
                $ress = [];
                foreach($ordershop as $k=>$o){
                    // 提交订单 改变购物车状态为3
                    $ress[] = DB::table('shopcart')->where('id',$o)->update(['state'=>3]);
                    // 添加到订单中购物车的信息
                    $res[] = ['ordernum'=>$ordernum,'ordershop'=>$o,'orderaddress'=>$orderadd,'ordertime'=>time(),'orderadd'=>$orderad];
                }
                // dd($res);
                foreach($res as $r){
                    // 添加到订单数据库
                    $result[] = DB::table('order')->insert($r);
                }
                // dd($res);
                // dd($result);
                if($res){
                    // 获取订单编号
                    foreach($res as $e){
                        // dd($e);
                        $order = DB::table('order')->where('ordernum',$e['ordernum'])->get();
                        $danhao = $e['ordernum'];
                    }
                    // dd($order);
                    return view('home\zhifu',compact('order','sum','danhao'));
                }else{
                    return redirect()->action('Home\ShopCarController@index');
                }
            }else{
                return redirect()->action('Home\ShopCarController@index');
            }
            
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
        // return $request->id;
        $res = [];
        foreach($request->id as $k=>$v){
            $res[$k] = DB::table('order')->where('id',$v)->update(['orderstatus'=>2]);          
        }
        if($res){
                $data=['status'=>0,'msg'=>'支付成功！'];
            }else{
                $data=['status'=>1,'msg'=>'支付失败，请稍后重试！'];
            }
            return $data;
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
        // dd($id);
        // 判断是否登录
        if(session('data')){
            // 获取待付款的订单信息
            $order = DB::table('order')->find($id);
            // 获取对应订单的购物车信息
            $shopcartall = DB::table('shopcart')->where('id',$order->ordershop)->get();
            $sum = 0;
            foreach($shopcartall as $v){
                $sum += $v->num*$v->goods_price;
            }
            $danhao = $order->ordernum;
            return view('home\zhifu',['order'=>$order,'sum'=>$sum,'danhao'=>$danhao]);
        }
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
