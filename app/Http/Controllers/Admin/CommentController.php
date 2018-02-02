<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Storage;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Comment as CommentModel;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //评论管理主页
        $stu =CommentModel::orderBy('id','desc')->paginate(5);
        return view('admin.comment.index',['stu'=>$stu]);
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
        $res = CommentModel::find($id);
       return view('admin\comment\edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $comment=CommentModel::find($id);
        //dd($comment);
        $comment->comback=$request->comback;
        $res=$comment->update();
        if($res){
            return redirect('admin\comment');
        }else{
            return "更新失败";
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

    }

     //修改启用/禁用功能的实现
    public function changestate(Request $request){
        // echo "123";
        $admin=CommentModel::find($request->id);
        if($admin->comstate=="审核"){
            $admin->comstate=2;
        }else{
            $admin->comstate=1;
        }
        $res=$admin->update();
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
        // dd($keywords);
        $stu = DB::table('comment')
              ->where('catename', 'like',"%{$keywords}%")
              ->paginate(1);
       return view('admin.comment.index', ['stu' => $stu])->with('keywords', $keywords);
    }
}
