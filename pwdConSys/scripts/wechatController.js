/**
 * Created by 1658 on 2017-7-4.
 */
$(function () {
    var wechatController = {
        init:function () {
            this.model();
        },
        ajax:function () {
            
        },
        model:function () {
            var weChat = new Vue({
               el:'#wrapper',
                data:{
                    username:'',
                    menus:{},
                    controller:{},
                    //选择信息
                    selectedInformation:{}
                },
                methods:{
                   //保存设置函数
                    save:function () {

                    },
                    //个人资料按钮事件
                    personalProfile:function(){
                        alert("点击了个人资料按钮");
                    },
                    //退出按钮
                    loginOut:function(){
                        //销毁令牌
                        common.destoryLocalstorage("access_token");
                        //销毁用户名
                        common.destoryLocalstorage("username");
                        //销毁左侧导航按钮
                        common.destoryLocalstorage("left_menu");
                        //销毁控制权限组
                        common.destoryLocalstorage("controller");
                        //跳转到登陆页面
                        location.href = "login.html";
                    },
                    //点击收缩
                    shrink:function(){
                        if($("#wrapper .sidebar").css("left") == '0px'){
                            $(".shrink").animate({left:"0px"},'slow',"linear");
                            $("#wrapper .sidebar").animate({left:"-260px"},'slow',"linear");
                            $(".shrink").html('&gt;')
                        }
                        else{
                            $("#wrapper .sidebar").css("left","-0px");
                            $(".shrink").css("left","260px");
                            $(".shrink").html('&lt;')
                        }
                    }
                }
            });
            //获取用户名
            weChat.username = common.getData("username");
            //获取左侧按钮
            weChat.menus = common.getData("left_menu");
            //获取控制列表
            weChat.controller = common.getData("controller");
        }
    }
    wechatController.init();
});