<?php

namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Model\Goodsattr;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Goodsattrvalue;
class GoodsattrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attr = Goodsattr::orderBy('id','desc')->paginate(10);
        return view('admin/goodsattr/index',['attr'=>$attr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin/goodsattr/add');
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
        // dd($request);
        $result = Goodsattr::create($request);
        if($result){
            return redirect()->action('Admin\GoodsattrController@index');
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
        //用于展示商品属性值信息
        $result = Goodsattrvalue::where('valuepid',$id)->paginate(10);
        return view('admin\goodsattrvalue\index',['result'=>$result]);
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
        $result = DB::table('goodsattr')->find($id);
        // $result = Goodsattr::find($id);
        // dd($result);
        return view('admin/goodsattr/edit',['result'=>$result]);
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
        $result = Goodsattr::where('id',$id)->update($request);
        if($result){
            return redirect()->action('Admin\GoodsattrController@index');
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
        $res=Goodsattr::where('id',$id)->delete();
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
        $attr = Goodsattr::where('attrname', 'like',"%{$keywords}%")
              ->paginate(10);
        return view('admin/goodsattr/index',['attr'=>$attr])->with('keywords',$keywords);
    }
}
