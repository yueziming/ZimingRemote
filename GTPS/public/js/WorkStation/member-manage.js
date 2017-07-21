/**
 * Created by 1195 on 2017-7-14.
 */

jQuery(function ($) {

    $("#products_list").fix({
        float: 'left',
        //minStatue : true,
        skin: 'green',
        durationTime: false,
        spacingw: 30,//设置隐藏时的距离
        spacingh: 260,//设置显示时间距
    });

    var oTable1 = $('#sample-table').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0, 2, 3, 4, 5, 8, 9]}// 制定列不参与排序
        ]
    });


    $('table th input:checkbox').on('click', function () {
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function () {
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });

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
});


/*用户-添加*/
$('.Order_form').on('click', function () {
    layer.open({
        type: 1,
        title: '入库',
        maxmin: true,
        shadeClose: true, //点击遮罩关闭层
        area: ['800px', ''],
        content: $('#storage_model'),
        btn: ['提交', '取消'],
        yes: function (index, layero) {
            var num = 0;
            var str = "";
            $(".add_menber input[type$='text']").each(function (n) {
                if ($(this).val() == "") {

                    layer.alert(str += "" + $(this).attr("name") + "不能为空！\r\n", {
                        title: '提示框',
                        icon: 0,
                    });
                    num++;
                    return false;
                }
            });
            if (num > 0) {
                return false;
            }
            else {
                layer.alert('添加成功！', {
                    title: '提示框',
                    icon: 1,
                });
                layer.close(index);
            }
        }
    });
});


var MemberCard = {}