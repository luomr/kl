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
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加商品其它信息</h5>
                    </div>
                    <div class="ibox-content">
                        <form enctype="multipart/form-data" method="post" action="/admin/goodsinfo/{{$result->id}}" class="form-horizontal m-t" id="commentForm">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品图：</label>
                                <div class="col-sm-4">
                                    <input name="infoimg[]" multiple type="file" value="{{ $result->infoimg }}" style="float:left">
                                    <img src="{{isset(explode(' ',$result->infoimg)[0])?explode(' ',$result->infoimg)[0]:$result->infoimg}}" style="margin-left:-60px;width:30px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品名称：</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="infoname" required="" aria-required="true">
                                        <option value="{{$goods1->id}}">{{$goods1->listname}}</option>
                                        @foreach ($goods as $v)
                                        <option value="{{$v->id}}">{{$v->listname}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品属性1：</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="infoattr1" required="" aria-required="true">
                                        <option select value="{{$attr1->id}}">{{$attr1->valueattr}}</option>
                                        @foreach ($attr as $v)
                                        <option value="{{$v->id}}">{{$v->valueattr}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品属性2：</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="infoattr2" required="" aria-required="true">
                                        <option select value="{{$attr2->id}}">{{$attr2->valueattr}}</option>
                                        @foreach ($attr as $v)
                                        <option value="{{$v->id}}">{{$v->valueattr}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品数量：</label>
                                <div class="col-sm-4">
                                    <input id="cname" name="infonum" minlength="2" type="text" class="form-control" required="" aria-required="true" value="{{ $result->infonum }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品原价：</label>
                                <div class="col-sm-4">
                                    <input id="cname" name="infoprice" minlength="2" type="text" class="form-control" required="" aria-required="true" value="{{$result->infoprice}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品折价：</label>
                                <div class="col-sm-4">
                                    <input id="cname" name="infosale" minlength="2" type="text" class="form-control" required="" aria-required="true" value="{{$result->infosale}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品内容：</label>
                                <div class="col-sm-10">
                                    <!-- 富文本编辑器 -->
                                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
                                    <script id="editor" type="text/plain" style="width:100%;height:300px;" name="infocontent">{{$result->infocontent}}</script>
                                    <script type="text/javascript">
                                        //实例化编辑器
                                        var ue = UE.getEditor('editor');
                                    </script>
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
