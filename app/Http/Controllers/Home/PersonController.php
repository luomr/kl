<?php

namespace App\Http\Controllers\Home;
use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Model\Address;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\http\Model\Order;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!is_null(session('data'))){
            $address=Address::where('user_id',session('data')->id)->take(3)->get();
            $cart = DB::table('shopcart')->where('user_id',session('data')->id)->get();
            if(empty($cart)){
                $order = "";
                return view('home.person',compact('address','order'));
            }else{
                $order = Order::
                            join("shopcart","shopcart.id","=",'order.ordershop')
                            ->join("address",'address.id','=','order.orderaddress')
                            ->select('address.*','shopcart.*','order.*')
                            ->orderBy('order.id','desc')
                            ->get();
                // dd($order);
                return view('home.person',compact('address','order'));
            }
        }else{
            return redirect()->action('Home\LoginController@index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $res = Order::where('id',$request->id)->update(['orderstatus'=>7]);
        if($res){
           $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'操作失败，请稍后重试！'];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $res = Order::where('id',$request->id)->update(['orderstatus'=>5]);
        if($res){
           $data=['status'=>0,'msg'=>'订单已取消！'];
        }else{
            $data=['status'=>1,'msg'=>'操作失败，请稍后重试！'];
        }
        return $data;
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
        // 上传图片
        if(!empty($request->user_img)){
            if ($request->isMethod('put')) {
                $file = $request->file('user_img');
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
                        $input['user_img']='/uploads/'.$filename;
                    }
                }
            }
            $res = DB::table("user")->where('id',$id)->update($input);
            if($res){
              return redirect()->action('Home\PersonController@index');
          }else{

          }
        }else{
            //dd($input);
            $res = DB::table("user")->where('id',$id)->update($input);
            if($res){
              return redirect()->action('Home\PersonController@index');
            
             }else{
                return "修改失败";
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
        $res = DB::table('order')->delete($id);
        if($res){
            $data=['status'=>0,'msg'=>'删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'操作失败，请稍后重试！'];
        }
        return $data;
    }
}
