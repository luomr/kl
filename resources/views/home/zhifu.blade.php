<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type='text/css' href="/css/common.css">
    <link rel="stylesheet" type='text/css' href="/css/PCstyle.css">
    <script type="text/javascript" src='/js/jquery.js'></script>
    <script type="text/javascript" src='/js/zhifu.js'></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
</head>

<body ng-app="myApp" ng-controller="mainCtrl" class="ng-scope">     
<div class="wrapper wap_top_x ng-scope">
    <div class="main_main">
        <div class="main100 main_title wap_hide">
            <span><a href="/" title="">首页&nbsp;&gt;</a></span><span>我的订单</span>
        </div>
        <div class="replen-title">
            <p>订单提交成功，请您尽快付款<span class="pc_hide"><br></span>
                
                <span class="ml15">订单号&nbsp;:&nbsp;</span>#<em id="danhao">{{$danhao}}</em><br>订单提示&nbsp;
                @if(is_array($order))
                @foreach ($order as $v)    
                <input class="orid" type="hidden" value="{{$v->id}}">
                    @endforeach
                    @else 
                    <input class="orid" type="hidden" value="{{$order->id}}">
                    @endif
                    <span id='tishi'>
                    "请您在提交订单<span class="color_red">24小时</span>内完成支付，否则订单会自动取消"
                    </span>
            </p>
            <div class="pa"><span id='yifu'>应付金额</span><strong>RMB<span id="order_pay_money">{{$sum}}</span></strong></div>
            
        </div>
        <!--付款-->
        <div class="main100 replen-content" id='fangshi'>
            <div class="replen-pay-title">选择支付方式</div>
            <div class="jz_content wap_hide">
                <div class="main100 jz_fu_main">
                    <input id='zhifubao' type="radio" name="fu" ng-click="choose_pay(pc_pay.alipay.baisonkey,2,$event)" value="2" class="jz_fu_btn">
                    <img src="/images/fu22.jpg" class="jz_fu_img">
                </div>
                <div id="pc_pay_vcode1" class="cus_html ng-binding" ng-bind-html="pc_pay_vcode"></div>
                
                <div class="main100 jz_fu_main">
                    <input id='yinlian' type="radio" name="fu" ng-click="choose_pay(&#39;chinapay&#39;,1,$event)" value="3" class="jz_fu_btn">
                    <img src="/images/fu11.jpg" class="jz_fu_img">.
                </div>
                
                <div id="pc_pay_vcode2" class="cus_html ng-binding" ng-bind-html="pc_pay_vcode"></div>
            </div>
            <!--手机端支付-->
            <div style="display:block;">
                <button id='liji' style='width:120px;height:32px;background:#222;color:white;border:0;font-size:18px;margin:20px auto;display:none;cursor:pointer'>立即支付</button>
                <div id="h5_pay_vcode" style="display:block;"></div>
            </div>
        </div>
    </div>
     <!--页面主体 end--> 
</div><!--wrapper ed--> 

</div>
</div>

</body></html>
