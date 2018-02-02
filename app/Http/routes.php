<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//后台路由
Route::get('admin/login', 'admin\AdminLoginController@login');
Route::post('admin/dologin', 'admin\AdminLoginController@dologin');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware'=>'admin.login'], function()
{
    //首页
    Route::get('/', 'IndexController@index');
    Route::get('/main', 'IndexController@main');
    Route::get('/loginout', 'IndexController@loginout');
    //管理员管理路由
    Route::any("/admin/search","AdminController@search");
    Route::post("/admin/changestate","AdminController@changestate");
    Route::resource('/admin', 'AdminController');
    //轮播图管理
    Route::get('/carousel/index', 'CarouselController@index');
    Route::any('/carousel/update', 'CarouselController@update');
    Route::any("/carousel/search","CarouselController@search");
    Route::resource('/carousel', 'CarouselController');
    //会员管理
    Route::get("/member/search","MemberController@search");
    Route::post("/member/changestate","MemberController@changestate");
    Route::resource('/member', 'MemberController');
    //评论管理
    Route::any('/comment/search','CommentController@search');
    Route::post("/comment/changestate","CommentController@changestate");
    Route::resource('/comment', 'CommentController');
    //商品分类管理
    Route::any("/goodscate/search","GoodscateController@search");
    Route::any("/goodscate/changeorder","GoodscateController@changeorder");
    Route::resource('/goodscate', 'GoodscateController');
    //商品类别管理
    Route::resource('/goodstype', 'GoodstypeController');
     //商品管理
    Route::post("/goodscate/changeorder","GoodscateController@changeorder");
    Route::resource('/goodscate', 'GoodscateController');
     // 商品属性
    Route::put('/goodsattr','GoodsattrController@update');
    Route::any('/goodsattr/search','GoodsattrController@search');
    Route::resource('/goodsattr', 'GoodsattrController');
    // 商品属性值
    Route::put('/goodsattrvalue','GoodsattrvalueController@update');
    Route::any('/goodsattrvalue/search','GoodsattrvalueController@search');
    Route::resource('/goodsattrvalue','GoodsattrvalueController');
    // 商品分类对应属性
    Route::put('/cateattr','CateattrController@update');
    Route::resource('/cateattr','CateattrController');
    // 商品管理
    Route::put('/goods','GoodsController@update');
    Route::any('/goods/search','GoodsController@search');
    Route::resource('/goods','GoodsController');
    //商品其他信息
    Route::put('/goodsinfo','GoodsinfoController@update');
    Route::any('/goodsinfo/search','GoodsinfoController@search');
    Route::resource('/goodsinfo','GoodsinfoController');
    //订单管理
    //后台的从待发货变为待收货
    Route::any("/order/changeorderstate","OrderController@changeorderstate");
    //前台的从待收货变为交易完成
    Route::any("/order/changeorderstate1","OrderController@changeorderstate1");
    Route::resource('/order', 'OrderController');
    //导航栏管理
    Route::resource('/nav', 'NavController');
    Route::any('/nav/update','NavController@update');
    Route::any('/nav/search','NavController@search');
    // 广告专栏
    Route::resource('/ad','AdController');
});
// 前台路由
Route::group(['namespace' => 'Home'],function(){
    //首页
    Route::resource('/','IndexController');
    // 列表页
    Route::get('/list/shop','ListController@shop');
    Route::resource('/list','ListController');
    // 详情页
    Route::any('/details/changeinventory','DetailsController@changeinventory');
    Route::resource('/details','DetailsController');
   // 登录页
    Route::post('/dologin','LoginController@dologin');
    Route::get('/esc','LoginController@esc');
    Route::resource('/login','LoginController');
    // 注册
    Route::post('/doregister','RegisterController@doregister');
    Route::post('/register/shouji','RegisterController@shouji');
    Route::resource('/register','RegisterController');
    // 找回密码
    Route::post('/dofind','FindController@dofind');
    Route::post('/shouji','FindController@shouji');
    Route::resource('/find','FindController');
    // 购物车
    Route::post('/shopCar/delsession','ShopCarController@delsession');
    Route::post('/shopCar/changesession','ShopCarController@changesession');
    Route::post('/shopCar/changestate','ShopCarController@changestate');
    Route::any('/shopCar/changestate1','ShopCarController@changestate1');
    Route::any('/shopCar/changenum','ShopCarController@changenum');
    Route::any('/shopCar/changenum1','ShopCarController@changenum1');
    Route::any('/shopCar/delshopcar','ShopCarController@delshopcar');
    Route::resource('/shopCar','ShopCarController');
    // 我的订单
    Route::put('/person','PersonController@update');
    Route::resource('/person','PersonController');
    //地址管理
    Route::any('/address/defaultAddress','AddressController@defaultAddress');
    Route::resource('/address','AddressController');
    //结算管理
    Route::resource('/pay','PayController');
    // 支付
    Route::resource('/zhifu',"ZhifuController");
    // 评论
    Route::resource('/comment','CommentController');
});
