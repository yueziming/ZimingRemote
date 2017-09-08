/**
 * Created by yueziming on 2017-8-23.
 */
var express = require("express");
var app = express();
app.get("/",function (req,res) {
    res.send("express发送的数据");
});
app.get("/index.html",function (req,res) {
    res.send("路由显示你要访问index.html");
});
var server = app.listen(8081,function () {
    var host = server.address().address;
    var port = server.address().port;
    console.log("应用实例,访问地址为：http://s%:s%",host,port);
});