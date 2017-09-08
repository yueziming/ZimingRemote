/**
 * Created by yueziming on 2017-8-23.
 */
var express = require("express");
var app = express();
var bodyParser = require("body-parser");
// 创建 bodyParser/x-www-form-urlencoded 编码解析
var urlencodedParser = bodyParser.urlencoded({ extended: false })

// app.use(express.static("./"));
app.get("/index.html",function (req,res) {
    res.sendFile(__dirname+"/index.html");
});
app.post("/process_post",urlencodedParser,function (req,res) {
    /*var response = {
        "firstname":req.query.first_name,
        "lastname":req.query.last_name,
    }*/
    var response = {
        "firstname":req.body.first_name,
        "lastname":req.body.last_name,
    }
    console.log(res.query);
    console.log(response);
    res.end(JSON.stringify(response));
});
var server = app.listen(8081,function () {
    var host = server.address().address;
    var port = server.address().port;
    console.log("The server is ruuning on :http://s%:s%",host,port);
});