<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Crypt;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function login(Request $request){

        return view('admin.adminlogin.login');
    }
    //处理登录页面提交过来的数据
    public function dologin(Request $request){
        //判断验证码
        $input=$request->except('_token');
        $validator=Validator::make($input,[ 'captcha'=>'captcha'],['captcha.captcha'=>'验证码输入有误']);
        //如果验证码通过，进行用户名和密码的判断
        if($validator->passes()){
            //取得管理员列表中name列的值
            $names = DB::table('admin')->lists('name');
            //如果用户名匹配成功
            if(in_array($input['name'], $names)){
                //获取数据表中用户名的一行
                $res = DB::table('admin')-> where ('name',$input['name'])->first();
                //对密码进行解密
                $res->password=Crypt::decrypt($res->password);
                //进行密码判断
                if($input['password']==$res->password){
                    session(['admin'=>$res]);
                   return redirect("admin");
                }else{
                    return back()->with('errors','密码输入有误输入有误');
                }
            }else{
                //如果用户名判断错误
                return back()->with('errors','用户名输入有误');
            }
        }else{
            //验证码错误，返回登录页面
            return back()->with('errors','验证码错误');
        }

    }
}
