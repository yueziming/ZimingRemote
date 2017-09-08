/**
 * Created by yueziming on 2017-8-22.
 */
var http = require("http");
var url = require("url");
var util = require("util");

http.createServer(function (request,response) {
    response.writeHead(200,{"Content-Type":"text/plain;charset=utf-8"});
    //解析url参数
    var params = url.parse(request.url,true).query;
    response.write("姓名为："+params.name+"\n");
    response.write("年龄为："+params.age+"\n");
    response.end(util.inspect(url.parse(request.url,true)));
}).listen(3000);
console.log("Server is running on http://localhost:3000");