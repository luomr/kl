<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录—网易考拉海购</title>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<script type="text/javascript" src='/js/login.js'></script>
</head>
<body>
	<!--顶部div框-->
	<div class="he">
		<div class="head">
			<div class="left">
				<a href="/"><img src="/images/logo.png"></a>
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
			<!-- 右登录 -->
			<div class="phone phone_show">
				<ul>
					<li class="select block">欢迎登录</li>
				</ul>
				<div class="write">
				<!--手机登录-->
					<div class="write_box show">
						<!--使用验证码登录-->
							<div class="tel" style="margin-top:50px;">
								<!--密码登录-->
								<div class="ph" style="display: block;">
									<form action="dologin" 	method="post">
                					 {!! csrf_field() !!}
									<div class="input_box">
									<span class="in_1"></span>
									<input type="text" placeholder="请输入手机号" name="user_ph" value="{{old('user_ph')}}">
							</div>
							<div class="input_box" style="margin-top: 20px;">
								<span class="in_2"></span>
								<input type="password" placeholder="请输入密码" name="user_pw">
							</div>
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
							<button class="u-login" type="submit" style="cursor: pointer;">登录</button>
							<p class="unlogin">
							<a href="find" target="_blank">忘记密码？</a>
							</p>
							</form>
							</div>
						</div>
					</div>
						<!-- 2 -->
						<div class="bottom">
							<div>
							<a href="register">手机快捷注册&gt;</a>
							</div>
						</div>
				</div>
			</div>

			</div>
		</div>
	</div>
	<!--最后结尾部分-->

</body>
</html>