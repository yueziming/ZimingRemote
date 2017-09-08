/**
 * Created by yueziming on 2017-8-22.
 */
/**
 * fs.read(fd, buffer, offset, length, position, callback)为异步读取文件内容的函数
 * 参数使用说明如下：
 * fd - 通过 fs.open() 方法返回的文件描述符。
 * buffer - 数据写入的缓冲区。
 * offset - 缓冲区写入的写入偏移量。
 * length - 要从文件中读取的字节数。
 * position - 文件读取的起始位置，如果 position 的值为 null，则会从当前文件指针的位置读取。
 * callback - 回调函数，有三个参数err, bytesRead, buffer，err 为错误信息， bytesRead 表示读取的字节数，buffer 为缓冲区对象。
 */
var fs = require("fs");
fs.open("input.txt","r+",function (err,fd) {
var buf = new Buffer(1024);

console.log("准备打开已存在的文件");
    if(err){
        return console.log(err);
    }
    console.log("文件打开成功");
    console.log("准备读取文件");
    console.log(fd.length);
    fs.read(fd,buf,0,buf.length,0,function (err,bytes) {
        if(err){
            console.log(err);
        }
        console.log(bytes+"字节数据被读取");
        if(bytes>0){
            console.log("读取到的数据为："+buf.slice(0,bytes).toString());
        }
        fs.close(fd,function (err) {
            if(err){
                return console.log(err);
            }
            console.log("文件关闭成功");
        })
    })
});