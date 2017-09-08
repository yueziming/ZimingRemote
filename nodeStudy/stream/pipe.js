/**
 * Created by yueziming on 2017-8-21.
 */
var fs = require("fs");

//创建可读流
var readStream = fs.createReadStream("input.txt");
//创建写入流
var writeStream = fs.createWriteStream("output2.txt");
//管道流输送
readStream.pipe(writeStream);
console.log("程序执行完毕");