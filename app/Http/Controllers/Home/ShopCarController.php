<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Model\Head;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Shopcart;
use App\Http\Model\Goodsinfo;
use Session;
use DB;
class ShopCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //登录状态的时候
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
                //$user_idlist=DB::table('shopcart')->lists('user_id');
                $goods_infotimelist=DB::table("shopcart")->where('user_id',$user_id)->where('state',2)->lists('goods_infotime');
                //dd($goods_infotimelist);
                //当购物车中存在此字段时候，那么不添加，否则，对数据库进行添加
                foreach($shopcart2 as $v){
                    if(!in_array($v['goods_infotime'],$goods_infotimelist)){
                        $res=Shopcart::create($v);
                    }
                }
            }
            //读取用户的购物车信息中状态为选定和不选定的信息，用于视图遍历
            $shopcartall=DB::table("shopcart")->where('user_id',session('data')->id)->where('state','<',3)->get();
            //对查询的结果进行判断，查询此用户购物车中是否有商品
            if($shopcartall){
                return view('home\shopCar',compact('shopcartall'));
            }else{
                return view('home\shopCar');
            }
        }else{
            return view('home\shopCar');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $goods_infotime=$request->goods_infotime;
        $a="";
        // 找到相应的库存
        $inventory=Goodsinfo::where('infotime',$goods_infotime)->value('infonum');
        $input1=$input;
        //将库存加入$input1中
        $input1['inventory']=$inventory;
        // 登录状态时将所得数据放入购物车数据库
       if(session('data')){
        // 取得user_id字段
        $input['user_id']=session('data')->id;
        //用model类的时候，得到一个对象，无法使用in_array函数，但是当用数据库的时候，得到的是一个数组，可以使用in_array()函数，取得此用户下的商品状态为未选定状态的infotime数组
        $goods_infotimelist=DB::table("shopcart")->where('user_id',session('data')->id)->where('state',2)->lists('goods_infotime');
        // 判断添加的物品是否在购物车中，如果在，那么弹出此物品已存在购物车中，否则添加到数据库中，对添加的结果进行判断
        if(!in_array($goods_infotime, $goods_infotimelist)){
            $res=Shopcart::create($input);
            if($res){
                return 3;
            }else{
                return 4;
            }
        }else{
            return 2;
        }
       }else{
            //当未登录时，将所得数据放入seeesion中，session中的数据多了一个库存的字段，当session未空，或者是session中不存在此字段时
            if(session('shopcar')==null || !in_array($input1,session('shopcar'))){
                $request->session()->push('shopcar',$input1);//连续存储session的值
                return 5;
            }else{
                return 6;
            }
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
    public function changesession(Request $request){
        //获取采购数量
        $num=$request->num;
        //获取在session中的排名
        $sessionorder=$request->sessionorder;
       // return  $num;
       $arr=session('shopcar')[$sessionorder];
       // return $arr['num'];
       $arr['num']=$num;
       // return $arr['num'];
       $request->session()->put('shopcar.'.$sessionorder,$arr);
       return 1;
    }
    public function delsession(Request $request){
        // return "123";
        $sessionorder=$request->sessionorder;
        // return $sessionorder;
        $a=$request->session()->forget('shopcar.'.$sessionorder);
        return 1;
    }
    //当处于选定状态时，将数据库里面的state修改为1
    public function changestate(Request $request){
        $id=$request->id;
        $state=$request->state;
        if($state==2){
            $state=1;
        }
        $shopcart=Shopcart::find($id);//用model类实现数据的更改
        $shopcart->state=$state;
        $res=$shopcart->update();
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    //当处于未选定状态时，将数据库里面的state修改为2
     public function changestate1(Request $request){
        $id=$request->id;
        $state=$request->state;
        // return $state;
        if($state==1){
            $state=2;
        }
        $shopcart=Shopcart::find($id);
        $shopcart->state=$state;
        $res=$shopcart->update();
        if($res){
            return 3;
        }else{
            return 4;
        }
    }
    //购买数量增加时的方法
    public function changenum(Request $request){
        $id=$request->id;
        $num=$request->num;
        $shopcart=Shopcart::find($id);
        $shopcart->num=$num;
        $res=$shopcart->update();
        if($res){
            return 5;
        }else{
            return 6;
        }
    }
    //购买数量降低时候的方法
    public function changenum1(Request $request){
        // return "123";
        $id=$request->id;
        $num=$request->num;
        // return $num;
        $shopcart=Shopcart::find($id);
        $shopcart->num=$num;
        $res=$shopcart->update();
        if($res){
            return 7;
        }else{
            return 8;
        }
    }
    public function delshopcar(Request $request){
        // return "123";
        //return $request->id;
        $id=$request->id;
        $res=Shopcart::where('id',$id)->delete();
        if($res){
            return 9;
        }else{
            return 10;
        }

    }








}

