/**
 * Created by yueziming on 2017-6-9.
 */
$(function(){
	var getRole = {
		//初始化
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			var data={};
			//获取按钮数据
			this.ajax(Api.url.GETROLE,"get",data);
//			this.model();
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
			});
		},
		model:function(res){
			var vue = new Vue({
				el:'#wrapper',
				data:{
					menus:[],
					username:'',
                    permissionList:[],
                    fieldList:[]
				},
				methods:{
					personalProfile:function (){

					},
					loginOut:function(){
						//销毁令牌
						common.destoryLocalstorage("access_token");
						//销毁用户名
						common.destoryLocalstorage("username");
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
					},
					addRole:function(){
						var id =[];
						var fieldsId = [];
                        //判断名称或标签非空
                        if(!common.isEmpty($(".name").val()) || !common.isEmpty($(".slug").val())){
                            common.tips("名称或标签不能为空",1500);
                            return false;
                        }
                        //判断标签只能为英文或数字
                        if(!common.isEnglishAndNum($(".slug").val())){
                            common.tips("标签只能为英文或数字",1500);
                            return false;
                        }
                        //等级只能为正整数
                        if(!common.isInteger($(".level").val())){
                            common.tips("等级只能为正整数",1500);
                            return false;
                        }
						$.each($("#permission").find("input[type='checkbox']:checked"),function(){
							id.push($(this).val());
						});
                        $.each($("#fields").find("input[type='checkbox']:checked"),function(){
                            fieldsId.push($(this).val());
                        });
//						var data = $(".create_role").serialize();
						var data = {
							name:$(".name").val(),
							slug:$(".slug").val(),
							description:$(".description").val(),
							level:$(".level").val(),
							permission:id,
							column:fieldsId
						}
						common.ajax(Api.url.CREATEROLE,"post",data,function(res){
							if(res.status ===1){
//								alert("创建成功");
								$("#add_role_suc").modal("show");
							}
							console.log(res);
							common.tips(res.message,1500);
						})
					},
					addRoleSuccess:function(){
						location.href = "role.html";
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
				}
			});
			if(res.status === 1 && res.data.permission){
				//获取权限列表
				for(var i=0;i<res.data.permission.length;i++){
					var obj = {};
					obj.id = res.data.permission[i].id;
					obj.name = res.data.permission[i].name;
					vue.permissionList.push(obj);
				}
				//获取字段列表
				for(var j=0;j<res.data.column.length;j++){
					var obj = {};
					obj.id = res.data.column[j].id;
					obj.comment = res.data.column[j].comment;
					obj.isEncrypt = res.data.column[j]["is_encrypt"];
					vue.fieldList.push(obj);
				}
			};
			console.log(res);
			//获取用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		},
		MenuView:function(){

		}
	};
	getRole.init();
})