/**
 * Created by 0967 on 2017-6-8.
 */
$(function(){
	var myLogin = new Vue({
		el:'#wrapper',
		data:{
			username:'',
			password:''
		},
		methods:{
			login:function(){
				var result = common.validateuserName(myLogin.username);
				var isPassword = common.isPasswd(myLogin.password);
				if(result && isPassword){
                    var data = {
                        username:myLogin.username,
                        password:myLogin.password,
                        grant_type:'password',
                        client_id:2,
                        client_secret:'GN4G8fvdhWrl7raXsevJHoAnRlPya5FlafC19McC'
                    };
                    common.ajax(Api.url.LOGIN,"post",data,function(res){
                        if(res.access_token){
                            common.setData("access_token",res.access_token);
                            common.setData("username",myLogin.username);
                            location.href = 'index.html';
                        }
                        common.tips(res.message,1500);
                    })
				}else{
					$("#login_error").modal("show");
					// common.tips("用户名或密码不合法，用户名不能包含特殊字符且在7个纯汉字或16个英文字母之内",2000);
				}
			},
            exitLoginDialog:function () {
                $("#login_error").modal("hide");
            }
		}
	})
})