/**
 * Created by Administrator on 2017/5/24.
 */

$(function () {
    console.log("shopcar测试");
// =================================================未登录状态的js=======================================================
    //全局的checkbox选中和未选中的样式
    var $allCheckbox = $('input[type="checkbox"]'),     //全局的全部checkbox
        $wholeChexbox = $('.whole_check'),//顶级的checkbox
        $cartBox = $('.cartBox'),                       //每个商铺盒子
        $shopCheckbox = $('.shopChoice'),               //每个商铺的checkbox
        $sonCheckBox = $('.son_check');                 //每个商铺下的商品的checkbox
        //因多选框已被隐藏，程序里使用里label来标志来起到此功能，判断全局的checkbox,添加点击事件
        // alert($allCheckbox.length);
            $allCheckbox.click(function () {
            if ($(this).is(':checked')) {
                $(this).next('label').addClass('mark');
            } else {
                $(this).next('label').removeClass('mark')
            }
        });
    //===============================================全局全选与单个商品的关系================================
    $wholeChexbox.click(function () {
        var $checkboxs = $cartBox.find('input[type="checkbox"]');//找到全局下面所有的checkbox
        //判断，如果是选定状态，那么其下的所有checkbox全部选定
        if ($(this).is(':checked')) {
            //全选的js效果
            $(this).parents('.cartMain').find('.son_check').each(function(){
                    var $shopcarstate=$(this).parents('.order_lists').find('.shopcarstate').val();
                    var $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();
                    //alert($shopcarid);
                    //当处于选定状态，将数据库中的state参数改为1
                    if($shopcarstate){
                        $.post('/shopCar/changestate',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                            alert(data);
                        })
                    }
            })
            $checkboxs.prop("checked", true);
            $checkboxs.next('label').addClass('mark');
        } else {
            //alert("456");
             $(this).parents('.cartMain').find('.son_check').each(function(){
                    var $shopcarstate=$(this).parents('.order_lists').find('.shopcarstate').val();
                    var $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();
                    //alert($shopcarid);
                    //当处于选定状态，将数据库中的state参数改为2
                    if($shopcarstate){
                        $.post('/shopCar/changestate1',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                            // alert(data);
                        })
                    }
            })
            $checkboxs.prop("checked", false);
            $checkboxs.next('label').removeClass('mark');
        }
        totalMoney();
    });


    $sonCheckBox.each(function () {
        $(this).click(function () {
            var $shopcarstate=$(this).parents('.order_lists').find('.shopcarstate').val();
            var $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();
            //alert($shopcarstate);
            //alert($shopcarid);
            if ($(this).is(':checked')) {
                //判断：所有单个商品是否勾选
                //所有商品的条数
                var len = $sonCheckBox.length;
                // alert(len);
                var num = 0;
                //被选定商品的条数
                $sonCheckBox.each(function () {
                    if ($(this).is(':checked')) {
                        num++;
                    }
                });
                // 如果两者相等，那么给全局的checkbox以样式改变
                if (num == len) {
                    $wholeChexbox.prop("checked", true);
                    $wholeChexbox.next('label').addClass('mark');
                }
                //当处于选定状态，将数据库中的state参数改为1
                if($shopcarstate){
                    $.post('/shopCar/changestate',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                        // alert(data);
                    })
                }
            } else {
                //单个商品取消勾选，全局全选取消勾选
                $wholeChexbox.prop("checked", false);
                $wholeChexbox.next('label').removeClass('mark');
                //当处于不选定状态时候，将state参数改为2
                if($shopcarstate){
                    $.post('/shopCar/changestate1',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                        //alert(data);
                    })
                }
            }
        })
    })

    //=======================================每个店铺checkbox与全选checkbox的关系/每个店铺与其下商品样式的变化===================================================

    //店铺有一个未选中，全局全选按钮取消对勾，若店铺全选中，则全局全选按钮打对勾。
    $shopCheckbox.each(function () {
        $(this).click(function () {
            if ($(this).is(':checked')) {
                //判断：店铺全选中，则全局全选按钮打对勾。
                var len = $shopCheckbox.length;
                var num = 0;
                $shopCheckbox.each(function () {
                    if ($(this).is(':checked')) {
                        num++;
                    }
                });
                if (num == len) {
                    $wholeChexbox.prop("checked", true);
                    $wholeChexbox.next('label').addClass('mark');
                }
                //店铺下的checkbox选中状态
                //alert("123");
                $(this).parents('.cartBox').find('.son_check').prop("checked", true);
                $(this).parents('.cartBox').find('.son_check').next('label').addClass('mark');
                //店铺的全选状态的效果
                $(this).parents('.cartBox').find('.son_check').each(function(){
                    var $shopcarstate=$(this).parents('.order_lists').find('.shopcarstate').val();
                    var $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();
                    //alert($shopcarid);
                     //当处于选定状态，将数据库中的state参数改为1
                    if($shopcarstate){
                        $.post('/shopCar/changestate',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                            // alert(data);
                        })
                    }
                })
            } else {
                //否则，全局全选按钮取消对勾
                $wholeChexbox.prop("checked", false);
                $wholeChexbox.next('label').removeClass('mark');
                $(this).parents('.cartBox').find('.son_check').each(function(){
                    var $shopcarstate=$(this).parents('.order_lists').find('.shopcarstate').val();
                    var $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();
                    //alert($shopcarid);
                     //当处于选定状态，将数据库中的state参数改为2
                    if($shopcarstate){
                        $.post('/shopCar/changestate1',{'_token':'{{csrf_token()}}','state':$shopcarstate,'id': $shopcarid},function(data){
                            // alert(data);
                        })
                    }
                })
                //店铺下的checkbox选中状态
                $(this).parents('.cartBox').find('.son_check').prop("checked", false);
                $(this).parents('.cartBox').find('.son_check').next('label').removeClass('mark');
            }
            totalMoney();
        });
    });


    //========================================每个店铺checkbox与其下商品的checkbox的关系======================================================

    //店铺$sonChecks有一个未选中，店铺全选按钮取消选中，若全都选中，则全选打对勾
    $cartBox.each(function () {
        var $this = $(this);
        var $sonChecks = $this.find('.son_check');
        $sonChecks.each(function () {
            $(this).click(function () {
                if ($(this).is(':checked')) {
                    //判断：如果所有的$sonChecks都选中则店铺全选打对勾！
                    var len = $sonChecks.length;
                    var num = 0;
                    $sonChecks.each(function () {
                        if ($(this).is(':checked')) {
                            num++;
                        }
                    });
                    if (num == len) {
                        $(this).parents('.cartBox').find('.shopChoice').prop("checked", true);
                        $(this).parents('.cartBox').find('.shopChoice').next('label').addClass('mark');
                    }

                } else {
                    //否则，店铺全选取消
                    $(this).parents('.cartBox').find('.shopChoice').prop("checked", false);
                    $(this).parents('.cartBox').find('.shopChoice').next('label').removeClass('mark');
                }
                totalMoney();
            });
        });
    });


    //=================================================商品数量==============================================
    var $plus = $('.plus'),
        $reduce = $('.reduce'),
        $all_sum = $('.sum');
    $plus.click(function () {
        var $inputVal = $(this).prev('input'),//找到紧邻的input元素
            $count = parseInt($inputVal.val())+1,//将得到的inputval值加1
            $obj = $(this).parents('.amount_box').find('.reduce'),//找到.reduce类
            $priceTotalObj = $(this).parents('.order_lists').find('.sum_price'),//找到金额
            $price = $(this).parents('.order_lists').find('.price').html(),  //找到单价
            //未登录状态时，session的排序和库存
            $sessionorder = $(this).parents('.order_lists').find('.sessionorder').val(),
            $inventory = $(this).parents('.order_lists').find('.inventory').val(),
            //登录状态时，购物车中商品的id
            $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val(),
            $priceTotal = $count*parseInt($price.substring(1));//得到总金额
            //未登录状态时,对count进行判断，当其大于库存时候，只能等于库存
            if($inventory){
                if($count>$inventory){
                $count=$inventory;
                layer.tips('已达到库存上限', $(this));
                }
            }
            $inputVal.val($count);
            // 登录状态时候，数据的改变
            if($shopcarid){
                $.post('/shopCar/changenum',{'_token':'{{csrf_token()}}','num':$count,'id':$shopcarid},function(data){
                    // alert(data);
                })
            }
            // 改变session中的采购数量ajax
            if($sessionorder){
                $.post('/shopCar/changesession',{'_token':'{{csrf_token()}}','num':$count,'sessionorder':$sessionorder},function(data){
                    // alert(data);
                });
            }
        $priceTotalObj.html('￥'+$priceTotal);//将变更或的金额放回去
        if($inputVal.val()>1 && $obj.hasClass('reSty')){
            $obj.removeClass('reSty');//颜色变为灰色
        }

        totalMoney();
    });

    $reduce.click(function () {
        var $inputVal = $(this).next('input'),
            $count = parseInt($inputVal.val())-1,
            $priceTotalObj = $(this).parents('.order_lists').find('.sum_price'),
            $price = $(this).parents('.order_lists').find('.price').html(),  //单价
            //未登录状态时，session的排序和库存
            $sessionorder = $(this).parents('.order_lists').find('.sessionorder').val(),
            $inventory = $(this).parents('.order_lists').find('.inventory').val(),
            //登录状态时，购物车中商品的id
            $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val(),
            $priceTotal = $count*parseInt($price.substring(1));
        if($inputVal.val()>1){
            $inputVal.val($count);
            if( $sessionorder){
                $.post('/shopCar/changesession',{'_token':'{{csrf_token()}}','num':$count,'sessionorder':$sessionorder},function(data){
                    // alert(data);
                });
            }
            if($shopcarid){
                $.post('/shopCar/changenum1',{'_token':'{{csrf_token()}}','num':$count,'id':$shopcarid},function(data){
                    //alert(data);
                })
            }
            $priceTotalObj.html('￥'+$priceTotal);
        }
        if($inputVal.val()==1 && !$(this).hasClass('reSty')){
            $(this).addClass('reSty');
        }
        totalMoney();
    });

    $all_sum.keyup(function () {
        var $count = 0,
            $priceTotalObj = $(this).parents('.order_lists').find('.sum_price'),
            $price = $(this).parents('.order_lists').find('.price').html(),  //单价
            $priceTotal = 0;
        if($(this).val()==''){
            $(this).val('1');
        }
        $(this).val($(this).val().replace(/\D|^0/g,''));
        $count = $(this).val();
        $priceTotal = $count*parseInt($price.substring(1));
        $(this).attr('value',$count);
        $priceTotalObj.html('￥'+$priceTotal);
        totalMoney();
    })

    //======================================移除商品========================================

    var $order_lists = null;
    var $order_content = '';
    var $sessionorder='';
    var $shopcarid='';
    $('.delBtn').click(function () {
        $sessionorder = $(this).parents('.order_lists').find('.sessionorder').val(); //找到session中的k值
        $shopcarid=$(this).parents('.order_lists').find('.shopcarid').val();//获取登录状态的商品id
        $order_lists = $(this).parents('.order_lists');
        $order_content = $order_lists.parents('.order_content');
        $('.model_bg').fadeIn(300);
        $('.my_model').fadeIn(300);
    });

    //关闭模态框
    $('.closeModel').click(function () {
        closeM();
    });
    $('.dialog-close').click(function () {
        closeM();
    });
    function closeM() {
        $('.model_bg').fadeOut(300);
        $('.my_model').fadeOut(300);
    }
   //确定按钮，移除商品
    $('.dialog-sure').click(function () {
        //未登录状态下，删除session
        if($sessionorder){
            $.post('/shopCar/delsession',{'_token':'{{csrf_token()}}','sessionorder':$sessionorder},function(data){
            location.href=location.href;
            })
        }
        //已登录状态下，删除数据
        if($shopcarid){
            $.post('/shopCar/delshopcar',{'_token':'{{csrf_token}}}','id':$shopcarid},function(data){
                location.href=location.href;
            })
        }
        $order_lists.remove();
        if($order_content.html().trim() == null || $order_content.html().trim().length == 0){
            $order_content.parents('.cartBox').remove();
        }
        closeM();
        $sonCheckBox = $('.son_check');
        totalMoney();
    })

    //======================================总计==========================================
    //加和函数
    function totalMoney() {
        var total_money = 0;
        var total_count = 0;
        var calBtn = $('.calBtn a');//获取结算元素节点
        //$sonCheckBox每个商铺下的每条商品的checkbox
        $sonCheckBox.each(function () {
            //判断是否选中
            if ($(this).is(':checked')) {
                //找到相应的总金额
                var goods = parseInt($(this).parents('.order_lists').find('.sum_price').html().substring(1));
                //找到相应的数量
                var num =  parseInt($(this).parents('.order_lists').find('.sum').val());
                //总金额
                total_money += goods;
                //总数量
                total_count += num;
            }
        });
        //将总金额放回去
        $('.total_text').html('￥'+total_money);
        //将总数量放回去
        $('.piece_num').html(total_count);

        // console.log(total_money,total_count);
        //结算类的格式改变函数
        if(total_money!=0 && total_count!=0){
            if(!calBtn.hasClass('btn_sty')){
                calBtn.addClass('btn_sty');
            }
        }else{
            if(calBtn.hasClass('btn_sty')){
                calBtn.removeClass('btn_sty');
            }
        }
    }
    //根据结算结果判断是否跳转页面
    $('.calBtn').click(function(){
        // alert("123");
        var total_money=parseInt($('.total_text').html().substring(1));
        //alert(total_money);
        if(total_money!=0){
            location.href="/pay";
        }else{
            location.href=location.href;
        }
    })
    $(window).scroll(function(){
        t=$(window).scrollTop();
        var h = $(window).height()-50;
        if(t<h){
            $('.bar-wrapper').css({'position':'fixed','top':h,'z-index':'100'});
        }else{
           $('.bar-wrapper').css({'position':'relative','top':'0'});
        }
    })
});