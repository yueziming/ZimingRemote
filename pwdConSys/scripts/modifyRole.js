/**
 * Created by yueziming on 2017-6-12.
 */

$(function(){

	var getRole = {
		//初始化
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			//获取左侧导航按钮
			var data={};
			//获取按钮数据
			this.ajax(this.base.getUrl,"get",data);
			//			this.model();
		},
		base:{
//			selectedId:location.href.split("?id=")[1],
			getUrl:Api.url.GETEDITROLE+''+location.href.split("?id=")[1],
			sendUrl:Api.url.MODIFYROLE+''+location.href.split("?id=")[1]
		},
		indexObject:{
			menus:[]
		},
		ajax:function(url,type,data){
			var self = this;
			common.ajax(url,type,data,function(res){
				if(res && res.status ===1){
//					console.log(res);
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
					//权限列表
                    permissionList:[],
					//字段列表
                    fieldList:[],
					//原有的选择的列表
					selectedRight:[],
					//选中的修改的用户的信息
					selectedInformation:{},
					//选中的字段
					selectedFields:[]
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
					modifyRole:function(){
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
						};
						common.ajax(getRole.base.sendUrl,"post",data,function(res){
							if(res.status ===1){
								$("#modify_role").modal("show");
//								alert("修改成功");
//								location.href = "role.html";
							}
							common.tips(res.message,1000);
//							console.log(res);
						})
					},
					modifyRoleSuccess:function(){
						location.href = "role.html";
					}
				}
			});
			if(res.status === 1 && res.data){
				//更改被选择角色的基本信息
				vue.selectedInformation.name = res.data.role.name;
				vue.selectedInformation.slug = res.data.role.slug;
				vue.selectedInformation.description = res.data.role.description;
				vue.selectedInformation.level = res.data.role.level;
				//获取选择角色已经存在的权限
				for(var j=0;j<res.data.rolePermission.length;j++){
					vue.selectedRight[j] = res.data.rolePermission[j].id;
				}
				//显示权限列表
				for(var i=0;i<res.data.permission.length;i++){
					var obj = {};
					obj.id = res.data.permission[i].id;
					obj.name = res.data.permission[i].name;
					vue.permissionList.push(obj);
				}
				//获取选择角色已经选择的字段
				for(var i=0;i<res.data.roleColumn.length;i++){
					vue.selectedFields[i] = res.data.roleColumn[i].column_id;
				}
				//显示角色字段
				for(var j=0;j<res.data.column.length;j++){
                    var obj = {};
                    obj.id = res.data.column[j].id;
                    obj.comment = res.data.column[j].comment;
                    obj.isEncrypt = res.data.column[j]["is_encrypt"];
                    obj.isSelected = 0;
                    for(var k=0;k<vue.selectedFields.length;k++){
                    	if(vue.selectedFields[k] == obj.id){
                    		obj.isSelected = 1;
                    		break;
						}
					}
                    vue.fieldList.push(obj);
				}
			}
			console.log(res);
			//渲染完成，选中被选择权限
			vue.$nextTick(function(){
				for(var i=0;i<vue.permissionList.length;i++){
					for(var j=0;j<vue.selectedRight.length;j++){
						if(vue.selectedRight[j] == vue.permissionList[i].id){
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
	getRole.init();
})