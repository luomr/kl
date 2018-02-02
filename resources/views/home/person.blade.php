<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>我的订单-个人中心-网易考拉海购</title>
    <link rel="stylesheet" href="/css/person.css">
    <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <script src="/js/person.js"></script>
    <script type="text/javascript" src="/js/pay.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
</head>
<body>
	 @include('home/head')
    <!-- 个人中心 -->
    <div class="m-personal">
      <!-- 左边导航 -->
        <div class="col-left">
           <aside class="leftmenu">
              <h3>个人中心</h3>
              <dl>
                  <dd class="active"><span class="ti">&nbsp;</span><a href="###">我的订单</a></dd>

                  <dd class=" sep"><span class="ti">&nbsp;</span><a href="###">帐号管理</a></dd>
                  <dd class=""><span class="ti">&nbsp;</span><a href="###">我的实名认证</a></dd>

                  <dd class="sep"><span class="ti">&nbsp;</span><a href="###">管理收货地址</a></dd>
              </dl>
           </aside>
        </div>
        <!-- 右边内容 -->
        <div class="col-right">
          <!-- 订单中心 -->
          <div class="slideTab tab_show">
            <!-- 订单状态 -->
            <ul>
              <li class="tab tab_li">所有订单</li>
              <li class="tab">待付款</li>
              <li class="tab">待发货</li>
              <li class="tab">待收货</li>
              <li class="tab">待评价</li>
              <li class="tab tab_last">
                <span></span>
                订单回收站
              </li>
            </ul>
            <!-- 订单列表 -->
            <div class="slideBox">
              @if ($order == "")
              <div class="cartMain" style="text-align:center;font-size:18px;">
                <span style="display:block;margin-top:150px">订单里空空如也，赶紧去 <a href="/">逛逛吧&gt;</a></span>
              </div>
              @else
              <!-- 公告 -->
              <div class="warp_ad">
                <span></span>
                <a href="">双十一期间发货时效公告
                </a>
              </div>
              <!-- 搜索 -->
              <div class="warp_search">
                <form>
                  <input type="search" name="" placeholder="请输入商品名称或订单号搜索">
                  <button type="submit">搜索</button>
                </form>
              </div>
              <!-- 目录 -->
              <div class="warp_nav">
                <span class="nav_1">订单详情</span>
                <span class="nav_2">订单状态</span>
                <span class="nav_2">操作</span>
              </div>

              <!-- 全部订单 -->
              <div class="slideWarp slideWarp_show">
                @foreach ($order as $v)
                @if($v->orderstatus != "订单回收中" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <span>订单号：<a href="">{{$v->ordernum}} </a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span>{{$v->name}}</span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span>@if ($v->orderstatus == "待付款") <a href="/zhifu/{{$v->id}}" target="_blank">{{$v->orderstatus}}</a> @else <span class="otherstate" onclick="otherstate(this,{{$v->id}})" style="cursor:pointer">{{$v->orderstatus}}</span> @endif</span>
                    </div>
                    <div class="co_ri">
                      @if($v->orderstatus == "交易完成" ||$v->orderstatus == "待评价")
                      <a  href="/comment/{{$v->id}}/edit" target="_blank">评价商品</a><br>
                      @endif
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                      @if($v->orderstatus == "交易完成" ||$v->orderstatus == "待评价")
                      <a class="goods_del" href="javascript:;" onclick="changeState(this,{{$v->id}})">删除</a>
                      @elseif ($v->orderstatus == "交易取消")
                      <a class="goods_del delord" href="javascript:;" onclick="delOrd(this,{{$v->id}})">删除</a>
                      @elseif ($v->orderstatus == "待付款")
                      <a class="goods_del" href="javascript:;" onclick="changeOrder(this,{{$v->id}})">取消订单</a>
                      @endif
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              <!-- 待付款 -->
              <div class="slideWarp">
                @foreach ($order as $v)
                @if ($v->orderstatus == "待付款" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <input type="checkbox">
                    <span>订单号：<a href="">{{$v->ordernum}}</a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span><a href="">{{$v->name}}</a></span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span> <a href="/pay" target="_blank">{{$v->orderstatus}}</a> </span>
                    </div>
                    <div class="co_ri">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                      <a class="goods_del" href="javascript:;" onclick="changeOrder(this,{{$v->id}})">取消订单</a>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              <!-- 待发货 -->
              <div class="slideWarp">
                @foreach ($order as $v)
                @if ($v->orderstatus == "待发货" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <input type="checkbox">
                    <span>订单号：<a href="">{{$v->ordernum}}</a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span><a href="">{{$v->name}}</a></span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span>{{$v->orderstatus}} </span>
                    </div>
                    <div class="co_ri">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              <!-- 待收货 -->
              <div class="slideWarp">
                @foreach ($order as $v)
                @if ($v->orderstatus == "待收货" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <input type="checkbox">
                    <span>订单号：<a href="">{{$v->ordernum}}</a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span><a href="">{{$v->name}}</a></span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span> {{$v->orderstatus}}</span>
                    </div>
                    <div class="co_ri">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                      <!-- <a href="javascript:;" onclick="takeGooods(this,{{$v->id}})">确认收货</a> -->
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              <!-- 待评价 -->
              <div class="slideWarp">
                @foreach ($order as $v)
                @if ($v->orderstatus == "待评价" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <input type="checkbox">
                    <span>订单号：<a href="">{{$v->ordernum}}</a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span><a href="">{{$v->name}}</a></span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span> {{$v->orderstatus}} </span>
                    </div>
                    <div class="co_ri">
                      <a href="/comment/{{$v->id}}/edit" target="_blank">评价商品</a><br>
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                      <a class="goods_del" href="javascript:;" onclick="changeState(this,{{$v->id}})">删除</a>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              <!-- 订单回收站 -->
              <div class="slideWarp">
                @foreach ($order as $v)
                @if ($v->orderstatus == "订单回收中" && $v->user_id == session('data')->id)
                <div class="warp_box">
                  <div class="warp_tit">
                    <input type="checkbox">
                    <span>订单号：<a href="">{{$v->ordernum}}</a></span>
                    |
                    <span>{{date("Y-m-d",$v->ordertime)}}</span>
                    |
                    <span>￥{{$v->goods_price * $v->num}}</span>
                    |
                    <span><a href="">{{$v->name}}</a></span>
                  </div>
                  <div class="warp_con">
                    <div class="co_lf">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">
                        <img src="{{str_limit($v->goods_img,38)}}" style="width:80px">
                      </a>
                      <div class="lf_text">
                        <p>{{$v->goods_name}}</p>
                        <p>￥{{$v->goods_price * $v->num}}</p>
                      </div>
                    </div>
                    <div class="co_md">
                      <span>@if ($v->orderstatus == "订单回收中") 交易完成 @else {{$v->orderstatus}} @endif</span>
                    </div>
                    <div class="co_ri">
                      <a href="/details/{{$v->goods_infotime}}" target="_blank">商品详情</a><br>
                      <a class="goods_del delord" href="javascript:;" onclick="delOrd(this,{{$v->id}})">删除</a>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
              @endif
            </div>
          </div>
          <!-- 个人中心 -->
          <div class="slideTab">
            <!-- <h3>账号管理</h3> -->
            <div class="add_form">
              <h2>我的主帐号</h2>
              <div class="gl">
                <span><img src="@if (session('data')->user_img == '') /images/121221.png @else {{session('data')->user_img}} @endif" style="width:50px"></span>
                <p>{{str_limit(session('data')->user_ph,3,'***')}}</p>
                <a href="/find" target="_blank">修改密码</a>
              </div>
            </div>
          </div>
          <!-- 实名认证 -->
          <div class="slideTab">
            <h3>我的实名认证</h3>
            <form  enctype="multipart/form-data" method="post" action="/person/{{session('data')->id}}">
              <?php echo method_field('PUT'); ?>
              <?php echo csrf_field(); ?>
              <div class="add_form">
                <h2></h2>
                <div class="con_div">
                  <span class="tit_sp">* 真实姓名</span>
                  <input class="zhenshi" type="text" name="surname" placeholder="请填写您的真实姓名" value="">
                  <p class="user_for1"></p>
                </div>
                <div class="con_div">
                  <span class="tit_sp">* 身份证号</span>
                  <input class="card" type="text" name="user_card" placeholder="请填写身份对应的身份证号" value="">
                  <p class="user_for2"></p>
                </div>
                <div class="con_div">
                  <span class="tit_sp">上传照片</span>
                  <input type="file" name="user_img" value="">
                  <p class="user_for3"></p>
                </div>
                <div class="con_div">
                  <button onsubmit="javascript:;" onclick="addUser(this,{{session('data')->id}})">认证</button>
                </div>
            </form>
            </div>
          </div>
          <!-- 收货地址 -->
          <div class="slideTab">
            <h3>我的地址</h3>
            <div class="add_data">
              <span class="data_1">已保存收货地址</span>
              <span class="data_2">(共1条) </span>最多保存3条
              <a href="#xin">+新增收货地址</a>
            </div>

            <!-- 我的地址 -->
            <table class="tb_address"  id="xin">
              <thead>
                @if(count($address) != 0)
                <tr>
                  <th class="col_name">收货人</th>
                  <th class="col_add">收货地址</th>
                  <th class="col_tel">联系电话</th>
                  <th class="col_act">操作</th>
                  <th class="col_w"></th>
                </tr>
                @endif
              </thead>
              <tbody>
                @foreach($address as $v)
                @if($v->user_id == session('data')->id)
                <tr>
                  <td class="col_name">{{$v->name}}</td>
                  <td class="col_add">{{$v->province}} {{$v->city}} {{$v->address}}</td>
                  <td class="col_tel">{{str_limit($v->telephone,3,"***")}}</td>
                  <td class="col_act"><a href="javascript:;" onclick="editAddress(this,{{$v->id}})">修改</a>
                   |
                   <a href="javascript:;" onclick="deleteAddress(this,{{$v->id}})">删除</a></td>
                  <td class="col_w"><span class="@if ($v->default == 2) default @endif">@if ($v->default == 2) 默认地址 @endif</span></td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <!-- 新增收货地址 -->
            <div class="add_form">
              <h2>新增收货地址</h2>
              <form action="" method="">
                <div class="con_div">
                  <span class="tit_sp">* 所在地区</span>
                  <select name="province" id="province">
                    <option value="-1">请选择省市区</option>
                  </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                <select name="city" id="city" >
                  <option value="-1">所在市</option>
                </select>
                  <p class="add_for"></p>
                </div>
                <div class="con_div">
                  <span class="tit_sp">* 详细地址</span>
                  <textarea class="add_xi" name="address" cols="60" rows="5" placeholder="无需重复填写省市区，小于75个字" style="" autocomplete="off">

                  </textarea>
                  <p class="add_for1"></p>
                </div>
                <div class="con_div">
                  <span class="tit_sp">* 收货人姓名</span>
                  <input class="mr" type="text" placeholder="不能为昵称、X先生、X小姐等，请使用真实姓名" name="name">
                  <p class="add_for2"></p>
                </div>
                <div class="con_div">
                  <span class="tit_sp">* 手机号码</span>
                  <input class="add_ph" type="text" placeholder="手机号码必须填" name="telephone">
                  <p class="add_for3"></p>
                </div>
                <div class="con_div">
                  <button  class="item-submit" onsubmit="javascript:;" onclick="addAddress(this,{{session('data')->id}})">保存新地址</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    @include('home/foot')

<script>
            //将待收货改为交易完成
            function otherstate(obj,id){
              var value=$(obj).text();
              if(value=="待收货"){
                $.post('/admin/order/changeorderstate1',{'_token':'{{csrf_token()}}','id':id,'orderstatus':value},function(data){
                  if(data.status==0){
                    $(obj).text("交易完成");
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                  }
                 if(data.status==1){
                    layer.alert(data.msg, {icon: 5});
                 }
                 if(data.status==2){
                    layer.alert(data.msg, {icon: 5});
                 }
                })
              }
            }
            // 伪删除
            function changeState(obj,id) {
                $.post('/person',{'_token':'{{csrf_token()}}','id':id},function(data){
                  if(data.status == 0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                  }else{
                    layer.alert(data.msg, {icon: 5});
                  }
                })
            }
            // 交易取消 回收站的删除
            function delOrd(obj,id) {
                $.post('/person/'+id,{'_method':'delete','_token':'{{csrf_token()}}','id':id},function(data){
                  if(data.status == 0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                  }else{
                    layer.alert(data.msg, {icon: 5});
                  }
                })
            }
            // 取消订单
            function changeOrder(obj,id) {
                $.get('/person/'+id,{'id':id},function(data){
                  if(data.status == 0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                  }else{
                    layer.alert(data.msg, {icon: 5});
                  }
                })
            }
            function addAddress(obj,user_id){
                // alert("123");
                // alert(user_id);
                var provinces = ["山西","山东","河南","河北","湖南","湖北"];
                var citys = [
                  ["太原","大同","阳泉","长治","晋城","忻州","朔州","临汾","运城","晋中"],
                  ["济南市","青岛市","淄博市","枣庄市","东营市","烟台市","潍坊市","济宁市","泰安市","威海市"],
                  ["郑州市","开封市","洛阳市","平顶山市","安阳市","鹤壁市","新乡市","焦作市","濮阳市","许昌市"],
                    ["石家庄市","唐山市","秦皇岛市","邯郸市","邢台市","保定市","张家口市","承德市","沧州市","廊坊市"],
                  ["长沙市","衡阳市","邵阳市","岳阳市","张家界市","永州市","常德市","株洲市","益阳市","湘潭市"],
                  ["武汉市","黄石市","十堰市","宜昌市","襄阳市","鄂州市","荆门市","咸宁市","随州市","孝感市"]
                ];
                // 省份的下标和省份的内容
                var provinceindex=parseInt($('#province').val());
                var province=provinces[provinceindex];
                //市区的下标和市区的内容
                var cityindex=parseInt($('#city').val());
                var city=citys[provinceindex][cityindex];
                //获取地址，收货人姓名，以及电话号码
                var address=$(".add_form textarea[name='address']").val();
                var name=$(".add_form input[name='name']").val();
                var telephone=$(".add_form input[name='telephone']").val();
                $.post('/address',{'_token':'{{csrf_token()}}','user_id':user_id,'province':province,'city':city,'address':address,'name':name,'telephone':telephone},function(data){
                    //alert(data.msg);
                    if(data.status==0){
                        // location.href=location.href;
                        layer.alert(data.msg, {icon: 6});
                    }else if(data.status==1){
                        // location.href=location.href;
                        layer.alert(data.msg, {icon: 5});
                    }else{
                       layer.alert(data.msg, {icon: 5});
                    }
                })
            }

            function editAddress(obj,id){
                   //增加和修改上面的省市联动
                var provinces = ["山西","山东","河南","河北","湖南","湖北"];
                var citys = [
              ["太原","大同","阳泉","长治","晋城","忻州","朔州","临汾","运城","晋中"],
              ["济南市","青岛市","淄博市","枣庄市","东营市","烟台市","潍坊市","济宁市","泰安市","威海市"],
              ["郑州市","开封市","洛阳市","平顶山市","安阳市","鹤壁市","新乡市","焦作市","濮阳市","许昌市"],
                ["石家庄市","唐山市","秦皇岛市","邯郸市","邢台市","保定市","张家口市","承德市","沧州市","廊坊市"],
              ["长沙市","衡阳市","邵阳市","岳阳市","张家界市","永州市","常德市","株洲市","益阳市","湘潭市"],
              ["武汉市","黄石市","十堰市","宜昌市","襄阳市","鄂州市","荆门市","咸宁市","随州市","孝感市"]
                   ];
              // 修改时候，省级联动改变函数，增加两个参数，分别为从控制器返回来的省份参数和市级参数
              function provincecity(provinces,citys,pro_id,city_id,province,city){
                 //获取并添加城市节点
                for(var i=0;i<provinces.length;i++){
                //给省里面添加内容
                // alert(province==provinces[i]);die;
                    if(province==provinces[i]){
                        //获取相应的省级下标，便于获得相应的市级数组
                        proindex=i;
                       //当添加的省级参数与省份参数相等时，添加选定属性
                       $(pro_id).append("<option value="+i+" selected>"+provinces[i]+"</option>");
                    }else{
                       $(pro_id).append("<option value="+i+">"+provinces[i]+"</option>");
                    }
                }
                //便利相应的市级下标，根据市级参数进行判断
               for(var i=0;i<citys[proindex].length;i++){
                    if(city==citys[proindex][i]){
                         $(city_id).append("<option value="+i+" selected>"+citys[proindex][i]+"</option>");
                    }else{
                         $(city_id).append("<option value="+i+" >"+citys[proindex][i]+"</option>");
                    }
               }
                //当省份改变的时候，对应到相应的市
                $(pro_id).change(function(){
                // alert("123");
                $(city_id).empty().append('<option value="-1">所在市</option>');
                var index =$(pro_id).val();
                // alert(index);
                var city = citys[index];
                // alert(city);
                for(var i=0;i<city.length;i++){
                    // alert(city1==city[i]);
                    $(city_id).append("<option value="+i+" >"+city[i]+"</option>");
                }
                })
              }
                // alert(id);
                $.get('/address/'+id+'/edit',{},function(data){
                provincecity(provinces,citys,'#province','#city',data.province,data.city);
                $('.add_form input[name=id]').val(data.id);
                $('.add_form textarea').val(data.address);
                $('.add_form input[name=name]').val(data.name);
                $('.add_form input[name=telephone]').val(data.telephone);
             });
            }
            function updateAddress(obj,user_id){
                var provinces = ["山西","山东","河南","河北","湖南","湖北"];
                var citys = [
                  ["太原","大同","阳泉","长治","晋城","忻州","朔州","临汾","运城","晋中"],
                  ["济南市","青岛市","淄博市","枣庄市","东营市","烟台市","潍坊市","济宁市","泰安市","威海市"],
                  ["郑州市","开封市","洛阳市","平顶山市","安阳市","鹤壁市","新乡市","焦作市","濮阳市","许昌市"],
                    ["石家庄市","唐山市","秦皇岛市","邯郸市","邢台市","保定市","张家口市","承德市","沧州市","廊坊市"],
                  ["长沙市","衡阳市","邵阳市","岳阳市","张家界市","永州市","常德市","株洲市","益阳市","湘潭市"],
                  ["武汉市","黄石市","十堰市","宜昌市","襄阳市","鄂州市","荆门市","咸宁市","随州市","孝感市"]
                ];
                // 省份的下标和省份的内容
                var provinceindex=parseInt($('#province').val());
                var province=provinces[parseInt(provinceindex)];
                //市区的下标和市区的内容
                var cityindex=parseInt($('#city').val());
                var city=citys[provinceindex][cityindex];
                //获取地址，收货人姓名，以及电话号码
                var id=$(".add_form input[name='id']").val();
                var address=$(".add_form textarea[name='address']").val();
                var name=$(".add_form input[name='name']").val();
                var telephone=$(".add_form input[name='telephone']").val();
                $.post('/address/'+id,{'_token':'{{csrf_token()}}','_method':'put','user_id':user_id,'province':province,'city':city,'address':address,'name':name,'telephone':telephone},function(data){
                    if(data.status==0){
                        layer.alert(data.msg, {icon: 6});
                        // location.href=location.href;
                    }else{
                        layer.alert(data.msg, {icon: 5});
                    }
                })
            }
            function deleteAddress(obj,id){
            layer.confirm('您确定要删除这个地址吗？',
            {btn: ['确定','取消']},
            function(){
             $.post('/address/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
               if(data.status==0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
             });
            },
            function(){
            layer.msg('也可以这样', {
             time: 20000, //20s后自动关闭
            btn: ['明白了', '知道了']});
            })
            }
</script>
<script type="text/javascript">
      $(function(){
        //form表单验证
            // 真实姓名
            $('.zhenshi').focusout(function(){
              if($('.zhenshi').val() == ""){
                $('.user_for1').html("姓名不能为空");
              }else{
                var tel_reg = /^([\u4e00-\u9fa5]){2,7}$/;
                if(tel_reg.test($('.zhenshi').val())){
                  }else{
                    $('.user_for1').html("格式不正确");
                  }
              }
            })
            // 身份证号
            $('.card').focusout(function(){
              if($('.card').val() == ""){
                $('.user_for2').html("身份证号不能为空");
              }else{
                var tel_reg = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;
                if(tel_reg.test($('.card').val())){
                  }else{
                    $('.user_for2').html("格式不正确");
                  }
              }
            })
            //详细地址
            $('.add_xi').focusout(function(){
              if($('.add_xi').val() == ""){
                $('.add_for1').html("姓名不能为空");
              }
            })
            // 收货人姓名
            $('.mr').focusout(function(){
              if($('.mr').val() == ""){
                $('.add_for2').html("姓名不能为空");
              }else{
                var tel_reg = /^([\u4e00-\u9fa5]){2,7}$/;
                if(tel_reg.test($('.mr').val())){
                  }else{
                    $('.add_for2').html("格式不正确");
                  }
              }
            })
            // 手机号码
            $('.add_ph').focusout(function(){
              if($('.add_ph').val() == ""){
                $('.add_for3').html("手机号不能为空");
              }else{
                var tel_reg = /^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/;
                if(tel_reg.test($('.add_ph').val())){
                  }else{
                    $('.add_for3').html("手机号格式不正确");
                  }
              }
            })
      })
</script>
</body>
</html>