/**
 * Created by yueziming on 2017-8-23.
 */
var http = require("http");
var url = require("url");
var fs =  require("fs");

http.createServer(function (request,response) {
    var pathname = url.parse(request.url).pathname;
    console.log("request for: "+pathname+" has received.");
    fs.readFile(pathname.substr(1),function (err,data) {
        if(err){
            return console.log(err);
            /**
             * 404错误，not found
             * content-type:text/html
             */
            response.writeHead(404,{"Content-Type":"text/html"});
        }
        console.log("文件读取成功");
        response.writeHead(200,{"Content-Type":"text/html"});
        response.write(data.toString());
        response.end();
    })
}).listen(8001);
console.log("Server is running on http://localhost:8001");