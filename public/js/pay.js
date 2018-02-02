$(function(){
    console.log("pay.js测试");
    //添加和修改地址上的div框的js效果
    //点击添加地址按钮效果
    $('.add_add').click(function(){
       $('.modal-row').css('display','block');
       $('.endbackground').css('display','block');
    })
    //点击增加和修改上面的关闭按钮
    $('.iDialogClose').click(function(){
       $('.modal-row').css('display','none');
       $('.endbackground').css('display','none');
    })
    $('.iDialogClose1').click(function(){
       $('.modal-row1').css('display','none');
       $('.endbackground').css('display','none');
    })
    $('.item-cancel').click(function(){
       $('.modal-row').css('display','none');
       $('.endbackground').css('display','none');
    })
     $('.item-cancel1').click(function(){
       $('.modal-row1').css('display','none');
       $('.endbackground').css('display','none');
    })
    //增加和修改上面的省市联动
     var provinces = ["山西","山东","河南","河北","湖南","湖北"];
     var citys = [
      ["太原","大同","阳泉","长治","晋城","忻州","朔州","临汾","运城","晋中"],
      ["济南市","青岛市","淄博市","枣庄市","东营市","烟台市","潍坊市","济宁市","泰安市","威海市"],
      ["郑州市","开封市","洛阳市","平顶山市","安阳市","鹤壁市","新乡市","焦作市","濮阳市","许昌市"],
        ["石家庄市","唐山市","秦皇岛市","邯郸市","邢台市","保定市","张家口市","承德市","沧州市","廊坊市"],
      ["长沙市","衡阳市","邵阳市","岳阳市","张家界市","永州市","常德市","株洲市","益阳市","湘潭市"],
      ["武汉市","黄石市","十堰市","宜昌市","襄阳市","鄂州市","荆门市","咸宁市","随州市","孝感市"]
           ];
      // 省级联动的函数
      function provincecity(provinces,citys,pro_id,city_id){
         //获取并添加城市节点
        for(var i=0;i<provinces.length;i++){
        //给省里面添加内容
        var provinceOption = $(pro_id).append("<option value="+i+">"+provinces[i]+"</option>");
        }
        //当省份改变的时候，对应到相应的市
        $(pro_id).change(function(){
        // alert("123");
        $(city_id).empty().append('<option value="-1">所在市</option>');
        var index =$(pro_id).val();
        // alert(index);
        var city = citys[index];
        // alert(city);
        for(var i=0;i<city.length;i++){
        //创建市区里面的option
        var cityOption = $(city_id).append("<option value="+i+">"+city[i]+"</option>");
        }
        })
      }
      //调用省级联动函数
      provincecity(provinces,citys,'#province','#city');
})