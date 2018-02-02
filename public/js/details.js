$(function(){
    // 详情左边部分
    var time = null;
    // 商品的移如移出效果
    $('#litimgUl li').mouseover(function(){
        var _this = $(this);
        // alert("123");
        time = setTimeout(function(){
           _this.addClass('active').siblings().removeClass('active');
            var index = _this.index();
            $('#showImgBox>img').eq(index).addClass('one').siblings('img').removeClass('one');
        },300);
      }).mouseout(function(){
          clearTimeout(time);
    })
    //下部图片的左右滚动
    var liW = $('#litimgUl li').eq(0).width();
    // alert(liW);
    var ulW = $('#litimgUl').width();
    var offset=liW-ulW;
    // alert(ulW);
    var index1 = 0;
    var index2 = 0;
    var num=0;
    $('#litimgUl li').each(function(i){
        num=i++;
    })
    // alert(num);
    // alert(ulW);
    function slide(){
        if(index1 == num){
           index1 = 0;
           //把第一张图片定位到最后一张图片的后面
           $('#litimgUl li').eq(0).css({'position':'relative','left':ulW});
        }else{
           index1++;
        }
        index2++;
        $('#litimgUl').animate({'left':-index2*(liW+20)},1000,function(){
         if(index1 == 0){
           //当显示移动后的第一张图片的时候，第一张图片回归之前的位置
           $('#litimgUl li').eq(0).css('position','static');
           //ul距离左边的距离为0
           $('#litimgUl').css('left',0);
           //index2的值设置为0
           index2 = 0;
          }
       });
    }
    function slideLeft(){
        if(index1 == 0){
           index1 = num-1;
           //把第一张图片定位到最后一张图片的后面
           $('#litimgUl li').eq(num).css({'position':'relative','left':-ulW});
        }else{
           index1--;
        }
        index2--;
        $('#litimgUl').animate({'left':-index2*(liW+20)},1000,function(){
         if(index1 == num){
           //当显示移动后的第一张图片的时候，第一张图片回归之前的位置
           $('#litimgUl li').eq(num).css('position','static');
           //ul距离左边的距离为0
           $('#litimgUl').css('left',liW*num);
           //index2的值设置为0
           index2 = num;
          }
       });
    }
    // // 点击箭头效果
    $('.scrollleft').click(function(){
        slideLeft();
    })
    // //点击右箭头的实现
    $('.scrollright ').click(function(){
        slide();
    })
    //放大镜
    //加减库存
    $('.plus').click(function(){
          var $stock=parseInt($('.inventory').text().substring(3));//获得库存数目
         // alert(typeof $stock);die;
         var $inputVal = $(this).prev('input');//找到紧邻的input元素
         var $count = parseInt($inputVal.val())+1;//将得到的inputval值加1
         if($count>$stock){
          $count=$stock;
         }
         $inputVal.val($count);
         $obj = $(this).parents('.ctrnum-wrap').find('.minus');//找到.minus类
        // 根据数量大于1的条件，给minus重新给样式
         if($inputVal.val()>1 && $obj.hasClass('reSty')){
            $obj.removeClass('reSty');
        }
    })
    $('.minus').click(function(){
        var $inputVal = $(this).next('input'),
            $count = parseInt($inputVal.val())-1;
        if($inputVal.val()>1){
            $inputVal.val($count);
        }
        if($inputVal.val()==1 && !$(this).hasClass('reSty')){
            $(this).addClass('reSty');
        }
    })
    //详情和用户评价的选项卡
    $('.P_nav span').click(function(){
        var index =$(this).index();
        // alert(index);
        $(this).addClass('active').siblings().removeClass('active');
        $('#P_content>div').eq(index).show().siblings().hide();
    })
    //ajax效果

})