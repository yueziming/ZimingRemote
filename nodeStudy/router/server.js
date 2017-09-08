/**
 * Created by yueziming on 2017-8-21.
 */
var http = require("http");
var url = require("url");
function start(route,interface) {
    function onRequest(request,response) {
        console.log("request.url is:"+request.url);
        console.log("url.parse is:"+ url.parse(request.url));
        var pathname = url.parse(request.url).pathname;

        route(pathname);

        console.log("Request for"+pathname+" has received");
        response.writeHead(200,{"Content-Type":"text/plain"});
        response.write("This is a router test server!");
        interface(pathname,request,response);
        response.end();
    }
    http.createServer(onRequest).listen(8888);
    console.log("server is running in http://localhost:8888");
}
exports.start = start;