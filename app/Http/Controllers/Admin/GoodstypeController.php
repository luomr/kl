<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Goodstype;
use App\Http\Model\Goodscate;

class GoodstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Goodstype::orderBy('id','desc')->paginate(2);
        return view('admin/goodstype/index')->with('goodstype',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodscate=new Goodscate();
        $goodscates=$goodscate->tree();
        // dd($goodscates);
        return view('admin/goodstype/add')->with('goodscates',$goodscates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['type'=>'required'],['type.required'=>'不能为空']);
        $input=$request->except('_token');
        $res=Goodstype::create($input);
        if($res){
            return redirect('admin/goodstype');
        }else{
            return back()->with('errors','类型添加失败，请稍后重试!');
        }
        // dd($input);
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
        // dd($id);
        $field=Goodstype::find($id);
        // dd($field);
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        return view('admin/goodstype/edit',compact('field','data'));
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
        $res=Goodstype::where('id',$id)->update($input);
        if($res){
            return redirect('admin/goodstype');
        }else{
            return back()->with('errors','信息更新失败,请稍后重试！');
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
        // dd($id);
        $res=Goodstype::where('id',$id)->delete();
        // dd($res);
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
        }
        return $data;
    }
}
