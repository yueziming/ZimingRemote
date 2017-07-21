/**
 * Created by 1658 on 2017-7-8.
 */

$(function(){
    var backups = {
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
            common.ajax(Api.url.GETBACKUPSDATABASE,"get",{},function(res){
                console.log(res);
                if(res.data){
                    console.log(res);
                    vue.showPage(res.data);
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
                    controller:{},
                    //显示消息
                    msg:''
                },
                methods: {
                    //分页数据
                    showPage:function(data){
                        for(var i=0;i<data.length;i++){
                            vue.arrayData.push(data[i]);
                        }
                        /*//储存关键字
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
                            /!*for(var k in vue.key){
                             obj[vue.key[k]] = res.data.column[i][vue.key[k]];
                             }*!/
                            vue.arrayData.push(obj);
                        }*/
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
                    //还原备份数据
                    show_modifyTd:function(event){
                        //弹出警告框
                        $("#backups_datas").modal("show");
                        var target = event.target || window.event.srcElement;
                        // vue.selectTd.id= $(target).closest("tr").find("td").eq(0).text();
                        vue.selectTd.name= $(target).closest("tr").find("td").eq(0).text();
                    },
                    //显示列表字段控制弹框
                    showListFieldControl:function () {
                        $("#list_menu").modal("show");
                    },
                    //还原备份数据
                    backupsReduce:function(){
                        //显示遮罩层
                        $(".body-mask").show();
                        $("#backups_datas").modal("hide");
                         var url =Api.url.REDUCEBACKUPSDATABASE;
                         //获取编辑内容信息
                         // vue.getModifyContent = [];
                         common.ajax(url,"post",{"name":vue.selectTd.name},function(res){
                             $(".body-mask").hide();
                             vue.msg = "还原备份成功，令牌改变，请重新登录！";
                             $("#backups_suc").modal("show");
                             setTimeout(function () {
                                 location.href = "login.html";
                             },1500);
                         /*location.reload();
                         $(".body-mask").hide();*/
                         });
                    },
                    //删除备份
                    delBackups:function(event){
                        $("#del_backups").modal("hide");
                        var url =Api.url.DELBACKUPSDATABASE;
                        //获取编辑内容信息
                        // vue.getModifyContent = [];
                        common.ajax(url,"post",{"name":vue.selectTd.name},function(res){
                            vue.msg = "删除备份成功！";
                            $("#backups_suc").modal("show");
                            setTimeout(function () {
                                location.reload();
                            },1500);
                        });
                        /*var url = Api.url.DELFIELD + this.selectTd.id;
                        common.ajax(url,"post",{},function(res){
                            // console.log(res);
                            if(res.status == 1){
                                location.reload();
                            }
                            //弹出提示，2秒钟
                            common.tips(res.message,2000);
                        })*/
                    },
                    //添加备份
                    createBackups:function () {
                        common.ajax(Api.url.ADDBACKUPSDATABASE,"get",{},function (res) {
                            vue.msg = "添加备份成功！";
                            $("#backups_suc").modal("show");
                            setTimeout(function () {
                                location.reload();
                            },1500);
                            /*console.log(res);
                            location.reload();*/
                        });
                    },
                    //显示删除备份
                    show_delTd:function(){
                        var target = event.target || window.event.srcElement;
                        vue.selectTd.name= $(target).closest("tr").find("td").eq(0).text();
                        $("#del_backups").modal("show");
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
    backups.init();
})
