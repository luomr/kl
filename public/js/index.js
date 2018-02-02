$(function(){
    //顶部导航栏
    $('.mcDropMenuBox a').mouseover(function(){
        $(this).css('color','red');
    })
    $('.mcDropMenuBox a').mouseout(function(){
        $(this).css('color','#333');
    })
    // 搜索栏部分
    // 二级菜单
    //banner图
    var index1=0;
    var time=null;
    var time1=null;
    //整个点个数
    var num=$('.show_pic li').length;
    //alert(num);
    $('.show_pic li').eq(0).addClass('selected1');
    $('#show_pic li').eq(0).addClass('selected');
     // alert("123");
    //手动轮播
    $('.show_pic li').mouseover(function(){
        var _this = $(this);
        time = setTimeout(function(){
          _this.addClass('selected1').siblings().removeClass('selected1');
          var index = _this.index();
          index1 = index;
          $('#show_pic li').eq(index).addClass('selected').siblings().removeClass('selected');
        },1000);
    }).mouseout(function(){
        clearTimeout(time);
    })
    //自动轮播
    function fade(){
       if(index1 == num-1){
          index1 = 0;
       }else{
          index1++;
       }
      $('.show_pic li').eq(index1).addClass('selected1').siblings().removeClass('selected1');
      $('#show_pic li').eq(index1).addClass('selected').siblings().removeClass('selected');
    }
    function fadeLeft(){
       if(index1 == 0){
          index1 = num-1;
          //alert(index1);
       }else{
          index1--;
       }
      $('.show_pic li').eq(index1).addClass('selected1').siblings().removeClass('selected1');
      $('#show_pic li').eq(index1).addClass('selected').siblings().removeClass('selected');
    }
    time1=setInterval(fade,2000);
    $('#picBox').mouseover(function(){
       clearInterval(time1);
       $('#picBox .arrow').css('display','block');
    }).mouseout(function(){
        time1 = setInterval(fade,2000);
        $('#picBox .arrow').css('display','none');
    })
    $('#picBox .arrowright').click(function(){
        fade();
    })
    $('#picBox .arrowleft').click(function(){
        fadeLeft();
    })
    //屏幕向下，固定侧边栏
    $(window).scroll(function(){
        if($(window).scrollTop() < 567){
            $('.page4').css('position','relative');
        }else{
            $('.page4').css({'position':'fixed','top':'75px','width':'100%'});
        }
    })


    // 倒计时
    window.onload=function(){
        getMyTime();
    }
    function getMyTime(){
            var startDate=new Date();
            var endDate=new Date('2017/12/18 18:00:00');
            var countDown=(endDate.getTime()-startDate.getTime())/1000;
            var h=parseInt(countDown/(60*60)%24);
            var m=parseInt(countDown/60%60);
            var s=parseInt(countDown%60);
            $('.time i').html(h+':'+m+':'+s);
            setTimeout(getMyTime,1000);
            if(countDown<=0){
              $('.time i').html('活动结束');
            }
          }

        // 广告弹窗

        //广告窗体延迟2s显示
        setTimeout(function(){
          $('.gg').show();
          $('.gg').css({'top':'0','left':'0'});
        },2000);
        //点击关闭按钮，广告窗体隐藏
        $('.close').click(function(){
          $('.gg').hide();
        })

})