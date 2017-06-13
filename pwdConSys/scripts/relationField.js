/**
 * Created by yueziming on 2017-6-13.
 */
$(function(){
	var relationField = {
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			this.model();
		},
		ajax:function(){

		},
		base:{

		},
		model:function(){
			//获取所有用户字段
			common.ajax(Api.url.GETALLFIELD,"get",{},function(res){
				console.log(res);
				if(res.status ===1 && res.data && res.data.column){
					for(var i=0;i<res.data.column.length;i++){
						var obj = {};
						obj.id=res.data.column[i].id;
						obj.comment = res.data.column[i].comment;
						vue.allFields.push(obj);
					}
				}
//				relationField.model(res);
			});
			common.ajax(Api.url.GETRELATIONFIELD,"get",{},function(res){
				console.log(res);
				if(res.status ===1 && res.data && res.data.column){
					for(var i=0;i<res.data.column.length;i++){
						var obj = {};
						obj.id=res.data.column[i].id;
						obj.comment = res.data.column[i].comment;
						vue.relationField.push(obj);
					}
				}
				//				relationField.model(res);
			});
			//获取用户关联字段
			var vue=new Vue({
				el:"#wrapper",
				data:{
					menus:{},
					username:'',
					//客户所有字段
					allFields:[],
					//关联字段
					relationField:[],
					//添加字段选中的id
					addId:'',
					//移除字段选中的id
					removeId:''
				},
				methods:{
					//增加关联字段
					addRelationField:function(event){
						var target = event.target || window.event.srcElement;
						//如果之前被选中，则显示取消选中样式
						if($(target).hasClass("btn-primary")){
							$(target).removeClass("btn-primary");
						}else{
							$(target).addClass("btn-primary");
						}
						vue.addId= $(target).closest("div").attr("data-id");
						var data = {id:vue.addId};
						var url=Api.url.ADDRELATIONFIELD+''+vue.addId;
						common.ajax(url,"post",data,function(res){
//							console.log(res);
							if(res.status === 1){
								$("#add_field_suc").modal("show");
							}
							common.tips(res.message,1500);
						});
					},
					//移除关联字段
					removeField:function(event){
						var target = event.target || window.event.srcElement;
						vue.removeId= $(target).closest("div").attr("data-id");
						var data = {id:vue.removeId}
						var url = Api.url.REMOVERELATIONFIELD+''+vue.removeId;
						common.ajax(url,"post",data,function(res){
//							console.log(res);
							if(res.status === 1){
								$("#remove_field_suc").modal("show");
							}
							common.tips(res.message,1500);
						});
					},
					//刷新页面
					refresh:function(){
						location.reload();
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
			//渲染完成，选中关联的字段
			vue.$nextTick(function(){
				for(var i=0;i<vue.allFields.length;i++){
					for(var j=0;j<vue.relationField.length;j++){
						if(vue.relationField[j].id == vue.allFields[i].id){
							//$("input[type='checkbox']").eq(i).attr("checked",true);
							$(".base_fields button").eq(i).addClass("btn-primary");
							return;
						}
					}
				}
			});
			//获取用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		}
	}
	relationField.init();
});