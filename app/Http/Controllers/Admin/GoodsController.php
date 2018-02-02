<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Model\Goodscate;
use App\Http\Model\Goods;
use App\Http\Model\Goodsinfo;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //商品列表遍历
        $result = Goods::orderBy('id','desc')->paginate(5);
        return view('admin\goods\index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分类参数,分类遍历
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        return view('admin/goods/add')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->except('_token');
        $arr = array_add($request,'listtime',time());
        $result = Goods::create($arr);
        if($result){
            return redirect()->action('Admin\GoodsController@index');
        }else{
            return "添加失败";
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
        //goodsinfo中的infoname字段对应的是goodslist中的id
        $result = Goodsinfo::where('infoname',$id)->paginate(5);
        return view('admin\goodsinfo\index',['result'=>$result]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = DB::table('goodslist')->find($id);
        //获取分类参数,分类遍历
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //获取选定的分类，放在选项的第一项
        $type1 = DB::table('goodscate')->find($result->listcate);
        return view('admin\goods\edit',['result'=>$result,'type1'=>$type1])->with('data',$data);
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
        $request = $request->except('_token','_method');
        // dd($request);
        $result = Goods::where('id',$id)->update($request);
        if($result){
            return redirect()->action('Admin\GoodsController@index');
        }else{
            return "亲，还没有进行任何操作哦";
        }
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
        $res=Goods::where('id',$id)->delete();
        // return $res;
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
        }
        return $data;
    }

    public function search(Request $request){
        $keywords = $request->keywords;
        $result = Goods::where('listname','like',"%{$keywords}%")
                    ->paginate(5);
        return view('admin\goods\index',['result'=>$result])->with('keywords',$keywords);
    }


}
