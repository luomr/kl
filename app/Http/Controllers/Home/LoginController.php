<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function index()
    {
        // $error = null;
        // return view('home.login',['error'=>$error]);
        return view('home.login');
    }
    public function dologin(request $request)
    {

        $rules=[
            'user_ph'=>'required|numeric|regex:/^1[34578][0-9]{9}$/',
            'user_ph'=>'required|numeric',
            'user_pw'=>'required|min:6',
        ];
        $message=[
        'user_ph.required'=>'手机号不能为空！',
        'user_ph.regex'=>'手机号码格式不正确',
        'user_ph.numeric'=>'必须是数字' ,
        'user_pw.required'=>'密码不能为空！',
        'user_pw.min'=>'不能少于6位',
        ];
        $this->validate($request,$rules,$message);
        //接受所有的数据
        $input=$request->except('_token');
        //取得管理员列表中name列的值
        $user_ph=DB::table('user')->lists('user_ph');
        $a = '该手机号未注册';
        $b = '输入密码有误';
        //如果用户名匹配成功
        if(in_array($input['user_ph'],$user_ph)){
            //获取数据表中用户名的一行
            $res=DB::table('user')->where('user_ph',$input['user_ph'])->first();
            $user_pw=Crypt::decrypt($res->user_pw);
                //进行密码判断
                if($input['user_pw']==$user_pw){
                    session(['data'=>$res]);
                   return redirect("/");
                }else{
                    return back()->with('error',$b);
                }
        }else{
            //如果手机号判断错误
            return back()->with('error',$a);
        }
    }
    public function esc(){
        session(['data'=>null]);
        return redirect('/');
    }
}
