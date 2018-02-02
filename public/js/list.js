$(function(){
	//二级菜单
	$('.navitm-cats').mouseover(function(){
		$('.navitm-cats ul').css('display','block');
	}).mouseout(function(){
		$('.navitm-cats ul').css('display','none');
	})

	$('.tab .tab1 ul li a').hover(function(){
		$(this).css('border-bottom','1px solid #333')
	},function(){
		$(this).css('border-bottom','0px solid #333')
	})
	
	$('.tab2-3 ul li').hover(function(){
		$(this).css('color','red');
	},function(){
		$(this).css('color','#333');
	})

	$('.tab3 .tab3-1').click(function(){
		var index=$(this).index();
		$('.tab3 .tab3-1').eq(index).addClass('selected').siblings().removeClass('selected');
	})

})