<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="  {{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href=" {{ asset('assets/css/font-awesome-ie7.min.css') }}"/>
    <![endif]-->
    <link rel="stylesheet" href=" {{ asset('assets/css/ace.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}"/>
    <!--    <link rel="stylesheet" href="{{ asset('css/common.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}"/>
    <![endif]-->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src=" {{ asset('assets/js/ace-extra.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src=" {{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
    <script src=" {{ asset('assets/layer/layer.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <title>医美系统-登录页</title>
</head>
<body class="login-layout Reg_log_style">
<div class="logintop">
    <span>欢迎来到瑞辉医美医疗管理软件</span>
    <ul>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
    </ul>
</div>
<div id="app" class="loginbody">
    <div class="login-container">
        <div class="center">
            <!-- <img src="{{ asset('assets/images/log1.png') }}"/>-->
            <h1 style=" color: #fff; font-family: '幼圆'">医美系统</h1>
        </div>
        <div class="space-6"></div>
        <div class="position-relative">
            <div id="login-box" class="login-box widget-box no-border visible">
                <div class="widget-body">
                    <div class="widget-main">
                        <h4 class="header blue lighter bigger">
                            <i class="icon-coffee green"></i>
                            用户登陆
                        </h4>
                        <div class="login_icon"><img src="{{ asset('assets/images/login.png') }}"/></div>
                        <form class="" method="post" action="" id="form-wrap">
                            {{csrf_field()}}
                            <fieldset>
                                <ul>
                                    <li class="frame_style form_error"><label class="user_icon"></label><input
                                            name="username" type="text" id="username"/><i>用户名</i></li>
                                    <li class="frame_style form_error"><label class="password_icon"></label><input
                                            name="password" type="password" id="password"/><i>密码</i></li>
                                    <!-- <li class="frame_style form_error"><label class="Codes_icon"></label><input
                                             name="验证码" type="text" id="Codes_text"/><i>验证码</i>
                                         <div class="Codes_region"></div>
                                     </li>-->
                                </ul>
                                <div class="space"></div>

                                <div class="clearfix">
                                    <!--<label class="inline">
                                        <input type="checkbox" class="ace">
                                        <span class="lbl">保存密码</span>
                                    </label>-->
                                    <button type="button" class="width-35 pull-right btn btn-sm btn-primary"
                                            id="login_btn"><i class="icon-key"></i>登陆
                                    </button>
                                </div>

                                <div class="space-4"></div>
                            </fieldset>
                        </form>
                        <div class="social-or-login center">
                            <span class="bigger-110">通知</span>
                        </div>

                        <div class="social-login center">
                            本网站系统不再对IE8以下浏览器支持，请见谅。
                        </div>
                    </div><!-- /widget-main -->
                    <div class="toolbar clearfix">
                    </div>
                </div><!-- /widget-body -->
            </div><!-- /login-box -->
        </div><!-- /position-relative -->
    </div>
</div>
<div class="loginbm">版权所有 2016 <a href="">深圳瑞辉医疗投资控股有限公司</a></div>
<strong></strong>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/WorkStation/login.js') }}"></script>
</body>
</html>
