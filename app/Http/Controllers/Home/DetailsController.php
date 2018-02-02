<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Model\Head;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DetailsController extends Controller
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
        // dd($id);
        // 产品的的信息
        $goods = DB::table('goodsinfo')
            ->where('infotime',$id)
            ->join('goodslist', 'goodslist.id', '=', 'goodsinfo.infoname')
            ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
            ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
            ->select('goodsattrvalue.*','goodsinfo.*','goodslist.*','goodscate.*')
            ->get();
            // dd($goods);
        foreach($goods as $v){
            // 产品的图片
            $arr = explode(" ",$v->infoimg);
            // dd($arr);
            // 本产品的评论
            $com = DB::table('goodsinfo')
                        ->where('infotime',$id)
                        ->join('comment','comment.comshop','=','goodsinfo.id')
                        ->join('user','user.id','=','comment.comname')
                        ->select('comment.*','user.*')
                        ->get();
            // 本产品的品论数
            $com_count = count($com);
            // dd($com_count);
            //本商品的类型
            $cate = DB::table('goodscate')
                ->where('catepid',$v->catepid)
                ->get();
                // dd($cate);
            foreach($cate as $k=>$d){
                // dd($v->id);
                // 同类型的所有信息
                $good[$k] = DB::table('goodslist')
                    ->where('listcate',$d->id)
                    ->join('goodscate', 'goodslist.listcate', '=', 'goodscate.id')
                    ->join('goodsinfo', 'goodslist.id', '=', 'goodsinfo.infoname')
                    ->join('goodsattrvalue', 'goodsinfo.infoattr1', '=', 'goodsattrvalue.id')
                    ->join('goodsattr', 'goodsattr.id', '=', 'goodsattrvalue.valuepid')
                    ->select('goodsinfo.*','goodslist.*','goodsattrvalue.*','goodscate.*','goodsattr.*')
                    ->take(2)
                    ->get();
            }
            // dd($good);
            // 同类产品的评论
            foreach($good as $c=>$gd){
                // dd($gd);
                foreach($gd as $k=>$g){
                    // dd($g);
                    $othercom[$k] = DB::table('goodsinfo')
                                    ->where('infotime',$g->infotime)
                                    ->join('comment','comment.comshop','=','goodsinfo.id')
                                    ->select('comment.*')
                                    ->get();
                    // $com_count = count($othercom[$k]);
                    // $num[$k] = $com_count;
                }
                // dd($num);
                // $other[$c] = $num;
            }
            $value = DB::table('goodsattrvalue')->get();
            // dd($other);
            return view('home\details',['goods'=>$goods,'value'=>$value,'arr'=>$arr,'good'=>$good,'com'=>$com,'com_count'=>$com_count]);
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
    public function changeinventory(Request $request){
        //路由连接正常
        //return "123";
        //ajax连接正常
        $num=$request->num;
        $infotime=$request->infotime;
        //查找已买出的商品数量
        $res=DB::table('order')->whereIn('order.orderstatus', [3,4])->join('shopcart','order.ordershop', '=', 'shopcart.id')->where('shopcart.goods_infotime',$infotime)->lists('order.orderstatus');
        $sold=count($res);
        //返回已卖商品的数量,如果没有卖出商品的化，返回值为0
        return $sold;
    }
}