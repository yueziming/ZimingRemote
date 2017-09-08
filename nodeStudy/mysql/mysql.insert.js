/**
 * Created by yueziming on 2017-9-7.
 */
var mysql = require('mysql');

var connection = mysql.createConnection({
    host:'localhost',
    port:'3306',
    user:'root',
    password:'',
    database:'test'
});

connection.connect();

var addSql = "insert into websites(id,name,url,alexa,country) values(0,?,?,?,?)";
var addSqlParams = ['京东','http://www.jd.com','2017','中国'];

connection.query(addSql,addSqlParams,function (error,results) {
    if(error){
        console.log("[ERROR MESSAGE] - "+error.message);
        return false;
    }
    console.log("---------------------------------------------------");
    console.log('Insert ID:'+results);
    console.log("---------------------------------------------------\n");
});

connection.end();