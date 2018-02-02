<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Goodsattrvalue;
use App\Http\Model\Goodsattr;
use App\Http\Model\Goodscate;

class GoodsattrvalueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $attr = Goodsattr::get;
        $result = Goodsattrvalue::orderBy('id','desc')->paginate(10);
        return view('admin/Goodsattrvalue/index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类参数，用于类的选择
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //属性表参数，用于属性的选择
        $attr = DB::table('goodsattr')->get();
        return view('admin/goodsattrvalue/add',['attr'=>$attr])->with('data',$data);
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
        $request = $request->except('_token');
        $result = Goodsattrvalue::create($request);
        if($result){
            return redirect()->action('Admin\GoodsattrvalueController@index');
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
        //找到对应的id数据
        $result = DB::table('goodsattrvalue')->find($id);
        //分类参数，用于分类的选择
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //在goodscate表中找到id等于$result->valuecate分类信息
        $data1 = DB::table('goodscate')->find($result->valuecate);
        //属性表参数，用于属性的选择
        $attr = Goodsattr::get();
        //在goodsattr表中找到id等于$result->valuepid属性信息
        $attr1 = DB::table('goodsattr')->find($result->valuepid);
        //将参数带回去
        return view('admin/goodsattrvalue/edit',['result'=>$result,'attr'=>$attr,'attr1'=>$attr1,'data1'=>$data1])->with('data',$data);
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
        $request = $request->except('_method','_token');
        $result = Goodsattrvalue::where('id',$id)->update($request);
        if($result){
            return redirect()->action('Admin\GoodsattrvalueController@index');
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
        $res=Goodsattrvalue::where('id',$id)->delete();
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
        // dd($keywords);
        $result = Goodsattrvalue::where('valueattr','like',"%{$keywords}%")
                    ->paginate(10);
        return view('admin/goodsattrvalue/index',['result'=>$result])->with('keywords
            ',$keywords);
    }
}
