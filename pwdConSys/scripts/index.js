/**
 * Created by yueziming on 2017-6-9.
 */
$(function(){
	var indexPage = {
		//初始化
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			var data={};
			//获取按钮数据
			this.ajax(Api.url.LEFTMENU,"get",data);
		},
		indexObject:{
			menus:[]
		},
		ajax:function(url,type,data){
			var self = this;
			common.ajax(url,type,data,function(res){
				if(res && res.status ===1){
					self.model(res);
				}
				else{
					common.tips("页面初始化失败",1500);
					location.href = "login.html";
				}
			});
		},
		model:function(res){
			var vue = new Vue({
				el:'#wrapper',
				data:{
					menus:[],
					username:'',
					controller:{},
                    password:'',
                    ensurePassword:'',
                    oldPassword:''
				},
				methods:{
					personalProfile:function (){
						$("#modify_password").modal("show");
						// vue.loginOut();
					},
                    modPassword:function () {
                        if(vue.password != vue.ensurePassword){
                            common.tips("两次密码输入不一致!",2000);
                        }else{
                            var data = {
                                newPassword:vue.ensurePassword,
                                oldPassword:vue.oldPassword
                            };
                            common.ajax(Api.url.MODIFYPASSWORD,"post",data,function (res) {
                                if(res && res.status && res.status == '1'){
                                    console.log(res);
                                    $("#modify_password").modal("hide");
                                    $("#modify_password_suc").modal("show");
                                    // vue.loginOut();
                                }
                                common.tips(res.message,2000);
                            })
                        }
                    },
                    toLogin:function () {
                        vue.loginOut();
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
					shrink:function(){
						if($("#wrapper .sidebar").css("left") == '0px'){
							//$("#wrapper .sidebar").css("left","-260px");
							$(".shrink").animate({left:"0px"},'slow',"linear");
							$("#wrapper .sidebar").animate({left:"-260px"},'slow',"linear");
							//$(".shrink").css("left","0px");
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
			//获取左侧导航按钮
			for(var i=0;i<res.navbarMenu.length;i++){
				if(res.navbarMenu[i] != ''){
                    var menuObj = {};
                    var childrens = [];
//				menuObj.id = res.navbarMenu[i].id;
                    menuObj.title = res.navbarMenu[i].title;
                    menuObj.icon = res.navbarMenu[i].icon;
                    menuObj.menuName = res.navbarMenu[i].menuName;
                    if(res.navbarMenu[i].children){
                        for(var j=0;j<res.navbarMenu[i].children.length;j++){
                            var children = {};
                            children.id = res.navbarMenu[i].children[j].id;
                            children.title = res.navbarMenu[i].children[j].title;
                            children.link = res.navbarMenu[i].children[j].link;
                            childrens.push(children);
                            //						menuObj.children = children;
                        }
                        menuObj.children = childrens;
                    }
                    vue.menus.push(menuObj);
				}
			}
			//获取权限控制对象列表
			for(var k in res.controller){
				vue.controller[k] = res.controller[k];
			}
			//存储左侧导航按钮到本地存储
			common.setData("left_menu",vue.menus);
			//存储权限控制到本地存储
			common.setData("controller",vue.controller);
			//设置用户名
			vue.username = common.getData("username");
		}
	};
	indexPage.init();
})