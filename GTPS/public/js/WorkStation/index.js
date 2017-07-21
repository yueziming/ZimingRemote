//面包屑返回值
// var index = parent.layer.getFrameIndex(window.name);
// parent.layer.iframeAuto(index);
/*$('.no-radius').on('click', function () {
    var cname = $(this).attr("title");
    var chref = $(this).attr("href");
    var cnames = parent.$('.Current_page').html();
    var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe').html(cname);
    parent.$('#iframe').attr("src", chref).ready();
    ;
    parent.$('#parentIframe').css("display", "inline-block");
    parent.$('.Current_page').attr({"name": herf, "href": "javascript:void(0)"}).css({
        "color": "#4c8fbd",
        "cursor": "pointer"
    });
    //parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);

});*/
$(document).ready(function () {
    //获取用户信息
    Common.ajax(Api.getLoginUserInfo,"get",{},function (res) {
        if(res && res.data){
            Common.setSession("userInfo",res.data);
            //设置用户名到页面
            $("#login-user-info").text(res.data.name || '');
        }
    });
    // Common.setSession("userInfo",)
    $(".t_Record").width($(window).width() - 640);
    //当文档窗口发生改变时 触发
    $(window).resize(function () {
        $(".t_Record").width($(window).width() - 640);
    });
});
