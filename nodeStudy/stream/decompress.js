/**
 * Created by yueziming on 2017-8-21.
 *
 * 运用管道流和链式流对文件进行解密
 */
var fs = require("fs");
var zlib = require("zlib");

var readStream = fs.createReadStream("output3.txt.gz");
try{
    readStream.pipe(zlib.createGunzip()).pipe(fs.createWriteStream("output3.txt"));
}catch(err){
    console.log(err.stack);
}
console.log("文件解压完毕！");