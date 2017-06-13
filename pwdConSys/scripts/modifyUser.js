/**
 * Created by yueziming on 2017-6-12.
 */
$(function(){

	var getUser = {
		//初始化
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			var data={};
			//获取按钮数据
			this.ajax(this.base.getUrl,"get",data);
			//			this.model();
		},
		base:{
			//			selectedId:location.href.split("?id=")[1],
			getUrl:Api.url.GETMODIFYUSER+''+location.href.split("?id=")[1],
			sendUrl:Api.url.MODIFYUSER+''+location.href.split("?id=")[1]
		},
		ajax:function(url,type,data){
			var self = this;
			common.ajax(url,type,data,function(res){
				if(res && res.status ===1){
					console.log(res);
					self.model(res);
				}
			});
		},
		model:function(res){
			var vue = new Vue({
				el:'#wrapper',
				data:{
					//左侧导航按钮
					menus:[],
					//用户名
					username:'',
					//角色列表
					roleList:[],
					//权限列表
					userRights:[],
					//原有的权限选择的列表
					selectedRight:[],
					//原有的角色
					selectedRole:'',
					//选中的修改的用户的信息
					selectedInformation:{}
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
					modifyUser:function(){
						var id =[];
						$.each($("input[type='checkbox']:checked"),function(){
							id.push($(this).val());
						});
						//						var data = $(".create_role").serialize();
						var data = {
							name:$(".name").val(),
							email:$(".email").val(),
							name_cn:$(".name_cn").val(),
							role_id:$("input[type='radio']:checked").val(),
							permission:id
						};
						common.ajax(getUser.base.sendUrl,"post",data,function(res){
							if(res.status ===1){
								$("#modify_user").modal("show");
								//								alert("修改成功");
								//								location.href = "role.html";
							}
							common.tips(res.message,1000);
							console.log(res);
						})
					},
					modifyUserSuccess:function(){
						location.href = "user.html";
					}
				}
			});
			if(res.status === 1 && res.data){
				//更改被选择角色的基本信息
				vue.selectedInformation.name = res.data.user.name;
				vue.selectedInformation.email = res.data.user.email;
				vue.selectedInformation.name_cn = res.data.user.name_cn;
				vue.selectedRole = res.data.userRole.id;
//				vue.selectedInformation.level = res.data.user.level;
				//获取选择角色已经存在的权限
				for(var j=0;j<res.data.userPermission.length;j++){
					vue.selectedRight[j] = res.data.userPermission[j].id;
				}
				//显示角色列表
				for(var j=0;j<res.data.role.length;j++){
					var obj = {};
					obj.id = res.data.role[j].id;
					obj.name =  res.data.role[j].name;
					vue.roleList.push(obj);
				}
				//显示权限列表
				for(var i=0;i<res.data.permission.length;i++){
					var obj = {};
					obj.id = res.data.permission[i].id;
					obj.name = res.data.permission[i].name;
					vue.userRights.push(obj);
				}
			}
			console.log(res);
			//渲染完成，选中被选择角色和权限
			vue.$nextTick(function(){
				for(var i=0;i<vue.roleList.length;i++){
					if(vue.selectedRole == vue.roleList[i].id){
						$("input[type='radio']").eq(i).attr("checked",true);
					}
				}
				for(var i=0;i<vue.userRights.length;i++){
					for(var j=0;j<vue.selectedRight.length;j++){
						if(vue.selectedRight[j] == vue.userRights[i].id){
							$("input[type='checkbox']").eq(i).attr("checked",true);
						}
					}
				}
			})
			//获取用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		},
		MenuView:function(){

		}
	};
	getUser.init();
})