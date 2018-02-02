<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/adminpublic/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/adminpublic/css/animate.css" rel="stylesheet">
    <link href="/adminpublic/css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">KL</h1>

            </div>
            <h3>欢迎使用 KL</h3>
            <form class="m-t" role="form" action="/admin/dologin"  method="post">
                @if(session('errors'))
                <h4 style="color:red">{{session('errors')}}</h4>
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名"  name="name" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码"  name="password">
                </div>
                <div class="form-group" style="position:relative">
                    <input type="text" class="form-control" placeholder="验证码"  name="captcha">
                    <img src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}?d='+Math.random()" style="cursor:pointer;position:absolute;left:310px;top:0px">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/adminpublic/js/jquery.min.js?v=2.1.4"></script>
    <script src="/adminpublic/js/bootstrap.min.js?v=3.3.6"></script>

    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->

</body>

</html>
