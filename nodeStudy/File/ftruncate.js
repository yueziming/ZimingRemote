/**
 * Created by yueziming on 2017-8-22.
 */
//截取文件内容ftruncate
var fs = require("fs");
var buf = new Buffer(1024);

console.log("准备打开已存在的文件");
fs.open("input.txt","r+",function (err,fd) {
    if(err){
        return console.log(err);
    }
    console.log("文件打开成功，准备截取20字节的数据");
    console.log("开始截取数据");
    fs.ftruncate(fd,20,function (err) {
        if(err){
            return console.log(err);
        }
        console.log("数据截取成功");
        fs.read(fd,buf,0,buf.length,0,function (err,bytes) {
            if(err){
                return console.log(err);
            }
            if(bytes>0){
                console.log("截取内容为:"+buf.slice(0,bytes).toString());
            }
        });
        fs.close(fd,function (err) {
            if(err){
                return console.log(err);
            }
            console.log("文件成功关闭");
        })
    })
});