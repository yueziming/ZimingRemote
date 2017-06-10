/**
 * Created by 0967 on 2017-6-8.
 */
$(function(){
	var myLogin = new Vue({
		el:'#wrapper',
		data:{
			username:'username',
			password:''
		},
		methods:{
			login:function(){
				var data = {
					username:myLogin.username,
					password:myLogin.password,
					grant_type:'password',
					client_id:2,
					client_secret:'iRP2TOMDyNALPSMVlCgU2kOKEOfQssK6BmE4A8HZ'
				};
				common.ajax(Api.url.LOGIN,"post",data,function(res){
					if(res.access_token){
						common.setData("access_token",res.access_token);
						common.setData("username",myLogin.username);
						location.href = 'index.html';
					}
				})
			}
		}
	})
})