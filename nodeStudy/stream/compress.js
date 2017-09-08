/**
 * Created by yueziming on 2017-8-21.
 */
var fs = require("fs");
var zlib = require("zlib");

/**
 * pipe管道流
 * 这里通过管道流和链式流来对文件进行压缩
 */
var readStream = fs.createReadStream("input.txt");
readStream.pipe(zlib.createGzip()).pipe(fs.createWriteStream("output3.txt.gz"));
console.log("文件压缩完成");