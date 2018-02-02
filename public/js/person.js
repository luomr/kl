$(function(){
	console.log("person测试");
	//个人中心
	$('.leftmenu dl dd').click(function(){
		var index = $(this).index();
		$(this).addClass('active').siblings().removeClass('active');
		$('.col-right .slideTab').eq(index).addClass('tab_show').siblings().removeClass('tab_show');
	})

	// 订单状态
	$('.col-right .slideTab ul li').click(function(){
		var index = $(this).index();
		$(this).addClass('tab_li').siblings().removeClass('tab_li');
		$('.slideTab .slideBox .slideWarp').eq(index).addClass('slideWarp_show').siblings().removeClass('slideWarp_show');
	})

	// 订单删除
	$('.co_ri .goods_del').click(function(){
		$('this').parent().parent().parent().css("display","none");
	})
})