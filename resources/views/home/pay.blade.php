<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>订单确认页-网易考拉海购</title>
	<link rel="stylesheet" type="text/css" href="/css/pay.css">
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/pay.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
</head>
<body>
    @include('home/head')
    	<!-- 收货地址 -->
    	<div class="addinfo clearf">
    		<h3>选择收货地址</h3>
            @foreach($address as $k=>$v)
    		<div class="addrLab">
    			<span class="add_tit">
    				<strong>{{$v->name}} 收</strong>
                    @if($v->default==2)
    				<a href="javascript:;" onclick="defaultAddress(this,{{$v->id}},{{session('data')->id}},{{$k}})" class="set_default" style="display:block">设为默认</a>
                    @else
                    <a href="javascript:;" onclick="defaultAddress(this,{{$v->id}},{{session('data')->id}},{{$k}})" class="set_default">设为默认</a>
                    @endif
    			</span>
    			<p class="add_text">
    				{{$v->province}}{{$v->city}}
    				<br>
    				<b>{{$v->address}}</b>
    				<br>
    				{{$v->telephone}}
                    <input type="hidden" class="markaddress" value="1">
    			</p>
    			<span class="add_btn">
    				<a href="javascript:;" id="add_btn_edit" onclick="editAddress(this,{{$v->id}})">修改</a>
    				<a href="javascript:;" onclick="deleteAddress(this,{{$v->id}})">删除</a>
    			</span>
    		</div>
            @endforeach
    	</div>
    	<!-- 新增收货地址div框-->
    	<div class="add_form">
    		<a class="add_add" href="javascript:;">+新增收货地址</a>
    		<div class="modal-row" id="modal-row">
    			<div class="iDialogHead">
    				<h4>新增收货地址</h4>
    				<a class="iDialogClose" href="javascript:;"></a>
    			</div>
    			<div class="modal-body">
    				<div class="m_myaddress clearf">
    					<div class="item itemfirst">
    						<span class="item-label"><i>*</i>&nbsp;所在省/市/县</span>
    						<select name="province" id="province">
    							<option value="-1">所在省</option>
    						</select>&nbsp;&nbsp;&nbsp;&nbsp;
    						<select name="city" id="city" >
    							<option value="-1">所在市</option>
    						</select>
    					</div>
    					<div class="item clearf">
    						<span class="item-label"><i>*</i>&nbsp;详细地址</span>
    						<div class="detail">
    							<textarea name="address" cols="60" rows="5" placeholder="无需重复填写省市区，小于75个字" style="" autocomplete="off"></textarea>
    						</div>
    					</div>
    					<div class="item clearf">
    						<span class="item-label"><i>*</i>&nbsp;收货人姓名</span>
    						<div class="detail">
    							<input type="text" placeholder="不能为昵称、X先生、X小姐等，请使用真实姓名" name="name">
    						</div>
    					</div>
    					<div class="item clearf">
    						<span class="item-label"><i>*</i>&nbsp;手机号码</span>
    						<div class="detail">
    							<input type="text" placeholder="手机号码必须填" name="telephone">
    						</div>
    					</div>
    					<div class="item-bottom clearf">
    						<button class="item-cancel">取消	</button>
    						<button class="item-submit" onsubmit="javascript:;" onclick="addAddress(this,{{session('data')->id}})">保存新地址</button>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
        <!-- 修改收货地址框 -->
        <div class="edit_form">
            <div class="modal-row1" id="modal-row1">
                <div class="iDialogHead1">
                    <h4>修改收货地址</h4>
                    <a class="iDialogClose1" href="javascript:;"></a>
                </div>
                <div class="modal-body1">
                    <div class="m_myaddress1 clearf">
                        <input type="hidden" name="id">
                        <div class="item itemfirst">
                            <span class="item-label"><i>*</i>&nbsp;所在省/市/县</span>
                            <select name="province" id="province1">
                                <option value="-1">所在省</option>
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="city" id="city1" >
                                <option value="-1">所在市</option>
                            </select>
                        </div>
                        <div class="item clearf">
                            <span class="item-label"><i>*</i>&nbsp;详细地址</span>
                            <div class="detail">
                                <textarea name="address" cols="60" rows="5" placeholder="无需重复填写省市区，小于75个字" style="" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="item clearf">
                            <span class="item-label"><i>*</i>&nbsp;收货人姓名</span>
                            <div class="detail">
                                <input type="text" placeholder="不能为昵称、X先生、X小姐等，请使用真实姓名" name="name">
                            </div>
                        </div>
                        <div class="item clearf">
                            <span class="item-label"><i>*</i>&nbsp;手机号码</span>
                            <div class="detail">
                                <input type="text" placeholder="手机号码必须填" name="telephone">
                            </div>
                        </div>
                        <div class="item-bottom clearf">
                            <button class="item-cancel1">取消</button>
                            <button class="item-submit" onsubmit="javascript:;" onclick="updateAddress(this,{{session('data')->id}})">保存新地址</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	<!-- 确认商品 -->
    	<div class="main">
    		<div class="cart_box">
    			<!-- 头部信息 -->
    			<div class="mycart">
    				<h3>确认商品信息</h3>
    				<span>因商品来自不同仓库或商家，将按照以下子订单分别为您配送</span>
    			</div>
    			<!-- 菜单分类 -->
    			<div class="cart_nav">
    				<div class="col col1">商品信息</div>
    				<div class="col col2">单价（元）</div>
    				<div class="col col2">数量</div>
    				<div class="col col2">金额（元）</div>
    			</div>
    			<!-- 添加的商品 -->
    			<div class="my_cart">
    				<!-- 店铺 -->
    				<div class="ware">
    					发货地址：
    					<strong class="cart_name">自营保税仓</strong>
    				</div>
    				<div class="goods">
    					<!-- 商品 -->
                        @foreach ($shopcartall as $v)
                        @if ($v->state == 1 && $v->user_id == session('data')->id)
    					<ul class="m_goods">
    						<li>
    							<ul class="actgoods">
    								<!-- 商品信息 -->
    								<li class="gooditm">
    									<div class="col col11">
    										<a class="col_img" href="/details/{{$v->goods_infotime}}" target="_blank">
    											<img src="{{str_limit($v->goods_img,48)}}" style="width:80px">
    										</a>
    										<div class="col_text" >
    											<a href="/details/{{$v->goods_infotime}}" target="_blank">{{$v->goods_name}}</a>
    											<p>不支持7天无理由退货</p>
    											<span>
    												限时购
    											</span>
    										</div>
    										<div class="col_ts">
    											<span></span>
    										</div>
    									</div>
    									<div class="col col13" style="text-align:center">
    										{{$v->goods_price}}
    									</div>
    									<div class="col col14" style="text-align:center">
    										{{$v->num}}
    									</div>
    									<div class="col col15" style="text-align:center">
    										{{$v->num * $v->goods_price}}
    									</div>
    								</li>
    							</ul>
    						</li>
    					</ul>
                        @endif
                        @endforeach
    				</div>
    			</div>
    		</div>
    		<!-- 提交订单 -->
    		<div class="pay_box">
    			<div class="invo">
    				<p class="invo_p"> 发票信息： 订单中所有商品均不支持开具发票 </p>
    				<p>发票须知:</p>
    				<p>1. 保税仓发货商品与海外仓发货商品属跨境海外商品，无法开具国内发票</p>
    				<p>2. 自2017年7月1日起，发票抬头选择公司（企业、有税号的非企业性单位和个体工商户）需提供纳税人识别号</p>
    				<p>3. 自营国内仓商品(即苏州仓、佛山1号仓、天津1号仓、杭州1号仓与杭州2号仓的商品)支持开具电子发票，电子发票在确认收货后48小时内开具</p>
    				<p>4. 杭州1号仓商品，若开具纸质发票，发票随包裹一起寄出</p>
    				<p>5. 苏州仓、佛山1号仓、天津1号仓、杭州2号仓商品，若开具纸质发票，发票在确认收货后7-30天单独寄出</p>
    				<p>6. 第三方商家若无法开具电子发票，则自动开纸质发票，商家发票以实际收到为准</p>
    				<p>7. 如需增值税专用发票，请在购买后联系客服</p>
    				<a href="">发票相关问题&gt;</a>
    			</div>

    	<!-- ++++++++++++++++++++++++++++++++++++++++++ -->
    			<div class="amount">
    				<div class="numrow">
    					<p class="zong"></p>
    					<p>商品应付总计：</p>

    				</div>
    				<div class="numrow">
    					<p class="yun">0</p>
    					<p>运费：</p>
    				</div>
    				<div class="numrow">
    					<p class="ying"></p>
    					<p>应付金额：</p>
    				</div>
    				<div class="numva">
    					<p><a href="/shopCar">返回购物车修改</a></p>
    					<a class="z_btn" href="javascript:;">提交订单</a>
    				</div>
    				<p class="pro_info">@foreach ($address as $v) @if($v->default == 2) {{$v->name}} {{$v->address}} {{str_limit($v->telephone,3,"***")}} @else 请设置默认地址作为收货地址 @endif @endforeach</p>
    			</div>
    		</div>
    	</div>
        <!-- 点击后的背景效果 -->
        <div class="endbackground" style="display:none"></div>
    @include('home/foot')
        <script type="text/javascript">
            // 金额总计
            var sum = 0;
            for(var i=0;i<$('.m_goods').length;i++){
                sum += parseInt($('.m_goods li .actgoods .gooditm .col15').eq(i).html());
            }
            $('.zong').html(sum);
            $('.ying').html(sum);
            //根据有无地址对页面跳转进行判断
            $('.z_btn').click(function(){
                $markaddress=$('.markaddress').val();
                if($markaddress){
                    location.href="/zhifu";
                }else{
                    layer.alert("亲，还没有收货地址", {icon: 6});
                }
            })
        </script>

        <script>
            //alert("123");
            function defaultAddress(obj,id,user_id,k){
                var setdefault=$('.set_default');
                //alert(setdefault.length);
               $.post('/address/defaultAddress',{'_token':'{{csrf_token()}}','id':id,'user_id':user_id},function(data){
                    location.href=location.href;
                    //alert(data);
               })
            }
            function addAddress(obj,user_id){
                //测试此函数是否有限
                //alert("123");
                //测试参数时候有效
                // alert(user_id);
                //二级联动
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
                var address=$(".m_myaddress textarea[name='address']").val();
                var name=$(".m_myaddress input[name='name']").val();
                var telephone=$(".m_myaddress input[name='telephone']").val();
                $.post('/address',{'_token':'{{csrf_token()}}','user_id':user_id,'province':province,'city':city,'address':address,'name':name,'telephone':telephone},function(data){
                     if(data.status==0){
                        location.href=location.href;
                        $('.modal-row').css('display','none');
                        $('.endbackground').css('display','none');
                        layer.alert(data.msg, {icon: 6});
                    }else if(data.status==1){
                        // location.href=location.href;
                        layer.alert(data.msg, {icon: 5});
                    }else{
                        location.href=location.href;
                        $('.modal-row').css('display','none');
                        $('.endbackground').css('display','none');
                       layer.alert(data.msg, {icon: 5});
                    }
                })
            }

            function editAddress(obj,id){
                $('.modal-row1').css('display','block');
                $('.endbackground').css('display','block');
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
              function provincecity(provinces,citys,pro_id,city_id,province,city1){
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
                    if(city1==citys[proindex][i]){
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
                provincecity(provinces,citys,'#province1','#city1',data.province,data.city);
                $('.m_myaddress1 input[name=id]').val(data.id);
                $('.m_myaddress1 textarea').val(data.address);
                $('.m_myaddress1 input[name=name]').val(data.name);
                $('.m_myaddress1 input[name=telephone]').val(data.telephone);
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
                var provinceindex=parseInt($('#province1').val());
                var province=provinces[parseInt(provinceindex)];
                //市区的下标和市区的内容
                var cityindex=parseInt($('#city1').val());
                var city=citys[provinceindex][cityindex];
                //获取地址，收货人姓名，以及电话号码
                var id=$(".m_myaddress1 input[name='id']").val();
                var address=$(".m_myaddress1 textarea[name='address']").val();
                var name=$(".m_myaddress1 input[name='name']").val();
                var telephone=$(".m_myaddress1 input[name='telephone']").val();
                $.post('/address/'+id,{'_token':'{{csrf_token()}}','_method':'put','user_id':user_id,'province':province,'city':city,'address':address,'name':name,'telephone':telephone},function(data){
                    if(data.status==0){
                        layer.alert(data.msg, {icon: 6});
                        location.href=location.href;
                        $('.modal-row1').css('display','none');
                        $('.endbackground').css('display','none');
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
                    $(obj).parents(".addrLab").remove();
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
</body>
</html>