/**
 * Created by 0967 on 2017-6-8.
 */
$(function(){
	$.ajax({
		url:'https://192.168.0.70:8443/login',
		type:'post',
		dataType:'json',
		data:{'name':'yueziming','passworld':'123456'},
		success:function(res){
			console.log(res);
		},
		error:function(){
			console.log("网络错误");
		}
	})
})