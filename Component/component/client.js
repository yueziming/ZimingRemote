/**
 * Created by yueziming on 2017-7-11.
 */
$(function () {
    var Client = {
        init: function () {
            //head末尾追加本页面css
            $("head").append("<link>");
            css = $("head").children(":last");
            css.attr({
                rel: "stylesheet",
                type: "text/css",
                href: location.origin+"/css/Bootstrap/bootstrap-datetimepicker.min.css"
            });
            $("head").append("<link>");
            css = $("head").children(":last");
            css.attr({
                rel: "stylesheet",
                type: "text/css",
                href: location.origin+"/css/client.css"
            });
            this.model();
            // this.view();
        },
        model: function () {
            var customer = new Vue({
                el: "#layout-2",
                data: {
                    //分页总页数
                    pagesize:10,
                    //显示分页数组
                    pageView:[],
                    //显示分页起始页
                    pageStart:1,
                    //显示分页终止页
                    pageEnd:1,
                    //当前选中页面
                    pageCurrent:1,
                    //状态
                    state: '已登记',
                    addClientList:[],
                    //数据总量
                    pageCount:0,
                    //手动刷新统计
                    count:0,
                    //客户列表表头数据
                    clientListTitle:{},
                    //客户列表内容
                    clientListContent:[],
                    //预约客户登记字段列表
                    appointmentClientList:[],
                    //选中的用户Id
                    clientId:0,
                    //修改客户字段
                    modClientField:[],
                    //每页显示信息条数,默认10条
                    pageRecordCount:10,
                    //搜索关键字
                    keyword:'',
                    //预约表单的科室选择值
                    departmentId:'',
                    //预约表单中的医生数组
                    reservationDoctor:{},
                    //预约表单中用来显示渲染的数据
                    // showDoctor:[]
                    // selectWidth:0
                },
                created:function(){
                },
                beforeUpdate:function(){
                },
                mounted:function () {

                },
                computed:{
                    countPages:function(){
                        // if(this.)
                        this.pageView = [];
                        this.pageCurrent = parseInt(this.pageCurrent);
                        this.pageStart = this.pageCurrent -2>0 ? (this.pageCurrent -2):1;
                        this.pageEnd = this.pageCurrent +2< this.pagesize ? (this.pageCurrent +2):this.pagesize;
                        //如果起始页为1并且pagesize大于等于5则pageEnd为5；
                        if(this.pageStart == 1 && this.pagesize >=5){
                            this.pageEnd = 5;
                        }else if(this.pageEnd == this.pagesize && this.pagesize >= 5){
                            this.pageStart = this.pageEnd - 4;
                        }else if(this.pageStart == 1 && this.pagesize <5){
                            this.pageEnd = this.pagesize;
                        }else if(this.pageEnd == this.pagesize && this.pagesize < 5){
                            this.pageStart = 1;
                        }
                        for(var i=this.pageStart;i<=this.pageEnd;i++){
                            this.pageView.push(i);
                        }
                        return this.pageView;
                    },
                    showDoctor:function(){
                        return this.reservationDoctor[this.departmentId];
                    }
                },
                updated:function(){
                    $(".form_datetime").datetimepicker({
                        format: "yyyy-mm-dd hh:ii"
                    });
                    $(".datetimepicker").attr("z-index","1226");
                    $(".pages").removeClass("active");
                    $(".page_"+this.pageCurrent).addClass("active");
                    $(".prev_page_btn").removeClass("disabled");
                    $(".next_page_btn").removeClass("disabled");
                    if(customer.pageCurrent == 1){
                        $(".prev_page_btn").addClass("disabled");
                    }else if(customer.pageCurrent == customer.pagesize){
                        $(".next_page_btn").addClass("disabled");
                    }
                },
                methods: {
                    addCustomer: function () {
                        Common.ajax(Api.getClientFieldList+'/write',"get",{},function (res){
                            // console.log(res);
                            if(res){
                                customer.addClientList = res;
                                setTimeout(function () {
                                    layer.open({
                                        type: 1,
                                        title: '客户登记&nbsp;&nbsp;&nbsp;&nbsp;(红色的为必填字段)',
                                        maxmin: true,
                                        shadeClose: true, //点击遮罩关闭层
                                        area: ['800px', ''],
                                        content: $('#add_menber_style'),
                                        btn: ['提交', '取消'],
                                        yes: function (index, layero) {
                                            //对必填字段进行非空验证
                                            var flag = true;
                                            $("#add_menber_style .necessary").each(function(){
                                                flag = true;
                                                var val = $(this).closest("li").find("input").eq(0).val() || $(this).closest("li").find("select").val() || $(this).closest("li").find("textarea").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsNotEmpty(val)){
                                                    layer.alert($(this).text()+'：不能为空！', {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            });
                                            //对邮箱、电话号码进行格式验证
                                            if($("#add_menber_style input[name='mobile']").length>0 && $("#add_menber_style input[name='mobile']").val()!='' && flag){
                                                var mobileVal = $("#add_menber_style input[name='mobile']").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsMobile(mobileVal)){
                                                    layer.alert("手机号码格式错误", {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            }
                                            if($("#add_menber_style input[name='email']").length>0 && $("#add_menber_style input[name='email']").val()!='' && flag){
                                                var mobileVal = $("#add_menber_style input[name='email']").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsEmail(mobileVal)){
                                                    layer.alert("邮箱格式错误", {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            }
                                            var data = $("#addClient").serialize();
                                            if(flag){
                                                Common.ajax(Api.createClientInfo,"post",data,function (res) {
                                                    if(res.status){
                                                        layer.alert('添加成功！', {
                                                            title: '提示框',
                                                            icon: 1,
                                                        });
                                                        setTimeout(function(){
                                                            location.reload();
                                                        },1000)
                                                    }else{
                                                        layer.alert('添加失败，失败原因为：“'+res.message+'”', {
                                                            title: '提示框',
                                                            icon: 0,
                                                        });
                                                    }
                                                    // console.log(res);
                                                });
                                            }
                                        }
                                    });
                                },200);
                            }
                        });
                    },
                    //修改客户信息
                    modifyClientInfo:function(event){
                        var target = event.target || window.event.srcElement;
                        this.clientId = $(target).closest("tr").find("td").eq(1).text();
                        var url = Api.getModifyClientField+''+this.clientId;
                        Common.ajax(url,"get",{},function(res){
                            // console.log(res);
                            if(res){
                                var result = res;
                                for(var i=0;i<result.length;i++){
                                    result[i].showValue = result[i].value;
                                    if(result[i].field == "organization_id"){
                                        for(var j=0;j<result[i].data.length;j++){
                                            if(result[i].data[j].id == result[i].value){
                                                result[i].showValue = result[i].data[j].name;
                                                break;
                                            }
                                        }
                                    }
                                }
                                customer.modClientField = result;
                                setTimeout(function () {
                                    layer.open({
                                        type: 1,
                                        title: '客户信息修改&nbsp;&nbsp;&nbsp;&nbsp;(红色的为必填字段)',
                                        maxmin: true,
                                        shadeClose: true, //点击遮罩关闭层
                                        area: ['800px', ''],
                                        content: $('#modify_client_info'),
                                        btn: ['提交', '取消'],
                                        yes: function (index, layero) {
                                            //对必填字段进行非空验证
                                            var flag = true;
                                            $("#modClient .necessary").each(function(){
                                                flag = true;
                                                var val = $(this).closest("li").find("input").eq(0).val() || $(this).closest("li").find("select").val() || $(this).closest("li").find("textarea").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsNotEmpty(val)){
                                                    layer.alert($(this).text()+'：不能为空！', {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            });
                                            //对邮箱、电话号码进行格式验证
                                            if($("#modify_client_info input[name='mobile']").length>0 && $("#modify_client_info input[name='mobile']").val()!='' && flag){
                                                var mobileVal = $("#modify_client_info input[name='mobile']").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsMobile(mobileVal)){
                                                    layer.alert("手机号码格式错误", {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            }
                                            if($("#modify_client_info input[name='email']").length>0 && $("#modify_client_info input[name='email']").val()!='' && flag){
                                                var mobileVal = $("#modify_client_info input[name='email']").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsEmail(mobileVal)){
                                                    layer.alert("邮箱格式错误", {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            }
                                            var data = $("#modClient").serialize();
                                            if(flag){
                                                Common.ajax(Api.modifyClientInfo+customer.clientId,"put",data,function (res) {
                                                    if(res.status){
                                                        for(var i=0;i<customer.clientListContent.length;i++){
                                                            if(customer.clientListContent[i].id == customer.clientId){
                                                                for(var k in customer.clientListContent[i]){
                                                                    if(k != 'id'){
                                                                        var changeValue = $("#modify_client_info").find("input[name="+k+"]").val() || $("#modify_client_info").find("select[name="+k+"]").val() || $("#modify_client_info").find("textarea[name="+k+"]").val();
                                                                        customer.clientListContent[i][k] = changeValue;
                                                                        // customer.count++;
                                                                        // customer.modClientField[i][k] =
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        layer.close($("#modify_client_info").closest(".layui-layer").attr("times"));
                                                        layer.alert('修改成功！', {
                                                            title: '提示框',
                                                            icon: 1,
                                                        });
                                                        /*setTimeout(function(){
                                                            location.reload();
                                                        },1000)*/
                                                    }else{
                                                        layer.alert('修改失败，失败原因为：“'+res.message+'”', {
                                                            title: '提示框',
                                                            icon: 0,
                                                        });
                                                    }
                                                    // console.log(res);
                                                });
                                            }
                                        }
                                    });
                                },200);
                            }
                        });
                    },
                    //删除客户信息
                    deleteClientInfo:function(event){
                        var target = event.target || window.event.srcElement;
                        this.clientId = $(target).closest("tr").find("td").eq(1).text();
                        //定义一个变量保存要删除的客户的姓名
                        var customerName = '';
                        for(var i=0;i<customer.clientListContent.length;i++){
                            if(this.clientId == customer.clientListContent[i].id){
                                customerName = customer.clientListContent[i].name;
                                break;
                            }
                        }
                        layer.confirm('确定要删除客户“'+customerName+'”的信息吗？', {
                            btn: ['删除','取消'] //按钮
                        }, function(){
                            var data={
                                client_id:customer.clientId
                            };
                            Common.ajax(Api.delClientInfo,"delete",data,function(res){
                                if(res && res.status){
                                    layer.msg(res.message, {time:1000,icon: 1});
                                    if(Math.ceil((customer.pageCount-1)/customer.pageRecordCount) < customer.pageCurrent){
                                        customer.pageCurrent = customer.pageCurrent - 1;
                                    }
                                    customer.RefClientList();
                                }else{
                                    layer.msg(res.message, {time:1000,icon: 0});
                                }
                            });
                        }, function(){});
                    },
                    //批量删除客户信息
                    batchDel:function(){
                        var selectedIds = [];
                        $("#sample-table .checkbox").each(function(){
                            if($(this).prop("checked")){
                                selectedIds.push($(this).closest("tr").find("td").eq(1).text());
                            }
                        });
                        if(selectedIds.length > 0){
                            layer.confirm('确定要删除选中的“'+selectedIds.length+'”条信息吗？', {
                                btn: ['删除','取消'] //按钮
                            }, function(){
                                var delLength = selectedIds.length;
                                selectedIds = selectedIds.join(",");
                                var data={
                                    client_id:selectedIds
                                };
                                Common.ajax(Api.delClientInfo,"delete",data,function(res){
                                    if(res && res.status){
                                        layer.msg(res.message, {time:1000,icon: 1});
                                        if(Math.ceil((customer.pageCount-delLength)/customer.pageRecordCount) < customer.pageCurrent){
                                            customer.pageCurrent = customer.pageCurrent - 1;
                                        }
                                        $("#sample-table .checkbox").prop("checked",false);
                                        $("#sample-table .all-check").prop("checked",false);
                                        customer.RefClientList();
                                    }else{
                                        layer.msg(res.message, {time:1000,icon: 0});
                                    }
                                    /*setTimeout(function(){
                                        location.reload();
                                    },1000);*/
                                    // console.log(res);
                                });
                                // layer.msg('的确很重要', {icon: 1});
                            }, function(){});
                        }else{
                            layer.alert('当前没有选择用户，不能删除,请选择客户后重新尝试！', {
                                title: '提示框',
                                icon: 2,
                            });
                        }

                    },
                    //点击首页按钮触发事件
                    toStartPage:function(){
                        customer.pageCurrent = 1;
                    },
                    //上一页按钮事件
                    prevPage:function(){
                        if(customer.pageCurrent > 1){
                            customer.pageCurrent--;
                        }
                    },
                    //页面改变从而改变表格数据显示
                    changePage:function (event) {
                        var target = event.target || window.event.srcElement;
                        customer.pageCurrent = $(target).text();
                    },
                    //下一页按钮事件
                    nextPage:function(){
                        if(customer.pageCurrent < customer.pagesize){
                            $(".prev_page_btn").removeClass("disabled");
                            customer.pageCurrent++;
                        }
                    },
                    //尾页按钮事件
                    toEndPage:function(){
                        customer.pageCurrent = customer.pagesize;
                    },
                    //预约功能
                    appointment: function (event) {
                        Common.ajax(Api.appointmentFieldList+'/write',"get",{},function(res){
                            // console.log("这是预约客户登记的字段信息");
                            console.log(res);
                            if(res){
                                customer.appointmentClientList = res;
                                //将医生对应填入数组，以科室名为健值
                                for(var i=0;i<res.reservation.length;i++){
                                    if(res.reservation[i].field == 'reservation[department_id]'){
                                        customer.departmentId = res.reservation[i].data.department[0].value || '';
                                        for(var j=0;j<res.reservation[i].data.department.length;j++){
                                            var doctorlist = new Array();
                                            // var key = res.reservation[i].data.department[j].value;
                                            var id = res.reservation[i].data.department[j].id;
                                            var doctor = res.reservation[i].data.doctor;
                                            for(var k=0;k<doctor.length;k++){
                                                if(doctor[k].department_id == id){
                                                    doctorlist.push(doctor[k]);
                                                }
                                            }
                                            customer.reservationDoctor[id] = doctorlist;
                                        }
                                            break;
                                    }
                                }
                                setTimeout(function(){
                                    layer.open({
                                        type: 1,
                                        title: '客户预约信息登记&nbsp;&nbsp;&nbsp;&nbsp;(红色的为必填字段)',
                                        maxmin: true,
                                        shadeClose: true, //点击遮罩关闭层
                                        area: ['800px', ''],
                                        content: $('#add_appointment_info'),
                                        btn: ['提交', '取消'],
                                        yes: function (index, layero) {
                                            //对必填字段进行非空验证
                                            var flag = true;
                                            $("#add_appointment_info .necessary").each(function(){
                                                flag = true;
                                                var val = $(this).closest("li").find("input").eq(0).val() || $(this).closest("li").find("select").val() || $(this).closest("li").find("textarea").val();
                                                var regExp = new Common.RegExpClass();
                                                if(!regExp.IsNotEmpty(val)){
                                                    layer.alert($(this).text()+'：不能为空！', {
                                                        title: '提示框',
                                                        icon: 0,
                                                    });
                                                    flag = false;
                                                    return false;
                                                }
                                            });
                                            var data = $("#appClient").serialize();
                                            if(flag){
                                                Common.ajax(Api.createReservation,"post",data,function (res) {
                                                    if(res.status){
                                                        layer.alert('添加成功！', {
                                                            title: '提示框',
                                                            icon: 1,
                                                        });
                                                        setTimeout(function(){
                                                            location.reload();
                                                        },1000)
                                                    }else{
                                                        layer.alert('添加失败，失败原因为：“'+res.message+'”', {
                                                            title: '提示框',
                                                            icon: 0,
                                                        });
                                                    }
                                                    console.log(res);
                                                });
                                            }
                                        }
                                    });
                                },200);
                            }
                        });
                    },
                    //预约表单搜索列表选中时
                    changeSearchList:function (event) {
                        var target =event.target || window.event.srcElement;
                        var ele1 = $(target).closest(".row").find("input").eq(0);
                        var ele2 = $(target).closest(".row").find("input").eq(1);
                        // var ele3 = $(target).closest(".row").find("input").eq(2);
                        //会所搜索框传ID，其它都传name
                        // if($(ele1).attr("name") == 'organization_id'){
                            ele1.val($(target).attr("data-id"));
                        /*}else{
                            ele1.val($(target).text());
                        }*/
                        ele2.val($(target).text());
                        // ele3.val($(target).text());
                        $(target).closest("ul").hide();
                    },
                    //判定选中全选
                    changeCheckbox:function (event) {
                        var target = event.target || window.event.srcElement;
                        if($(target).hasClass("all-check")){
                            if($(target).prop("checked")){
                                $("#sample-table .checkbox").prop("checked",true);
                            }else{
                                $("#sample-table .checkbox").prop("checked",false);
                            }
                        }else{
                            if($(".checkbox").length == $("#sample-table input[type='checkbox']:checked").not(".all-check").length){
                                $(".all-check").prop("checked",true);
                            }else{
                                $(".all-check").prop("checked",false);
                            }
                        }
                    },
                    //预约表单搜索
                    changeSearch:function (event) {
                        var target = event.target || window.event.srcElement;
                        var searchVal = '';
                        searchVal = $(target).val();
                        /*}else */if($(target).hasClass("search-btn")){
                            searchVal = $(target).closest("div").find("input").eq(1).val();
                        }
                        var searchInfo = [];
                        var k = $(target).closest("div").find("input").eq(1).attr("data-index");
                        var data = this.appointmentClientList.reservation;
                        data[k].showLength = 0;
                        for(var i=0;i<data[k].data.length;i++){
                            data[k].data[i].show = false;
                            if(data[k].data[i].value.indexOf(searchVal) != -1 || data[k].data[i].value_pinyin.indexOf(searchVal) != -1){
                                var obj = {};
                                obj.id = data[k].data[i].client_id;
                                obj.name = data[k].data[i].value;
                                obj.name_pinyin = data[k].data[i].value_pinyin;
                                obj.show = true;
                                data[k].data[i].show = true;
                                $(target).closest(".row").find("ul").show();
                                data[k].showLength++;
                                this.flag = true;
                            }
                            this.count ++;
                        }
                    },
                    cancelAppointment: function (event) {
                        var obj = event.target || window.event.srcElement;
                        layer.confirm('确认要取消预约吗？', function () {
                            $(obj).text('预约');
                            $(obj).closest("tr").find(".td-status span").text("未预约");
                            $(obj).closest("tr").find(".td-status span").removeClass("label-success");
                            $(obj).closest("tr").find(".td-status span").addClass("label-default");
                            // customer.state = "未预约";
                            layer.msg('已取消预约!', {icon: 5, time: 1000});
                        });
                    },
                    //顶部搜索栏搜索按钮点击
                    searchKeyword:function(){
                        this.pageCurrent = 1;
                        this.RefClientList();
                    },
                    //刷新加载列表公用方法
                    RefClientList:function(){
                        var data={
                            page_record_count:customer.pageRecordCount,
                            current_page:customer.pageCurrent,
                            keyword:customer.keyword
                        }
                        //获取页面列表
                        Common.ajax(Api.getClientList,"get",data,function(res){
                            if(res && res.title){
                                customer.pageCount = res.count;
                                customer.pagesize = Math.ceil(res.count/customer.pageRecordCount);
                                customer.clientListTitle = res.title;
                                customer.clientListContent = res.data;
                            }
                            // console.log(res);
                        });
                    },
                    //跳转至详情页
                    goDetailPage:function (event) {
                        var target = event.target || window.event.srcElement;
                        var address = location.href;
                        var replaceAddress = "detail/"+$(target).parents("tr").find("td").eq(1).text();
                        address = address.replace("manage",replaceAddress);
                        location.href = address;
                    },
                }
            })
            customer.RefClientList();
            /**
             * 监测科室变更
             */
            /*customer.$watch("departmentId", function (value) {
                console.log(value);
            });*/
            /**
             * 监测活动页变动
             */
            customer.$watch("pageCurrent", function (value) {
                customer.RefClientList();
            });
            /**
             * 监测每页多少条记录数变动
             */
            customer.$watch("pageRecordCount", function (value) {
                customer.pageCurrent =1;
                customer.RefClientList();
            });
        },
        //视图函数
        view: function () {
            var oTable1 = $('#sample-table').dataTable({
                "aaSorting": [[1, "desc"]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable": false, "aTargets": [0, 2, 3, 4, 5, 8, 9]}// 制定列不参与排序
                ]
            });
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                var w2 = $source.width();

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }
        }
    }
    Client.init();
});