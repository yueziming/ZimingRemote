/**
 * Created by yueziming on 2017-8-28.
 */
$(function () {
    //定义全局变量选中列
    var $selectRow;
    //判定是执行单个保存还是批量保存
    var flag = 0;
    //判断是执行单个更新还是批量更新
    var updateFlag = 0;
    //判断是执行单个还是批量取消审核
    var cancelCheckFlag = 0;
    // 开始时间
    laydate({
        elem   :'#start',
        event  :'focus',
        isclear:false, //是否显示清空
        istoday:false, //是否显示今天
        issure :false, //是否显示确认
        choose :function(datas){ //选择日期完毕的回调
            console.log(datas);
        }
    });
    // 结束时间
    laydate({
        elem   :'#end',
        event  :'focus',
        isclear:false, //是否显示清空
        istoday:false, //是否显示今天
        issure :false, //是否显示确认
        // format :'YYYY-MM-DD hh:mm:ss', // 日期格式
        choose :function(datas){ //选择日期完毕的回调
            console.log(datas);
        }
    });
    //操作时间
    /*laydate({
        elem   :'.operationTime',
        event  :'focus',
        isclear:false, //是否显示清空
        istoday:false, //是否显示今天
        issure :false, //是否显示确认
        choose :function(datas){ //选择日期完毕的回调
            console.log(datas);
        }
    });*/
    //监测金额输入框小数点数不能超过2位  var reg = /^\d{0,8}\.{0,1}(\d{1,2})?$/;
    $(".price-check").blur(function () {
        var reg = /^\d{0,8}\.{0,1}(\d{1,2})?$/;
        var val =  $(this).val();
        if(val && !reg.test(val)) {
            $("#warmingDialog .message").text("请输入2位小数的正确格式金额，且不要超过2位数！");
            $("#warmingDialog").modal("show");
        }
    });
    //类型下拉点击改变
    $(".select-type a").on("click", function(){
        $("#selectType").val($(this).attr("data-id"));
        $("#typeShow").find(".text").text($(this).text());
    });
    $(".select-client-type a").on("click", function(){
        $("#selectClientType").val($(this).attr("data-id"));
        $("#clientTypeShow").find(".text").text($(this).text());
    });
    //全选取消全选
    $(".checkbox-btn").on("click",function(){
        if($.trim($(this).text()) === "全选"){
            $(".item-check").prop("checked",true);
            $(this).find(".select-text").text("取消全选");
        }else{
            $(".item-check").prop("checked",false);
            $(this).find(".select-text").text("全选");
        }
    });
    //根据比例更新数据
    $('#setting-save-btn').on('click', function(){
        compute();
    });
    //下拉列表比例改变时触发
    $(".proportion select").on("change", function(){
        var fwk_type = "";
        for(var i in Formula.PROPORTION_TABLE){
            if(i === $(this).val()){
                fwk_type = i;
                break;
            }
        }
        var receipt_price       = $(this).closest("tr").find('td.receipt-price').attr('data-price');
        var incidental_expenses = $(this).closest("tr").find('td.receipt-price').attr('data-incident-price');
        var share               = $(this).closest("tr").find('td.receipt-price').attr('data-share');
        incidental_expenses     = parseFloat(incidental_expenses).toFixed(2);
        var fee                 = parseFloat($('#fee').val());
        $(this).closest("tr").find('td.club-achievement input').val(
            Formula.getAchievement(receipt_price, fee, incidental_expenses, fwk_type, 'club')
        );
        $(this).closest("tr").find('.clubFee').val(
            Formula.getFee(receipt_price, fee, incidental_expenses, fwk_type, 'club')
        );
        if(share == 1){
            $(this).closest("tr").find('td.organization-achievement input').val(
                Formula.getAchievement(receipt_price, fee, incidental_expenses, fwk_type, 'organization')/2
            );
            $(this).closest("tr").find('.organizationFee').val(
                Formula.getFee(receipt_price, fee, incidental_expenses, fwk_type, 'organization')/2
            );
        }else{
            $(this).closest("tr").find('td.organization-achievement input').val(
                Formula.getAchievement(receipt_price, fee, incidental_expenses, fwk_type, 'organization')
            );
            $(this).closest("tr").find('.organizationFee').val(
                Formula.getFee(receipt_price, fee, incidental_expenses, fwk_type, 'organization')
            );
        }
    });
    //点击保存按钮
    $(".btn-save").on("click", function(){
        flag       = 0;
        $selectRow = $(this).closest("tr");
        $("#sureDialog .message").text("确定复核当前单据吗？");
        $("#sureDialog").modal("show");
    });
    //批量保存按钮
    $("#batchSave").on("click", function(){
        if($(".item-check:checked").length === 0){
            $("#warmingDialog .message").text("当前没有选中任何数据，请在左边选中数据后再进行操作");
            $("#warmingDialog").modal("show");
        }else{
            flag = 1;
            $("#sureDialog .message").text("确认复核所选的复核单吗？");
            $("#sureDialog").modal("show");
        }
    });
    //消息警告框确认按钮
    $(".sure-cancel-btn").on("click", function(){
        $("#warmingDialog").modal("hide");
    });
    /**
     * 复核操作
     */
    //确认保存按钮点击
    $(".sure-save-btn").on("click", function(){
        /*var reg = /^\d{0,8}\.{0,1}(\d{1,2})?$/;
         $.each($(this).closest("section").find(".price-check"),function () {
         var val =  $(this).val();
         if(val && !reg.test(val)) {
         $("#warmingDialog .message").text("请输入2位小数的正确格式金额，且不要超过2位数！");
         $("#warmingDialog").modal("show");
         flag =2;
         return false;
         }
         });*/
        if(flag == 0){
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :{
                    requestType            :"save",
                    clubFee                :$selectRow.find(".clubFee").val(),
                    organizationFee        :$selectRow.find(".organizationFee").val(),
                    fee                    :$selectRow.find(".fee").val(),
                    share                  :$selectRow.find(".share").val(),
                    fwkID                  :$selectRow.find(".item-check").attr("data-id"),
                    code                   :$selectRow.find("td.code").text(),
                    divisionProportion     :$selectRow.find(".proportion select").val(),
                    clubAchievement        :$selectRow.find(".club-achievement input").val(),
                    organizationAchievement:$selectRow.find(".organization-achievement input").val(),
                    clientType             :$selectRow.find(".clientType").val(),
                    price                  :$selectRow.find(".receipt-price input[name='price']").val(),
                    operationTime          :$selectRow.find(".operationTime").val()
                },
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    if(res){
                        $("#warmingDialog .message").text(res.message);
                        $("#warmingDialog").modal("show");
                        $("#sureDialog").modal("hide");
                        if(res.status ==1){
                            setTimeout(function () {
                                location.reload();
                            },2000)
                        }
                    }
                    console.log(res)
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                }
            })
        }else if(flag==1){
            var saveData = {
                requestType            :"batch_save",
                fwkID                  :[],
                code                   :[],
                divisionProportion     :[],
                clubAchievement        :[],
                organizationAchievement:[],
                clientType             :[],
                clubFee                :[],
                organizationFee        :[],
                fee                    :[],
                share                  :[],
                price                  :[],
                operationTime          :[]
            };
            $.each($(".item-check:checked"), function(){
                saveData.clubFee.push($(this).closest("tr").find(".clubFee").val());
                saveData.organizationFee.push($(this).closest("tr").find(".organizationFee").val());
                saveData.fee.push($(this).closest("tr").find(".fee").val());
                saveData.share.push($(this).closest("tr").find(".share").val());
                saveData.fwkID.push($(this).attr("data-id"));
                saveData.code.push($(this).closest("tr").find("td.code").text());
                saveData.divisionProportion.push($(this).closest("tr").find(".proportion select").val());
                saveData.clubAchievement.push($(this).closest("tr").find(".club-achievement input").val());
                saveData.organizationAchievement.push($(this).closest("tr").find(".organization-achievement input").val());
                saveData.clientType.push($(this).closest("tr").find(".clientType").val());
                saveData.price.push($(this).closest("tr").find(".receipt-price input[name='price']").val());
                saveData.operationTime.push($(this).closest("tr").find(".operationTime").val());
                //                        console.log()
            });
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :saveData,
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text(res.message);
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                    if(res.status ==1){
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                }
            })
        }else{

        }
    });
    //更新数据
    $(".updateDB").on("click",function () {
        updateFlag = 0;
        $selectRow = $(this).closest("tr");
        var $dialog = $('#updateSureDialog');
        $dialog.find("p.batch").addClass('hide');
        $dialog.find("p.single").removeClass('hide');
        $dialog.modal("show");
    });
    //批量更新数据
    $("#batchUpdate").on("click",function () {
        updateFlag = 1;
        var $dialog = $('#updateSureDialog');
        $dialog.find("p.single").addClass('hide');
        $dialog.find("p.batch").removeClass('hide');
        $dialog.modal("show");
    });
    $(".sure-update-btn").on("click",function () {
        $("#updateSureDialog").modal("hide");
        if(updateFlag ==1){
            var updateData = {
                startTime:$("#start").val(),
                endTime:$("#end").val(),
                fwkID:[],
                requestType:"update"
            };
            if($(".item-check:checked").length>0){
                $.each($(".item-check:checked"), function(){
                    updateData.fwkID.push($(this).closest("tr").find(".updateDB").attr("data-id"));
                });
            }
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :updateData,
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text(res.message);
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                    if(res.status ==1){
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                }
            })
        }else{
            var updateData = {
                fwkID:[],
                requestType:"update"
            };
            updateData.fwkID.push($selectRow.find(".item-check").attr("data-id"));
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :updateData,
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text(res.message);
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                    if(res.status ==1){
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                    $("#sureDialog").modal("hide");
                }
            })
        }
    });
    /**
     * 取消复核
     */
    //取消复核按钮点击
    $(".btn-cancel-check").on("click",function(){
        cancelCheckFlag = 0;
        $selectRow = $(this).closest("tr");
        $("#cancelCheckDialog .message").text("确定要取消审核吗？");
        $("#cancelCheckDialog").modal("show");
    });
    //批量取消复核按钮点击
    $("#batchCancel").on("click",function () {
        if($(".item-check:checked").length === 0){
            $("#warmingDialog .message").text("当前没有选中任何数据，请在左边选中数据后再进行操作");
            $("#warmingDialog").modal("show");
        }else{
            cancelCheckFlag = 1;
            $("#cancelCheckDialog .message").text("确定要取消审核吗？");
            $("#cancelCheckDialog").modal("show");
        }
    });
    //取消复核弹框点击确定
    $("#cancelCheckDialog .sure-cancel-btn").on("click",function () {
        $("#cancelCheckDialog").modal("hide");
        if(cancelCheckFlag == 0){
            var unCheckData = {
                requestType:"cancel",
                fwkID:[],
                id:[]
            }
            unCheckData.fwkID.push($selectRow.find(".item-check").attr("data-id"));
            unCheckData.id.push($selectRow.find(".item-check").attr("data-check1-id"));
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :unCheckData,
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text(res.message);
                    $("#warmingDialog").modal("show");
                    if(res.status ==1){
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                }
            })
        }else{
            var unCheckData = {
                requestType:"cancel",
                fwkID:[],
                id:[]
            }
            $.each($(".item-check:checked"), function(){
                unCheckData.fwkID.push($(this).closest("tr").find(".item-check").attr("data-id"));
                unCheckData.id.push($(this).closest("tr").find(".item-check").attr("data-check1-id"));
            });
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :unCheckData,
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text(res.message);
                    $("#warmingDialog").modal("show");
                    if(res.status ==1){
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },
                error   :function(){
                    Common.ajaxLoadingStop();
                    $("#warmingDialog .message").text("网络异常");
                    $("#warmingDialog").modal("show");
                }
            })
        }
    })
    /**
     * 点击单元格更新详细信息等选项卡
     */
    $(".select-td").on("click",function () {
        //选中行高亮显示
        $(".content-table tr").removeClass("selected-tr");
        $(this).closest("tr").addClass("selected-tr");
        var dataVAC01 = $(this).closest("tr").find(".item-check").attr("data-vac01");
        var dataID = $(this).closest("tr").find(".item-check").attr("data-id");
        var dataCheckid = $(this).closest("tr").find(".item-check").attr("data-check1-id");
        var serviceSrc = $("#serviceCard iframe").attr("data-src-temp");
        if(serviceSrc){
            serviceSrc = serviceSrc.replace("_VAC01_",dataVAC01);
            serviceSrc = serviceSrc.replace("_ID_",dataID);
        }
        $("#serviceCard iframe").attr("src",serviceSrc);
        var checkFormSrc = $("#checkForm iframe").attr("data-src-temp");
        if(checkFormSrc){
            checkFormSrc = checkFormSrc.replace("_CHECK1_ID_",dataCheckid);
            $("#checkForm iframe").attr("src",checkFormSrc);
        }
        //更新详细信息选项卡
        //时间
        var $element = $(this).parent("tr");
        $(".detailTime").text($element.find(".select-td").eq(1).text());
        //状态
        $(".detailStatus").text($element.find(".status").text());
        //服务卡号
        $(".detailServiceCard").text($element.find(".code").text());
        //服务卡类型
        $(".detailServiceType").text($element.find(".fwk-type").text());
        //客户姓名
        $(".detailClientName").text($element.find(".client-name").text());
        //会所名称
        $(".detailClub").text($element.find("input[data-name='会所']").val());
        //顾客来源
        $(".detailClientSource").text($element.find("input[data-name='客户来源']").val());
        //开拓顾问
        $(".detailDevelop").text($element.find("input[data-name='开拓顾问']").val());
        //咨询顾问
        $(".detailConsult").text($element.find("input[data-name='咨询顾问']").val());
        //服务顾问
        $(".detailService").text($element.find("input[data-name='服务顾问']").val());
        //服务地址
        $(".detailServiceAddress").text($element.find("input[data-name='服务地址']").val());
        //操作专家
        $(".detailOperate").text($element.find("input[data-name='操作专家']").val());
        //团队
        $(".detailTeam").text($element.find("input[data-name='团队']").val());
        //会所手续费
        $(".detailClubFee").text($element.find("input[data-name='会所手续费']").val());
        //机构手续费
        $(".detailOrgFee").text($element.find("input[data-name='机构手续费']").val());
        //加盟款
        // $(".detailJoin").text($element.find("input[data-name='加盟款']").val());
        //实收金额
        var DetailReceivedAcount = $element.find(".receipt-price input[name='price']").val() || $element.find(".receipt-price").attr("data-price");
        $(".detailReceivedAcount").text(DetailReceivedAcount);
        //分成比例
        var DetailFee = $element.find(".receipt-price select").val() || $element.find(".receipt-price span").eq(1).text();
        $(".detailFee").text(DetailFee);
        //会所业绩
        var ClubAchievement = $element.find(".club-achievement input").val() || $element.find(".club-achievement span").text();
        $(".detailClubAchievement").text(ClubAchievement);
        //机构业绩
        var OrgAchievement = $element.find(".organization-achievement input").val() || $element.find(".organization-achievement span").text();
        $(".detailOrgAchievement").text(OrgAchievement);
        /**
         * 这里获取支付方式，从中抽取会所、机构、其它收款
         */
        var payType = JSON.parse($element.find("input[data-name='支付方式']").val());
        //会所收款
        $(".detailClubCollections").empty();
        for(var i=0;i<payType.club.length;i++){
            var str = "<span class='price-tag' data-id='"+payType.club[i].id+"'>"+payType.club[i].name+"："+payType.club[i].price+"<span>";
            $(".detailClubCollections").append(str);
        }
        //机构收款
        $(".detailOrgCollections").empty();
        for(var j=0;j<payType.organization.length;j++){
            var str = "<span class='price-tag' data-id='"+payType.organization[j].id+"'>"+payType.organization[j].name+"："+payType.organization[j].price+"<span>";
            $(".detailOrgCollections").append(str);
        }
        //其它收款
        $(".detailOtherCollections").empty();
        for(var k=0;k<payType.other.length;k++){
            var str = "<span class='price-tag' data-id='"+payType.other[k].id+"'>"+payType.other[k].name+"："+payType.other[k].price+"<span>";
            $(".detailOtherCollections").append(str);
        }
        // $(".detailOtherCollections").text(payType.other);
    });
    /*//点击展开收缩
    $(".kdr_icon").on("click",function () {
        if($(this).hasClass("glyphicon-plus")){
            $(this).closest("tr").find("section").css("display","block");
            $(this).removeClass("glyphicon-plus");
            $(this).addClass("glyphicon-minus");
        }else{
            $(this).closest("tr").find("section").css("display","none");
            $(this).removeClass("glyphicon-minus");
            $(this).addClass("glyphicon-plus");
        }
    });*/
});
function compute(){
    $('.proportion').each(function(){
        var fwk_type            = $(this).closest("tr").find('td.fwk-type').attr('data-code');
        var receipt_price       = $(this).closest("tr").find('.receipt-price').attr('data-price');
        var incidental_expenses = $(this).closest("tr").find('.receipt-price').attr('data-incident-price');
        incidental_expenses     = parseFloat(incidental_expenses).toFixed(2);
        var fee                 = parseFloat($('#fee').val());
        var proportion_type     = Formula.FWK_PROPORTION_RELATION_TABLE[fwk_type];
        $(this).closest("tr").find('td.proportion>select').val(proportion_type);
        $(this).closest("tr").find('td.proportion>span').text(proportion_type);
        $(this).closest("tr").find('td.club-achievement input').val(
            Formula.getAchievement(receipt_price, fee, incidental_expenses, proportion_type, 'club')
        );
        $(this).closest("tr").find('td.organization-achievement input').val(
            Formula.getAchievement(receipt_price, fee, incidental_expenses, proportion_type, 'organization')
        );
    })
}
var Formula = {
    FWK_PROPORTION_RELATION_TABLE:{
        0:'5:5', // 医美服务卡
        1:'4:6', // 纹绣服务卡
        2:'0:0', // 订金服务卡
        3:'5:5', // 大健康服务卡
        4:'0:0' // 退费服务卡
    },
    PROPORTION_TABLE             :{
        '9:1':{
            club        :9,
            organization:1
        },
        '8:2':{
            club        :8,
            organization:2
        },
        '7:3':{
            club        :7,
            organization:3
        },
        '6:4':{
            club        :6,
            organization:4
        },
        '5:5':{
            club        :5,
            organization:5
        },
        '4:6':{
            club        :4,
            organization:6
        },
        '3:7':{
            club        :3,
            organization:7
        },
        '2:8':{
            club        :2,
            organization:8
        },
        '1:9':{
            club        :1,
            organization:9
        },
        '0:0':{
            club        :0,
            organization:0
        }
    },
    getFee                       :function(receipt_price, fee, incidental_expenses, index, type){
        if(type !== 'club' && type !== 'organization') return 0;
        if(index === '0:0'){
            return 0;
        }else{
            var proportion = this.PROPORTION_TABLE[index];
            // （XX）业绩计算公式： 实收金额*(1-手续费比例)/(会所分成+机构分成)*（XX）分成
            // （XX）可为会所、机构
            return parseFloat((receipt_price-incidental_expenses)*(fee)/(proportion.club+proportion.organization)*proportion[type]).toFixed(2);
        }
    },
    /**
     *
     * @param receipt_price 实收金额
     * @param fee 手续费比例
     * @param incidental_expenses 杂费总和
     * @param index 索引值
     * @param type 会所/机构（分成类别）
     * @returns {*}
     */
    getAchievement               :function(receipt_price, fee, incidental_expenses, index, type){
        if(type !== 'club' && type !== 'organization') return 0;
        if(index === '0:0'){
            return 0;
        }else{
            var proportion = this.PROPORTION_TABLE[index];
            // （XX）业绩计算公式： 实收金额*(1-手续费比例)/(会所分成+机构分成)*（XX）分成
            // （XX）可为会所、机构
            return parseFloat((receipt_price-incidental_expenses)*(1-fee)/(proportion.club+proportion.organization)*proportion[type]).toFixed(2);
        }
    }
};