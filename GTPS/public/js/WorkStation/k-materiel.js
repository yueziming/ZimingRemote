/**
 * Created by 1195 on 2017-7-19.
 */

$(function () {
    // 开始时间
    laydate({
        elem: '#start',
        event: 'focus'
    });

    // 结束时间
    laydate({
        elem: '#end',
        event: 'focus'
    });

    $('#search').on('click',function(){
        alert('123');
    });

});