/**
 * Created by yueziming on 2017-8-21.
 */
var fs = require("fs");

//创建一个写入流
var writeStream = fs.createWriteStream("output.txt");
var data = "这是用node写入的文本内容"
//设置用utf8格式写入数据
writeStream.write(data,"UTF8");
//标记文件末尾
writeStream.end();

writeStream.on("finish",function () {
    console.log("文件写入完毕");
});
writeStream.on("error",function (err) {
    console.log(err.stack);
});
console.log("程序执行完毕");