<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 基础表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/adminpublic/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/adminpublic/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/adminpublic/css/animate.css" rel="stylesheet">
    <link href="/adminpublic/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>购物车管理</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>订单编号</th>
                                    <th>商品信息</th>
                                    <th>收货信息</th>
                                    <th>订单时间</th>
                                    <th>交易状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->ordernum}}</td>
                                    <td>{!!$v->ordershop!!}</td>
                                    <td>{!!$v->orderadd!!}</td>
                                    <td>{{date("Y-m-d H:i",$v->ordertime)}}</td>
                                    <td onclick='fatodai(this,"{{$v->orderstatus}}",{{$v->id}})' style="cursor:pointer">{{$v->orderstatus}}</td>
                                    <td><a href="javascript:;" onclick='changeState(this,{{$v->id}})'>取消订单</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       <style>
                           .pagination{
                                margin-left:40%;
                            }
                        </style>
                        <div id="pagination">
                            {{ isset($keywords) ? $result->appends(['keywords' => "$keywords"])->links() : $result->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 全局js -->
    <script src="/adminpublic/js/jquery.min.js?v=2.1.4"></script>
    <script src="/adminpublic/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>



    <!-- Peity -->
    <script src="/adminpublic/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- 自定义js -->
    <script src="/adminpublic/js/content.js?v=1.0.0"></script>


    <!-- iCheck -->
    <script src="/adminpublic/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/adminpublic/js/plugins/layer/layer.min.js"></script>

    <!-- Peity -->
    <script src="/adminpublic/js/demo/peity-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script>
        //取消交易
        function changeState(obj,id){
            $.post('/admin/order',{'_token':'{{csrf_token()}}','id':id},function(data){
               if(data.status==0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
            })
        }
        //点击待发货变成待收货
        function fatodai(obj,orderstatus,id){
            //获取状态数值
           var orderstatus=$(obj).text();

            $.post('/admin/order/changeorderstate',{'_token':'{{csrf_token()}}','orderstatus':orderstatus,'id':id},function(data){
                 if(data.status==0){
                    $(obj).text("待收货");
                    layer.alert(data.msg, {icon: 6});
                 }
                 if(data.status==1){
                    layer.alert(data.msg, {icon: 5});
                 }
                 if(data.status==2){
                    layer.alert(data.msg, {icon: 5});
                 }
            })
        }
    </script>

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->

</body>

</html>
