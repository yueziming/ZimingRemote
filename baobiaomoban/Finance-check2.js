/**
 * Created by yueziming on 2017-8-31.
 */
// $('.context').contextmenu();
//屏蔽浏览器右键菜单
document.oncontextmenu = function(){
    return false;
}
$(function(){
    //定义全局变量选中行
    var $selectRow;
    //定义增加的备注数组
    var commentArray = [];
    //定义一个计数器ID
    var cId          = 0;
    //按下鼠标
    $("tbody").delegate(".comment-td", "mousedown", function(e){
        if($("body").attr("data-status") == 1){
            return false;
        }else{
            $selectRow = $(this).parent("tr");
            var key    = e.which; //获取鼠标键位
            if(key == 3)  //(1:代表左键； 2:代表中键； 3:代表右键)
            {
                //获取右键点击坐标
                var x = e.clientX;
                var y = e.clientY;
                // alert("点击了鼠标右键");
                $("#rightMenu").show().css({left:x, top:y});
            }
        }
    });
    //点击任意部位隐藏
    $(document).click(function(){
        $("#rightMenu").hide();
    });
    /**
     * 增加备注
     */
    //右键菜单--增加按钮点击
    $("#addComment").on("click", function(){
        $("#addModal").modal("show");
        // $("#addtipsModal").modal("show");
    });
    //确定增加备注
    // $("#addtipsModal .btn-sure").on("click",function () {
    //     $("#addtipsModal").modal("hide");
    //     $("#addModal").modal("show");
    // });
    //增加备注
    $("#addCommentBtn").on("click", function(){
        var commentName  = $("#addModal .name").val();
        var commentPrice = $("#addModal .price").val();
        var priceType    = $("#addModal .price-type:checked").val();
        // var price = 55;
        reg              = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
        if($.trim(commentName) == ''){
            $("#tipsModal .message").text("名称不能为空，请重新填写");
            $("#tipsModal").modal("show");
            return false;
        }
        if(!reg.test(commentPrice)){
            $("#tipsModal .message").text("金额格式不正确，请填写正确金额");
            $("#tipsModal").modal("show");
            return false;
        }
        if(priceType === undefined){
            $("#tipsModal .message").text("请选择是增款还是扣款");
            $("#tipsModal").modal("show");
            return false;
        }
        cId++;
        commentArray.push({
            name :commentName,
            price:commentPrice,
            type:priceType,
            cid:cId
        });
        if(priceType == 0){
            commentPrice = "-"+commentPrice;
        }else if(priceType == 1){
            commentPrice = "+"+commentPrice;
        }
        $(".get-fee").parent("tr").before("<tr><td colspan='3' class='comment-td'></td><td colspan='7' class='comment-td' data-id='"+cId+"'>"+commentName+"</td><td class='comment-td my-td' data-type='"+priceType+"'>"+commentPrice+"</td><td colspan='2' class='comment-td'>"+Arabia_to_Chinese(commentPrice)+"</td></tr>");
        calPay();
        $("#tipsModal .message").text("增加成功！");
        $("#addModal").modal("hide");
        $("#tipsModal").modal("show");
        // $("#addCommentForm").serialize();
    });
    /**
     * 修改备注
     */
    //右键菜单--修改按钮点击
    $("#editComment").on("click", function(){
        $("#edittipsModal").modal("show");
        // $("#modModal input[name='name']").val($selectRow.find("td").eq(2).text());
    });
    //确定修改备注
    $("#edittipsModal .btn-sure").on("click", function(){
        $("#edittipsModal").modal("hide");
        if($selectRow.hasClass("no-del")){
            $("#tipsModal .message").text("固定行不能被直接编辑");
            $("#tipsModal").modal("show");
            return false;
        }
        $("#modModal .name").val($selectRow.find("td").eq(1).text());
        $("#modModal .price").val($selectRow.find("td").eq(2).text().replace("-","").replace("+",""));
        $("#modModal .cid").val($selectRow.find("td").eq(1).attr("data-id"));
        var type = $selectRow.find("td").eq(2).attr("data-type");
        if(type == 0){
            $("#modModal .price-type").eq(0).prop("checked", true);
            $("#modModal .price-type").eq(1).prop("checked", false);
            $("#modModal .price-type").eq(2).prop("checked", false);
        }else if(type == 1){
            $("#modModal .price-type").eq(0).prop("checked", false);
            $("#modModal .price-type").eq(1).prop("checked", true);
            $("#modModal .price-type").eq(2).prop("checked", false);
        }else if(type == 2){
            $("#modModal .price-type").eq(0).prop("checked", false);
            $("#modModal .price-type").eq(1).prop("checked", false);
            $("#modModal .price-type").eq(2).prop("checked", true);
        }else{
            $("#modModal .price-type").eq(0).prop("checked", false);
            $("#modModal .price-type").eq(1).prop("checked", false);
            $("#modModal .price-type").eq(2).prop("checked", false);
        }
        $("#modModal").modal("show");
    });
    //修改备注
    $("#modCommentBtn").on("click", function(){
        var commentName  = $("#modModal .name").val();
        var commentPrice = $("#modModal .price").val();
        var priceType    = $("#modModal .price-type:checked").val();
        reg              = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
        if($.trim(commentName) == ''){
            $("#tipsModal .message").text("名称不能为空，请重新填写");
            $("#tipsModal").modal("show");
            return false;
        }
        if(!reg.test(commentPrice)){
            $("#tipsModal .message").text("金额格式不正确，请填写正确金额");
            $("#tipsModal").modal("show");
            return false;
        }
        if(priceType === undefined){
            $("#tipsModal .message").text("请选择是增款还是扣款");
            $("#tipsModal").modal("show");
            return false;
        }
        for(var i = 0; i<commentArray.length; i++){
            if(commentArray[i].cid == $("#modCommentForm .cid").val()){
                commentArray[i].name  = commentName;
                commentArray[i].price = commentPrice;
                commentArray[i].type  = priceType;
                break;
            }
        }
        if(priceType == 0){
            commentPrice = "-"+commentPrice;
        }else if(priceType == 1){
            commentPrice = "+"+commentPrice;
        }
        $selectRow.find("td").eq(1).text(commentName);
        $selectRow.find("td").eq(2).text(commentPrice);
        $selectRow.find("td").eq(3).text(Arabia_to_Chinese(commentPrice));
        $selectRow.find("td").eq(2).attr("data-type", priceType);
        $("#tipsModal .message").text("修改成功！");
        calPay();
        $("#tipsModal").modal("show");
        $("#modModal").modal("hide");
        // $("#modCommentForm").serialize();
    });
    /**
     * 删除备注
     */
    //右键菜单--删除按钮点击
    $("#delComment").on("click", function(){
        $("#deltipsModal").modal("show");
    });
    //确定删除备注
    $("#deltipsModal .btn-sure").on("click", function(){
        $("#deltipsModal").modal("hide");
        if($selectRow.hasClass("no-del")){
            $("#tipsModal .message").text("固定行不能被删除");
            $("#tipsModal").modal("show");
            return false;
        }
        for(var i = 0; i<commentArray.length; i++){
            if(commentArray[i].cid == $selectRow.find("td").eq(1).attr("data-id")){
                commentArray.splice(i, 1);
                break;
            }
        }
        $selectRow.remove();
        $("#tipsModal .message").text("删除成功");
        calPay();
        $("#tipsModal").modal("show");
        /**
         * todo
         */
    });
    /**
     * 加盟款发生改变时触发.
     */
    $("#joinFee").on("change", function(){
        $(this).closest("tr").find("td").eq(3).text(Arabia_to_Chinese($(this).val()));
        calPay();
    });
    /**
     * 加盟款余额发生改变时触发
     */
    $("#joinBalance").on("change",function () {
        $(this).parent("td").next("td").text(Arabia_to_Chinese($(this).val()));
        calPay();
    });
    /**
     * 保存表格
     */
    //保存表格按钮点击
    $("#saveForm").on("click", function(){
        $("#savetipsModal").modal("show");
    });
    //确定保存表格
    $("#savetipsModal .btn-sure").on("click", function(){
        console.log(commentArray);
        $("#savetipsModal").modal("hide");
        $("#tipsModal").modal("show");
        Common.ajaxLoading();
        $.ajax({
            url     :location.href,
            data    :{
                joinFee    :$("#joinFee").val(),
                comment    :$("#comment").val(),
                customData :commentArray,
                joinBalance:$("#joinBalance").val(),
                requestType:'save'
            },
            type    :"post",
            dataType:"json",
            success :function(res){
                Common.ajaxLoadingStop();
                if(res){
                    $("#tipsModal .message").text(res.message);
                    $("#tipsModal").modal("show");
                }
            },
            error   :function(){
                Common.ajaxLoadingStop();
                $("#tipsModal .message").text("网络异常");
                $("#tipsModal").modal("show");
            }
        })
    });
    //计算结算款
    function calPay() {
        var joinFee = parseFloat($(".join-fee input").val()).toFixed(2) || 0;
        if($(".join-fee input").val() == ''){
            joinFee = 0;
        }
        var payMoney = (parseFloat($(".divide-fee").text()) +parseFloat(joinFee)).toFixed(2);
        var noNeedPayTotal = parseFloat($("#joinBalance").val()) || 0;
        for(var i = 0; i<commentArray.length; i++){
            if(commentArray[i].type == 0){
                payMoney = (payMoney - commentArray[i].price).toFixed(2);
            }else if(commentArray[i].type == 1){
                var needMoney = parseFloat(commentArray[i].price);
                payMoney = parseFloat( parseFloat(payMoney) +  needMoney).toFixed(2);
            }else{
                //不处理的数据
                var noNeedMoney = parseFloat(commentArray[i].price);
                noNeedPayTotal = parseFloat(parseFloat(noNeedPayTotal) + noNeedMoney).toFixed(2);
            }
        }
        //待付款金额
        $(".get-fee").text(payMoney);
        $(".get-fee").next("td").text(Arabia_to_Chinese(payMoney.toString()));
        //不处理合计
        $(".no-done-total").text(noNeedPayTotal);
        $(".no-done-total").next("td").text(Arabia_to_Chinese(noNeedPayTotal.toString()));
    };
});
//金额替换中文方法
function Arabia_to_Chinese(Num){
    for(i = Num.length-1; i>=0; i--){
        Num = Num.replace(",", "")//替换tomoney()中的“,”
        Num = Num.replace(" ", "")//替换tomoney()中的空格
    }
    Num = Num.replace("￥", "")//替换掉可能出现的￥字符
    if(isNaN(Num)){ //验证输入的字符是否为数字
        alert("请检查小写金额是否正确");
        return;
    }
    //---字符处理完毕，开始转换，转换采用前后两部分分别转换---//
    part    = String(Num).split(".");
    newchar = "";
    //小数点前进行转化
    for(i = part[0].length-1; i>=0; i--){
        if(part[0].length>10){
            alert("位数过大，无法计算");
            return "";
        } //若数量超过拾亿单位，提示
        tmpnewchar = ""
        perchar    = part[0].charAt(i);
        switch(perchar){
            case "-":
                tmpnewchar = "负"+tmpnewchar;
                break;
            case "+":
                tmpnewchar = "正"+tmpnewchar;
                break;
            case "0":
                tmpnewchar = "零"+tmpnewchar;
                break;
            case "1":
                tmpnewchar = "壹"+tmpnewchar;
                break;
            case "2":
                tmpnewchar = "贰"+tmpnewchar;
                break;
            case "3":
                tmpnewchar = "叁"+tmpnewchar;
                break;
            case "4":
                tmpnewchar = "肆"+tmpnewchar;
                break;
            case "5":
                tmpnewchar = "伍"+tmpnewchar;
                break;
            case "6":
                tmpnewchar = "陆"+tmpnewchar;
                break;
            case "7":
                tmpnewchar = "柒"+tmpnewchar;
                break;
            case "8":
                tmpnewchar = "捌"+tmpnewchar;
                break;
            case "9":
                tmpnewchar = "玖"+tmpnewchar;
                break;
        }
        if(perchar != "-" && perchar!= "+"){
            switch(part[0].length-i-1){
                case 0:
                    tmpnewchar = tmpnewchar+"元";
                    break;
                case 1:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"拾";
                    break;
                case 2:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"佰";
                    break;
                case 3:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"仟";
                    break;
                case 4:
                    tmpnewchar = tmpnewchar+"万";
                    break;
                case 5:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"拾";
                    break;
                case 6:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"佰";
                    break;
                case 7:
                    if(perchar != 0) tmpnewchar = tmpnewchar+"仟";
                    break;
                case 8:
                    tmpnewchar = tmpnewchar+"亿";
                    break;
                case 9:
                    tmpnewchar = tmpnewchar+"拾";
                    break;
            }
        }
        newchar = tmpnewchar+newchar;
    }
    //小数点之后进行转化
    if(Num.indexOf(".") != -1){
        if(part[1].length>2){
            alert("小数点之后只能保留两位,系统将自动截段");
            part[1] = part[1].substr(0, 2)
        }
        for(i = 0; i<part[1].length; i++){
            tmpnewchar = ""
            perchar    = part[1].charAt(i)
            switch(perchar){
                case "0":
                    tmpnewchar = "零"+tmpnewchar;
                    break;
                case "1":
                    tmpnewchar = "壹"+tmpnewchar;
                    break;
                case "2":
                    tmpnewchar = "贰"+tmpnewchar;
                    break;
                case "3":
                    tmpnewchar = "叁"+tmpnewchar;
                    break;
                case "4":
                    tmpnewchar = "肆"+tmpnewchar;
                    break;
                case "5":
                    tmpnewchar = "伍"+tmpnewchar;
                    break;
                case "6":
                    tmpnewchar = "陆"+tmpnewchar;
                    break;
                case "7":
                    tmpnewchar = "柒"+tmpnewchar;
                    break;
                case "8":
                    tmpnewchar = "捌"+tmpnewchar;
                    break;
                case "9":
                    tmpnewchar = "玖"+tmpnewchar;
                    break;
            }
            if(i == 0) tmpnewchar = tmpnewchar+"角";
            if(i == 1) tmpnewchar = tmpnewchar+"分";
            newchar = newchar+tmpnewchar;
        }
    }
    //替换所有无用汉字
    while(newchar.search("零零") != -1)
        newchar = newchar.replace("零零", "零");
    newchar = newchar.replace("零亿", "亿");
    newchar = newchar.replace("亿万", "亿");
    newchar = newchar.replace("零万", "万");
    if(Num.indexOf("-") == -1 && Num.indexOf("+") == -1){
        newchar = newchar.replace("零元", "元");
    }
    newchar = newchar.replace("零角", "");
    newchar = newchar.replace("零分", "");
    if(newchar.charAt(newchar.length-1) == "元" || newchar.charAt(newchar.length-1) == "角")
        newchar = newchar+"整"
    //  document.write(newchar);
    return newchar;
}
/*$(document).mousedown(function(e){

    var key = e.which; //获取鼠标键位
    if(key == 3)  //(1:代表左键； 2:代表中键； 3:代表右键)
    {
        //获取右键点击坐标
        var x = e.clientX;
        var y = e.clientY;
        // alert("点击了鼠标右键");
        $("#rightMenu").show().css({left:x,top:y});
    }
});*/
