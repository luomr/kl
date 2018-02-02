<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use DB;
use Validator;
use Storage;
use session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home\comment');
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
        //
        // dd($id);
        $res = DB::table('order')
                    ->where('order.id',$id)
                    ->join('shopcart','order.ordershop','=','shopcart.id')
                    ->select('shopcart.*','order.*')
                    ->get();
        // dd($res);
        return view('home\comment',['res'=>$res]);
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
        //$id为goodsinfo中的infotime,将其存储为infotime,为了存储页面
        $infotime=$id;
        $id = DB::table('goodsinfo')->where('infotime',$id)->lists('id');
        // dd(session('data')->id);
        $input = $request->except('_token','_method');
        // 获取form表单提交过来的图片信息
        $file = $request->file("comimg");
        // dd(!is_null($file));
        if(!empty($file[0])){
            foreach ($file as $key => $value) {
               // 文件是否上传成功ee
                if ($value->isValid()) {
                    // 获取文件相关信息
                    $originalName = $value->getClientOriginalName();// 文件原名
                    $ext = $value->getClientOriginalExtension();// 扩展名
                    $realPath = $value->getRealPath();   //临时文件的绝对路径
                    $type = $value->getClientMimeType();     // image/jpeg
                    // 上传文件后得到的名字
                    $filename[$key] = str_random(10) . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('uploads')->put($filename[$key], file_get_contents($realPath));
                    // 如果存储成功，那么获得图片路径，组成数组
                    if($bool){
                        $filePath[]='/uploads/'.$filename[$key];
                    }
                }
            }
            //将图片路径转化为字串
           $comimg = implode(" ",$filePath);
           //去除掉从表单提交过来的comimg
           $input = array_except($input,['comimg']);
           //组合新的数组
           $res = ['comname'=>session('data')->id,'comshop'=>$id[0],'comdata'=>time(),'comstate'=>1,'comimg'=>$comimg,'comcontent'=>$input['comcontent']];
           $result = DB::table('comment')->insert($res);
           if($result){
                return redirect("/details/{$infotime}");
           }else{
                return '评论未成功';
           }
        }else{
            //组合新的数组
           $res = ['comname'=>session('data')->id,'comshop'=>$id[0],'comdata'=>time(),'comstate'=>1,'comcontent'=>$input['comcontent']];
           $result = DB::table('comment')->insert($res);
           if($result){
                 return redirect("/details/{$infotime}");
           }else{
                return '评论未成功';
           }
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
