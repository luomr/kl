<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Storage;
use Validator;
use DB;
use Crypt;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Carousel;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Carousel::paginate(1);
        return view('admin/carousel/index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/carousel/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //接受所有的数据
        $input=$request->except('_token');
        //上传头像
        if($request->img){
            if ($request->isMethod('post')) {
                $file = $request->file('img');
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
                        $input['img']='/uploads/'.$filename;
                    }
                }
            }
        }
        //插入数据
        $result=DB::table('banner')->insert($input);
        //如果插入数据成功，返回管理页面
        if($result){
            return redirect()->action('Admin\CarouselController@index');
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
        //修改
        $result = DB::table('banner')->find($id);
        return view('admin.carousel.edit', ['result' => $result]);
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
       $input = $request->except(['_token','id']);
        $id=$request->id;
        // 上传图片
        if(isset($input['img'])){
            if ($request->isMethod('post')) {
                $file = $request->file('img');
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
                        $input['img']='/uploads/'.$filename;
                    }
                }
            }
            $result=DB::table('banner')->where('id', $id)->update($input);
            if($result){
                 return redirect()->route('admin.carousel.index');
            }else{
                return "亲，还没有进行任何操作哦";
            }
        }
        $result=DB::table('banner')->where('id', $id)->update($input);
       if($result){
            return redirect()->route('admin.carousel.index');
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
        $res=Carousel::where('id',$id)->delete();
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
        $data = DB::table('banner')
              ->where('name', 'like',"%{$keywords}%")
              ->paginate(1);
       return view('admin/carousel/index', ['data' => $data])->with('keywords', $keywords);
    }
}
