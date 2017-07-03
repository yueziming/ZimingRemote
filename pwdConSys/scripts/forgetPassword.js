/**
 * Created by 1658 on 2017-6-21.
 */
$(function(){
    var myLogin = new Vue({
        el:'#wrapper',
        data:{
            // username:'',
            email:'',
            emailError:''
            // passwordError:'',
            // resultMessage:''
        },
        methods:{
            login:function(){
                /*var result = common.validateuserName(myLogin.username);
                 var isPassword = common.isPasswd(myLogin.password);*/
                // if(result && isPassword){
                var data = {
                    email:myLogin.email,
                    // password:myLogin.password,
                    // grant_type:'password',
                    // client_id:2,
                    // client_secret:'X5soaYva7koIDcScbxxF1RCDR7bOO2jSqUyB3PrK'
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
    myLogin.$watch("email", function (value) {
        if(!common.validateEmail(myLogin.email)){
            $("#passworld").addClass("has-error");
            $("#passworld").addClass("has-feedback");
            myLogin.emailError = "邮箱格式不正确，请输入正确的邮箱";
        }else{
            $("#passworld").removeClass("has-error");
            $("#passworld").removeClass("has-feedback");
            myLogin.emailError = "";
        }
    });
})