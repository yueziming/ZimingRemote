/**
 * Created by yueziming on 2017-8-23.
 */
var http = require("http");

var options = {
    host:"localhost",
    port:"8001",
    path:"/index.html"
};
//处理相应的回调函数
var callback = function (response) {
    var body = "";
    //不断更新数据
    response.on("data",function (data) {
        body += data;
    })
    response.on("end",function () {
        console.log("数据接收完成");
        console.log(body);
    })
};
//像服务器发送请求
var req = http.request(options,callback);
req.end();