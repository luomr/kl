<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Goodscate;
use App\Http\Model\Goodsattr;
use App\Http\Model\Cateattr;
use DB;
class CateattrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Cateattr::orderBy('id','desc')->paginate(10);
        return view('admin\cateattr\index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        $attr = Goodsattr::get();
        return view('admin/cateattr/add',['attr'=>$attr])->with('data',$data);
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
        // dd($request);
        $result = Cateattr::create($request);
        if($result){
            return redirect()->action('Admin\CateattrController@index');
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
        $result = DB::table('cateattr')->find($id);
       //获取分类参数，用于类别的选择
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //选定类，另一种方法为可以在视图页面进行selected属性判断
        $data1 = DB::table('goodscate')->find($result->cateid);
        //获取属性参数，用于属性的选择
        $attr = Goodsattr::get();
         //选定属性，另一种方法为可以在视图页面进行selected属性判断
        $attr1 = DB::table('goodsattr')->find($result->attrid);
        //回到编辑页面，进行数据遍历
        return view('admin/cateattr/edit',['result'=>$result,'attr'=>$attr,'attr1'=>$attr1,'data1'=>$data1])->with('data',$data);
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
        // dd($request);
        $result = Cateattr::where('id',$id)->update($request);
        if($result){
            return redirect()->action('Admin\CateattrController@index');
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
        $res=Cateattr::where('id',$id)->delete();
        // return $res;
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
        }
        return $data;
    }
}
