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
                        <h5>商品其他属性</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>商品图</th>
                                    <th>商品名称</th>
                                    <th>商品属性1</th>
                                    <th>商品属性2</th>
                                    <th>商品数量</th>
                                    <th>商品原价</th>
                                    <th>商品折价</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td><img style="width:50px" src="{{isset(explode(' ',$v->infoimg)[0])?explode(' ',$v->infoimg)[0]:$v->infoimg}}"></td>
                                    <td>{{$v->infoname}}</td>
                                    <td>{{$v->infoattr1}}</td>
                                    <td>{{$v->infoattr2}}</td>
                                    <td>{{$v->infonum}}</td>
                                    <td>{{$v->infoprice}}</td>
                                    <td>{{$v->infosale}}</td>
                                    <td><a href="/admin/goodsinfo/{{$v->id}}/edit " title="修改"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="javascript:;" title="删除" onclick="delInfo(this,{{$v->id}})"><i class="fa fa-trash-o"></i></a></td>
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
        //删除
        function delInfo(obj,id){
            layer.confirm('您确定要删除这个产品吗？',
            {btn: ['确定','取消']},
            function(){
             $.post('/admin/goodsinfo/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
               if(data.status==0){
                    $(obj).parents("tr").remove();
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
             });
            },
            function(){
            layer.msg('也可以这样', {
             time: 20000, //20s后自动关闭
            btn: ['明白了', '知道了']});
            })
        }
    </script>

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->

</body>

</html>
