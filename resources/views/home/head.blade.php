<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网易考拉海购-网易旗下_正品低价_海外直采_海外直邮</title>
    <link rel="stylesheet" href="/css/head.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/head.js"></script>
</head>
<body>
    <!-- 顶部导航栏 -->
    <div id="topNav">
        <div id="topNavWrap" class="clearf">
            <div id="topNavLeft" class="fl">
                @if(session('data')=='')
                <span>考拉欢迎你！</span>
                <a href="/login" class="login" target="_blank">登录</a>
                <span class="sep">|</span>
                <a href="/register" target="_blank">免费注册</a>
             @else
                <a href="###" class="login"><span>您好,</span>{{session('data')->user_ph}}</a>
                <span class="sep">|</span>
                <a href="/esc">退出</a>
            @endif
            </div>
            <div id="topNavLeft2" class="fl">
                <a href="" class="app">
                    手机考拉海购
                    <span class="m-notice">
                        <img src="/images/2dcode-app3.jpg" alt="">
                        <span class="txt">下载APP<br>领1000元新人礼包</span>
                    </span>
                </a>
            </div>
            <ul id="topNavRight" class="fr">
                <li>
                  <a href="" class="toplevel">每日签到</a>
                   <span class="sep">|</span>
                </li>
                <li>
                    <a href="/person" class="toplevel" target="_blank">我的订单</a>
                    <span class="sep">|</span>
                </li>
                <li>
                    <div class="mcDropMenuBox">
                        <a href="/person" class="topNavHolder" target="_blank">个人中心<i class="arr"></i></a>
                        <span class="sep">|</span>
                        <div class="mcDropMenu">
                           <a href="">我的优惠券</a>
                           <a href="">我的考拉豆</a>
                           <a href="">帐号管理</a>
                           <a href="">我的实名认证</a>
                           <a href="">我收藏的商品</a>
                           <a href="">我关注的品牌</a>
                           <a href="">售后管理</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="mcDropMenuBox">
                         <a href="" class="topNavHolder">客户服务<i class="arr"></i></a>
                    <span class="sep">|</span>
                    <div class="mcDropMenu">
                        <a href="">联系客服</a>
                       <a href="">帮助中心</a>
                    </div>
                    </div>
                </li>
                <li>
                    <div class="mcDropMenuBox">
                         <a href="" class="topNavHolder">充值中心<i class="arr"></i></a>
                    <span class="sep">|</span>
                    <div class="mcDropMenu">
                        <a href="">话费流量</a>
                       <a href="">游戏充值</a>
                       <a href="">AppStore充值码</a>
                    </div>
                    </div>
                </li>
                <li><a href="" class="toplevel">消费者告知书</a><span class="sep">|</span></li>
                <li>
                    <div class="mcDropMenuBox">
                         <a href="" class="topNavHolder">更多<i class="arr"></i></a>
                    <span class="sep">|</span>
                    <div class="mcDropMenu">
                        <a href="">收藏本站</a>
                       <a href="">新浪微博</a>
                       <a href="">微信公众号</a>
                       <a href="">易信公众号</a>
                       <a href="">招商合作</a>
                        <a href="">考拉招聘</a>
                    </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- 搜索框部分 -->
    <div id="docHead">
        <div id="docHeadWrap">
            <a href="/" class="logokaola"></a>
            <div class="searchBar">
            <div class="topsearchbox">
              <form action="/" method="post">
                {!! csrf_field() !!}
                <input type="text" placeholder="成人奶粉" name="keywords">
                <button>搜索</button>
              </form>
            </div>
            <ul class="suggestlist clearf">
                @foreach ($sea as $s)
                <li><span class="suggestlistson">|</span><a href="/list/{{$s->id}}" target="_blank">{{$s->catename}}</a></li>
                @endforeach
                <script>
                  $('.suggestlistson').eq(0).css('display','none');
                </script>
            </ul>
        </div>
        <a class="m-shopcartnew" href="/shopCar">
            <span style="color:#000">购物车<span class="shopnum"></span></span>
        </a>
        </div>
    </div>
    <!-- 二级菜单 -->
    <div id="topTabBox">
        <div id="topTab">
            <div id="topCats" class="navitm-cats ">
                <div class="toplevel">
                    <div class="lineicon">
                        <i></i>
                        <i></i>
                        <i></i>
                    </div>
                    <span>所有分类</span>
                </div>

                <ul class="catitmlst">
                  @foreach ($cateres as $v)
                   <li>
                       <img src="/images/iqkplg1m99_40_40.png" alt="" class="icon">
                       <span class="t">{{$v->catename}}</span>
                       <span class="arrow"></span>
                       <em class="seg"></em>
                       <div class="m-ctgcard">
                        <div class="fl m-ctglist">
                          <!-- 二级导航栏中的左边内容 -->
                          <div class="m-ctgtbl">
                            <div>
                              @if(is_array($v->children))
                              @foreach ($v->children as $v1)
                             <div class="litd">
                               <div class="item">
                                 <p class="title"><a href="/list/{{$v1->id}}" class="cat2" target="_blank">{{$v1->catename}}</a></p>
                                 <div class="ctgnamebox">
                                  @if(is_array($v1->grandchildren))
                                  @foreach ($v1->grandchildren as $v2)
                                  <a href="/list/{{$v2->id}}/edit" class="f-fcred3" target="_blank">{{$v2->catename}}</a>
                                  @endforeach
                                  @endif
                                 </div>
                               </div>
                             </div>
                             @endforeach
                             @endif
                          </div>
                        </div>
                   </li>
                   @endforeach
                </ul>
            </div>
            <ul id="funcTab">
              @foreach ($link as $l)
            <li><a href="{{$l->link}}" target="_blank">{{$l->name}}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
</body>
</html>