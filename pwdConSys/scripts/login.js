/**
 * Created by 0967 on 2017-6-8.
 */
$(function(){
	var myLogin = new Vue({
		el:'#wrapper',
		data:{
			username:'',
			password:'',
            userError:'',
            passwordError:'',
            resultMessage:'',
            forgetPassword:location.protocol+'//'+location.hostname+':2345/password/reset'
		},
		methods:{
			login:function(){
				/*var result = common.validateuserName(myLogin.username);
				var isPassword = common.isPasswd(myLogin.password);*/
				// if(result && isPassword){
                var data = {
                    username:myLogin.username,
                    password:myLogin.password,
                    grant_type:'password',
                    client_id:2,
                    client_secret:'dakTVKqTAG9c2qJRoNly64QE33qIdrFsNdAJ11Vl',
                };
                common.ajaxLoading();
                $.ajax({
                    url:Api.url.LOGIN,
                    type:"post",
                    dataType:"json",
                    data:data,
                    success:function (res) {
                        if(res.access_token){
                            common.setData("access_token",res.access_token);
                            common.setData("username",myLogin.username);
                            location.href = 'index.html';
                        }
                        common.ajaxLoadingStop();
                    },
                    error:function (XMLHttpRequest, textStatus, errorThrown) {
                        if(XMLHttpRequest.status == 401){
                            $("#login_error").modal("show");
                        }
                        console.log(XMLHttpRequest.status);
                        console.log(XMLHttpRequest.readyState);
                        console.log(textStatus);
                        common.tips("网络异常,获取数据失败",1500);
                        common.ajaxLoadingStop();
                    }
                })
                /*common.ajax(Api.url.LOGIN,"post",data,function(res){
                    if(res.access_token){
                        common.setData("access_token",res.access_token);
                        common.setData("username",myLogin.username);
                        location.href = 'index.html';
                    }else{
                        // resultMessage = res.message;
                        $("#login_error").modal("show");
                    }
                    // common.tips(res.message,1500);
                })*/
/*				}else{
					// $("#login_error").modal("show");
					// common.tips("用户名或密码不合法，用户名不能包含特殊字符且在7个纯汉字或16个英文字母之内",2000);
				}*/
			},
            exitLoginDialog:function () {
                $("#login_error").modal("hide");
            }
		}
	})
    myLogin.$watch("username", function (value) {
        if(!common.validateuserName(myLogin.username)){
            $("#username").addClass("has-error");
            $("#username").addClass("has-feedback");
            myLogin.userError = "用户名不能包含特殊字符且在16个英文字母之内";
        }else{
            $("#username").removeClass("has-error");
            $("#username").removeClass("has-feedback");
            myLogin.userError = "";
        }
    });
    myLogin.$watch("password", function (value) {
        if(!common.isPasswd(myLogin.password)){
            $("#passworld").addClass("has-error");
            $("#passworld").addClass("has-feedback");
            myLogin.passwordError = "只能输入6-20个字母、数字、下划线";
        }else{
            $("#passworld").removeClass("has-error");
            $("#passworld").removeClass("has-feedback");
            myLogin.passwordError = "";
        }
    });
})