<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注册—网易考拉海购</title>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<script type="text/javascript" src='/js/login.js'></script>

</head>
<body>
	<!--顶部div框-->
	<div class="he">
		<div class="head">
			<div class="left">
				<a href="/" target="_blank"><img src="/images/logo.png"></a>
			</div>
			<div class="right">
				<img src="/images/head.jpg">
			</div>
		</div>
	</div>
	<!--中间输入账号-->
	<div class="center">
		<div class="zuo">
			<!-- 左广告 -->
			<a class="ad" href="">
				<img src="/images/login.png">
			</a>
			<!-- 注册 -->
			<div class="phone" style="display: block;">
					<div class="tit">
						<span class="select">欢迎注册</span>
						<span class="select1">已有账号？<a href="/login">去登录&gt;</a></span>
					</div>
					<div class="con">
						<form action="/doregister" method="post">
							 {!! csrf_field() !!}
							<div class="input_box">
								<span class="in_1"></span>
								<input type="text" placeholder="请输入手机号" name="phone" value="{{old('phone')}}" id="phone">
							</div>
							<div class="input_box">
								<input class="pw" type="text
									" placeholder="请输入验证码" id="code" name="code">
								<button type="submit" id="btn" onclick="">获取验证码</button>
							</div>
							<div class="input_box">
								<span class="in_2"></span>
								<input  style="margin-top: -2px;" type="password" placeholder="请输入密码" name="user_pw">
							</div>
							<p class="infor">
								@if ($errors->has('user_ph')) {{ $errors->first('phone')}}
								@elseif ($errors->has('user_pw')) {{$errors->first('user_pw')}}
								@endif
								@if(session('error'))
								{{session('error')}}
								@endif
							</p>
							<button style="cursor: pointer;"  class="u-login" type="submit" >注册</button>
							<p class="unlogin">我同意
								<a href="">《服务条款》</a>
									和
								<a href="">《网易隐私协议》</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--最后结尾部分-->
	<script>
			$(function(){
				$('#phone').focusout(function(){
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
								        url:"/register/shouji",        //请求地址
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