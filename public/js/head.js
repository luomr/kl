$(function(){
	//二级菜单显示与隐藏
 
    $('#topTabBox #topTab #topCats .toplevel').mouseover(function(){
      $('.catitmlst').show();
    })
    $('#topTabBox #topTab #topCats .toplevel').mouseout(function(){
      $('.catitmlst').hide();
    })
    $('.catitmlst').mouseover(function(){
      $('.catitmlst').show();
    })
    $('.catitmlst').mouseout(function(){
      $('.catitmlst').hide();
    })
    //屏幕向下走多高的距离，出现#docHead
    $(window).scroll(function(){
        if($(window).scrollTop() < 40){
            $('#docHead').css('position','relative');
        }else{
            $('#docHead').css({'position':'fixed','top':'0','width':'100%'});
        }
    });
})