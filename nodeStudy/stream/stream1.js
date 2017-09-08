/**
 * Created by yueziming on 2017-8-21.
 */
var fs = require("fs");
var data = '';

//创建可读流
var readStream = fs.createReadStream("input.txt");
//设置编码
readStream.setEncoding("UTF8");

/**
 * 处理data、end、error事件
 */
readStream.on("data",function (chunk) {
    data+=chunk;
});
readStream.on("end",function () {
    console.log(data);
});
readStream.on("error",function (err) {
    console.log(err.stack);
});
console.log("程序运行结束");