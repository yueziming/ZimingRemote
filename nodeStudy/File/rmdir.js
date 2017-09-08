/**
 * Created by yueziming on 2017-8-22.
 */
var fs = require("fs");

console.log("准备删除./tmp/test/目录");
fs.rmdir("./tmp/test/",function (err) {
    if(err){
        return console.log(err);
    }
    console.log("./tmp/test/目录删除成功");
});