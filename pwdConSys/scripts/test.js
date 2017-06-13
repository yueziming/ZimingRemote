/**
 * Created by yueziming on 2017-6-13.
 */
$(function(){
	common.ajax("https://192.168.0.70:8443/api/column-index","get",{},function(res){
		console.log(res);
	});
	common.ajax("https://192.168.0.70:8443/api/column-list","get",{},function(res){
		console.log(res);
	});
})