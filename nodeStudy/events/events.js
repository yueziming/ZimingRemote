/**
 * Created by 1658 on 2017-8-19.
 */

/**
 *引入events对象
 */
var events = require("events");
/**
 *创建eventEmitter对象
 */
var eventEmitter = new events.EventEmitter();
/**
 *创建connection事件处理程序
 */
var connectHander = function connected() {
    console.log("连接成功。");
    eventEmitter.emit("data_received");
}
/**
 *为connection事件绑定处理程序
 */
eventEmitter.on("connection",connectHander);
/**
 *为data_received事件创建匿名处理函数
 */
eventEmitter.on("data_received",function () {
    console.log("数据接收成功。");
});
/**
 * 触发connection事件
 */
 eventEmitter.emit("connection");
 console.log("程序执行完毕");