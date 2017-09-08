/**
 * Created by yueziming on 2017-9-7.
 */
var mysql = require('mysql');

var connection = mysql.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    port:'3306',
    database:'test'
});

connection.connect();

var sql = 'select * from websites';
connection.query(sql,function (error,results) {
    if(error){
        console.log("[select error]-"+error.message);
        return false;
    }
    console.log("---------------------------------------------");
    console.log(results);
    console.log("---------------------------------------------/n/n");
});

connection.end();