/**
 * Created by yueziming on 2017-8-21.
 */
var http = require("http");
http.createServer(function (request,response) {
    response.writeHead(200,{"Content-Type":"text/plain"});
    response.write("Hello world");
    response.end();
}).listen(8888);
console.log("server is running on http://localhost:8888");