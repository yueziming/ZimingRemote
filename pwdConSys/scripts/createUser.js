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
					addUser:function(){
						var id =[];
						$.each($("input[type='checkbox']:checked"),function(){
							id.push($(this).val());
						});
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
								common.tips(res.message);
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