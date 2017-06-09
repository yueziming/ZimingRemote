/**
 * Created by yueziming on 2017-6-8.
 */
$(function(){
	$.ajax({
		//url:Api.url.INDEXTABLE,
		url:'assets/json/test.json',
		type:'get',
		dataType:'json',
		//data:{},
		success:function(res){
			if(res.status === 1 && res.data){
				vue.showPage(res);
				//for(var i=0;i<arrayData.length/2;i++)
				//vue.showPage(2, null, true);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
			console.log("网络异常");
		}
	});
	//只能输入正整数过滤器
	Vue.filter('onlyNumeric', {
		// model -> view
		// 在更新 `<input>` 元素之前格式化值
		read: function (val) {
			return val;
		},
		// view -> model
		// 在写回数据之前格式化值
		write: function (val, oldVal) {
			var number = +val.replace(/[^\d]/g, '')
			return isNaN(number) ? 1 : parseFloat(number.toFixed(2))
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
			arrayDataPage:	[]
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
				for(var i=0;i<=vue.pagesize;i++){
					vue.arrayDataPage[i]=vue.arrayData[i];
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
				for(var i=start;i<=parseInt(vue.pagesize)*$(target).text();i++){
					vue.arrayDataPage[i]=vue.arrayData[i];
				}
				$(target).closest("li").addClass("active");
			}
			/*showPage: function (pageIndex, $event, forceRefresh) {

				if (pageIndex > 0) {

					if (pageIndex > this.pageCount) {
						pageIndex = this.pageCount;
					}

					//判断数据是否需要更新
					var currentPageCount = Math.ceil(this.totalCount / this.pagesize);
					if (currentPageCount != this.pageCount) {
						pageIndex = 1;
						this.pageCount = currentPageCount;
					}
					else if (this.pageCurrent == pageIndex && currentPageCount == this.pageCount && typeof (forceRefresh) == "undefined") {
						console.log("not refresh");
						return;
					}

					//处理分页点中样式
					var buttons = $("#pager").find("span");
					for (var i = 0; i < buttons.length; i++) {
						if (buttons.eq(i).html() != pageIndex) {
							buttons.eq(i).removeClass("active");
						}
						else {
							buttons.eq(i).addClass("active");
						}
					}

					/!*!//测试数据 随机生成的
					var newPageInfo = [];
					for (var i = 0; i < this.pagesize; i++) {
						newPageInfo[newPageInfo.length] = {
							name: "test" + (i + (pageIndex - 1) * 20),
							age: (i + (pageIndex - 1) * 20)
						};
					}
					this.pageCurrent = pageIndex;
					this.arrayData = newPageInfo;*!/

					//计算分页按钮数据
					if (this.pageCount > this.showPages) {
						if (pageIndex <= (this.showPages - 1) / 2) {
							this.showPagesStart = 1;
							this.showPageEnd = this.showPages - 1;
							console.log("showPage1")
						}
						else if (pageIndex >= this.pageCount - (this.showPages - 3) / 2) {
							this.showPagesStart = this.pageCount - this.showPages + 2;
							this.showPageEnd = this.pageCount;
							console.log("showPage2")
						}
						else {
							console.log("showPage3")
							this.showPagesStart = pageIndex - (this.showPages - 3) / 2;
							this.showPageEnd = pageIndex + (this.showPages - 3) / 2;
						}
					}
					console.log("showPagesStart:" + this.showPagesStart + ",showPageEnd:" + this.showPageEnd + ",pageIndex:" + pageIndex);
				}

			}
			, deleteItem: function (index, age) {
				if (confirm('确定要删除吗')) {
					//console.log(index, age);
					var newArray = [];
					for (var i = 0; i < this.arrayData.length; i++) {
						if (i != index) {
							newArray[newArray.length] = this.arrayData[i];
						}
					}
					this.arrayData = newArray;
				}
			}*/
		}
	});
	vue.$watch("pagesize", function (value) {
		vue.arrayDataPage = {};
		for(var i=0;i<=parseInt(vue.pagesize);i++){
			vue.arrayDataPage[i]=vue.arrayData[i];
		}
		//获取分页按钮数
		vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
		console.log(parseInt(vue.pagesize)+1);
	});
//	vue.showPage(vue.pageCurrent, null, true);
})