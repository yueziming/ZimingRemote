/**
 * Created by yueziming on 2017-6-8.
 */
$(function(){
	$.ajax({
		//url:Api.url.INDEXTABLE,
		url:'json/test.json',
		type:'get',
		dataType:'json',
		//data:{},
		success:function(res){
			if(res.status === 1 && res.data){
				vue.showPage(res);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
			console.log("网络异常");
		}
	});

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
			//分页方法
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
					vue.arrayDataPage[i]=vue.arrayData[i];
				}
				//获取表头
				for(var i=0;i<res.headerTitle.length;i++){
					vue.tablesTitle.push(res.headerTitle[i]);
				}
				//获取左侧导航按钮
				for(var i=0;i<res.nvabarMenu.length;i++){
					var menuObj = {};
					var childrens = [];
					menuObj.id = res.nvabarMenu[i].id;
					menuObj.title = res.nvabarMenu[i].title;
					menuObj.icon = res.nvabarMenu[i].icon;
					menuObj.menuName = res.nvabarMenu[i].menuName;
					for(var j=0;j<res.nvabarMenu[i].children.length;j++){
						var children = {};
						children.id = res.nvabarMenu[i].children[j].id;
						children.title = res.nvabarMenu[i].children[j].title;
						children.link = res.nvabarMenu[i].children[j].link;
						childrens.push(children);
//						menuObj.children = children;
					}
					menuObj.children = childrens;
					vue.menus.push(menuObj);
				}
				$(".pagination li").eq(1).addClass("active");
				//获取分页按钮数
				vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
			},
			changePage:function(event){
				$(".pagination li").removeClass("active");
				var target = event.target || window.event.srcElement;
				var start = vue.pagesize*(parseInt($(target).text())-1);
				vue.arrayDataPage = {};
				for(var i=start;i<parseInt(vue.pagesize)*$(target).text();i++){
					vue.arrayDataPage[i]=vue.arrayData[i];
				}
				$(target).closest("li").addClass("active");
			},
			//上一页
			prevPage:function(){
				//按钮被禁用，无任何反应
				if($(".prev_page_btn").hasClass("disabled")){

				}
				else{
					alert("上一页按钮点击");
				}
			},
			nextPage:function(){
				//按钮被禁用，不做任何操作
				if($(".next_page_btn").hasClass("disabled")){

				}
				else{
					vue.pageCurrent++;
					alert("下一页按钮点击");
				}
			},
			createRole:function(){
				alert("点击了创建角色按钮");
				$("#create_role").modal("show");
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
//					$("#wrapper .sidebar").css("left","-260px");
					$(".shrink").animate({left:"0px"},'slow',"linear");
					$("#wrapper .sidebar").animate({left:"-260px"},'slow',"linear");
//					$(".shrink").css("left","0px");
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
		vue.arrayDataPage = {};
		for(var i=0;i<parseInt(vue.pagesize);i++){
			vue.arrayDataPage[i]=vue.arrayData[i];
		}
		//获取分页按钮数
		vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
		console.log(parseInt(vue.pagesize)+1);
	});
//	vue.showPage(vue.pageCurrent, null, true);
})