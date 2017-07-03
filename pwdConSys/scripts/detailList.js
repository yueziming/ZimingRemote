/**
 * Created by 1658 on 2017-6-22.
 */
$(function(){
    var detailList = {
        init:function () {
            detailList.id = location.href.split("?id=")[1] || '';
            // common.ajax();
            this.model();
        },
        model:function () {
            var vue = new Vue({
                el:"#wrapper",
                data:{
                    detail:[
                        {
                           title:'字段1',
                            content:'内容1'
                        },
                        {
                            title:'字段1',
                            content:'内容1'
                        },
                        {
                            title:'字段1',
                            content:'内容1'
                        },
                        {
                            title:'字段1',
                            content:'内容1'
                        },
                    ]
                },
                methods:{
                    goBack:function(){
                        history.back();
                    }
                }
            });
            // Something todo
            /*$.ajax({
                url:''+ detailList.id,
                data:{},
                type:"get",
                dataType:"json",
                success:function (res) {
                    if(res.status === 1 && res.detail){
                        vue.detail = res.detail;
                    }
                },
                error:function () {

                }
            })*/
        }
    }
    detailList.init();
});