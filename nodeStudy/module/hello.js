/**
 * Created by yueziming on 2017-8-21.
 */
var Hello = function () {
    var name;
    this.setName =  function (thyName) {
        name = thyName;
    };
    this.sayHello = function () {
        console.log("hello:"+name);
    };
};
module.exports = Hello;