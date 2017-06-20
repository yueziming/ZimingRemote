/**
 * Created by yueziming on 2017-6-8.
 */
$(function(){
	var common = {
		//初始化
		init:function(){
			this.ajaxSetting();
		},
		//公共ajax方法
		ajax:function(url,type,data,callback){
			common.ajaxLoading();
			$.ajax({
				url:url,
				data:data,
				type:type,
				beforeSend: function(request) {
					if(common.getData("access_token")){
						request.setRequestHeader("Authorization", "Bearer "+common.getData("access_token"));
					}
				},
				dataType:'json',
				success:function(res){
					callback(res);
					common.ajaxLoadingStop();
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					console.log(XMLHttpRequest.status);
					console.log(XMLHttpRequest.readyState);
					console.log(textStatus);
					common.tips("网络异常,获取数据失败",1500);
					common.ajaxLoadingStop();
				}
			})
		},
		//ajax的loading样式
		ajaxLoading:function(){
			var loadingHtml = '<div id="loading" class="spinner"><div class="spinner-container container1"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container2"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container3"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div>加载中</div>';
			$("body").append(loadingHtml);
		},
		//ajax的loading停止
		ajaxLoadingStop:function(){
//			setTimeout($("#loading").remove(),5000);
			$("#loading").remove();
		},
		//ajax设置
		ajaxSetting:function(){

		},
		//设置本地存储
		setData:function(key,value){
			if(typeof value == 'object'){
				localStorage.setItem(key,JSON.stringify(value));
			}
			else{
				localStorage.setItem(key,value);
			}
		},
		//获取本地存储数据
		getData:function(key){
			try{
				var data = JSON.parse(localStorage.getItem(key));
			}catch(e){
				var data = localStorage.getItem(key);
			}
			return data;
		},
		//销毁本地存储
		destoryLocalstorage:function(key){
			localStorage.removeItem(key);
		},
		//弹出提示
		tips:function(msg,time){
			var toast = "<div class='toast' id='toast'>"+msg+"</div>";
			$("body").append(toast);
			$("#toast").animate({opacity:0},time);
			setTimeout(function(){
				$("#toast").remove();
			},time);
		},
        /**
		 * 验证表达式
         */
        //验证用户名
        validateuserName:function (username) {
			var reg = /(^[A-Za-z0-9]{6,16}$)|(^[\u4E00-\u9FA5]{2,8}$)/;
			var res = reg.test(username);
			return res;
        },
        //校验密码：只能输入6-20个字母、数字、下划线
        isPasswd:function(s)
		{
			var patrn=/^(\w){6,20}$/;
			if (!patrn.exec(s)) return false
			return true
		},
		//非空判断
		isEmpty:function (s) {
			if(s == ''){
				return false;
			}else{
				return true;
			}
        },
		//邮箱验证
		validateEmail:function (email) {
			var reg =/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/;
            var res = reg.test(email);
            return res;
        },
        //是否为正整数｛
		isInteger:function (num) {
        	// var num = parseInt(s);
			var reg = /^[0-9]\d*$/;
            var res = reg.test(num);
            return res;
        },
        //是否为英文和数字
		isEnglishAndNum:function (s) {
			var reg = /^[A-Za-z0-9]+$/;
            var res = reg.test(s);
            return res;
        }
}
	window.common = common;
	common.init();
})