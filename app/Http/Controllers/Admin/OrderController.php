<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\http\Model\Order;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Order::orderBy('id','desc')->paginate(10);
        //将得到的数据返回首页
        return view('admin\order\index',['result'=>$result]);
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
        $sta = ['orderstatus'=>5];
        $res = Order::where('id',$request->id)->update($sta);
        if($res){
             $data=['status'=>0,'msg'=>'取消成功'];
        }else{
            $data=['status'=>1,'msg'=>'亲，此订单已取消'];
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
    //将待发货改为待收货
    public function changeorderstate(Request $request){
        // 路由正确
        // ajax正确,数据接收成功
       $id=$request->id;
       $orderstatus=$request->orderstatus;
       $order=Order::find($id);
       if($orderstatus=="待发货"){
            $order->orderstatus=3;
            $res=$order->update();
           if($res){
                $data=['status'=>0,'msg'=>'更改成功！'];
            }else{
                $data=['status'=>1,'msg'=>'更改失败！'];
            }
            return $data;
       }else{
            $data=['status'=>2,'msg'=>'无更改权限'];
            return $data;
        }
    }
    //将待收货改为交易完成
    public function changeorderstate1(Request $request){
        // 路由正确
        // ajax正确,数据接收成功
        $id=$request->id;
        $orderstatus=$request->orderstatus;
        $order=Order::find($id);
        if($orderstatus=="待收货"){
            $order->orderstatus=4;
            $res=$order->update();
            if($res){
                $data=['status'=>0,'msg'=>'更改成功！'];
            }else{
                $data=['status'=>1,'msg'=>'更改失败！'];
            }
            return $data;
        }else{
            $data=['status'=>2,'msg'=>'无更改权限'];
            return $data;
        }
    }
}
