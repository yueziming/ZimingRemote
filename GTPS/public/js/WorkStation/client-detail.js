/**
 * Created by 1658 on 2017-7-17.
 */
/**
 * Created by yueziming on 2017-7-11.
 */
$(function () {
    var Detail = {
        init: function () {
            this.bindEvent();
            this.view();
            this.model();
        },
        bindEvent: function () {
            // 全选
            $('table th input:checkbox').on('click', function () {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function () {
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });

            /*   $('.Order_form ,.brond_name').on('click', function () {
             var cname = $(this).attr("title");
             var cnames = parent.$('.Current_page').html();
             var herf = parent.$("#iframe").attr("src");
             parent.$('#parentIframe span').html(cname);
             parent.$('#parentIframe').css("display", "inline-block");
             parent.$('.Current_page').attr("name", herf).css({"color": "#4c8fbd", "cursor": "pointer"});
             //parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+">" + cnames + "</a>");
             parent.layer.close(index);

             });*/
        },
        model: function () {
            Common.ajax(Api.getClientFieldList,"get",{},function (res) {
                console.log(res);
                if(res){
                    // customer.selectWidth = $(".add_name").css("width");
                    customer.addClientList = res;
                }
            });
            var customer = new Vue({
                el: "#layout-2",
                data: {
                    state: '已登记',
                    addClientList:[],
                    // selectWidth:0
                },
                methods: {
                    addCustomer: function () {
                        layer.open({
                            type: 1,
                            title: '添加用户',
                            maxmin: true,
                            shadeClose: true, //点击遮罩关闭层
                            area: ['800px', ''],
                            content: $('#add_menber_style'),
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
                    },
                    //按照Id排序
                    idSort:function () {
                        console.log("将进行排序");
                    },
                    appointment: function (event) {
                        var obj = event.target || window.event.srcElement;
                        layer.confirm('确认要预约吗？', function () {
                            // $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs" @Click="cancelAppointment($event);" href="javascript:;" title="取消预约"><i class="fa fa-tty bigger-120"></i>取消预约</a>');
                            // $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已预约</span>');
                            // $(obj).remove();
                            // $(obj).find(".fa").removeClass("fa-tty");
                            // $(obj).find(".fa").addClass("fa-phone");
                            $(obj).text('取消预约');
                            $(obj).closest("tr").find(".td-status span").text("已预约");
                            // customer.state = "已预约";
                            layer.msg('已预约!', {icon: 6, time: 1000});
                        });
                    },
                    cancelAppointment: function (event) {
                        var obj = event.target || window.event.srcElement;
                        layer.confirm('确认要取消预约吗？', function () {
                            /*$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" @Click="appointment($event)" href="javascript:;" title="预约"><i class="bigger-120 fa fa-phone mr4"></i>预约</a>');
                             $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">未预约</span>');
                             $(obj).remove();*/
                            $(obj).text('预约');
                            $(obj).closest("tr").find(".td-status span").text("未预约");
                            $(obj).closest("tr").find(".td-status span").removeClass("label-success");
                            $(obj).closest("tr").find(".td-status span").addClass("label-default");
                            // customer.state = "未预约";
                            layer.msg('已取消预约!', {icon: 5, time: 1000});
                        });
                    },
                    //搜索框内容改变或者点击了搜索按钮
                    changeList:function (event) {
                        var target = event.target || window.event.srcElement;
                        // enter跳转
                        if (event.keyCode === 13) {
                            console.log($(target).val());
                        }else if($(target).hasClass("search-btn")){
                            console.log("点击了搜索按钮，输入框的值为："+$(target).closest("li").find("input").val());
                        }
                        // console.log(target);
                    },
                    //跳转至详情页
                    goBack:function () {
                        history.back();
                    }
                }
            })
        },
        view: function () {
            var oTable1 = $('#sample-table').dataTable({
                "aaSorting": [[1, "desc"]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable": false, "aTargets": [0, 1, 3, 4, 5, 6, 8, 9]}// 制定列不参与排序
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
    Detail.init();
});