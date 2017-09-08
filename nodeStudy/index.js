/**
 * Created by yueziming on 2017-7-25.
 */
var server = require("./server");
var router = require("./router");

server.start(router.route);
console.log("INDEX:"+pathname);