<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/font/css/font-awesome.min.css') }}"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href=" {{ asset('assets/css/font-awesome-ie7.min.css') }}"/><![endif]-->
    <link rel="stylesheet" href=" {{ asset('assets/Widget/zTree/css/zTreeStyle/zTreeStyle.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/Widget/icheck/icheck.css') }}" type="text/css"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/ace.min.css') }} "/>
    <link rel="stylesheet" href=" {{ asset('assets/css/ace-rtl.min.css') }} "/>
    <link rel="stylesheet" href=" {{ asset('assets/css/ace-skins.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('css/style.css') }} "/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}"/><![endif]-->
    <script src="{{ asset('js/vue1.0.js') }}"></script>
    <script src=" {{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src=" {{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src=" {{ asset('assets/js/ace-extra.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src=" {{ asset('assets/js/html5shiv.js') }}"></script>
    <script src=" {{ asset('assets/js/respond.min.js') }}"></script><![endif]-->
    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src=' {{ asset('assets/js/jquery.mobile.custom.min.js') }}'>" + "<" + "script>");
    </script>
    <script src=" {{ asset('assets/js/typeahead-bs2.min.js') }} "></script>
    <!--[if lte IE 8]>
    <script src=" {{ asset('assets/js/excanvas.min.js') }}"></script><![endif]-->
    <script src=" {{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src=" {{ asset('assets/js/ace.min.js') }}"></script>
    <script src=" {{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src=" {{ asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
    <script src=" {{ asset('js/H-ui.js') }}"></script>
    <script src=" {{ asset('js/H-ui.admin.js') }}"></script>
    <script src=" {{ asset('assets/layer/layer.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/laydate/laydate.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/Widget/zTree/js/jquery.ztree.all-3.5.min.js') }}"></script>
    <script src=" {{ asset('js/lrtk.js') }}" type="text/javascript"></script>
    <!--- 公用的Js --->
    <script src=" {{ asset('js/Workstation/public.js') }}"></script>
    <script src=" {{ asset('js/Workstation/api.js') }}"></script>
    <script src=" {{ asset('js/common.js') }}"></script>
    <script src="{{env('NODE_SERVER_SOCKET_URL')}}"></script>
    <title>医美系统-首页</title>
    <script>
        var user_id = parseInt("{{Session::get(\App\Data\Session::LOGIN_USER_ID)}}");
        // 连接socket
        var connecter = io.connect('{{env('NODE_SERVER_SOCKET_PROTOCOL')}}://{{env('NODE_SERVER_SOCKET_HOST')}}:{{env('NODE_SERVER_SOCKET_PORT')}}?userID={{Session::get(\App\Data\Session::LOGIN_USER_ID)}}');
        connecter.on('connect', function () {
            console.log({socketID: connecter.id, userID: user_id});
            Common.ajax(Api.socketBind, "post", {userID: user_id, socketID: connecter.id}, function (res) {
                console.log(res);
            });
        });
        connecter.on('send.hint', function (data) {
            layer.tips('收到来自' + data.user + '的新消息', '#messageCenter', {
                tips: [3, '#190a71']
            });
//            #1c0bc3
            //如果里面有文本，也就是有这个元素，则直接更改条数
            if ($("#messageCount").text() != "") {
                $("#messageCount").text(8);
            } else {
                //没有这个元素则添加这个元素
                $("#messageCenter").append('<span id="messageCount"class="badge badge-important">1</span>');
            }
            console.log(data);
        });
        /**
         * 通过socket发送数据给指定的用户
         *
         * @param user 用户ID（若存在多个则用半角逗号,分隔，例如：67,33,666）
         * @param message 发送的信息
         */
        function socketSend(user, message) {
            try {
                user = user.toString();
            } catch (error) {
                user = '';
            }
            var user_list = [];
            if (user != '') user_list = user.split(',');
            connecter.emit('send.specify', {message: message, user: user_list});
        }
    </script>
</head>
<body>
<!-- 顶部栏-->
<div class="navbar navbar-default" id="navbar">
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <h1 class="c-title">
                    <image src="{{ asset('images/logo.png') }}"></image>
                </h1>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->
        <div class="navbar-header operating pull-left">

        </div>
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="time"><em id="time"></em></span><span class="user-info"><small>欢迎光临,</small><span
                            id="login-user-info">超级管理员</span></span> <i class="icon-caret-down"></i> </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li><a href="javascript:void(0)" name="Systems.html" title="系统设置" class="iframeurl"><i
                                class="icon-cog"></i>网站设置</a></li>
                        <li><a href="javascript:void(0)" name="admin_info.html" title="个人信息" class="iframeurl"><i
                                class="icon-user"></i>个人资料</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:logout()" id="Exit_system"><i class="icon-off"></i>退出</a></li>
                    </ul>
                </li>
                <li class="purple">
                    <a id="messageCenter" data-toggle="dropdown" class="dropdown-toggle" href="#"><i
                            class="icon-bell-alt"></i>{{--<span id="messageCount"
                                                                class="badge badge-important">0</span>--}}</a>
                    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header"><i class="icon-warning-sign"></i>8条通知</li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comments-alt"></i>
												最新消息
											</span> <span class="pull-right badge badge-info">+12</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#"> <i class="btn btn-xs btn-primary icon-user"></i> 切换为编辑登录.. </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												新订单
											</span> <span class="pull-right badge badge-success">+8</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												用户消息
											</span> <span class="pull-right badge badge-info">+11</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#"> 查看所有通知 <i class="icon-arrow-right"></i> </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- 导航栏 + body -->
<div class="main-container" id="main-container">
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#"> <span class="menu-text"></span> </a>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <a class="btn btn-success"> <i class="icon-signal"></i> </a>

                    <a class="btn btn-info"> <i class="icon-pencil"></i> </a>

                    <a class="btn btn-warning"> <i class="icon-group"></i> </a>

                    <a class="btn btn-danger"> <i class="icon-cogs"></i> </a>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->
            <div id="menu_style" class="menu_style">
                <ul class="nav nav-list" id="nav_list">
                    <li class="home menu-item" data-tab="index"><a href="/workstation/index" name="home.html"
                                                                   class="iframeurl"
                                                                   title=""><i
                            class="icon-home"></i><span class="menu-text"> 系统首页 </span></a></li>
                    <li class="menu-item active" data-tab="base"><a href="javascript:void(0)" class="dropdown-toggle"><i
                            class="icon-group"></i><span
                            class="menu-text"> 基础模块 </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <li class="home active" data-tab="use"><a href="/workstation/user/manage"
                                                                      name="admin_Competence.html"
                                                                      title="用户管理"
                                                                      class="iframeurl"><i
                                    class="icon-double-angle-right"></i>用户管理</a>
                            </li>
                            <li class="home" data-tab="role"><a href="/workstation/role/manage"
                                                                name="administrator.html" title="角色管理"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>角色管理</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" data-tab="base"><a href="javascript:void(0)" class="dropdown-toggle"><i
                            class="icon-user"></i><span
                            class="menu-text"> 客服模块 </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <li class="home" data-tab="role"><a href="/workstation/client/manage"
                                                                name="administrator.html" title="客户管理"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>客户管理</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" data-tab="base"><a href="javascript:void(0)" class="dropdown-toggle"><i
                            class="icon-credit-card"></i><span
                            class="menu-text"> 会员模块 </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <li class="home" data-tab="role"><a href="/workstation/member/manage"
                                                                name="administrator.html" title="会员管理"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>会员管理</a></li>
                            <li class="home" data-tab="role"><a href="/workstation/member/manage-card"
                                                                name="administrator.html" title="会员卡管理"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>会员卡管理</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" data-tab="base"><a href="javascript:void(0)" class="dropdown-toggle"><i
                            class="icon-comments-alt"></i><span
                            class="menu-text"> 消息管理 </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <li class="home" data-tab="role"><a href="/workstation/message/manage"
                                                                name="administrator.html" title="消息中心"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>消息中心</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" data-tab="base"><a href="javascript:void(0)" class="dropdown-toggle"><i
                            class="icon-desktop"></i><span
                            class="menu-text"> K3 </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <li class="home" data-tab="role"><a href="/workstation/k3/client"
                                                                name="administrator.html" title="客户同步页"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>客户同步页</a></li>
                            <li class="home" data-tab="role"><a href="/workstation/k3/department"
                                                                name="administrator.html" title="部门同步页"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>部门同步页</a></li>
                            <li class="home" data-tab="role"><a href="/workstation/k3/employee"
                                                                name="administrator.html" title="员工同步页"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>员工同步页</a></li>
                            <li class="home" data-tab="role"><a href="/workstation/k3/materiel"
                                                                name="administrator.html" title="物料同步页"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>物料同步页</a></li>
                            <li class="home" data-tab="role"><a href="/workstation/k3/supplier"
                                                                name="administrator.html" title="供应商同步页"
                                                                class="iframeurl"><i
                                    class="icon-double-angle-right"></i>供应商同步页</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left"
                   data-icon2="icon-double-angle-right"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i> <a href="javascript:void(0)">首页</a>
                    </li>
                    <li class="active"><a class="Current_page iframeurl"></a></li>
                    <li class="active" id="parentIframe"><span class="parentIframe iframeurl"></span></li>
                    <li class="active" id="parentIfour"><span class="parentIfour iframeurl"></span></li>
                </ul>
            </div>
            <!-- content 引入中间内容 -->
            <div id="include-content">
                @yield('content')
            </div>
            <!-- /.page-content -->
        </div><!-- /.main-content -->

        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>
            <div class="ace-settings-box" id="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="default" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&nbsp; 选择皮肤</span>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar"/>
                    <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl"/>
                    <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container"/>
                    <label class="lbl" for="ace-settings-add-container"> 切换窄屏 <b></b> </label>
                </div>
            </div>
        </div><!-- /#ace-settings-container -->
    </div><!-- /.main-container-inner -->
</div>

<!--底部样式-->
<div class="footer_style" id="footerstyle">
    <p class="l_f">版权所有：吉美国际集团</p>
    <p class="r_f">地址：深圳南山智慧广场
    </p>
</div>

<!--提醒窗口-->
.
<!--修改密码样式-->
<div class="change_Pass_style" id="change_Pass">
    <ul class="xg_style">
        <li><label class="label_name">原&nbsp;&nbsp;密&nbsp;码</label><input name="原密码" type="password" class=""
                                                                          id="password"></li>
        <li><label class="label_name">新&nbsp;&nbsp;密&nbsp;码</label><input name="新密码" type="password" class=""
                                                                          id="Nes_pas"></li>
        <li><label class="label_name">确认密码</label><input name="再次确认密码" type="password" class="" id="c_mew_pas"></li>
    </ul>
</div>
<!-- /.main-container -->
<!-- basic scripts -->
</body>
</html>
