/**
 * Created by 1658 on 2017-8-18.
 */
var fs = require("fs");
fs.readFile('input.txt',function (err,data) {
     if(err){
         return console.error(err);
     }
     console.log(data.toString());
});
console.log("程序已结束");