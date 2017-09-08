/**
 * Created by yueziming on 2017-8-22.
 */
var fs = require("fs");
fs.readdir("./tmp",function (err,files) {
    if(err){
        return console.log(err);
    }
    console.log("文件目录读取成功");
    files.forEach(function (file) {
        console.log(file);
    })
})