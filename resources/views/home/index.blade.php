<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网易考拉海购-网易旗下_正品低价_海外直采_海外直邮</title>
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</head>
<body>

  @include('home/head')
    <!-- 顶部导航栏 -->

<!-- ========================================顶部公共部分结束=================================== -->

      <!-- banner图片 -->
      <div class="topBgWrap">
        <div class="imgBox">
          <section id="picBox" class="sliderBox sliderBox2">
            <ul id="show_pic">
            @foreach ($banner as $k=>$v)
             <li><a href="/list/{{$cateclick[$k]}}/edit" target="_blank"><img src="{{$v->img}}"></a></li>
            @endforeach
            </ul>
            <ol class="show_pic">
                @for($i=0;$i<$arr;$i++)
              <li>{{$i+1}}</li>
              @endfor
            </ol>
           <div class="arrow arrowleft">
              <span></span>
            </div>
            <div class="arrow arrowright">
              <span></span>
            </div>
          </section>
        </div>
      </div>
      <!-- 侧边栏 -->
      <div class="page4">
            <div class="bian">
                <!-- 左边栏 -->
                <div class="left_nav">
                    <div>
                        <img src="/images/ip50ucjr81_99_49.jpg">
                    </div>
                    <ul class="channel">
                        <li><a href="#xian">今日限购</a></li>
                        <li><a href="#hot">热门品牌</a></li>
                    </ul>
                    <ul class="floor">
                        @foreach ($cateres as $v)
                        <li><a href="#{{$v->id}}">{{$v->catename}}</a></li>
                        @endforeach
                    </ul>
                    <div>
                        <a href="">
                            <img src="/images/izgqdo7f9_99_128.jpg">
                        </a>
                    </div>
                </div>
                <!-- 右边栏 -->
                <div class="right_nav">
                    <a href=""></a>
                    <a href=""></a>
                    <a class="app" href="">
                        <div>
                            <img src="/images/qrcode-app.png.jpg">
                        </div>
                    </a>
                    <a href=""></a>
                    <a href=""></a>
                </div>
            </div>
      </div>
      <!-- 商品 -->
        <div class="page5">
            <!-- 专场 -->
            <div class="zhuan">
                <div>
                    <a href="" target="_blank">
                    <img src="/images/1buqtibnt2_265_220.jpg"></a>
                </div>
                <div>
                    <a href="" target="_blank">
                    <img src="/images/1buqtjaua63_265_220.jpg"></a>
                </div>
                <div>
                    <a href="" target="_blank">
                    <img src="/images/1busmqija1_265_220.jpg"></a>
                </div>
                <div>
                    <a href="" target="_blank">
                    <img src="/images/1buqtkljq77_265_220.jpg"></a>
                </div>
            </div>
            <!-- 今日限时抢购 -->
            <div id="xian" class="xianshi">
                <div class="xian_tit">
                    <h2>今日限时购</h2>
                    <span class="time">
                        本场还剩：
                        <i>0</i>
                    </span>
                    <a href="">进入限时抢购频道&gt;</a>
                </div>
                <div class="xian_con">
                    <div class="con_left">
                      
                    @foreach ($shop as $sh)
                    @foreach ($sh as $s)
                    @if ($s->listcate2 == 67)
                    <div class="xian_goods">
                        <div class="goods_pic">
                            <a href="/details/{{$s->infotime}}" target="_blank">
                                <img src="{{isset(explode(' ',$s->infoimg)[0])?explode(' ',$s->infoimg)[0]:$s->infoimg}}" style="width:188px">
                            </a>
                        </div>
                        <div class="goods_list">
                            <p class="list1">
                                <a href=""></a>
                            </p>
                            <p class="list2">
                                <a href="/details/{{$s->infotime}}" target="_blank">{{$s->listname}}</a>
                            </p>
                            <p class="list3">
                                <span>￥{{$s->infosale}}</span>
                                <del>￥{{$s->infoprice}}</del>
                            </p>
                            <div class="list4">
                                <span>剩余{{$s->infonum}}件</span>
                                <a href="/details/{{$s->infotime}}" target="_blank">立即抢购</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                    
                    </div>

                    <div class="con_right">
                        <a href="">
                            <img src="@foreach ($ad as $v) @if ($v->adname == '限时购') {{$v->adimg}} @endif @endforeach">
                        </a>
                    </div>
                </div>
            </div>

            <!-- 分类专区 -->
            @foreach ($cateres as $cat)
            <div id="{{$cat->id}}" class="cat">
                <div class="cat_tit">
                    <h2>{{$cat->catename}}</h2>
                    <span>
                        热搜词:
                        @if (is_array($cat->children))
                         @foreach ($cat->children as $cat1)
                        <a href="/list/{{$cat1->id}}" target="_blank">{{$cat1->catename}}</a>
                        |
                        @endforeach
                        @endif
                    </span>
                    <a class="gd" href="">更多好货 &gt</a>
                </div>
                <div class="cat_con">
                    <div class="con_left">
                        <a href="" target="_blank">
                            <img src="@foreach ($ad as $v) @if ($v->adname == $cat->catename) {{$v->adimg}} @endif @endforeach">
                        </a>
                        <ul>
                            @if (is_array($cat->children))
                            @foreach ($cat->children as $cat1)
                            <a href="/list/{{$cat1->id}}" target="_blank"><li>
                                {{$cat1->catename}}
                            </li></a>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="con_mid">
                        @foreach ($shop as $sh)
                        @foreach ($sh as $s)
                        @if ($s->listcate2 == $cat->id)
                        <a href="/details/{{$s->infotime}}" target="_blank">
                            <h3>优惠特价</h3>
                            <p style="width:200px;height:20px;overflow: hidden;text-overflow: ellipsis;padding:0 0;">{{$s->listname}}</p>
                            <img src="{{isset(explode(' ',$s->infoimg)[0])?explode(' ',$s->infoimg)[0]:$s->infoimg}}" style="width:148px">
                        </a>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                    <div class="con_right">
                        <h3>最新热卖</h3>
                       <div class="pro_list">
                            <div class="pro pro_show">
                                <div>
                                    @foreach ($shop as $sh)
                                    @foreach ($sh as $s)
                                    @if ($s->listcate2 == $cat->id)
                                    <div class="list">
                                        <a href="/details/{{$s->infotime}}" target="_blank">
                                            <img src="{{isset(explode(' ',$s->infoimg)[0])?explode(' ',$s->infoimg)[0]:$s->infoimg}}" style="width:75px">
                                        </a>
                                        <div>
                                            <a href="/details/{{$s->infotime}}" target="_blank"><p style="width:125px;height:36px;overflow: hidden;text-overflow: ellipsis;padding:0 0;">{{$s->listname}}</p></a>
                                            <span>￥{{$s->infosale}}</span>
                                            <del>￥{{$s->infoprice}}</del>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="pro">
                                <div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE  成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养fsgvyseguj 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <a href="">
                                            <img src="/images/e4aad7c6-673c-4c28-9cc7-a3d44731cd04.jpg">
                                        </a>
                                        <div>
                                            <a href=""><p>CHILDLIFE 童年时光 钙镁锌 成长营养液 474毫升</p></a>
                                            <span>￥182</span>
                                            <del>￥228</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <ul class="pro_ul">
                            <li class="pro_li"></li>
                            <li></li>
                            <li></li>
                       </ul>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- 猜你喜欢 -->
            <div class="sup">
                <div class="sup_tit">
                    <h2>猜你喜欢</h2>
                    <span>
                        根据你的浏览记录推荐的商品
                    </span>
                </div>
                <div class="sup_con">
                    @foreach ($shop as $sh)
                    @foreach ($sh as $s)
                    @if ($s->listcate2 == 65)
                    <div>
                        <a class="sup_img" href="/details/{{$s->infotime}}" target="_blank">
                            <img src="{{str_limit($s->infoimg,38)}}" style="width:270px">
                        </a>
                        <p class="sup_name">
                            <a href="/details/{{$s->infotime}}" target="_blank">{{$s->listname}}</a>
                        </p>
                        <p class="sup_pri">
                            <span>￥{{$s->infosale}}</span>
                            <del>￥{{$s->infoprice}}</del>
                        </p>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
<!-- 尾部部分 -->
        <div class="gg">
          <img src="/images/1bgb081a178_800_490.jpg"/>
          <div class="close"></div>
          <a href="" class="link"></a>
        </div>
    <!-- 联系方式 -->
       @include('home/foot')
</body>
</html>