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
                        <h5>管理员管理</h5>
                        <form method="post" action="/admin/admin/search" class="pull-right mail-search" style="margin-top:-6px">
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
                                    <th>序号</th>
                                    <th>姓名</th>
                                    <th>头像</th>
                                    <th>密码</th>
                                    <th>权限</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($admin as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td><img src="{{$v->thumb}}" alt="" style="width:50px"></td>
                                    <td><span style="display:inline-block;width:240px;overflow: hidden;text-overflow: ellipsis;">{{$v->password}}</span></td>
                                    <td class="adminrole">{{$v->role}}</td>
                                    <td>
                                        <a href="javascript:;" onclick='changeState(this,{{$v->id}},"{{$v->state}}")' title="启用">{{$v->state}}</a>
                                    </td>
                                   <td>@if(session('admin')->role==1)<a href="/admin/admin/{{$v->id}}/edit " title="修改"><i class="fa fa-pencil"></i></a>@else <a href="/admin/admin " title="修改" onclick="layer.tips('普通管理员无此权限', $(this))"><i class="fa fa-pencil"></i></a>@endif&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;@if(session('admin')->role==1) <a href="javascript:;" title="删除" onclick="delAdmin(this,{{$v->id}})"><i class="fa fa-trash-o"></i></a>@else <a href="/admin/admin " title="删除" onclick="layer.tips('普通管理员无此权限', $(this))"><i class="fa fa-trash-o"></i></a>@endif</td>
                                </tr>
                                </tbody>
                                @endforeach
                        </table>
                        {{ isset($keywords) ? $admin->appends(['keywords' => "$keywords"])->links() : $admin->links() }}
                        <style>
                           .pagination{
                                margin-left:40%;
                            }
                        </style>

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
    <script>
        //删除管理员
        function delAdmin(obj,id){
            layer.confirm('您确定要删除这个管理员吗？',
            {btn: ['确定','取消']},
            function(){
             $.post('/admin/admin/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
               if(data.status==0){
                    $(this).parents('tr').remove();
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                }
                if(data.status==2){
                    layer.alert(data.msg, {icon: 5});
                }
                if(data.status==3){
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
        //启用禁用状态的改变
        function changeState(obj,id,state){
            $.post('/admin/admin/changestate',{'_token':'{{csrf_token()}}','id':id,'state':state},function(data){
                if(data.status==0){
                    // location.href=location.href;
                    if($(obj).text()=="启用"){
                        $(obj).text("禁用");
                    }else{
                        $(obj).text("启用");
                    }
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.alert(data.msg, {icon: 5});
                }
                if(data.status==4){
                    layer.alert(data.msg, {icon: 5});
                }
                if(data.status==3){
                    layer.alert(data.msg, {icon: 5});
                }

                // alert(data);
            })
        }
    </script>

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->

</body>

</html>
