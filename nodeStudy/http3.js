/**
 * Created by yueziming on 2017-7-25.
 */
var http = require("http");
// var express = require("express");
// var app = express();
var querystring = require("querystring");

//设置跨域访问
/*app.all('*', function(req, res, next) {
    res.header("Access-Control-Allow-Origin","*");
    // res.header("Access-Control-Allow-Headers","X-Requested-With");
    res.header("Access-Control-Allow-Methods","post");
    // res.header("X-Powered-By",'3.2.1')
    res.header("Content-Type", "application/json;charset=utf-8");
    console.log("开始获取数据");
    next();
});*/
var postHtml = '<html><head><meta charset="utf-8"><title>菜鸟教程 Node.js 实例</title></head>' +
    '<body>' +
    '<form method="post">' +
    '网站名： <input name="name"><br>' +
    '网站 URL： <input name="url"><br>' +
    '<input type="submit">' +
    '</form>' +
    '</body></html>';

http.createServer(function(req,res){
    res.setHeader('Access-Control-Allow-Origin','http://localhost:888');
    res.setHeader("Access-Control-Allow-Headers","X-CSRF-TOKEN");
    var body = '';
    //通过req的data事件监听函数，每当接受到请求体的数据，就累加到data变量中
    req.on("data",function(chunk){
        body += chunk;
    });
    req.on("end",function(){
        //在end事件触发后，通过querystring.parse将post解析为真正的POST请求格式，然后向客户端返回。
        body = querystring.parse(body);
        // 设置响应头部信息及编码
        res.writeHead(200,{"Content-Type":"application/json;charset=utf-8"});
        if(body.name && body.url){// 输出提交的数据
            var responseData = {
                "code":1,
                "status":"1",
                "message":"请求成功！",
                "data":{
                    "name":"你大爷",
                    "pingyin":"什么拼音，还是你大爷"
                }
            };
            res.write(JSON.stringify(responseData));
            console.log("请求的名字为："+body.name);
            console.log("请求的URL为："+body.url);
            // res.write("<br>");
            // res.write("网站URL："+body.url);
        }else{
            res.write(postHtml);
        }
        res.end();
    })
}).listen(3000);