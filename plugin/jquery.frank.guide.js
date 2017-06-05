/*
 =============================================================
 V1.00 2017-06-02 12:12
 初版
 =============================================================
 */
/**
 * 自定义通用新手指导工具
 * *若需要用到UrlClass并且URL模式为PATHINFO的话，可以在载入该js文件的标签内写入data-mvc-name的属性键入需要排除的关键值
 *
 * @author yueziming
 * @version 1.00
 * @Updated 2017-06-02 16:58
 * @Created 2017-06-02 10:00
 */
;$(function(){
	//全局基本记录配置
	var guideObject = {
		guides:{},
		prev:{},
		length:0,
//		activeGuideEle:{el:'.a2',position:'',zIndex:'',boxShadow:'',opacity:1},
		activeLen:0
	}
	//定义新手指引构造函数
	var guideConstruct =function(el,opt){
		this.$element = el;
		this.defaults ={
			//底层蒙版透明度，默认0.2
			maskingOpacity:0.2,
			position:'relative',
			boxShadow:'0px 0px 0px 1980px #fff',
			opacity:0.9,
			//步数长度
			length:1,
			steps:[{el:'body',title:'新手指引',content:'这是新手指引内容'}]
		};
		this.options = $.extend({},this.defaults,opt);
	};
	//定义guide方法
	guideConstruct.prototype = {
		//创建一个灰白全屏蒙版
		createMasking : function(){
			//如果不存在则添加一个蒙版
			if($("#masking").length == 0){
				var str = "<div id='masking'></div>";
				$("body").append(str);
				$('#masking').css({
					width:'100%',
					height:'100%',
					position:'fixed',
					top:0,
					left:0,
					backgroundColor:'#000',
					opacity:this.options.maskingOpacity
				});
				return $("#masking");
			}
		},
		showGuide:function(){
			show(this);
		}
	};
	$.extend({
		//新手向导初始化,创立蒙版.
	    guideInit:function(opacatiy){
			var opacity = opacatiy || '0.2';
	        var guide = new guideConstruct(this, {'maskingOpacity':opacity});
	        return guide.createMasking();
		},
		showGuide:function(arg){
			var guide = new guideConstruct(this,{'steps':arg});
			guideObject.guides = guide;
			return guide.showGuide();
		},
		guideClose:function(){
			//关闭蒙版，如果存在蒙版则移除，不存在则提示
			if($("#masking").length > 0){
				$("#masking").remove();
			}
			else{
				console.log("并没有创建masking蒙版");
			}
		},
	});
	//结束指引
	$("body").delegate("#guide-end","click",function(){
		//移除弹出的指引框
		$(".guide").remove();
		//移除蒙版
		$("#masking").remove();
		//还原上一步样式
		if(guideObject.prev.el){
			$(guideObject.prev.el).css({
				position:guideObject.prev.position,
	        	boxShadow:guideObject.prev.boxShadow,
	        	zIndex:guideObject.prev.zIndex,
	        	opacity:guideObject.prev.opacity
			});
		}
		guideObject.activeLen = 0;
	});
	//上一步
	$("body").delegate("#guide-prev","click",function(){
		if(guideObject.activeLen>0){
			guideObject.activeLen--;
			guideObject.guides.showGuide(); 
		}
	});
	//下一步
	$("body").delegate("#guide-next","click",function(){
		if(guideObject.activeLen<guideObject.length-1){
			guideObject.activeLen++;
			guideObject.guides.showGuide();
		}
	});
	function show(arg){
		var steps = arg.options.steps;
		guideObject.length = steps.length;
		var i=guideObject.activeLen;
//		for(var i in steps){
			//移除之前的
			$(".guide").remove();
			//还原之前操作记录的css
			$(guideObject.prev.el).css({
				position:guideObject.prev.position,
	        	boxShadow:guideObject.prev.boxShadow,
	        	zIndex:guideObject.prev.zIndex,
	        	opacity:guideObject.prev.opacity
			});
			//记录当前元素要改的Css属性
			guideObject.prev.el = steps[i].el;
			guideObject.prev.position = $(steps[i].el).css("position") || '';
			guideObject.prev.boxShadow = $(steps[i].el).css("boxShadow") || '';
			guideObject.prev.zIndex = $(steps[i].el).css("zIndex")=='auto'? '':$(steps[i].el).css("zIndex");
			guideObject.prev.opacity = $(steps[i].el).css("opacity") || '';
			//创建右侧指引
			var str='<div class="guide" style="position:absolute;padding-bottom:4px; top:'+$(steps[i].el).offset().top+'px;left:'+($(steps[i].el).offset().left+$(steps[i].el).width())+'px;width: 200px;background-color: #fff;z-index: 999;box-shadow: 1px 1px 3px 3px #aaa;">'+
	        	'<div style="background-color:#343F55;text-align: center;height: 24px;line-height: 24px;"><span class="guide-title" style="color: #fff;font-size: 14px;">'+steps[i].title+'</span></div>'+
	        	'<div style="padding:2px 8px"><span class="guide-content" style="font-size: 12px;">'+steps[i].content+'</span></div><div style="text-align:center">'+
	        	'<button id="guide-prev" type="button" style="font-size:14px;padding:4px;background-color: #367cee;color: #fff;margin:0px 8px;border:0px;border-radius: 4px;">上一步</button>'+
	        	'<button id="guide-next" type="button" style="font-size:14px;padding:4px;background-color: #367cee;color: #fff;margin-right: 8px;border:0px;border-radius: 4px;">下一步</button>'+
	        	'<button id="guide-end" style="font-size:14px;background-color: #ee364c;padding:4px;color: #fff;border:0px;border-radius: 4px;">结束指引</button>'+
	        '</div></div>';
	        $("body").append(str);
	        //i=0时上一步变成灰色
	        if(i == 0){
	        	$("#guide-prev").css("background-color","#888");
	        }
	        //i=steps.length-1时，下一步变灰色
	        if(i == steps.length-1){
	        	$("#guide-next").css("background-color","#888");
	        }
	        $(steps[i].el).css({
	        	position:'relative',
	        	boxShadow:"0px 0px 0px 1980px #111",
	        	zIndex:999,
	        	opacity:arg.options.opacity
	        });
//		}
	}
});
