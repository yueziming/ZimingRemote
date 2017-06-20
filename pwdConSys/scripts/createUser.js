/**
 * Created by yueziming on 2017-6-12.
 */
$(function(){
	var createUser= {
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			this.ajax();
		},
		ajax:function(){
			common.ajax(Api.url.CREATEUSERINFO,"get",{},function(res){
				console.log(res);
				createUser.model(res);
			})
		},
		base:{

		},
		model:function(res){
			var vue = new Vue({
				el:'#wrapper',
				data:{
					menus:[],
					username:'',
					roleList:[],
					permissions:[]
				},
				methods:{
					personalProfile:function (){

					},
                    //退出按钮
                    loginOut:function(){
                        //销毁令牌
                        common.destoryLocalstorage("access_token");
                        //销毁用户名
                        common.destoryLocalstorage("username");
                        common.destoryLocalstorage("left_menu");
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
					addUser:function(){
						var id =[];
						$.each($("input[type='checkbox']:checked"),function(){
							id.push($(this).val());
						});
						//判断是否有选择角色
						if($("input[type='radio']:checked").length === 0){
							common.tips("必须选择一个角色",1500);
							return false;
						}
						//判断用户名
						if(!common.validateuserName($(".name").val())){
							common.tips("用户名不能包含特殊字符且在7个纯汉字或16个英文字母之内",2000);
							return false;
						}
                        //判断密码
                        if(!common.isPasswd($(".password").val())){
                            common.tips("密码只能输入6-20个字母、数字或下划线",2000);
                            return false;
                        }
                        //验证邮箱
                        if(!common.validateEmail($(".email").val())){
                            common.tips("邮箱格式错误",1500);
                            return false;
                        }
						//判断是否有配置权限

						//						var data = $(".create_role").serialize();
						var data = {
							name:$(".name").val(),
							password:$(".password").val(),
							email:$(".email").val(),
							name_cn:$(".name_cn").val(),
							role_id:$("input[type='radio']:checked").val() || '',
							permission:id
						}
						common.ajax(Api.url.ADDUSER,"post",data,function(res){
							if(res.status ===1){
								$("#add_user_suc").modal("show");
//								alert("添加成功");
//								location.href = "user.html";
							}else{
								common.tips(res.message,1500);
							}
							console.log(res);
						})
					},
					addUserSuccess:function(){
						location.href = "user.html";
					}
				}
			});
			if(res.status === 1 && res.permission && res.role){
				//获取权限列表
				for(var i=0;i<res.permission.length;i++){
					var obj = {};
					obj.id = res.permission[i].id;
					obj.name = res.permission[i].name;
					vue.permissions.push(obj);
				}
				//获取角色列表
				for(var j=0;j<res.role.length;j++){
					var obj = {};
					obj.id = res.role[j].id;
					obj.name = res.role[j].name;
					vue.roleList.push(obj);
				}
			}else{
				location.href = "user.html";
			}
			console.log(res);
			//设置用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		}
	}
	createUser.init();
});