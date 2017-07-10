/**
 * Created by 1658 on 2017-6-16.
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
            //获取字段内容列表
            common.ajax(Api.url.GETALLFIELD,"get",{},function(res){
                if(res.status ===1 && res.data){
                    console.log(res);
                    vue.showPage(res);
                }
            });
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
                    // tablesTitle:[],
                    //左侧导航按钮菜单
                    menus:[],
                    //选中列
                    selectTd:{name:''},
                    //设置用户字段id
                    columnId:[],
                    //创建内容label
                    createContentComment:[],
                    //权限控制列表
                    controller:{}
                },
                methods: {
                    //分页数据
                    showPage:function(res){
                        //储存关键字
                        for(var k in res.data.column[0]){
                            vue.key[k] = k;
                        }
                        //储存获取到的数据
                        for(var i=0;i<res.data.column.length;i++){
                            var obj ={};
                            obj.id = res.data.column[i].id;
                            obj.comment = res.data.column[i].comment;
                            obj.name = res.data.column[i].name;
                            obj.isEncrypt = res.data.column[i]["is_encrypt"]?"是":"否";
                            obj.createTime = res.data.column[i]['created_at'];
                            obj.updateTime = res.data.column[i]['updated_at'];
                            /*for(var k in vue.key){
                                obj[vue.key[k]] = res.data.column[i][vue.key[k]];
                            }*/
                            vue.arrayData.push(obj);
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
                    showAddField:function(){
                        $("#add_field").modal("show");
                    },
                    //添加自定义字段
                    addField:function(){
                        //判断字段非空
                        if(!common.isEmpty($("#add_field .name").val())){
                            common.tips("名称不能为空",1500);
                            return false;
                        }
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
                            location.reload();
                        })
                    },
                    //跳转到关联字段控制页面
                    toRelationPage:function(){
                        location.href = "relation-field.html";
                    },
                    //显示修改内容信息
                    show_modifyTd:function(event){
                        var target = event.target || window.event.srcElement;
                        vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
                        vue.selectTd.name= $(target).closest("tr").find("td").eq(1).text();
                        vue.selectTd.isEncrypt = $(target).closest("tr").find("td").eq(3).text() == "是"? 1:0;
                        var url =Api.url.GEIEDITFIELD+''+vue.selectTd.id;
                        //获取编辑内容信息
                        // vue.getModifyContent = [];
                        common.ajax(url,"get",{},function(res){
                            console.log(res);
                            if(res.status === 1){
                                $("#modify_field").modal("show");
                            }
                            else{
                                common.tips(res.message);
                            }
                        });
                    },
                    //显示列表字段控制弹框
                    showListFieldControl:function () {
                        $("#list_menu").modal("show");
                    },
                    //修改字段
                    modField:function(){
                        //判断字段非空
                        if(!common.isEmpty($("#modify_field .name").val())){
                            common.tips("名称不能为空",1500);
                            return false;
                        }
                        var data = {
                            name:$("#modify_field .name").val(),
                            is_encrypt:$("#modify_field input[type='checkbox']:checked").length
                            // is_encrypt:vue.selectTd
                        };
                        var url =Api.url.MODIFYFIELD+''+vue.selectTd.id;
                        common.ajax(url,"post",data,function(res){
                            console.log(res);
                            if(res.status === 1){
                                location.reload();
                            }
                            common.tips(res.message);
                        })
                    },
                    //删除字段
                    delField:function(event){
                        var url = Api.url.DELFIELD + this.selectTd.id;
                        common.ajax(url,"post",{},function(res){
                            // console.log(res);
                            if(res.status == 1){
                                location.reload();
                            }
                            //弹出提示，2秒钟
                            common.tips(res.message,2000);
                        })
                    },
                    //显示删除弹出框
                    show_delTd:function(){
                        var target = event.target || window.event.srcElement;
                        $("#del_field").modal("show");
                        vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
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
    field.init();
})
