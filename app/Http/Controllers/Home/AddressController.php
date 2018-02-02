<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Address;
use DB;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
       $input=$request->except('_token');
       $address=DB::table('address')->where('user_id',session('data')->id)->get();
       $count=0;
       $count=count($address);
       //限制添加的条数最多为3条
       if($count>=3){
        $data=['status'=>2,'msg'=>'亲,已经添加3条了！'];
        return $data;
       }else{
         // return $input['address'];
           $res=Address::create($input);
           if($res){
                $data=['status'=>0,'msg'=>'添加地址成功！'];
            }else{
                $data=['status'=>1,'msg'=>'添加地址失败，请稍后重试！'];
            }
            return $data;
       }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        $field=Address::find($id);
        return $field;
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
        $input=$request->except('_token','_method');
        $res=Address::where('id',$id)->update($input);
        if($res){
            $data=['status'=>0,'msg'=>'修改地址成功！'];
        }else{
            $data=['status'=>1,'msg'=>'修改地址失败，请稍后重试！'];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取订单表中状态为待付款、待发货、待收货状态的结果
        $orderres=DB::table('order')->where('orderaddress',$id)->where('orderstatus','<',4)->get();
        if($orderres){
            $data=['status'=>2,'msg'=>'此地址正在使用中，无法删除'];
            return $data;
        }else{
            $res=Address::where('id',$id)->delete();
            if($res){
                $data=['status'=>0,'msg'=>'删除成功！'];
            }else{
                $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
            }
            return $data;
        }
    }
    public function defaultAddress(Request $request){
        // return "123";
        // 获取地址id
        $id=$request->id;
        //获取用户id
        $user_id=$request->user_id;
        // 找到用户名下所有的address的id
        $addressid = DB::table('address')->where('user_id',$user_id)->lists('id');
        //通过便利整个address的id,将与$id值相等的设为默认，其他的设为非默认
        foreach ($addressid as $k=>$v){
            if($v==$id){
                $address=Address::find($v);
                $address->default=2;
                $res=$address->update();
            }else{
                $address=Address::find($v);
                $address->default=1;
                $res=$address->update();
            }
        }
        return 1;
    }
}
