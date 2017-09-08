/**
 * Created by 1658 on 2017-8-19.
 */
buf = new Buffer(256);
len = buf.write("什么名字");
var json = buf.toJSON(buf);
console.log("写入字节数" + len);
console.log(buf.toString('ascii'));
console.log(buf.toString('ascii', 0, 5));
console.log(buf.toString('utf-8', 0, 9));
/**
 * json的使用方法，汉字打印太长了
 */
// console.log(json);

/**
 * concat方法的使用(将2个二进制流进行合并)
 * compare方法的使用(对比2个二进制缓存区)
 */
var buffer1 = new Buffer("你是谁？");
var buffer2 = new Buffer("我是你二大爷啊！");
var buffer3 = Buffer.concat([buffer1, buffer2]);
var result = buffer1.compare(buffer2);
if (result < 0) {
    console.log(buffer1 + '在' + buffer2 + "之前");
} else if (result === 0) {
    console.log(buffer1 + "与" + buffer2 + "相等");
} else {
    console.log(buffer1 + '在' + buffer2 + "之后");
}
console.log("合并后的buffer3的值为：" + buffer3);

/**
 * copy方法的使用
 * slice方法的使用，缓冲区裁剪
 */
var buffer1 = new Buffer("what are you doing?");
var buffer2 = new Buffer(20);
buffer1.copy(buffer2);
var buffer3 = buffer1.slice(0,10);
console.log(buffer2.toString());
console.log(buffer3.toString());