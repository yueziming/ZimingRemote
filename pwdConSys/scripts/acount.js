/**
 * Created by yueziming on 2017-6-13.
 */
$(function(){
	var acount = {
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
			//获取用户选择的显示关联字段
			common.ajax(Api.url.GETSELECTEDRELATIONFIELD,"get",{},function(res){
				if(res.status ===1 && res.data){
//					console.log(res);
					for(var i=0;i<res.data.length;i++){
						var obj = {};
						obj.id = res.data[i].id;
						obj.name = res.data[i].name;
						obj.column = res.data[i].column;
						vue.selectedRelationFields.push(obj);
					}
                    //获取用户显示关联字段
                    common.ajax(Api.url.GETALLFIELD,"get",{},function(res){
                        if(res.status ===1 && res.data && res.data.column){
                            for(var i=0;i<res.data.column.length;i++){
                                var obj = {};
                                obj.id = res.data.column[i].id;
                                obj.comment = res.data.column[i].comment;
                                obj.name = res.data.column[i].name;
                                obj.isEncrypt = res.data.column[i]["is_encrypt"];
                                obj.isSelected = 0;
                                for(var j=0;j<vue.selectedRelationFields.length;j++){
                                	if(obj.id == vue.selectedRelationFields[j].id){
                                        obj.isSelected = 1;
                                        break;
									}
								}
                                vue.showRelationFields.push(obj);
                            }
//					console.log(res);
                        }
                    });
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
				if(res.status === 1 && res.data){
					console.log("这是创建内容获取的信息");
					console.log(res);
					//获取内容信息结构主体
					for(var i=0;i<res.data.column.length;i++){
						var obj={};
						obj.comment = res.data.column[i].comment;
						obj.id = res.data.column[i].id;
						obj.name = res.data.column[i].name;
						obj.isEncrypt = res.data.column[i]["is_encrypt"];
						vue.createContentComment.push(obj);
					}
					//获取权限列表
					for(var i=0;i<res.data.role.length;i++){
						var obj = {};
						obj.id = res.data.role[i].id;
						obj.name = res.data.role[i].name;
						vue.createContentRole.push(obj);
					}
				}
//				common.tips(res.message,1500);
			});
			//公司列表
			common.ajax(Api.url.COMPANYSEARCH,"get",{},function (res) {
                if(res.status === 1 && res.data){
					// console.log(res);
					for(var i=0;i<res.data.length;i++){
						var obj = {};
						obj.id = res.data[i].id;
						obj.name = res.data[i].name;
						vue.companneyList.push(obj);
					}
                }
            });
			//下载EXCEL
			/*common.ajax(Api.url.DOWNLOADEXCEL,"get",{},function(res){
				if(res.status ===1){
					console.log("下载EXECEL");
					console.log(res);
				}
			})*/
			/*common.ajax(Api.url.USERINFO,"get",{},function(res){
				if(res.status === 1 && res.data){
					vue.showPage(res);
				}
			})*/
			var vue = new Vue({
				el: "#wrapper",
				data: {
					username:'',
					//下载地址
					downloadUrl:Api.url.DOWNLOADEXCEL,
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
					//详情页表头
					detailTablesTitle:[],
					//详情页数据
					detailData:[],
					//左侧导航按钮菜单
					menus:[],
					//选中列
					selectTd:{name:''},
					//显示关联字段
					showRelationFields:[],
					//选中关联字段
					selectedRelationFields:[],
					//设置用户字段id
					columnId:[],
					//创建内容label
					createContentComment:[],
					//创建内容分配的角色
					createContentRole:[],
					//修改内容获取的信息
					getModifyContent:[],
					//模板下载地址
					downloadUrl:'',
					//公司列表
					companneyList:[],
					//搜索内容
                    searchText:'',
					//上传文件地址
					uploadFileAddress:'',
					//获取权限控制列表
                    controller:{},
                    password:'',
                    ensurePassword:'',
                    oldPassword:'',
					//拖放旧元素
					dragOldElement:null,
					//拖动新元素
					dragNewElement:null
				},
				methods: {
					//分页数据
					showPage:function(res){
						vue.detailTablesTitle = [];
                        vue.tablesTitle = [];
                        //获取表头
						var count = 0;
                        for(var i in res.headerTitle){
                            var obj = {};
                            obj.title = res.headerTitle[i];
                            obj.key = i;
                            obj.content = '';
                            //不显示创建时间、修改时间并且在8行以内
                            if(obj.key !='created_at' && obj.key != 'updated_at' && count<8){
                                vue.tablesTitle.push(obj);
                                count ++;
                            }
                            vue.detailTablesTitle.push(obj);
                        }
						//储存关键字
						for(var k in res.data[0]){
							vue.key[k] = k;
						}
                        vue.arrayData = [];
                        vue.arrayDataPage = [];
						//储存获取到的数据
						for(var i=0;i<res.data.length;i++){
							var obj ={};
							var obj2 = {};
                            var count = 0;
							for(var k in vue.key){
								//不显示创建时间、修改时间并且在8列以内
                                if(vue.key[k] !='created_at' && vue.key[k] != 'updated_at' && count<8){
                                    obj[vue.key[k]] = res.data[i][vue.key[k]];
                                    count ++;
								}
								obj2[vue.key[k]] = res.data[i][vue.key[k]];
							}
							vue.arrayData.push(obj);
							vue.detailData.push(obj2);
						}
						for(var i=0;i<vue.pagesize;i++){
							if(vue.arrayData[i]){
								vue.arrayDataPage[i]=vue.arrayData[i];
							}
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
					/*showAddField:function(){
						$("#add_field").modal("show");
					},*/
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
						/*$.each($("input[type='checkbox']:checked"),function(){
							vue.columnId.push(parseInt($(this).attr("data-id")));
						});*/
						for(var i=0;i<$("#field_list .relation_btn_list").length;i++){
                            vue.columnId.push(parseInt($("#field_list .relation_btn_list").eq(i).find("button").attr("data-id")));
						}
						var data = {
							column_id:vue.columnId
						}
						common.ajax(Api.url.SETSHOWRELATIONFIELD,"post",data,function(res){
							if(res.status ===1){
								console.log(res);
								common.tips(res.message,1500);
								location.reload();
							}
						});
					},
					//创建内容
					createContent:function(){
						var data = {};
						data.data = {};
						for(var i=0;i<$(".create_content").find("input[type = text]").length;i++){
							var obj = {};
//							var roleIdPath = [];
//							var obj2 = {};
							obj[$(".create_content").find("input[type = text]").eq(i).attr("name")] = $(".create_content").find("input[type = text]").eq(i).val();
							var el = "."+$(".create_content").find("input[type = text]").eq(i).attr("name");
							var str = '';
							$.each($(el).find("input[type=checkbox]:checked"),function(){
//								roleIdPath.push($(this).val());
								str += $(this).val()+',';
							});
//							obj[$(".create_content input").eq(i).attr("name")] = $(".create_content select").eq(i).val();
							str=str.substring(0,str.length-1);
							obj["role_id_path"] = str;
							// obj.company = $("#add_content select").val();
							data.data[$(".create_content").find("input[type = text]").eq(i).attr("name")]=obj;
//							roleIdPath.push(obj2);
						}
						data.company = $("#add_content select").val();
//						data.push(roleIdPath);
							common.ajax(Api.url.ADDCONTENT,"post",data,function(res){
							if(res.status === 1){
								location.reload();
							}
							common.tips(res.message);
						})
//						[ [ column1:value,column2:value,role_id_path[ column1:role_id(Ps:1,2,3,4), column2:role_id(3,4,5,6) ] ]
					},
					//详情
                    details:function (event) {
                        var target = event.target || window.event.srcElement;
                        vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
                        for(var k =0;k<vue.detailData.length;k++){
                        	if(vue.detailData[k].id == vue.selectTd.id){
                                for(var i=0;i<vue.detailTablesTitle.length;i++){
                                    vue.detailTablesTitle[i].content = vue.detailData[k][vue.detailTablesTitle[i].key];
                                }
                                break;
							}
						}
						$(".right_details").css("right","0px");
                    },
					//显示创建内容按钮
                    showCreateContent:function () {
						$("#add_content").modal("show");
                    },
					//关闭详情页
                    closeDetail:function () {
                        $(".right_details").css("right","-30%");
                    },
					//显示关联字段更改
					changeShowField:function (event) {
                        var target = event.target || window.event.srcElement;
                        // vue.selectedRelationFields = [];
                        if($(target).attr("data-checked") == 0){
                            $(target).attr("data-checked",1);
                            var obj = {};
                            obj.id = $(target).attr("data-id");
                            obj.name = $(target).closest("label").text().trim();
                            obj.column = $(target).attr("data-name");
                            vue.selectedRelationFields.push(obj);
						}else{
                            $(target).attr("data-checked",0);
                            var obj = {};
                            obj.id = $(target).attr("data-id");
                            // obj.column - $(target).attr("data-name");
                            // obj.name = $(target).closest("label").text().trim();
                            for(var i=0;i<vue.selectedRelationFields.length;i++){
                            	if(obj.id == vue.selectedRelationFields[i].id){
                                    vue.selectedRelationFields.splice(i,1);
                                    break;
								}
							}
						}
                        // input[type='checkbox']:checked
                        // alert("点击更改");
                    },
                    drop:function (event) {
						console.log("拖放结束");
						this.dragNewElement = event.target;
                        var id = $(this.dragOldElement).attr("data-id");
                        var text = $(this.dragOldElement).text();
                        $(this.dragOldElement).text($(this.dragNewElement).text());
                        $(this.dragOldElement).attr("data-id",$(this.dragNewElement).attr("data-id"));
                        $(this.dragNewElement).text(text);
                        $(this.dragNewElement).attr("data-id",id);
						// console.log(event.target);
						// console.log(event.target.attr("data-id"));
						// console.log(event.target.text());
                    },
                    allowDrop:function (event) {
                        event.preventDefault();
						// console.log("拖放结束");
                    },
                    drag:function (event) {
						console.log("开始拖放");
						this.dragOldElement = event.target;
                        // console.log(event.currentTarget);
						// console.log("start");
                    },
					//搜索
                    search:function () {
						var data = {
							company:$("select").eq(0).val(),
							keyword:{
                                'column':$("select").eq(1).val(),
								'value':vue.searchText
							}
						}
						//重新获取用户内容
                        common.ajax(Api.url.GETCONTENTLIST,"get",data,function(res){
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
                            else{
                            	common.tips(res.message,1500);
							}
                        });
                    },
					//显示修改内容信息
					show_modifyTd:function(event){
						var target = event.target || window.event.srcElement;
						vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
						var url =Api.url.GETEDITCONTENT+''+vue.selectTd.id;
						//获取编辑内容信息
						vue.getModifyContent = [];
						common.ajax(url,"get",{},function(res){
							if(res.status === 1){
								for(var k=0;k<res.data.length;k++){
									var obj={};
									obj.comment = res.data[k].comment;
									obj.is_encrypt = res.data[k].is_encrypt;
									obj.name = res.data[k].name;
									obj.content = res.data[k].content;
									var role_ids = res.data[k].role_id_path.split(",");
									obj.modifyContentRole = [];
//									obj.modifyContentRole = vue.createContentRole;
									for(var c=0;c<vue.createContentRole.length;c++){
										var object = {};
										object.id = vue.createContentRole[c].id;
										object.name = vue.createContentRole[c].name;
										obj.modifyContentRole.push(object);
//										obj.modifyContentRole[c].id = vue.createContentRole[c].id;
//										obj.modifyContentRole[c].name = vue.createContentRole[c].name;
//										obj.modifyContentRole[c].isSelected = 0;
									}
//									obj.role_id_path = res.data.column[i].role_id_path;
									//判断哪些角色被选中
									for(var i=0;i<obj.modifyContentRole.length;i++){
//										var arr =[];
//										obj.modifyContentRole[i].isSelected = 0;
										for(var j=0;j<role_ids.length;j++){
											if(obj.modifyContentRole[i].id == role_ids[j]){
//												arr.push(1);
												obj.modifyContentRole[i].isSelected = 1;
//												return;
//												vue.createContentRole[i]
											}
										}
//										obj.modifyContentRole[i].isSelected.push(arr);
									}

									vue.getModifyContent.push(obj);
								}
                                //判断原来属于哪个公司并删除
                                for(var i=0;i<vue.companneyList.length;i++){
                                    // vue.companneyList[i].selected = 0;
                                    if(res["company_id"] && res["company_id"]==vue.companneyList[i].id){
                                        //存储name值
                                        var name = vue.companneyList[i].name;
                                        //列表第一个跟默认选择交换位置
                                        vue.companneyList[i].id = vue.companneyList[0].id;
                                        vue.companneyList[i].name = vue.companneyList[0].name;
                                        vue.companneyList[0].id = res["company_id"];
                                        vue.companneyList[0].name = name;
                                        // vue.companneyList.splice(i,1,vue.companneyList[0]);
                                        // vue.companneyList.splice(0,1,res["company_id"]);
                                        break;
                                        // vue.companneyList[i].selected = 1;
                                    }
                                };
								console.log("这是编辑内容获取的信息");
								console.log(res);
								$("#modify_content").modal("show");
							}
							common.tips(res.message,1500);
						});
					},
					//显示列表字段控制弹框
                    showListFieldControl:function () {
                        vue.showRelationFields = [];
                        //获取用户显示关联字段
                        common.ajax(Api.url.GETALLFIELD,"get",{},function(res){
                            if(res.status ===1 && res.data && res.data.column){
                                for(var i=0;i<res.data.column.length;i++){
                                    var obj = {};
                                    obj.id = res.data.column[i].id;
                                    obj.comment = res.data.column[i].comment;
                                    obj.name = res.data.column[i].name;
                                    obj.isEncrypt = res.data.column[i]["is_encrypt"];
                                    obj.isSelected = 0;
                                    for(var j=0;j<vue.selectedRelationFields.length;j++){
                                        if(obj.id == vue.selectedRelationFields[j].id){
                                            obj.isSelected = 1;
                                            break;
                                        }
                                    }
                                    vue.showRelationFields.push(obj);
                                }
//					console.log(res);
                            }
                        });
						$("#list_menu").modal("show");
                    },
					//修改内容
					modifyContent:function(){
						var data = {};
						data.data = {};
						for(var i=0;i<$("#modify_content").find("input[type = text]").length;i++){
							var obj = {};
							//							var roleIdPath = [];
							//							var obj2 = {};
							obj[$("#modify_content").find("input[type = text]").eq(i).attr("name")] = $("#modify_content").find("input[type = text]").eq(i).val();
							var el = "."+$("#modify_content").find("input[type = text]").eq(i).attr("name");
							var str = '';
							$.each($(el).find("input[type=checkbox]:checked"),function(){
								//								roleIdPath.push($(this).val());
								str += $(this).val()+',';
							});
							//							obj[$(".create_content input").eq(i).attr("name")] = $(".create_content select").eq(i).val();
							str=str.substring(0,str.length-1);
							obj["role_id_path"] = str;
							data.data[$("#modify_content").find("input[type = text]").eq(i).attr("name")]=obj;
							//							roleIdPath.push(obj2);
						}
                        data.company = $("#modify_content select").val() || '';
						//						data.push(roleIdPath);
						var url =Api.url.MODIFYCONTENT+''+vue.selectTd.id;
						common.ajax(url,"post",data,function(res){
							if(res.status === 1){
								location.reload();
							}
							common.tips(res.message);
						})
					},
					//删除内容
					delContent:function(event){
						var url = Api.url.DELCONTENT + this.selectTd.id;
						common.ajax(url,"post",{},function(res){
							if(res.status == 1){
								location.reload();
							}
							//弹出提示，2秒钟
							common.tips(res.message,2000);
						})

					},
					//下载内容
					downloadModel:function(){
						common.ajax(Api.url.DOWNLOADEXCEL,"get",{},function(res){
							console.log(res);
							if(res.status === 1){
								vue.downloadUrl = Api.baseUrl+''+res.url;
								location.href = vue.downloadUrl;
							}else{
								common.tips("你没有下载内容的权限",1500);
							}
						})
					},
					//显示上传内容
					uploadModel:function(){
						// $("#upload_content").modal("show");
                        $("#upload_file").modal("show");
					},
					//上传文件
                    uploadFile:function () {
                        var data = new FormData($('#updateFile')[0]);
                        console.log(data);
                        $.ajax({
                            url        :Api.url.IMPORTEXCEL,
                            type       :'POST',
                            data       :data,
                            dataType   :'JSON',
                            cache      :false,
                            processData:false,
                            contentType:false,
                            beforeSend: function(request) {
                                if(common.getData("access_token")){
                                    request.setRequestHeader("Authorization", "Bearer "+common.getData("access_token"));
                                }
                            },
                        }).done(function(data){
                            console.log(data);
                            if(data.status && data.status == 1){
                            	vue.uploadFileAddress = data.url;
                                $("#upload_file").modal("hide");
                                $("#upload_content").modal("show");
                            	common.tips("上传成功",1500);
                                // ManageObject.object.toast.toast(data.message);
                                // imgUploadArray['background_upload'] = 1;
                                // $('input[name=mobile_invitation_background]').val(data.data.background_upload.path);
                                // $('.background-show img').attr('src', data.data.background_upload.path);
                            }else{
                                // ManageObject.object.toast.toast(data.message);
								common.tips(data.message,1500);
                            }
                        });
                    },
					uploadInfoSuc:function(){
						var data = {};
						data["excel_file"] = vue.uploadFileAddress;
						data["role_id_path"] = {};
                        data.company = $("#upload_content select").val();
						for(var i=0;i<$("#upload_content").find(".column_field").length;i++){
							//							var obj = {};
							//							var roleIdPath = [];
							//							var obj2 = {};
							//							obj[$("#upload_content").find(".column_field").eq(i).attr("name")] = $("#upload_content").find(".column_field").eq(i).val();
							var el = "."+$("#upload_content").find(".column_field").eq(i).attr("name");
							var str = '';
							$.each($(el).find("input[type=checkbox]:checked"),function(){
								//								roleIdPath.push($(this).val());
								str += $(this).val()+',';
							});
							//							obj[$(".create_content input").eq(i).attr("name")] = $(".create_content select").eq(i).val();
							str=str.substring(0,str.length-1);
							data["role_id_path"][$("#upload_content").find(".column_field").eq(i).attr("data-id")]= str;
							//							obj["role_id_path"] = str;
							/*data.data[$("#upload_content").find("input[type = text]").eq(i).attr("name")]=obj;*/
							//							roleIdPath.push(obj2);
						}

						console.log(data);
						common.ajax(Api.url.IMPORTEXCEL,"post",data,function(res){
							// console.log(res);
							if(res.status ===1){
								location.reload();
							}
							common.tips(res.message,1500);
						})
					},
					//开始上传
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
					//刷新页面
					refresh:function () {
						location.reload();
                    },
					/*//删除用户
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
					},*/
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
	}
	acount.init();
})
