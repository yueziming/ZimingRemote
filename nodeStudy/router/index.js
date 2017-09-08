/**
 * Created by yueziming on 2017-8-21.
 */
var server = require("./server");
var router = require("./router");
var interface = require("./interface");

server.start(router.router,interface.interface);