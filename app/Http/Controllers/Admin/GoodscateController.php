<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Goodscate;

class GoodscateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //dd($data);
        return view('admin/goodscate/index')->with('data',$data);
    }

    public function changeorder(Request $request){
        //return $request->cateorder;
        $goodscate=Goodscate::find($request->id);//用model类实现数据的更改
        $goodscate->cateorder=$request->cateorder;
        $res=$goodscate->update();
        if($res){
            $data=['status'=>0,'msg'=>'分类排序更新成功！'];
        }else{
            $data=['status'=>1,'msg'=>'分类排序更新失败，请稍后重试！'];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        //dd($data);
        return view('admin/goodscate/add')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $rules=['catename'=>'required'];
        $message=['catename.required'=>'分类名称不能为空'];
        // 方法1
        // 需要use Validator;
        if($input['catename']==null){
            die("<script>alert('数据不能为空');javascript:history.go(-1);</script>");
        }
        $validator=Validator::make($input,$rules,$message);
        if($validator->passes()){
            //取得商品列表中catename字段中的一列

            $name = DB::table('goodscate')->lists('catename');
            //如果用户名匹配成功
            if(in_array($input['catename'],$name)){
                return back()->with('errors','该数据已存在,请重新添加');
            }else{
                $re=Goodscate::create($input);//用model类来实现数据的插入,用guarded方法
                //dd($re);
                if($re){
                    return redirect('admin/goodscate');//里面的参数为手册P39页面中的路径，前台页面中的跳转也是路径
                }else{
                    return back()->with('errors','数据填充失败，请稍后重试！');
                }
            }
        }else{
            return back()->withErrors($validator);
        }
        //方法2：
        // $this->validate($request,$rules,$message);//$request必须为对象
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
        // return $id;
        $field=Goodscate::find($id);
        $goodscate=new Goodscate();
        $data=$goodscate->tree();
        return view('admin/goodscate/edit',compact('field','data'));
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
        $input=$request->except('_token','_method');
        // dd($input);
        $res=Goodscate::where('id',$id)->update($input);
        if($res){
            return redirect('admin/goodscate');
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

        $goodscate=new Goodscate();
        $data=$goodscate->getchildrenid($id);
        $res=Goodscate::where('id',$id)->delete();
        // dd($res);
        if($res){
            // foreach($data as $v){
            //     $res=Goodscate::where('id',$v)->delete();
            // }//删除成功后，删除其所有的子类
            foreach($data as $v){
                $res=Goodscate::where('id',$v)->update(['catepid'=>0]);
            }//删除成功后，将其的子类的pid设置为0；
            $data=['status'=>0,'msg'=>'分类删除成功！'];
        }else{
            $data=['status'=>1,'msg'=>'分类删除失败，请稍后重试！'];
        }
        return $data;
    }
    public function search(Request $request){
        $keywords = $request->keywords;
        // dd($keywords);
        $data = Goodscate::where('catename', 'like',"%{$keywords}%")->orWhere('id', $keywords)->orWhere('catepid', $keywords)->get();
        // dd($admin);
       return view('admin/goodscate/index', compact('data','keywords'));
    }
}
