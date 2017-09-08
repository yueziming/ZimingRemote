/**
 * Created by yueziming on 2017-9-7.
 */
var mysql = require("mysql");

var connection = mysql.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    database:'test'
});

connection.connect();

connection.query('select 1 + 1 as solution',function (error,results,fields) {
    if(error){
        throw error;
    }
    console.log('The solution is:'+results[0].solution);
})