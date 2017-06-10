/**
 * Created by yueziming on 2017-6-9.
 */
$(function(){
	var getRole = {
		//初始化
		init:function(){
			//获取左侧导航按钮
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
					roleList:[]
				},
				methods:{
					personalProfile:function (){

					},
					loginOut:function(){

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
						$.each($("input[type='checkbox']:checked"),function(){
							id.push($(this).val());
						});
//						var data = $(".create_role").serialize();
						var data = {
							name:$(".name").val(),
							slug:$(".slug").val(),
							description:$(".description").val(),
							level:$(".level").val(),
							permission:id
						}
						common.ajax(Api.url.CREATEROLE,"post",data,function(res){
							if(res.status ===1){
								alert("添加成功");
								location.href = "role.html";
							}
							console.log(res);
						})
					}
				}
			});
			if(res.status === 1 && res.data.permission){
				for(var i=0;i<res.data.permission.length;i++){
					var obj = {};
					obj.id = res.data.permission[i].id;
					obj.name = res.data.permission[i].name;
					vue.roleList.push(obj);
				}
			}
			console.log(res);
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		},
		MenuView:function(){

		}
	};
	getRole.init();
})