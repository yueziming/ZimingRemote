/**
 * Created by yueziming on 2017-6-10.
 */
$(function(){
	common.ajax(Api.url.RIGHTMANAGEMENT,"get",{},function(res){
		if(res.status === 1 && res.data){
			vue.showPage(res);
		}
	})

	//数组删除某项功能
	Array.prototype.remove = function (dx) {
		if (isNaN(dx) || dx > this.length) { return false; }
		for (var i = 0, n = 0; i < this.length; i++) {
			if (this[i] != this[dx]) {
				this[n++] = this[i]
			}
		}
		this.length -= 1
	}

	var vue = new Vue({
		el: "#wrapper",
		data: {
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
			menus:[]
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
			showAddRight:function(){
				//				alert("点击了创建角色按钮");
				$("#add_right").modal("show");
//				location.href = "createRole.html";
			},
			//修改表格列显示
			show_modifyTd:function(event){
				var target = event.target || window.event.srcElement;
				$("#modify_right").modal("show");
				modal.selectTd.name= $(target).closest("tr").find("td").eq(1).text();
				modal.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
				modal.selectTd.slug= $(target).closest("tr").find("td").eq(2).text();
				modal.selectTd.description= $(target).closest("tr").find("td").eq(3).text();
				modal.selectTd.model= $(target).closest("tr").find("td").eq(4).text();
			},
			//显示删除弹出框
			show_delTd:function(){
				var target = event.target || window.event.srcElement;
				$("#del_right").modal("show");
				modal.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
			},
			//个人资料按钮事件
			personalProfile:function(){
				alert("点击了个人资料按钮");
			},
			//退出按钮
			loginOut:function(){
				alert("点击了退出按钮");
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
	//获取左侧按钮
	vue.menus = common.getData("left_menu");
	vue.$watch("pagesize", function (value) {
		//获取分页按钮数
		vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
		vue.changeShow();
		console.log(parseInt(vue.pagesize)+1);
	});
	//创建moadal框的vue模型
	var modal = new Vue({
		el:".operate_pop",
		data:{
			//表头信息
			tablesTitle:[],
			//选中列
			selectTd:{name:''},
			name:123
		},
		methods:{
			addRight:function(){
				var data = $(".add_right").serialize();
				common.ajax(Api.url.CREATERIGHT,"post",data,function(res){
					console.log(res);
					//添加成功
					if(res.status==1){
						console.log(res);
						location.reload();
					}
					//弹出提示，2秒钟
					common.tips(res.message,2000);
				});
			},
			//修改权限
			modRight:function(){
				var url = Api.url.MODIFYRIGHT+ this.selectTd.id;
				var data = $(".modify_right").serialize();
				common.ajax(url,"post",data,function(res){
					if(res.status == 1){
						location.reload();
					}
					//弹出提示，2秒钟
					common.tips(res.message,2000);
				});
//				var data =
			},
			//删除权限
			delRight:function(){
				var url = Api.url.DELRIGHT + this.selectTd.id;
				common.ajax(url,"post",{},function(res){
					if(res.status == 1){
						location.reload();
					}
					//弹出提示，2秒钟
					common.tips(res.message,2000);
				})
			}
		}
	});
	//获取创建表头
	modal.tablesTitle = vue.tablesTitle;
/*	var data = {
		name:"添加测试1",
		slug:"yy1",
		description:"无描述1",
		model:"测试模型1"
	}
////	name(名称),slug(标签),description(描述),model(模型)"
//	common.ajax(Api.url.CREATERIGHT,"post",data,function(res){
//		console.log(res);
//		common.tips(res.message,2000);
//	})*/
})