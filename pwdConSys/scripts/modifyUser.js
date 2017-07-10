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
			this.model();
			// var data={};
			//获取按钮数据
			// this.ajax(this.base.getUrl,"get",data);
			//			this.model();
		},
		base:{
			//			selectedId:location.href.split("?id=")[1],
			getUrl:Api.url.GETMODIFYUSER+''+location.href.split("?id=")[1],
			sendUrl:Api.url.MODIFYUSER+''+location.href.split("?id=")[1]
		},
		ajax:function(url,type,data){
			// var self = this;
		},
		model:function(){
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
					selectedInformation:{},
					//公司列表
                    companneyList:[]
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
					},
					modifyUser:function(){
						var id =[];
                        var companyId = [];
                        //判断是否有选择角色
                        if($("input[type='radio']:checked").length === 0){
                            common.tips("必须选择一个角色",1500);
                            return false;
                        }
                        //验证邮箱
                        if(!common.validateEmail($(".email").val())){
                            common.tips("邮箱格式错误",1500);
                            return false;
                        }
                        //判断手机号码格式是否正确
                        if(!common.isMobile($(".mobile").val())){
                            common.tips("手机号码格式不正确",1500);
                            return false;
                        }
                        //验证公司
                        if($("#companyList").find("input[type='checkbox']:checked").length ==0){
                            common.tips("必须要分配至少一个公司",1500);
                            return false;
                        }
                        $.each($("#permissionList").find("input[type='checkbox']:checked"),function(){
                            id.push($(this).val());
                        });
                        $.each($("#companyList").find("input[type='checkbox']:checked"),function(){
                            companyId.push($(this).val());
                        });
						//						var data = $(".create_role").serialize();
						var data = {
							name:$(".name").val(),
							email:$(".email").val(),
							name_cn:$(".name_cn").val(),
							role_id:$("input[type='radio']:checked").val(),
							mobile:$(".mobile").val(),
							permission:id,
							company:companyId
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
			/*//获取公司列表
            common.ajax(Api.url.COMPANNEYLIST,"get",{},function (rest) {
                if(rest.status === 1 && rest.data){
                    // console.log(res);
                    for(var i=0;i<rest.data.length;i++){
                        var obj = {};
                        obj.id = rest.data[i].id;
                        obj.name = rest.data[i].name;
                        vue.companneyList.push(obj);
                    }
                }
            });*/
			var data = {};
            common.ajax(getUser.base.getUrl,"get",data,function(res){
                if(res && res.status ===1){
                    console.log(res);
                    // self.model(res);
                    if(res.status === 1 && res.data){
                        //更改被选择角色的基本信息
                        vue.selectedInformation.name = res.data.user.name || '';
                        vue.selectedInformation.email = res.data.user.email || '';
                        vue.selectedInformation.name_cn = res.data.user.name_cn || '';
                        vue.selectedInformation.mobile = res.data.user.mobile || '';
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
                            obj.isSelected = 0;
                            if(obj.id == res.data.userRole.id){
                                obj.isSelected = 1;
							}
                            // for(var k=0;k<res.data.userRole)
                            vue.roleList.push(obj);
                        }
                        //显示权限列表
                        for(var i=0;i<res.data.permission.length;i++){
                            var obj = {};
                            obj.id = res.data.permission[i].id;
                            obj.name = res.data.permission[i].name;
							obj.isSelected = 0;
							for(var k=0;k<res.data.userPermission.length;k++){
								if(obj.id == res.data.userPermission[k].id){
									obj.isSelected = 1;
									break;
								}
							}
                            vue.userRights.push(obj);
                        }
                        //获取公司列表
                        for(var i=0;i<res.data.company.length;i++){
                            var obj = {};
                            obj.id = res.data.company[i].id;
                            obj.name = res.data.company[i].name;
                            obj.isSelected = 0;
                            for(var h=0;h<res.data.userCompany.length;h++){
                            	if(obj.id == res.data.userCompany[h]["company_id"]){
                            		obj.isSelected =1;
                            		break;
								}
							}
                            vue.companneyList.push(obj);
                        }
                    }
                    // console.log(res);
                }else{
                    common.tips(res.message,1500);
                }
            });
			/*//渲染完成，选中被选择角色和权限
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
			})*/
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