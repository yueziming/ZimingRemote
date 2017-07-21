/**
 * Created by Iceman on 2017-6-26.
 */
$(function () {
    /*
     //左侧导航栏的滚动插件
     $("#menu_style").niceScroll({
     cursorcolor: "#888888",
     cursoropacitymax: 1,
     touchbehavior: false,
     cursorwidth: "5px",
     cursorborder: "0",
     cursorborderradius: "5px"
     });*/
    // 保存左侧导航的状态
    try {
        ace.settings.check('navbar', 'fixed')
    } catch (e) {
    }
    // 保存切换窄屏的状态
    try {
        ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }

    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }

    try {
        ace.settings.check('sidebar', 'collapsed')
    } catch (e) {
    }
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {
    }
    try {
        ace.settings.check('footerstyle', 'fixed')
    } catch (e) {
    }

    // 遍历带有home类的li标签 -- 链接
    $('li.home').on('click', function () {
        console.log($(this).parents().is('.submenu'));
        if ($(this).parents().is('.submenu')) {
            // 如果是二级菜单
            var tab2 = $(this).attr('data-tab');
            var tab1 = $(this).parents('.menu-item').attr('data-tab');
            cookie.setCookie('tab2', tab2, 1);
            cookie.setCookie('tab1', tab1, 1);
        } else {
            // 如果是一级菜单
            var tab1 = $(this).attr('data-tab');
            cookie.setCookie('tab1', tab1, 1);
            cookie.delCookie('tab2');
            console.log(cookie.getCookie('tab2'));
        }
    });

    //初始化宽度、高度 右侧内容
    windowSize();
    //当文档窗口发生改变时 触发
    $(window).resize(function () {
        windowSize();
    });
    try {
        var $layout_1 = $('#layout-1');
        if ($layout_1.length > 0) {
            /**
             * 初始化宽度、高度
             */
            $('#sidebar-collapse').on('click', function () {
                layout_1(); // 中间内容的自适应
            });
            layout_1(); // 中间内容的自适应
            //当文档窗口发生改变时 触发
            $(window).resize(function () {
                layout_1(); // 中间内容的自适应
            });
        }

        var $layout_2 = $('#layout-2');
        if ($layout_2.length > 0) {
            /**
             * 初始化宽度、高度
             */
            $('#sidebar-collapse').on('click', function () {
                layout_2(); // 中间内容的自适应
            });
            layout_2(); // 中间内容的自适应
            //当文档窗口发生改变时 触发
            $(window).resize(function () {
                layout_2(); // 中间内容的自适应
            });
        }
    } catch (error) {
        console.log(error);
    }


    // 面包屑
    if (sessionStorage.title) {
        // 本地会话存储存在，获取贝蒂存储title字段
        var title = sessionStorage.getItem('title');
        var $Current_page = $('.Current_page'); // 面包屑：当前页面title
        $Current_page.html(title);
    } else {
        // 本地会话存储不存在
        // 用户第一次登录
    }

    // 有链接的导航栏项，点击事件
    $('.iframeurl').on('click', function () {
        var title = $(this).attr('title');
        // 如果点击标签的title值为空，则删除title的session存储。如果标签的title不为空，则重新定义。
        if (title != '') {
            sessionStorage.setItem('title', title); //
        } else {
            sessionStorage.removeItem('title'); // 删除session 存储
        }
    });
    // 在页面显示当前登录用户的用户名
    // 在页面显示登录用户名
    var loginUser = Common.getSession("userInfo") || {"name": ''};
    $("#login-user-info").text(loginUser.name);
    /**
     * 给二级菜单添加id 给二级菜单li添加高度
     * @type {*}
     */
    var cid = $('#nav_list> li>.submenu');
    cid.each(function (i) {
        $(this).attr('id', "Sort_link_" + i);
        var $li = $(this).children("li");
        var rowCount = $li.size(); //li的数量
        /* var divHeigth = $(this).height();
         $li.height(divHeigth / rowCount);*/
    });

    // 点击导航栏 获取title 填入面包屑
    $('.iframeurl').on('click', function () {
        var href = $(this).attr("href");
        var title = $(this).attr("title");
    });

    $('#nav_list,.link_cz').find('li.home').on('click', function () {
        $('#nav_list,.link_cz').find('li.home').removeClass('active');
        $(this).addClass('active');
    });

    //时间设置
    function currentTime() {
        var d = new Date(), str = '';
        str += d.getFullYear() + '年';
        str += d.getMonth() + 1 + '月';
        str += d.getDate() + '日';
        str += d.getHours() + '时';
        str += d.getMinutes() + '分';
        str += d.getSeconds() + '秒';
        return str;
    }

    setInterval(function () {
        $('#time').html(currentTime)
    }, 100);

    //修改密码
    $('.change_Password').on('click', function () {
        layer.open({
            type: 1,
            title: '修改密码',
            area: ['300px', '300px'],
            shadeClose: true,
            content: $('#change_Pass'),
            btn: ['确认修改'],
            yes: function (index, layero) {
                if ($("#password").val() == "") {
                    layer.alert('原密码不能为空!', {
                        title: '提示框',
                        icon: 0,

                    });
                    return false;
                }
                if ($("#Nes_pas").val() == "") {
                    layer.alert('新密码不能为空!', {
                        title: '提示框',
                        icon: 0,

                    });
                    return false;
                }

                if ($("#c_mew_pas").val() == "") {
                    layer.alert('确认新密码不能为空!', {
                        title: '提示框',
                        icon: 0,

                    });
                    return false;
                }
                if (!$("#c_mew_pas").val || $("#c_mew_pas").val() != $("#Nes_pas").val()) {
                    layer.alert('密码不一致!', {
                        title: '提示框',
                        icon: 0,

                    });
                    return false;
                }
                else {
                    layer.alert('修改成功！', {
                        title: '提示框',
                        icon: 1,
                    });
                    layer.close(index);
                }
            }
        });
    });

    // 注销登录
    $('#Exit_system').on('click', function () {
        layer.confirm('是否确定退出系统？', {
                btn: ['是', '否'],//按钮
                icon: 2,
            },
            function () {
                Common.ajax(Api.logout, "delete", {}, function (result) {
                    if (result.status) location.reload(true);
                });
            });
    });

});

