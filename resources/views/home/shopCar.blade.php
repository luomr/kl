<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车管理</title>
    <link rel="stylesheet" type="text/css" href="/css/shopcar.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/js/shopcar.js"></script>
</head>
<body>
    @include('home/head')
    @if(session('data') and isset($shopcartall))
     <section class="cartMain">
        <div class="cartMain_hd">
            <ul class="order_lists cartTop">
                <li class="list_chk">
                    <!--所有商品全选-->
                    <input type="checkbox" id="all" class="whole_check">
                    <label for="all"></label>
                    全选
                </li>
                <li class="list_con">商品信息</li>
                <li class="list_info"><!-- 商品参数 --></li>
                <li class="list_price">单价</li>
                <li class="list_amount">数量</li>
                <li class="list_sum">金额</li>
                <li class="list_op">操作</li>
            </ul>
        </div>
        <div class="cartBox">
            <div class="shop_info">
                <div class="all_check">
                    <!--店铺全选-->
                    <input type="checkbox" id="shop_a" class="shopChoice">
                    <label for="shop_a" class="shop"></label>
                </div>
                <div class="shop_name">
                    自营保税仓
                </div>
            </div>
            <div class="order_content">
                @foreach($shopcartall as $k=>$v)
                @if($v->user_id == session('data')->id)
                <ul class="order_lists">
                    <input type="hidden" class="shopcarid" value="{{$v->id}}">
                    <input type="hidden" class="shopcarstate" value="{{$v->state}}">
                    <li class="list_chk">
                        <input type="checkbox" id="{{$k}}" class="son_check">
                        <label for="{{$k}}"></label>
                    </li>
                    <li class="list_con">
                        <div class="list_img"><a href="javascript:;"><img src="{{$v->goods_img}}" alt=""></a></div>
                        <div class="list_text"><a href="javascript:;">{{$v->goods_name}}</a></div>
                    </li>
                    <li class="list_info">
                       <!--  <p>规格：默认</p>
                        <p>尺寸：16*16*3(cm)</p> -->
                    </li>
                    <li class="list_price">
                        <p class="price">￥{{$v->goods_price}}</p>
                    </li>
                    <li class="list_amount">
                        <div class="amount_box">
                            <a href="javascript:;" class="reduce reSty">-</a>
                            <input type="text" value="{{$v->num}}" class="sum">
                            <a href="javascript:;" class="plus">+</a>
                        </div>
                    </li>
                    <li class="list_sum">
                        <p class="sum_price">￥{{$v->goods_price*$v->num}}</p>
                    </li>
                    <li class="list_op">
                        <p class="del"><a href="javascript:;" class="delBtn">移除商品</a></p>
                    </li>
                </ul>
                @endif
                @endforeach
            </div>
        </div>

        <!--底部-->
        <div class="bar-wrapper">
            <div class="bar-right">
                <div class="piece">已选商品<strong class="piece_num">0</strong>件</div>
                <div class="totalMoney">共计: <strong class="total_text">¥0</strong></div>
                <div class="calBtn"><a href="javascript:;">结算</a></div>
            </div>
        </div>
    </section>
    <section class="model_bg"></section>
    <section class="my_model">
        <p class="title">删除宝贝<span class="closeModel">X</span></p>
        <p>您确认要删除该宝贝吗？</p>
        <div class="opBtn"><a href="javascript:;" class="dialog-sure">确定</a><a href="javascript:;" class="dialog-close">关闭</a></div>
    </section>
    @else
    @if(!empty(session('shopcar')))
    <section class="cartMain">
        <div class="cartMain_hd">
            <ul class="order_lists cartTop">
                <li class="list_chk">
                    <!--所有商品全选-->
                    <input type="checkbox" id="all" class="whole_check">
                    <label for="all"></label>
                    全选
                </li>
                <li class="list_con">商品信息</li>
                <li class="list_info"><!-- 商品参数 --></li>
                <li class="list_price">单价</li>
                <li class="list_amount">数量</li>
                <li class="list_sum">金额</li>
                <li class="list_op">操作</li>
            </ul>
        </div>
        <div class="cartBox">
            <div class="shop_info">
                <div class="all_check">
                    <!--店铺全选-->
                    <input type="checkbox" id="shop_a" class="shopChoice">
                    <label for="shop_a" class="shop"></label>
                </div>
                <div class="shop_name">
                    自营保税仓
                </div>
            </div>
            <div class="order_content">
                @foreach(session('shopcar') as $k=>$v)
                <ul class="order_lists">
                    <input type="hidden" class="sessionorder" value="{{$k}}">
                    <input type="hidden" class="inventory" value="{{$v['inventory']}}">
                    <li class="list_chk">
                        <input type="checkbox" id="{{$k}}" class="son_check">
                        <label for="{{$k}}"></label>
                    </li>
                    <li class="list_con">
                        <div class="list_img"><a href="javascript:;"><img src="{{$v['goods_img']}}" alt=""></a></div>
                        <div class="list_text"><a href="javascript:;">{{$v['goods_name']}}</a></div>
                    </li>
                    <li class="list_info">
                       <!--  <p>规格：默认</p>
                        <p>尺寸：16*16*3(cm)</p> -->
                    </li>
                    <li class="list_price">
                        <p class="price">￥{{$v['goods_price']}}</p>
                    </li>
                    <li class="list_amount">
                        <div class="amount_box">
                            <a href="javascript:;" class="reduce reSty">-</a>
                            <input type="text" value="{{$v['num']}}" class="sum">
                            <a href="javascript:;" class="plus">+</a>
                        </div>
                    </li>
                    <li class="list_sum">
                        <p class="sum_price">￥{{$v['goods_price']*$v['num']}}</p>
                    </li>
                    <li class="list_op">
                        <p class="del"><a href="javascript:;" class="delBtn">移除商品</a></p>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>

        <!--底部-->
        <div class="bar-wrapper">
            <div class="bar-right">
                <div class="piece">已选商品<strong class="piece_num">0</strong>件</div>
                <div class="totalMoney">共计: <strong class="total_text">¥0</strong></div>
                <div class="calBtn"><a href="/login">结算</a></div>
            </div>
        </div>
    </section>
    <section class="model_bg"></section>
    <section class="my_model">
        <p class="title">删除宝贝<span class="closeModel">X</span></p>
        <p>您确认要删除该宝贝吗？</p>
        <div class="opBtn"><a href="javascript:;" class="dialog-sure">确定</a><a href="javascript:;" class="dialog-close">关闭</a></div>
    </section>
    @else
    <div class="cartMain" style="text-align:center;font-size:18px;">
        <span style="display:block;margin-top:150px">购物车里空空如也，赶紧去 <a href="/">逛逛吧&gt;</a></span>
        <span>或者您可以先进行 <a href="/login">登录></span>
    </div>
    @endif
    @endif
    @include('home/foot')
</body>
</html>