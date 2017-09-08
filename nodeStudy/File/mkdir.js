/**
 * Created by yueziming on 2017-8-22.
 */
var fs = require("fs");
console.log("准备创建目录./temp/test/");
fs.mkdir("./tmp/",0777,function(err){
    if (err) {
        return console.error(err);
    }
    console.log("目录/temp创建成功。");
    fs.mkdir("./tmp/test/",function (err) {
        if(err){
            return console.log(err);
        }
        console.log("目录./tmp/test/创建成功");
    })
});