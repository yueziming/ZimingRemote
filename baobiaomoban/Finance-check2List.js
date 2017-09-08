/**
 * Created by yueziming on 2017-8-30.
 */
$(function(){
    //定义全局变量选中列
    var $selectRow;
    //判定是执行单个保存还是批量保存
    var flag = 0;
    //判断是执行单个还是批量oa工作流
    var flagOa =0;
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
        choose :function(datas){ //选择日期完毕的回调
            console.log(datas);
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
    $(".select-status a").on("click",function () {
        $("#oaStatusType").val($(this).attr("data-id"));
        $("#oaStatusShow").find(".text").text($(this).text());
    });
    /**
     * 生成OA工作流
     */
    $(".btn-oa-check").on("click",function () {
        flagOa = 0;
        $selectRow = $(this).closest("tr");
        $("#sureOaDialog .message").text("确定生成OA工作流吗？");
        $("#sureOaDialog").modal("show");
    });
    $("#batchOaBtn").on("click",function () {
        if($(".item-check:checked").length === 0){
            $("#warmingDialog .message").text("当前没有选中任何数据，请在左边选中数据后再进行操作");
            $("#warmingDialog").modal("show");
        }else{
            flagOa = 1;
            $("#sureOaDialog .message").text("确认审核所选的复核单吗？");
            $("#sureOaDialog").modal("show");
        }
    });
    /**
     * 生成工作流操作
     */
    $(".sure-oa-btn").on("click", function(){
        $("#sureOaDialog").modal("hide");
        if(flagOa == 0){
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :{
                    requestType            :"new_oa",
                    id                     :$selectRow.find(".item-check").attr("data-check1-id"),
                },
                dataType:"json",
                success :function(res){
                    Common.ajaxLoadingStop();
                    if(res){
                        $("#warmingDialog .message").text(res.message);
                        $("#warmingDialog").modal("show");
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
                }
            })
        }else{
            var saveData = {
                requestType            :"new_oa",
                id                     :[]
            };
            $.each($(".item-check:checked"), function(){
                saveData.id.push($(this).attr("data-check1-id"));
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
        }
    });
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
            $("#serviceCard iframe").attr("src",serviceSrc);
        }
        var checkFormSrc = $("#checkForm iframe").attr("data-src-temp");
        if(checkFormSrc){
            checkFormSrc = checkFormSrc.replace("_CHECK1_ID_",dataCheckid);
            $("#checkForm iframe").attr("src",checkFormSrc);
        }
        var dataFrameSrc = $("#detailDatabase iframe").attr("data-src-temp");
        if(dataFrameSrc){
            dataFrameSrc = dataFrameSrc.replace("_CHECK1_ID_",dataCheckid);
            $("#detailDatabase iframe").attr("src",dataFrameSrc);
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
        /**
         * 这里从后台获取OA流程
         */
        if($.trim($element.find(".oa-id").text()) !=""){
            var oaId = $.trim($element.find(".oa-id").text());
            $.ajax({
                // url:location.origin+"/bpm/flow-process-5-"+$.trim($element.find(".oa-id").text()),
                url:"http://192.168.0.70:7891/bpm/flow-process-5-"+oaId,
                dataType:"json",
                type:"get",
                data:{},
                success:function (res) {
                    if(res && res.status){
                        console.log(res);
                        //清空原来的内容
                        $(".oa-content").empty();
                        //设置流程标题
                        $("#oaMap .oa-title span").text("流程开始：流水号（"+oaId+"）");
                        if(res.data.run_process_info && res.data.run_process_info.process){
                            var  process = res.data.run_process_info.process;
                            for(var i=0; i<process.length;i++){
                                if(process[i].DATA){
                                    var html = '<div class="oa-group-map">'+
                                        '<figure class="my-figure">'+
                                        '<div class="oa-manage"></div>'+
                                        '<figcaption class="my-figcaption">'+
                                        '<ul style="list-style: none;margin: 0;padding: 0;">'+
                                        '<li> 第<span class="prcs-id">'+process[i].PRCS_ID+'</span>步</li>'+
                                        '<li> '+process[i].PRCS_NAME+'</li>'+
                                        '<li>'+process[i].DATA.USER_NAME+'：&nbsp;'+process[i].DATA.IS_HOST+'</li>'+
                                        '<li class="ellipsis" title="'+process[i].DATA.PROCESS_FLAG+'，用时：'+process[i].DATA.DIFF_TIME+'"> 【'+process[i].DATA.PROCESS_FLAG+'，用时：'+process[i].DATA.DIFF_TIME+'】</li>'+
                                        // '<li>  时限24小时，超时2天5小时 </li>'+
                                        '<li> 开始于：'+process[i].DATA.START_TIME+'</li>'+
                                        '<li> 结束于：'+process[i].DATA.END_TIME+'</li>'+
                                        '</ul>'+
                                        '</figcaption>'+
                                        '</figure>'+
                                        '<div class="oa-to"><span class="oa-to-image"></span></div>'+
                                        '</div>';
                                }else{
                                    var html = '<div class="oa-group-map">'+
                                        '<figure class="my-figure">'+
                                        '<div class="oa-manage"></div>'+
                                        '<figcaption class="my-figcaption">'+
                                        '<ul style="list-style: none;margin: 0;padding: 0;">'+
                                        '<li> 第<span class="prcs-id">'+process[i].PRCS_ID+'</span>步</li>'+
                                        '<li> '+process[i].PRCS_NAME+'</li>'+
                                        '<li> &nbsp;</li>'+
                                        '<li> &nbsp;</li>'+
                                        // '<li> &nbsp;</li>'+
                                        '<li> &nbsp;</li>'+
                                        '<li> &nbsp;</li>'+
                                        '</ul>'+
                                        '</figcaption>'+
                                        '</figure>'+
                                        '<div class="oa-to"><span class="oa-to-image"></span></div>'+
                                        '</div>';
                                }
                                $(".oa-content").append(html);
                            }
                            $(".oa-content .oa-group-map").eq(process.length-1).find(".oa-to").hide();
                        }
                    }
                },
                error:function () {
                    console.log("网络异常");
                }
            })
        }else{
            //清空原来的内容
            $(".oa-content").empty();
        }
        // $(".detailOtherCollections").text(payType.other);
    });
    /**
     * 审核表单
     */
    //点击审核按钮
    $(".btn-save").on("click", function(){
        flag       = 0;
        $selectRow = $(this).closest("tr");
        $("#sureDialog .message").text("确定审核当前单据吗？");
        $("#sureDialog").modal("show");
    });
    //批量审核按钮
    $("#batchSave").on("click", function(){
        if($(".item-check:checked").length === 0){
            $("#warmingDialog .message").text("当前没有选中任何数据，请在左边选中数据后再进行操作");
            $("#warmingDialog").modal("show");
        }else{
            flag = 1;
            $("#sureDialog .message").text("确认审核所选的复核单吗？");
            $("#sureDialog").modal("show");
        }
    });
    //审核操作
    $(".sure-save-btn").on("click", function(){
        if(flag == 0){
            Common.ajaxLoading();
            $.ajax({
                url     :location.href,
                type    :"post",
                data    :{
                    requestType            :"save",
                    joinFee                :$selectRow.find(".join-fee").val(),
                    check2Comment          :$selectRow.find(".comment textarea").val(),
                    id                     :$selectRow.find(".item-check").attr("data-check1-id"),
                    fwkID                  :$selectRow.find(".item-check").attr("data-id"),
                    joinBalance            :$selectRow.find(".join-balance").val()
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
                joinFee                :[],
                check2Comment          :[],
                id                     :[],
                fwkID                  :[],
                joinBalance            :[]
            };
            $.each($(".item-check:checked"), function(){
                saveData.joinFee.push($(this).closest("tr").find(".join-fee").val());
                saveData.check2Comment.push($(this).closest("tr").find(".comment textarea").val());
                saveData.id.push($(this).attr("data-check1-id"));
                saveData.fwkID.push($(this).attr("data-id"));
                saveData.joinBalance.push($(this).closest("tr").find(".join-balance").val())
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
});