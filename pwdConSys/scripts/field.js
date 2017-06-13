/**
 * Created by yueziming on 2017-6-13.
 */
$(function(){
	var field = {
		init:function(){
			//首先判断是否有令牌，没有的话直接返回到登陆页面
			if(!common.getData("access_token")){
				location.href = "login.html";
			}
			this.model();
		},
		basefield:{

		},
		ajax:function(){

		},
		model:function(){
			//获取用户显示关联字段
			common.ajax(Api.url.GETSHOWRELATIONFIELD,"get",{},function(res){
				if(res.status ===1 && res.data && res.data.column){
					for(var i=0;i<res.data.column.length;i++){
						var obj = {};
						obj.id = res.data.column[i].id;
						obj.comment = res.data.column[i].comment;
						vue.showRelationFields.push(obj);
					}
//					console.log(res);
				}
			});
			//获取用户选择的显示关联字段
			common.ajax(Api.url.GETSELECTEDRELATIONFIELD,"get",{},function(res){
				if(res.status ===1 && res.data){
//					console.log(res);
					for(var i=0;i<res.data.length;i++){
						var obj = {};
						obj.id = res.data[i].id;
						obj.name = res.data[i].name;
						vue.selectedRelationFields.push(obj);
					}
				}
			});
			//获取用户内容列表
			common.ajax(Api.url.GETCONTENTLIST,"get",{},function(res){
				if(res.status ===1 && res.data && res.headerTitle){
					vue.showPage(res);
					/*for(var i in res.headerTitle){
						var obj = {};
						obj.title = res.headerTitle[i];
						obj.key = i;
						vue.tablesTitle.push(obj);
					}
					console.log("内容列表为：");
					console.log(res);*/
				}
			});
			//创建内容先获取的列表
			common.ajax(Api.url.CREATECONTENT,"get",{},function(res){
				if(res.status === 1){
					console.log("这是创建内容获取的信息");
					console.log(res);
				}
			});
			//下载EXCEL
			common.ajax(Api.url.DOWNLOADEXCEL,"get",{},function(res){
				if(res.status ===1){
					console.log("下载EXECEL");
					console.log(res);
				}
			})
			/*common.ajax(Api.url.USERINFO,"get",{},function(res){
				if(res.status === 1 && res.data){
					vue.showPage(res);
				}
			})*/
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
					//选中列
					selectTd:{name:''},
					//显示关联字段
					showRelationFields:[],
					//选中关联字段
					selectedRelationFields:[],
					//设置用户字段id
					columnId:[]
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
						for(var i in res.headerTitle){
							var obj = {};
							obj.title = res.headerTitle[i];
							obj.key = i;
							vue.tablesTitle.push(obj);
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
							if(vue.arrayData[i]){
								vue.arrayDataPage[i]=vue.arrayData[i];
							}
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
					//显示添加字段弹框
					showAddField:function(){
						$("#add_field").modal("show");
					},
					//添加自定义字段
					addField:function(){
						var data = {
							name:$("#add_field .name").val(),
							is_encrypt:$("#add_field input[type='checkbox']:checked").length
						};
						common.ajax(Api.url.ADDFIELD,"post",data,function(res){
							if(res.status == 1){
//								location.reload();
								$("#add_field").modal("hide");
							}
							//弹出提示，2秒钟
							common.tips(res.message,2000);
						})
					},
					//跳转到关联字段控制页面
					toRelationPage:function(){
						location.href = "relation-field.html";
					},
					//设置显示字段
					saveShowField:function(){
						$.each($("input[type='checkbox']:checked"),function(){
							vue.columnId.push(parseInt($(this).attr("data-id")));
						});
						var data = {
							column_id:vue.columnId
						}
						common.ajax(Api.url.SETSHOWRELATIONFIELD,"post",data,function(res){
							if(res.status ===1){
								console.log(res);
								common.tips(res.message,1500);
							}
						});
					},
					/*//修改表格列显示
					modUser:function(event){
						var target = event.target || window.event.srcElement;
						var id= $(target).closest("tr").find("td").eq(0).text();
						location.href = "modify-user.html?id=" + id;
					},*/
					//显示删除弹出框
					show_delTd:function(){
						var target = event.target || window.event.srcElement;
						$("#del_content").modal("show");
						vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
					},
					//删除用户
					delUser:function(){
						var url = Api.url.DELUSER + this.selectTd.id;
						common.ajax(url,"post",{},function(res){
							if(res.status == 1){
								location.reload();
							}
							//弹出提示，2秒钟
							common.tips(res.message,2000);
						})
					},
					//删除用户成功
					delUserSuccess:function(){
						//						location.reload();
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
			//设置用户名
			vue.username = common.getData("username");
			//获取左侧按钮
			vue.menus = common.getData("left_menu");
			vue.$watch("pagesize", function (value) {
				//获取分页按钮数
				vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
				vue.changeShow();
				console.log(parseInt(vue.pagesize)+1);
			});
		}
	}
	field.init();
})
