<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>_价格_评价-网易考拉海购</title>
    <link rel="stylesheet" href="/css/details.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/details.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript">
      window.onload = function () {
          // 获取所需要操作的对象
          var small = document.getElementById("showImgBox");
          var big = document.getElementById("showDetails");
          // 鼠标移动到对象上显示放大镜和放大镜放大后的图像
          small.onmouseover = function(){
            big.style.display = "block";
          }

          // 鼠标移出对象时隐藏放大镜和放大镜放大后的图像
          small.onmouseout = function(){
            big.style.display = "none";
          }

          // 鼠标在对象上移动触发的事件
          small.onmousemove = function(e){
            //alert("123");
            var event = e || window.event;
            //获取小图每个点的x轴坐标
            var spotX = event.clientX;
            //获取小图每个点的y轴坐标
            var spotY = event.clientY;
            //获取小图左边的距离
            var smallLeft = small.offsetLeft;
            //获取小图顶部的距离
            var smallTop = small.offsetTop;
            //获取小图的点距离左边框的距离
            var width = spotX - smallLeft;
            //获取小图的点距离上边框的距离
            var height = spotY - smallTop;
            //获取小图的宽度
            var smallWidth = small.offsetWidth;
            //获取小图的高度
            var smallHeight = small.offsetHeight;
            //转化为百分比
            var px = width / smallWidth * 100;
            //alert(px);
            var py = height / smallHeight * 100;
            //parseInt():作用是取整
            px = parseInt(px)-30;
            py = parseInt(py)-60;
            big.style.backgroundPosition = px+'%'+py+'%';
          }
          }
    </script>
