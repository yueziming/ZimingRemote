/**
 * Created by yueziming on 2017-6-10.
 */
$(function(){
	var user = {
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
			common.ajax(Api.url.USERINFO,"get",{},function(res){
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
					pageCount: 8,
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
					//控制列表
                    controller:{},
                    password:'',
                    ensurePassword:'',
                    oldPassword:''
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
					//跳转到添加用户页面
					toAddUser:function(){
						location.href = "create-user.html"
					},
					//修改用户跳转
					modUser:function(event){
						var target = event.target || window.event.srcElement;
						var id= $(target).closest("tr").find("td").eq(0).text();
						location.href = "modify-user.html?id=" + id;
					},
					//显示删除弹出框
					show_delTd:function(){
						var target = event.target || window.event.srcElement;
						$("#del_user").modal("show");
						vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
					},
					//删除用户
					delUser:function(){
						var url = Api.url.DELUSER + this.selectTd.id;
						common.ajax(url,"post",{},function(res){
							if(res.status == 1){
								location.reload();
								/*$("#del_user").modal("hide");
								for(var i=0;i<vue.arrayDataPage.length;i++){
									if(vue.arrayDataPage[i].id == vue.selectTd.id){
										vue.arrayDataPage.splice(i,1);
										vue.arrayData.splice(vue.arrayDataPage[i],1);
									}
								}
								vue.changeShow();*/
								$("#del_user_suc").modal("show");
							}
							//弹出提示，2秒钟
							common.tips(res.message,2000);
						})
					},
					//删除用户成功
					delUserSuccess:function(){
//						location.reload();
					},
                    //修改密码
                    personalProfile:function (){
                        $("#modify_password").modal("show");
                        // vue.loginOut();
                    },
                    modPassword:function () {
                        if(vue.password != vue.ensurePassword){
                            common.tips("两次密码输入不一致!",2000);
                        }else{
                            var data = {
                                newPassword:vue.ensurePassword,
                                oldPassword:vue.oldPassword
                            };
                            common.ajax(Api.url.MODIFYPASSWORD,"post",data,function (res) {
                                if(res && res.status && res.status == '1'){
                                    console.log(res);
                                    $("#modify_password").modal("hide");
                                    $("#modify_password_suc").modal("show");
                                    // vue.loginOut();
                                }
                                common.tips(res.message,2000);
                            })
                        }
                    },
                    toLogin:function () {
                        vue.loginOut();
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
            //获取控制列表
            vue.controller = common.getData("controller");
			vue.$watch("pagesize", function (value) {
				//获取分页按钮数
				vue.pageCount = Math.ceil(vue.arrayData.length/vue.pagesize);
                vue.pageCurrent = 1;
				vue.changeShow();
				console.log(parseInt(vue.pagesize)+1);
			});
		}
	};
	user.init();

	/*//数组删除某项功能
	Array.prototype.remove = function (dx) {
		if (isNaN(dx) || dx > this.length) { return false; }
		for (var i = 0, n = 0; i < this.length; i++) {
			if (this[i] != this[dx]) {
				this[n++] = this[i]
			}
		}
		this.length -= 1
	}*/

})