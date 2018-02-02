<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>忘记密码</title>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/find.css">
	<script type="text/javascript" src='/js/find.js'></script>
</head>
<body>
	<!--头部设置-->
	<div id="head">
		<div class="head-left">
			<a href="/">
				<div class="head-logo"></div>
			</a>
			<div class="head-right">
				<a href="" class="head-help">帮助中心</a>
			</div>
		</div>
	</div>
	<!--中间部分-->
	<div class="center">
		<div class="center-find">忘记密码</div>
		<!--中间输入框-->
		<div class="center-put">
		<!--安全验证-->
			<div class="one show" style="margin-top: 100px;">
				<p class="infor" style="width:430px;height: 30px;line-height:30px;text-align:center;font-size: 16px;color: #ed2345;position:absolute;top:230px">
				@if ($errors->has('user_ph')) {{ $errors->first('phone')}}
				@elseif ($errors->has('user_pw')) {{$errors->first('user_pw')}}
				@endif
				@if(session('error'))
				{{session('error')}}
				@endif
				</p>
				<form action="/dofind" method="post" style="margin-top:-60px">
					{!! csrf_field() !!}
					<div class="center-box">
						<div class="country">
							<span class="in-1"><img src="../images/phone.png"></span>
						</div>
						<div class="write">
							<input type="text" placeholder="请输入当前手机号" name="phone"  value="" id="phone">
						</div>
					</div>
					<div class="center-three">
						<div class="three">
							<input type="text" name="code" placeholder="请输入手机验证码" style="width: 208px"  id="code" >
						</div>
						<div class="three-left">
							<button type="submit" id="btn" onclick="">获取验证码</button>
						</div>
					</div>
					<div class="center-box">
						<div class="country">
							<span class="in-1"><img src="../images/suo.png"></span>
						</div>
						<div class="write">
							<input type="password" placeholder="请输入新密码" name="user_pw">
						</div>
					</div>
					<div class="center-login" style="margin-top:50px">
						<button style="width: 300px;
    							height: 40px;
    							display: block;
    							text-align: center;
    							line-height: 40px;
    							background: rgb(237, 35, 69);
   							 	border: 1px solid #4cbafe;
    							cursor: pointer;color: white;outline:none;border:none"  class="u-login" type="submit" >确认</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--最后结尾部分-->
	<div class="end">
		<p class="end-top">
			<a href="">About NetEase - </a>
			<a href="">公司简介 - </a>
			<a href="">联系方式 - </a>
			<a href="">OAuth2.0认证 - </a>
			<a href="">招聘信息 - </a>
			<a href="">客户服务 - </a>
			<a href="">相关法律 - </a>
			<a href="">网络营销</a>
		</p>
		<p>网易公司版权所有 ©1997-2017</p>
	</div>
		<script>
			$(function(){
				console.log("测试js是否能用");
				$('#phone').focusout(function(){
					//alert($('#phone').val());
					if($('#phone').val() == ""){
						$('.infor').html("手机号码不能为空");
					}else{
						var tel_reg = /^(13|14|15|17|18)\d{9}$/;
						if(tel_reg.test($('#phone').val())){
							//验证码获取
							var code='';
							$("#btn").click(function(){
								var phone = $("#phone").val();
								// alert(phone);
								  $.ajax({
								        url:"/shouji",        //请求地址
								        type:"post",     //发送方式
								        data:{"phone":phone},      //是否同步
								        dataType:"json",    //响应数据格式
								        success:function(data){
								          	$('.infor').html(data.msg);
								        }
								  });
								if($('#btn').html()=='获取验证码'){
									var time=setInterval(daojishi,1000);
									setTimeout(function(){
										clearInterval(time);
										code='';
										$('#btn').html('获取验证码');
										daoji=59;
									},60000);
								}
								return false;
							})
							//验证码倒计时
							var daoji=60;
							var time='';
							function daojishi(){
								daoji--;
								$('#btn').html(daoji+'s');
							}

						}else{
							$('.infor').html("手机号码格式不正确");
						}
					}
				})
			})
		</script>
</body>
</html>