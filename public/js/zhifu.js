$(function(){
	// 支付方式选择事件
	$('#weixin').click(function(){
		$('#erweima').show();
		$('#liji').css('display','none');
	})
	$('#zhifubao').click(function(){
		$('#erweima').hide();
		$('#liji').css('display','block');
	})
	$('#yinlian').click(function(){
		$('#erweima').hide();
		$('#liji').css('display','block');
	})


	// 支付事件
	$('#liji').click(function(){
		var reg = /^[0-9]{6}$/;
		var a = prompt('请输入密码');
		if(reg.test(a)){
			// alert('支付成功');

			$('#tishi').html(': 支付成功');
			$('#yifu').html('已付金额');
			$('#fangshi').hide();
			var ddh = [];
			for(var i=0;i<$('.orid').length;i++){
				ddh[i] = $('.orid').eq(i).val();
			}
			$.post('/zhifu',{'_token':"{{csrf_token()}}",'id':ddh},function(data){
				if(data.status == 0){
					layer.alert(data.msg, {icon: 6});
					setTimeout(function(){
					window.location.href = "/person";
					},3000);
				}else{
					layer.alert(data.msg, {icon: 5});
				}
			})	
		}else{
			alert('支付失败');
		}
	})
})
