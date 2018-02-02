$(function(){
	// 登录方式切换
	$('.center .zuo .phone ul .select').click(function(){
		var index = $('li').index(this);
		$(this).addClass('block').siblings('li').removeClass('block');
		$('.write > div').eq(index).addClass('show').siblings().removeClass('show');
	})
	// 密码登录和短信登录切换
	$('.center .zuo .phone .write .write_box .qie').click(function(){
		var index = $(this).index();
		$(this).removeClass('qie_show').siblings().addClass('qie_show');
		$('.center .zuo .phone .write .write_box .tel .ph').eq(index).removeClass('ph_show').siblings().addClass('ph_show');
	})
	// 去登录页面
	$('.center .zuo .phone .tit .select1 a').click(function(){
		$('.center .zuo .phone').eq(1).removeClass('phone_show').siblings().addClass('phone_show');
	})
	// 去注册页面
	$('.center .zuo .phone .write .bottom div a').click(function(){
		$('.center .zuo .phone').eq(0).removeClass('phone_show').siblings().addClass('phone_show');
	})

	
})