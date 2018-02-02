<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Goodsinfo;

class GoodsinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = Goodsinfo::orderBy('id','desc')->paginate(20);
        return view('admin.goodsinfo.index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获得商品属性参数，用于视图页面属性值选择
        $attr = DB::table('goodsattrvalue')->get();
        //获得列表页的参数，用于视图页面商品名遍历
        $goods = DB::table('goodslist')->get();
        return view('admin.goodsinfo.add',['attr'=>$attr,'goods'=>$goods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        // 获取form表单提交过来的图片信息
        $file = $request->file("infoimg");
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
       $infoimg = implode(" ",$filePath);
       //去除掉从表单提交过来的infoimg
       $input = array_except($input,['infoimg']);
       //将新的图片路径信息$infoimg放入用于数据库添加的数组
       $input = array_add($input,'infoimg',$infoimg);
       //另外补充一个时间戳到用于数据库添加的数组
        $input = array_add($input,'infotime',time());
        //进行数据添加
        $result = Goodsinfo::create($input);
        //对添加结果进行判断
        if($result){
            return redirect()->action('Admin\GoodsinfoController@index');
        }else{
            return "添加失败";
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
        //根据id查找goodsinfo中商品信息
        $result = DB::table('goodsinfo')->find($id);
        //查找所有的商品列表信息，用于名字的修改
        $goods = DB::table('goodslist')->get();
        //查找所有的商品属性值，用于属性值的修改
        $attr = DB::table('goodsattrvalue')->get();
        //修改的选定选项，视图中selected选项需要的内容
        $goods1 = DB::table('goodslist')->find($result->infoname);
        $attr1 = DB::table('goodsattrvalue')->find($result->infoattr1);
        $attr2 = DB::table('goodsattrvalue')->find($result->infoattr2);
        //返回修改页面
        return view('admin.goodsinfo.edit',['result'=>$result,'goods'=>$goods,'attr'=>$attr,'goods1'=>$goods1,'attr1'=>$attr1,'attr2'=>$attr2]);
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
        //接受form表单提交过来的数据
        $input = $request->except('_token','_method');
        $filePath=array();
        //如果修改了图片的话
        if(!empty($input['infoimg'][0])){
             // 获取form表单提交过来的图片信息
            $file = $request->file("infoimg");
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
        }
        if($filePath){
            // 将图片路径转化为字串
            $infoimg = implode(" ",$filePath);
            // 去除掉从表单提交过来的infoimg
            $input = array_except($input,['infoimg']);
            // 将新的图片路径信息$infoimg放入用于数据库添加的数组
            $input = array_add($input,'infoimg',$infoimg);
        }else{
            $input = array_except($input,['infoimg']);
        }
        $result = Goodsinfo::where('id',$id)->update($input);
        if($result){
            return redirect()->action('Admin\GoodsinfoController@index');
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
        //删除对应图片下的商品
        $res=Goodsinfo::where('id',$id)->delete();
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
        }
        return $data;
    }

    public function search(Request $request){
        $keywords = $request->keywords;
        // $result = Goodsinfo::where('')
    }
}
