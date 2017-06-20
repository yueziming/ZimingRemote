/**
 * Created by yueziming on 2017-6-8.
 */
$(function(){
	var role = {
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			this.model();
		},
		ajax:function(){

		},
		model:function(){
			common.ajax(Api.url.ROLELIST,"get",{},function(res){
				if(res.status === 1 && res.data){
					vue.showPage(res);
				}
			})
			var vue = new Vue({
				el: "#wrapper",
				data: {
					username:'',
					//总项目数
					totalCount: 200,
					//分页数
					pageCount: 20,
					//当前页面
					pageCurrent: 1,
					//分页大小
					pagesize: 10,
					//显示分页按钮数
					showPages: 10,
					//开始显示的分页按钮
					showPagesStart: 1,
					//结束显示的分页按钮
					showPageEnd: 100,
					//分页数据
					arrayData: [],
					//ajax对象属性
					key:{},
					//分页显示数据
					arrayDataPage:	[],
					//表头信息
					tablesTitle:[],
					//左侧导航按钮菜单
					menus:[],
					//记录选中列
					selectTd:{}
				},
				methods: {
					//分页数据
					showPage:function(res){
						//储存关键字
						for(var k in res.data[0]){
							vue.key[k] = k;
						}
						//储存获取到的数据
						for(var i=0;i<res.data.length;i++){
							var obj ={};
							for(var k in vue.key){
								obj[vue.key[k]] = res.data[i][vue.key[k]];
							}
							vue.arrayData.push(obj);
						}
						for(var i=0;i<vue.pagesize;i++){
							if(vue.arrayData[i]){
								vue.arrayDataPage[i]=vue.arrayData[i];
							}
						}
						//获取表头
						for(var i=0;i<res.headerTitle.length;i++){
							vue.tablesTitle.push(res.headerTitle[i]);
						}
						$(".pagination li").eq(1).addClass("active");
						//获取分页按钮数
						vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
						//如果只有一页,则下一页禁用
						if(vue.pageCount == 1){
							$(".next_page_btn").addClass("disabled");
						}
					},
					changePage:function(event){
						var target = event.target || window.event.srcElement;
						vue.pageCurrent = parseInt($(target).text());
						this.changeShow();
					},
					//改变表格显示
					changeShow:function(){
						$(".pagination li").removeClass("active");
						var start = (vue.pageCurrent -1)*vue.pagesize;
						vue.arrayDataPage = {};
						for(var i=start;i<parseInt(vue.pagesize)*vue.pageCurrent;i++){
							vue.arrayDataPage[i]=vue.arrayData[i];
						};
						var page = ".page_"+vue.pageCurrent;
						$(page).addClass("active");
						$(".prev_page_btn").removeClass("disabled");
						$(".next_page_btn").removeClass("disabled");
						if(vue.pageCurrent === 1){
							$(".prev_page_btn").addClass("disabled");
						}else if(vue.pageCurrent == vue.pageCount){
							$(".next_page_btn").addClass("disabled");
						}
					},
					//上一页
					prevPage:function(){
						if(!$(".prev_page_btn").hasClass("disabled")){
							vue.pageCurrent --;
							this.changeShow();
						}
					},
					nextPage:function(){
						if(!$(".next_page_btn").hasClass("disabled")){
							vue.pageCurrent++;
							this.changeShow();
						}
					},
					createRole:function(){
						location.href = "create-role.html";
					},
					//修改表格列显示
					show_modifyTd:function(event){
						var target = event.target || window.event.srcElement;
						vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
						location.href = "modify-role.html?id="+vue.selectTd.id;
					},
					//显示删除弹出框
					show_delTd:function(){
						var target = event.target || window.event.srcElement;
						$("#del_role").modal("show");
						vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
					},
					//删除角色
					delRole:function(){
						var url = Api.url.DELROLE + this.selectTd.id;
						common.ajax(url,"post",{},function(res){
							if(res.status == 1){
//								$("#del_role").modal("hide");
								location.reload();
								/*for(var i in vue.arrayDataPage){
									if(vue.arrayDataPage[i].id == vue.selectTd.id){
										vue.arrayDataPage.splice(i,1);
										vue.arrayData.splice(vue.arrayDataPage[i],1);
									}
								}
								vue.changeShow();*/
							}else{
								// common.tips(res.message,1000);
							}
							//弹出提示，2秒钟
							common.tips(res.message,2000);
						})
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
                        common.destoryLocalstorage("left_menu");
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
			vue.$watch("pagesize", function (value) {
				//获取分页按钮数
				vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
				vue.changeShow();
				console.log(parseInt(vue.pagesize)+1);
			});
			//获取用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
		}
	}
	role.init();
})