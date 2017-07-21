/**
 * Created by 1195 on 2017-6-23.
 */
// 创建一个AjaxHelper实例
var AjaxHelper = new AjaxHelper();
$(document).ready(function () {
    //监控密码框回车事件
    $("#password").keydown(function(event) {
        if (event.keyCode == 13) {
            login();
        }
    })
    // 登录按钮绑定点击事件
    $('#login_btn').on('click', function () {
        login();
    });
    // 当输入框触发焦点时，改变样式
    $("input[type='text'],input[type='password']").blur(function () {
        var $el = $(this);
        var $parent = $el.parent();
        $parent.attr('class', 'frame_style').removeClass(' form_error');
        if ($el.val() == '') {
            $parent.attr('class', 'frame_style').addClass(' form_error');
        }
    });
    // 当输入框失去焦点时，还原样式
    $("input[type='text'],input[type='password']").focus(function () {
        var $el = $(this);
        var $parent = $el.parent();
        $parent.attr('class', 'frame_style').removeClass(' form_errors');
        if ($el.val() == '') {
            $parent.attr('class', 'frame_style').addClass(' form_errors');
        } else {
            $parent.attr('class', 'frame_style').removeClass(' form_errors');
        }
    });
    //登录函数
    function login() {
        var num = 0; // 用作判定输入框是否为空的判定值
        var str = ""; // 用作储存提示语的字符串变量
        var data = $('#form-wrap').serialize();
        /*$("input[type$='text'],input[type$='password']").each(function (n) {
         if ($(this).val() == "") {

         layer.alert(str += "" + $(this).attr("name") + "不能为空！\r\n", {
         title: '提示框',
         icon: 0,
         });
         num++;
         return false;
         }
         });*/
        if (num > 0) {
            return false;
        } else {
            AjaxHelper.post('', data, function (res) {
                // 如果提交登录成功，则给出成功的提示。并跳转到对应得页面。
                if (res.status) {
                    layer.alert('登陆成功！', {
                        title: '提示框',
                        icon: 1,
                    });
                    setTimeout(function () {
                        location.href = res.nextPage;
                    }, 1000);
                    //layer.close(index);
                }
                else {
                    layer.alert('登录失败，错误原因为“' + res.message + '"', {
                        title: '提示框',
                        icon: 0,
                    });
                }
            })
        }
    }
});

