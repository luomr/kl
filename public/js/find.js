$(function(){
	//安全验证的下一步
	$('.center .center-put .one form .center-login .u-login1').click(function(){
		$('.center .center-put .one').eq(0).removeClass('show');
		$('.center .center-put .one').eq(1).addClass('show');
		$('.center ul li').eq(1).addClass('center-select').siblings().removeClass('center-select');
	})
	//设置新密码的下一步
	$('.center .center-put .one form .newpass-login .u-login2').click(function(){
		$('.center .center-put .one').eq(2).addClass('show');
		$('.center .center-put .one').eq(1).removeClass('show');
		$('.center .center-put .one').eq(0).removeClass('show');
		$('.center ul li').eq(2).addClass('center-select').siblings().removeClass('center-select');
	})
})