/**
 * Created by yueziming on 2017-8-23.
 */
var express = require("express");
var app = express();
//获取get请求
app.get("/",function (req,res) {
    res.send("Hello GET");
});
//获取post请求
app.post("/",function (req,res) {
    res.send("Hello POST");
});
//用户页面路由
app.get("/user",function (req,res) {
    res.send("这是用户页面");
});
//角色页面路由
app.get("/role",function (req,res) {
    res.send("这是角色页面");
});
//群组页面路由
app.get("/group",function (req,res) {
    res.send("这是群组页面");
});
var server = app.listen(8081,function () {
    var host = server.address().address
    var port = server.address().port
    console.log("Server is running on :http:// s% : s%",host,port)
});