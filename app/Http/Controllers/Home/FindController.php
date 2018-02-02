<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use DB;
use Crypt;
use App\libs\sms\api_demo\SmsDemo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //渲染模板
        return view('home.find');
    }
    //修改密码
    public function dofind(Request $request){
        //dd("123");
       $rules=[
            'phone'=>'required|numeric|regex:/^1[34578][0-9]{9}$/',
            'user_pw'=>'required|min:6',
        ];
        $message=[
        'phone.required'=>'手机号不能为空！',
        'phone.regex'=>'手机号格式不正确',
        'phone.numeric'=>'必须是数字' ,
        'user_pw.required'=>'密码不能为空！',
        'user_pw.min'=>'不能少于6位',
        ];
        $this->validate($request,$rules,$message);
        //接受所有的数据,用于判断
        $code = $request->code;
        $phone = $request->phone;
        $pw=$request->user_pw;
        $pw=Crypt::encrypt($pw);
        $input=['user_ph'=>$phone,'user_pw'=>$pw];
        //dd($input);
        // dd($phone);
        //$a = "验证码错误";
        if($code==session('code')){
            if($phone==session('phone')){
                $res=DB::table('user')->where('user_ph', $phone)->update(['user_pw'=>$pw]);
                if($res){
                    return redirect('/login')->with('success','密码修改成功');
                }else{
                    return back()->with('error','未知错误');
                }
            }else{
                return back()->with('error','手机输入错误');
            }
        }else{
            return back()->with('error',"验证码输入有误");
        }
    }
     //手机短信
    public function shouji(Request $request){
        set_time_limit(0);
        header('Content-Type: text/plain; charset=utf-8');
        $code = mt_rand(100000,999999);
        $phone =$request->phone;
        // return $phone;
        $ph = DB::table('user')->lists('user_ph');
        // return $ph[0];
        if(in_array($phone,$ph)){
            session(["phone"=> $phone]);
            session(["code"=> $code]);
            $response = SmsDemo::sendSms(
                "刘家炒鸡店", // 短信签名
                "SMS_114385956", // 短信模板编号
                $phone, // 短信接收者
                Array(  // 短信模板中字段的值
                    "code"=>$code
                ),
                "123"   // 流水号,选填
            );
            if($response->Message == "OK"){
                $data=['status'=>0,'msg'=>"发送成功"];
                return $data;
            }else{
                $data=['status'=>1,'msg'=>"发送失败"];
                return $data;
            }
        }else{
            $data=['status'=>2,'msg'=>"手机号输入有误,请稍后重试"];
            return $data;
        }
    }
}
