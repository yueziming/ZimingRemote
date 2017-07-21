/**
 * Created by 1195 on 2017-7-19.
 */

$(function () {
    // 开始时间
    laydate({
        elem: '#start',
        event: 'focus',
        choose: function (datas) { //选择日期完毕的回调
            K3Department.start_time = datas;
        }
    });

    // 结束时间
    laydate({
        elem: '#end',
        event: 'focus',
        choose: function (datas) { //选择日期完毕的回调
            K3Department.end_time = datas;
        }
    });
});

var K3Department = new Vue({
    el: '#layout-2',
    data: {
        areas: '',
        start_time: '',
        end_time: '',
        chose_area: '',
        list: []
    },
    created: function () {
        this.getArea();
    },
    methods: {
        // 获取区域
        getArea: function () {
            var self = this;
            Common.ajax(Api.getArea, "get", {}, function (res) {
                self.areas = res;
            });
        },
        // 搜索
        setSearch: function () {
            var self = this;
            var data = {
                area: self.chose_area,
                start_time: self.start_time,
                end_time: self.end_time
            };
            var submit_url = Api.getInputList.replace('{area}', self.chose_area);
            Common.ajax(submit_url, "get", data, function (res) {
                self.list = res;
            });
        },
        // 同步
        submitData: function () {
            /* var self = this;
             Common.ajax(submit_url, "get", {data: self.list}, function (res) {
             console.log(res);
             });*/
            alert('123');
        }
    }
});