</head>
<body>
  @include('home/head')
    <!-- ======公共部分结束 -->
    <div class="mainWrap">
        <!-- 位置信息 -->
        @if (is_array($goods))
        @foreach ($goods as $gd)
        <input type="hidden" value="{{$gd->infotime}}" id="infotime">
        <div id="catbarbox" class="crumbsbox">
            <div class="crumbs">
                <a href="/">网易考拉海购</a>
                <span> > </span>
                <span class="crumbs-title"> {{$gd->listname}} {{$gd->valueattr}}
                  @foreach ($value as $va)
                        @if ($gd->infoattr2 == $va->id) {{$va->valueattr}} @endif
                  @endforeach</span>
            </div>
        </div>
        <!-- 详情部分 -->
        <div id="j-producthead" class="clearf">
            <!-- 左边图片部分 -->
            <div class="PImgBox m-productimgbox clearf">
                <!-- 箭头 -->
                <a href="javascript:;" class="scrollBtn scrollleft sign icon-arrow-left scrollDis" id="auto-id-1511167589824"><span></span></a>
                <a href="javascript:;" class="scrollBtn scrollright sign icon-arrow-left scrollDis" id="auto-id-1511167589824"><span></span></a>
                <!-- 图片 -->
                <div class="litimg_box">
                  <ul id="litimgUl">
                    @foreach ($arr as $v)
                    <li id="auto-id-1511278166952" class="active">
                      <a href="javascript:;"><img src="{{$v}}" alt="" class="" style="width:60px "></a>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <div id="showImgBox">
                   <!-- 图片展示 -->
                   @foreach ($arr as $v)
                   <img src="{{$v}}" alt="{{$gd->listname}}" class="" >
                   @endforeach
                </div>
                <!-- 放大用图片 -->
                <div id="showDetails" style='border:1px solid yellow;background:white url("{{isset(explode(" ",$v)[0])?explode(" ",$v)[0]:$v}}") no-repeat 20% 20%;background-size:200% 200%;'>

                </div>
            </div>
            <!-- 右边信息部分 -->
            <dl class="PInfo PInfo-standout">
              <dt class="orig-country">
                <span class="split">|</span>
                <a>{{$gd->listname}}</a>
              </dt>
              <dt class="product-title">
                <span>{{$gd->listname}} {{$gd->valueattr}}
                                        @foreach ($value as $va)
                                              @if ($gd->infoattr2 == $va->id) {{$va->valueattr}} @endif
                                        @endforeach</span>
              </dt>
              <dt class="subTit">
                {{$gd->listtitle}}
              </dt>
              <dd class="m-price-wrap clearf">
                <div class="m-price fl">
                  <span class="m-line-title m-price-title j-price-title">售价</span>
                </div>
                <div class="m-price-cnt fl">
                  <span class="PInfo_r currentPrice">
                    ¥
                    <span>{{$gd->infosale}}</span>
                  </span>
                  <span class="PInfo_r marketPrice j-marketprice">
                  参考价&nbsp;&nbsp;¥
                  <span>{{$gd->infoprice}}</span>
                  </span>
                </div>
              </dd>
               <div class="clearf">
                  <form action="">
                    <div class="buybox">
                      <span class="buynum">数量</span>
                      <span class="ctrnum-wrap clearf">
                        <span class="minus reSty">-</span>
                        <input type="text" value="1">
                        <span class="plus">+</span>
                      </span>
                      <span class="inventory">库存：<span>{{$gd->infonum}}</span></span>
                    </div>
                  </form>
                </div>
                <div class="buynowonly-wrap">
                  <span class="tips fl">说明</span>
                  <div class="point fl">
                    <i></i>
                    <span>支持7天无忧退货</span>
                  </div>
                </div>
                <div class="buyBtns">
                  <a href="javascript:;" id="addCart" onclick="addShopcar(this)">加入购物车</a>
                </div>
              </dd>
            </dl>
        </div>
        @endforeach
        @endif

        <!-- 看了看以及商品信息评论部分 -->
        <div class="mainBtmWrap clearf">
          <!-- 看了看 -->
          <div class="siderBox">
            <div class="sideGrayBox">
              <h4>看了又看</h4>
              <ul class="userBuyView">
                @foreach ($good as $g)
                @foreach($g as $k=>$gg)
                <li>
                  <a href="/details/{{$gg->infotime}}" class="aImg" target="_blank">
                    <img src="{{str_limit($gg->infoimg,38)}}" alt="">
                  </a>
                  <p class="productTit">
                    <a href="/details/{{$gg->infotime}}" target="_blank" class="aTit">{{$gg->listname}} {{$gg->valueattr}}
                                        @foreach ($value as $va)
                                              @if ($gg->infoattr2 == $va->id) {{$va->valueattr}} @endif
                                        @endforeach</a>
                  </p>
                  <div>
                    <p class="productPrice">
                      <span>
                        ¥{{$gg->infosale}}
                      </span>
                      <del>
                        ¥{{$gg->infoprice}}
                      </del>
                    </p>
                    <p class="commentCount">
                      <!-- <a href="">  人已评价</a> -->
                    </p>
                  </div>
                </li>
                @endforeach
                @endforeach
              </ul>
            </div>
          </div>
          <div class="goodsDetailWrap">
            <div class="P_nav">
              <span class="active">
                商品详情
                <i></i>
              </span>
              <span>
                用户评价
                <em>{{$com_count}}</em>
              </span>
            </div>
            <div id="P_content">
              <div id="goodsDetail" >
                <ul class="goods_parameter" style="height:46px">
                  <li class="ellipsis">商品品牌：@foreach ($goods as $g) {{$g->catename}} @endforeach</li>
                </ul>
                <h4 class="goodsParaTit">
                  <!-- <a href="" class="zk"><span>展开</span></a> -->
                </h4>
                <div class="m-textarea">
                  <div class="textareabox">
                    @foreach ($goods as $g)
                    {!!$g->infocontent!!}
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="j-commwrap" style="display:none">
                @if(count($com) == 0)
                <div class="cartMain" style="text-align:center;font-size:18px;">
                  <span style="display:block;margin-top:150px">还没有客官的评论~</span>
                </div>
                @else
                <div class="commWrap">
                  @foreach($com as $m)
                  <div class="eachInfo m-eachinfonew">
                    <div class="commItem userinfo fl">
                      <div class="avatar" style="background: url(@if ($m->user_img == "") /images/121221.png @else {{$m->user_img}} @endif) center center no-repeat;">
                      </div>
                    </div>
                    <ul class="commItem commcnt fl">
                      <li class="commcnttop">{{date("Y-m-d",$m->comdata)}}</li>
                      <li class="c_666">
                        <span class="itemDetail">
                          <label class="aliasItem">精华评价</label>
                          {{$m->comcontent}}
                        </span>
                      </li>
                      <li class="c_666">
                        @if (!empty($m->comimg))
                        @foreach (explode(' ',$m->comimg) as $v)
                        <div class="pic_list">
                          <a href="" title="" class="pic_item">
                            <img src="{{$v}}" alt="" style="width:75px">
                          </a>
                        </div>
                        @endforeach
                        @endif
                      </li><br/><br/><br/><br>
                      <li class="c_666">
                        <span class="itemDetail">
                          @if($m->comback)
                          <label class="aliasItem">客服回复</label>
                          {{$m->comback}}
                          @endif
                        </span>
                      </li>
                    </ul>
                  </div>
                @endforeach
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- 登陆界面 -->
        <div class="zhifu">
            <div class="payye">
                <div class="colse"><img src="/images/tcgb.png"></div>
                <h1>登录界面</h1>
                <form action="/dologin"  method="post">
                           {!! csrf_field() !!}
                    <div class="pay_form">
                        <span>手机号：</span>
                        <input type="text" placeholder="请输入手机号" name="user_ph" value="{{old('user_ph')}}">
                        <span>密码：</span>
                        <input type="password" placeholder="请输入密码" name="user_pw">
                        <p class="infor">
                          @if ($errors->has('user_ph')) {{ $errors->first('user_ph')}}
                          @elseif ($errors->has('user_pw')) {{$errors->first('user_pw')}}
                          @endif
                          @if(session('error'))
                          {{session('error')}}
                          @endif
                          @if(isset($success))
                          {{$success}}
                          @endif
                        </p>
                        <button class="sub">登录</button>
                    </div>
                </form>
            </div>
        </div>
    <script>
      function addShopcar(obj){
        // 商品标题
        var goods_name=$('.product-title span').text();
        // 获取商品图片
        var goods_img=$('#auto-id-1511278166952 a img').attr('src');
        //获取商品单价
        var goods_price=$('.currentPrice span').text();
        //获取加入购物车中商品数量
        var num=$('.buybox input').val();
        //获取商品的infotime,作用相当于goods_id
        var goods_infotime=$('#infotime').val();
         //获取库存
        var $inventory=$('.inventory span').text();
        //当不等于库存不足时
        if($inventory!="库存不足"){
           //跳转至shopcar中的store方法中
          $.post('/shopCar',{'_token':'{{csrf_token()}}','goods_img':goods_img,'goods_name':goods_name,'goods_price':goods_price,'num':num,'goods_infotime':goods_infotime,},function(data){
           if(data==1){
            layer.alert("未登录状态添加购物车成功", {icon: 6});
           }
           if(data==2){
            layer.alert("登录状态下此物品在购物车中已存在", {icon: 5});
           }
           if(data==3){
            layer.alert("登录状态添加购物车成功", {icon: 6});
           }
           if(data==4){
            layer.alert("登录状态添加购物车失败", {icon: 5});
           }
           if(data==5){
            layer.alert("未登录状态添加购物车成功", {icon: 6});
           }
           if(data==6){
            layer.alert("未登录状态下此物品已存在于购物车", {icon: 5});
           }
          })
        }else{
          layer.alert("亲，暂时没有货", {icon: 6});
        }
      }
      // 登录界面
      $('.z_btn').click(function(){
        $('.zhifu').css("display","block");
        return false;
      })
      $('.colse').click(function(){
        $('.zhifu').css("display","none");
      })
      //获取库存
      var $inventory=$('.inventory span').text();
      //获取商品id
      var $infotime=$('#infotime').val();
      $.post('/details/changeinventory',{'_token':'{{csrf_token()}}','num':$inventory,'infotime':$infotime},function(data){
        if(data>=$inventory){
            $inventory=$('.inventory span').text("库存不足");
        }else{
            $inventory=$('.inventory span').text($inventory-data);
        }
      })
    </script>
    @include('home/foot')
</body>
</html>