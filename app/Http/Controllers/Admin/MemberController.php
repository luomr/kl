<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Member as MemberModel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=MemberModel::paginate(3);
        return view('admin/member/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin/member/add');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/member/edit');
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
    //修改启用/禁用功能的实现
    public function changestate(Request $request){
        $member=MemberModel::find($request->id);
        if($member->state=="启用"){
            $member->state=2;
        }else{
            $member->state=1;
        }
        $res=$member->update();
        if($res){
            $data=['status'=>0,'msg'=>'更改成功！'];
        }else{
            $data=['status'=>1,'msg'=>'更改失败！'];
        }
        return $data;
    }
    //搜索功能的实现
    public function search(Request $request){
        $keywords = $request->keywords;
        //dd($keywords);
        $data = DB::table('user')
              ->where('user_ph', 'like',"%{$keywords}%")
              ->paginate(3);
       return view('admin.member.index', ['data' => $data])->with('keywords', $keywords);
    }
}
