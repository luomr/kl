<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Storage;
use Crypt;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin as AdminModel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //获取所有的所有的数据库数据，用于视图遍历
        $admin = AdminModel::orderBy('id','desc')->paginate(10);
        //返回管理员管理首页
        return view('admin/admin/index',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|unique:admin|min:6',
            'password'=>'required|min:6',
        ];
        $message=[
            'name.required'=>'分类名称不能为空！',
            'name.unique'=>'用户名已存在！',
            'name.min'=>'不能少于6位',
            'password.required'=>'密码不能为空！',
            'password.min'=>'不能少于6位',
        ];
        //进行validate验证
        $this->validate($request,$rules,$message);
        //接受所有的数据
        $input=$request->except('_token');
        $input['password']=Crypt::encrypt($input['password']);
        $file = $request->file('thumb');
        //对是否上传头像进行判断
        if($file){
            if ($request->isMethod('post')) {
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
                   //对存储结果进行判断
                    if($bool){
                        $input['thumb']='/uploads/'.$filename;
                    }
                }
            }
        }
        //添加数据
        $re=AdminModel::create($input);
        //对添加结果进行判断
        if($re){
            return redirect('admin/admin');//里面的参数为手册P39页面中的路径，前台页面中的跳转也是路径
        }else{
            return back()->with('errors','数据添加失败，请稍后重试！');
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
        //找的需要修改的数据
        $result=AdminModel::find($id);
        //对密码进行解密
        $result->password=Crypt::decrypt($result->password);
        //返回到修改页面
        return view('admin/admin/edit',compact('result'));
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
        //获取form表单提交过来的数据
        $input=$request->except('_token','_method');
        //对提交过来的密码进行加密
        $input['password']=Crypt::encrypt($input['password']);
        //将提交过来上传图片信息
        $file = $request->file('thumb');
        //判断是否上传图片
        if($file){
            if ($request->isMethod('put')) {
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
                // 判断上传图片是否上传成功
                if($bool){
                    $input['thumb']='/uploads/'.$filename;
                }
            }
            }
        }
        //因model中进行了getattribute操作,导致得到的$input['role']为普通管理员或是超级管理员，对其进行修改
        if($input['role']=="普通管理员"){
            $input['role']=2;
        }else{
            $input['role']=1;
        }
        //更新数据
        $res=AdminModel::where('id',$id)->update($input);
        //对数据更新结果进行判断
        if($res){
            return redirect('admin/admin');
        }else{
            return back()->with('errors','分类信息更新失败,请稍后重试！');
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
        //对删除的条件进行判断
        if(session('admin')->role==1 && session('admin')->id!=$id){
            $res=AdminModel::where('id',$id)->delete();
            if($res){
                $data=['status'=>0,'msg'=>'删除成功！'];
            }else{
                $data=['status'=>1,'msg'=>'删除失败，请稍后重试！'];
            }
            return $data;
        }elseif(session('admin')->role==2){
            $data=['status'=>2,'msg'=>'普通管理员无此权限！'];
            return $data;
        }elseif(session('admin')->role==1 && session('admin')->id=$id){
            $data=['status'=>3,'msg'=>'不能删除自己'];
            return $data;
        }
    }
    //修改启用/禁用功能的实现
    public function changestate(Request $request){
        // return $request->id;
        $admin=AdminModel::find($request->id);
        //return $admin->id;
        if(session('admin')->role == 1 && session('admin')->id == $admin->id){
            $data=['status'=>3,'msg'=>'超管不能禁用自己'];
            return $data;
        }elseif(session('admin')->role == 2){
            $data=['status'=>2,'msg'=>'普通管理员无此权限！'];
            return $data;
        }elseif(session('admin')->role == 1 && session('admin')->id != $admin->id){
            if($admin->state=="启用"){
                $admin->state=2;
            }else{
                $admin->state=1;
            }
            $res=$admin->update();
            if($res){
                $data=['status'=>0,'msg'=>'更改成功！'];
            }else{
                $data=['status'=>1,'msg'=>'更改失败！'];
            }
            return $data;
        }
    }
    //搜索功能的实现
    public function search(Request $request){
        $keywords = $request->keywords;
        $admin = AdminModel::where('name', 'like',"%{$keywords}%")
              ->paginate(10);
       return view('admin/admin/index', compact('admin','keywords'));
    }
}
