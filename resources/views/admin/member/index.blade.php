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
                        <h5>会员管理</h5>
                        <form method="get" action="/admin/member/search" class="pull-right mail-search" style="margin-top:-6px">
                         {!! csrf_field() !!}
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="keywords" placeholder="请输入搜索关键词">
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
                                    <th>序号</th>
                                    <th>头像</th>
                                    <th>手机号</th>
                                    <th>邮箱</th>
                                    <th>密码</th>
                                    <th>家庭地址</th>
                                    <th>状态</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td><img src="{{$v->user_img}}" alt="" style="width:50px"></td>
                                    <td>{{$v->user_ph}}</td>
                                    <td>{{$v->user_mail}}</td>
                                    <td style="display:inline-block;width:80px;overflow: hidden;text-overflow: ellipsis;"><span>{{$v->user_pw}}</span></td>
                                    <td>{{$v->user_address}}</td>
                                    <td><a href="javascript:;" onclick='changeState(this,{{$v->id}},"{{$v->state}}")' title="启用">{{$v->state}}</a></td>
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
                             {{ isset($keywords) ? $data->appends(['keywords' => "$keywords"])->links() : $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/adminpublic/js/jquery.min.js?v=2.1.4"></script>
    <script src="/adminpublic/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/adminpublic/js/plugins/layer/layer.min.js"></script>


    <!-- Peity -->
    <script src="/adminpublic/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- 自定义js -->
    <script src="/adminpublic/js/content.js?v=1.0.0"></script>


    <!-- iCheck -->
    <script src="/adminpublic/js/plugins/iCheck/icheck.min.js"></script>

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
        //启用禁用状态的改变
        function changeState(obj,id,state){
            $.post('/admin/member/changestate',{'_token':'{{csrf_token()}}','id':id,'state':state},function(data){
               if(data.status==0){
                    if($(obj).text()=="启用"){
                        $(obj).text("禁用");
                    }else{
                        $(obj).text("启用");
                    }
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
            })
        }
    </script>
</body>

</html>
