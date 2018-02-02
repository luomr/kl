<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Storage;
use Validator;
use DB;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //导航栏遍历
        $nav = DB::table('nav')->paginate(5);
        //dd($nav);
        return view('admin.nav.index',['nav'=>$nav]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //==========================渲染添加页面
        return view('admin.nav.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //==========================执行添加
        $nav = $request->except('_token');
        $result = DB::table('nav')->insert($nav);
        return redirect()->action('Admin\NavController@index');
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
        //===============修改操作
        $result = DB::table('nav')->find($id);
        return view('admin.nav.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input = $request->except(['_token','id']);
        $id=$request->id;
        $result=DB::table('nav')->where('id',$id)->update($input);
        return redirect()->action('Admin\NavController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //==================================删除操作
        $res=DB::table('nav')->where('id',$id)->delete();
        // return $res;
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
        }
        return $data;
    }
    //搜索功能的实现
    public function search(Request $request){
        $keywords = $request->keywords;
        // dd($keywords);
        $nav = DB::table('nav')
              ->where('name', 'like',"%{$keywords}%")
              ->paginate(1);
        return view('admin/nav/index', ['nav' => $nav])->with('keywords', $keywords);
    }
}
