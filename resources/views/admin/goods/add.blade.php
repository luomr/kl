<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/adminpublic/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/adminpublic/css/animate.css" rel="stylesheet">
    <link href="/adminpublic/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加商品</h5>
                    </div>
                    <div class="ibox-content">
                        <form enctype="multipart/form-data" method="post" action="/admin/goods" class="form-horizontal m-t" id="commentForm">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商品名称：</label>
                                <div class="col-sm-8">
                                    <input id="cname" name="listname" minlength="2" type="text" class="form-control" required="" aria-required="true" value="{{ old('listname') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商品类型：</label>
                                <div class="col-sm-3">
                                    <select name="listcate"  required="" aria-required="true" class="form-control">
                                    <option value="">请选择分类</option>
                                    @foreach($data as $v)
                                    @if($v->catepid != 0)
                                    <option value="{{$v->id}}">
                                     @if($v->level!==0)|@endif
                                     {{str_repeat('_',$v->level*3)}}
                                     {{$v->catename}}</option>
                                     @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商品简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="cname" name="listtitle" class="form-control" required="" aria-required="true" value="{{ old('listtitle') }}"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="status" required="" aria-required="true">
                                        <option selected value=1>上架</option>
                                        <option value=2>下架</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- 全局js -->
    <script src="/adminpublic/js/jquery.min.js?v=2.1.4"></script>
    <script src="/adminpublic/js/bootstrap.min.js?v=3.3.6"></script>

    <!-- 自定义js -->
    <script src="/adminpublic/js/content.js?v=1.0.0"></script>

    <!-- jQuery Validation plugin javascript-->
    <script src="/adminpublic/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="/adminpublic/js/plugins/validate/messages_zh.min.js"></script>

    <script src="/adminpublic/js/demo/form-validate-demo.js"></script>

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->

</body>

</html>