/******/
/*$(document).on('click', '.link_cz > li', function () {
 $('.link_cz > li').removeClass('active');
 $(this).addClass('active');
 });*/
/*******************/
//jQuery( document).ready(function(){
//	  $("#submit").click(function(){
//	// var num=0;
//     var str="";
//     $("input[type$='password']").each(function(n){
//          if($(this).val()=="")
//          {
//              // num++;
//			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
//                title: '提示框',
//				icon:0,
//          });
//             // layer.msg(str+=""+$(this).attr("name")+"不能为空！\r\n");
//             layer.close(index);
//          }
//     });
//})
//	});
/*
 function link_operating(name, title) {
 var cid = $(this).name;
 var cname = $(this).title;
 $("#iframe").attr("src", cid).ready();
 $("#Bcrumbs").attr("href", cid).ready();
 $(".Current_page a").attr('href', cid).ready();
 $(".Current_page").attr('name', cid);
 $(".Current_page").html(cname).css({"color": "#333333", "cursor": "default"}).ready();
 $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display", "none").ready();
 $("#parentIfour").html('').css("display", "none").ready();
 }*/


function windowSize() {
    var $sidebar = $('.sidebar'); // 左侧导航栏
    var $navList = $('#nav_list'); // 导航列表
    var $sidebarShortcuts = $('#sidebar-shortcuts'); // 导航头部图表
    var $sidebarCollapse = $('#sidebar-collapse'); // 导航底部图表
    var $mainContainer = $('#main-container');
    var $footerstyle = $('#footerstyle'); // 底部
    var $navbar = $('#navbar'); // 头部
    var $breadcrumbs = $('#breadcrumbs'); // 面包屑
    var $includeContent = $('#include-content'); // 中间内容
    $sidebar.height($(window).outerHeight() - $navbar.outerHeight() - $footerstyle.outerHeight()); // 左侧导航高度计算
    $navList.height($sidebar.outerHeight() - $sidebarShortcuts.outerHeight() - $sidebarCollapse.outerHeight());
    $mainContainer.height($(window).outerHeight() - $footerstyle.outerHeight() - $navbar.outerHeight()); // 中间内容高度计算
    $includeContent.height($(window).outerHeight() - $navbar.height() - $breadcrumbs.outerHeight() - $footerstyle.outerHeight()); // 中间内容左侧内容高度计算
}

// 中间内容的自适应   layout-1  左右布局
function layout_1() {
    var $includeContent = $('#include-content'); // 内容框
    var $testIframe = $('#testIframe'); // 右侧外框
    var $search_wrap = $('#search-wrap'); // 外层搜索框
    var $function_wrap = $('#function-wrap'); // 外层功能按钮
    var $scrollsidebar = $('#scrollsidebar'); // 左侧内容
    $(".widget-box").height($includeContent.outerHeight() - $search_wrap.outerHeight(true) - $function_wrap.outerHeight(true) - 15); // 计算左侧内容高度
    $testIframe.width($includeContent.width() - 30 - $scrollsidebar.width() - 10); // 计算右侧内容宽度
    $testIframe.height($includeContent.outerHeight() - $search_wrap.outerHeight(true) - 15 - $function_wrap.outerHeight(true)); // 计算右侧内容高度
}

// 中间内容的自适应   layout-2 flat-style  平式布局
function layout_2() {
    var $includeContent = $('#include-content');
    var $table_menu_list2 = $('.table_menu_list2'); // 表格上面层
    var $search_wrap = $('#search-wrap'); // 外层搜索框
    console.log($includeContent.width());
    var $function_wrap = $('.function-wrap'); // 功能按钮
    $table_menu_list2.width($includeContent.width() - 30).height($includeContent.outerHeight(true) - $function_wrap.outerHeight(true) - $search_wrap.outerHeight(true) - 15);
}

/**
 *消息推送
 *
 */

