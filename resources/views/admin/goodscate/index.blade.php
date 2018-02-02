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
                        <h5>商品分类大全</h5>
                        <form method="post" action="/admin/goodscate/search" class="pull-right mail-search" style="margin-top:-6px">
                            <div class="input-group">
                                 {!! csrf_field() !!}
                                <input type="text" class="form-control input-sm" name="keywords" placeholder="请输入搜索关键词" value="">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        搜索
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>排序</th>
                                    <th>id</th>
                                    <th>类型名称</th>
                                    <th>所属类别</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $v)
                                <tr>
                                    <td style="width:50px;"><input type="text" value="{{$v->cateorder}}" name="cateorder" style="width:100%" onchange="changeOrder(this,{{$v->id}})"></td>
                                    <td>{{$v->id}}</td>
                                    <td>@if($v->level!==0)|@endif
                                        {{str_repeat('_',$v->level*3)}}
                                        {{$v->catename}}</td>
                                    <td>{{$v->catepid}}</td>
                                    <td><a href="/admin/goodscate/{{$v->id}}/edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="delGoodscate(this,{{$v->id}})"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right pagination">
        <ul class="pagination pagination-outline">
            <li class="page-first disabled"><a href="javascript:void(0)">«</a></li>
            <li class="page-pre disabled"><a href="javascript:void(0)">‹</a></li>
            <li class="page-number active"><a href="javascript:void(0)">1</a></li>
            <li class="page-number"><a href="javascript:void(0)">2</a></li>
            <li class="page-number"><a href="javascript:void(0)">3</a></li>
            <li class="page-next"><a href="javascript:void(0)">›</a></li>
            <li class="page-last"><a href="javascript:void(0)">»</a></li>
        </ul>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/adminpublic/js/jquery.min.js?v=2.1.4"></script>
    <script src="/adminpublic/js/bootstrap.min.js?v=3.3.6"></script>



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

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->
    <script>
        //更新排序
        function changeOrder(obj,id){
            // alert("123");
            var order=$(obj).val();
            // alert(acte_order);
            $.post('/admin/goodscate/changeorder',{'_token':'{{csrf_token()}}','id':id,'cateorder':order},function(data){
                if(data.status==0){
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
            })
        }
        //删除分类
        function delGoodscate(obj,id){
            layer.confirm('您确定要删除这个分类吗？',
            {btn: ['确定','取消']},
            function(){
             $.post('/admin/goodscate/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
               if(data.status==0){
                    location.href=location.href;//刷新当前页面
                    // $(obj).parents("tr").remove();
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
</body>

</html>
