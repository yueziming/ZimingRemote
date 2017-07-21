/**
 * Created by yueziming on 2017-7-11.
 */
$(function() {
    var oTable1 = $('#sample-table').dataTable( {
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,2,3,5,6]}// 制定列不参与排序
        ] } );
    $('table th input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
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

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }
})
/*用户-查看*/
function member_show(title,url,id,w,h){
    layer_show(title,url+'#?='+id,w,h);
}
/*留言-删除*/
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $(obj).parents("tr").remove();
        layer.msg('已删除!',{icon:1,time:1000});
    });
}

/*checkbox激发事件*/
$('#checkbox').on('click',function(){
    if($('input[name="checkbox"]').prop("checked")){
        $('.Reply_style').css('display','block');
    }
    else{

        $('.Reply_style').css('display','none');
    }
})
/*留言查看*/
function Guestbook_iew(id){
    var index = layer.open({
        type: 1,
        title: '留言信息',
        maxmin: true,
        shadeClose:false,
        area : ['600px' , ''],
        content:$('#Guestbook'),
        btn:['确定','取消'],
        yes: function(index, layero){
            if($('input[name="checkbox"]').prop("checked")){
                if($('.form-control').val()==""){
                    layer.alert('回复内容不能为空！',{
                        title: '提示框',
                        icon:0,
                    })
                }else{
                    layer.alert('确定回复该内容？',{
                        title: '提示框',
                        icon:0,
                        btn:['确定','取消'],
                        yes: function(index){
                            layer.closeAll();
                        }
                    });
                }
            }else{
                layer.alert('是否要取消回复！',{
                    title: '提示框',
                    icon:0,
                });
                layer.close(index);
            }
        }
    })
};
/*字数限制*/
function checkLength(which) {
    var maxChars = 200; //
    if(which.value.length > maxChars){
        layer.open({
            icon:2,
            title:'提示框',
            content:'您输入的字数超过限制!',
        });
        // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
        which.value = which.value.substring(0,maxChars);
        return false;
    }else{
        var curr = maxChars - which.value.length; //250 减去 当前输入的
        document.getElementById("sy").innerHTML = curr.toString();
        return true;
    }
};