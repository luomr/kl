<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Storage;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = DB::table('ad')->paginate(5);
        return view('admin/ad/index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/ad/add');
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
        $input = $request->except('_token');
        if($request->adimg){
            if ($request->isMethod('post')) {
                $file = $request->file('adimg');
                // dd($file);
                // 文件是否上传成功ee
                if ($file->isValid()) {
                    // 获取文件相关信息
                    $originalName = $file->getClientOriginalName();
                    // 文件原名
                    $ext = $file->getClientOriginalExtension();// 扩展名
                    $realPath = $file->getRealPath();   //临时文件的绝对路径
                    $type = $file->getClientMimeType();     // image/jpeg

                    // 上传文件
                    $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                    // var_dump($bool);
                    if($bool){
                        $input['adimg']='/uploads/'.$filename;
                    }
                }
            }
        }
        //dd($input);
        $res = DB::table('ad')->insert($input);
        if($res){
            return redirect()->action('Admin\AdController@index');
        }else{
            return "添加失败，请不要灰心哦";
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
        $res = DB::table('ad')->find($id);
        return view('admin/ad/edit',['res'=>$res]);
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
        $input = $request->except('_token','_method');
        // dd($input);
        if($request->adimg){
            if ($request->isMethod('put')) {
                $file = $request->file('adimg');
                // dd($file);
                // 文件是否上传成功ee
                if ($file->isValid()) {
                    // 获取文件相关信息
                    $originalName = $file->getClientOriginalName();
                    // 文件原名
                    $ext = $file->getClientOriginalExtension();// 扩展名
                    $realPath = $file->getRealPath();   //临时文件的绝对路径
                    $type = $file->getClientMimeType();     // image/jpeg

                    // 上传文件
                    $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                    // var_dump($bool);
                    if($bool){
                        $input['adimg']='/uploads/'.$filename;
                    }
                }
            }
        }
        // dd($input);
        $res = DB::table('ad')->where('id',$id)->update($input);
        if($res){
            return redirect()->action('Admin\AdController@index');
        }else{
            return "修改失败，请重新再来";
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
    }
}
