var Common = {
    //公共ajax方法
    ajax: function (url, type, data, callback) {
        Common.ajaxLoading();
        $.ajax({
            url: url,
            data: data,
            type: type,
            beforeSend: function (request) {
                var token = $("meta[name=csrf-token]").attr("content");
                if (token) {
                    request.setRequestHeader("X-CSRF-TOKEN", token);
                }
            },
            dataType: 'json',
            success: function (res) {
                callback(res);
                Common.ajaxLoadingStop();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(textStatus);
                Common.validateAjaxStatus(XMLHttpRequest.status);
                /*layer.alert('网络异常,获取数据失败！', {
                    title: '警告',
                    icon: 0,
                });*/
                // Common.tips("网络异常,获取数据失败", 1500);
                Common.ajaxLoadingStop();
            }
        });
    },
    ajaxStatusDictionary:{
        status:{
            //请求成功
            "201":"对象创建成功并返回相应资源数据。",
            "202":"接受请求，但无法立即完成创建行为，比如其中涉及到一个需要花费若干小时才能完成的任务。返回的实体中应该包含当前状态的信息，以及指向处理状态监视器或状态预测的指针，以便客户端能够获取最新状态。",
            "204":"请求执行成功，不返回相应资源数据，如 PATCH ， DELETE 成功。",
            //重定向
            "301":"被请求的资源已永久移动到新位置。",
            "302":"请求的资源现在临时从不同的 URI 响应请求。",
            "303":"对应当前请求的响应可以在另一个 URI 上被找到，客户端应该使用 GET 方法进行请求。",
            "307":"对应当前请求的响应可以在另一个 URI 上被找到，客户端应该保持原有的请求方法进行请求。",
            //条件请求
            "304":"资源自从上次请求后没有再次发生变化，主要使用场景在于实现数据缓存。",
            "409":"请求操作和资源的当前状态存在冲突。主要使用场景在于实现并发控制。",
            "412":"服务器在验证在请求的头字段中给出先决条件时，没能满足其中的一个或多个。主要使用场景在于实现并发控制。",
            //客户端错误
            "400":"请求体包含语法错误。",
            "401":"需要验证用户身份。",
            "403":"服务器拒绝执行。",
            "404":"找不到目标资源。",
            "405":"不允许执行目标方法，响应中应该带有 Allow 头，内容为对该资源有效的 HTTP 方法。",
            "406":"服务器不支持客户端请求的内容格式，但响应里会包含服务端能够给出的格式的数据。",
            "410":"被请求的资源已被删除。",
            "413":"POST 或者 PUT 请求的消息实体过大。",
            "415":"服务器不支持请求中提交的数据的格式。",
            "422":"请求格式正确，但是由于含有语义错误，无法响应。",
            "428":"要求先决条件，如果想要请求能成功必须满足一些预设的条件。",
            //服务端错误
            "500":"服务器遇到了一个未曾预料的状况，导致了它无法完成对请求的处理。",
            "501":"服务器不支持当前请求所需要的某个功能。",
            "502":"作为网关或者代理工作的服务器尝试执行请求时，从上游服务器接收到无效的响应。",
            "503":"由于临时的服务器维护或者过载，服务器当前无法处理请求。"
        }
    },
    validateAjaxStatus:function (status) {
        layer.alert('网络异常状态码为：“'+status+'”<br//>请联系信息部获取支持！<br//>详细错误原因为：'+this.ajaxStatusDictionary.status[status], {
            title: '警告',
            icon: 0,
        });
    },
    //ajax的loading样式
    ajaxLoading: function () {
        var loadingHtml = '<div id="loading" class="spinner"><div class="spinner-container container1"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container2"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container3"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div>加载中</div>';
        $("body").append(loadingHtml);
    },
    //ajax的loading停止
    ajaxLoadingStop: function () {
        $("#loading").remove();
    },
    //设置本地sessionStorage
    setSession:function(key,value){
        if(typeof value == 'object'){
            sessionStorage.setItem(key,JSON.stringify(value));
        }
        else{
            sessionStorage.setItem(key,value);
        }
    },
    //获取本地session数据
    getSession:function(key){
        try{
            var data = JSON.parse(sessionStorage.getItem(key));
        }catch(e){
            var data = sessionStorage.getItem(key);
        }
        return data;
    },
    //销毁本地sessionStorage
    destorySessionstorage:function(key){
        sessionStorage.removeItem(key);
    },
    CookieClass: function () {
        var self = this;
        /**
         * 设定Cookie
         * @param name 添加Cookie的名称
         * @param value 添加Cookie的值
         * @param expiresHours 添加Cookie的过期时间(单位：小时)
         * @param path 添加Cookie的域
         */
        self.setCookie = function (name, value, expiresHours, path) {
            if (arguments.length == 1) {
                Quasar._setError(-1, 11, '函数缺少必要参数', 'CookieClass/setCookie()');
                return false;
            }
            if (arguments.length == 2) expiresHours = 0;
            if (arguments.length == 3) path = '/';
            var cookieString = name + "=" + encodeURI(value);
            // 判断是否设置过期时间
            if (expiresHours > 0) {
                var date = new Date();
                date.setTime(date.getTime() + expiresHours * 3600 * 1000);
                cookieString = cookieString + "; expires=" + date.toUTCString() + "; path=" + path;
            }
            document.cookie = cookieString;
        };
        //noinspection JSUnusedGlobalSymbols
        /**
         * 获取Cookie
         * @param name 获取Cookie的名称
         *
         * @returns string|null|boolean 返回Cookie的值，无对应name的Cookie则返回null
         */
        self.getCookie = function (name) {
            if (arguments.length <= 0) {
                Quasar._setError(-1, 11, '函数缺少必要参数', 'CookieClass/getCookie()');
                return false;
            }
            var strCookie = document.cookie;
            var arrCookie = strCookie.split("; ");
            for (var i = 0; i < arrCookie.length; i++) {
                var arr = arrCookie[i].split("=");
                if (arr[0] == name) return decodeURI(arr[1]);
            }
            return null;
        };
        //noinspection JSUnusedGlobalSymbols
        /**
         * 删除Cookie
         * @param name 删除Cookie的名称
         */
        self.delCookie = function (name) {
            if (arguments.length <= 0) {
                Quasar._setError(-1, 11, '函数缺少必要参数', 'CookieClass/delCookie()');
                return false;
            }
            var date = new Date();
            date.setTime(date.getTime() - 10000);
            document.cookie = name + "=''; expires=" + date.toUTCString();
        };
    },
    /**
     *            正则判断字符串是否正确
     * @type {
 * {
 * 		IsEmail: RegExpClass.IsEmail,
 * 		IsMobile: RegExpClass.IsMobile,
 * 		IsTel: RegExpClass.IsTel,
 * 		IsCN: RegExpClass.IsCN,
 * 		IsNum: RegExpClass.IsNum,
 * 		IsUnSymbols: RegExpClass.IsUnSymbols
 * 		}
 * }
     */
    RegExpClass: function () {
        var self = this;
        /**
         *        验证字符串是否为空
         */
        self.IsNotEmpty = function (str) {
            if(str == '' || str == undefined){
                return false;
            }
            return true;
        };
        /**
         *        验证字符串是否为email
         */
        self.IsEmail = function (str) {
            var emailReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*\.[\w-]+$/i;
            return emailReg.test(str);
        };
        /**
         *        验证字符串是否为手机号码
         */
        self.IsMobile = function (str) {
            var patrn = /^((13[0-9])|(15[0-35-9])|(18[0,2,3,5-9]))\d{8}$/;
            return patrn.test(str);
        };
        /**
         *        验证字符串是否为电话或者传真
         */
        self.IsTel = function (str) {
            var patrn = /^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
            return patrn.test(str);
        };
        /**
         *        验证字符串是否为汉字
         */
        self.IsCN = function (str) {
            var p = /^[\u4e00-\u9fa5]+$/;
            return p.test(str);
        };
        /**
         * 验证字符串是否为数字
         */
        self.IsNum = function (str) {
            var p = /^\d+$/;
            return p.test(str);
        };
        /**
         *        验证字符串是否含有特殊字符
         */
        self.IsUnSymbols = function (str) {
            var p = /^[\u4e00-\u9fa5\w \.,()，ê?。¡ê（ê¡§）ê?]+$/;
            return p.test(str);
        };
    },
    /**
     * 金钱处理对象
     * @type {
 * {
 * 		toThousands: MoneyUtils.toThousands,
 * 		encodeMoney: MoneyUtils.encodeMoney,
 * 		decodeMoney: MoneyUtils.decodeMoney,
 * 		encodeRate: MoneyUtils.encodeRate,
 * 		decodeRate: MoneyUtils.decodeRate,
 * 		accAdd: MoneyUtils.accAdd,
 * 		accDiv: MoneyUtils.accDiv,
 * 		accMul: MoneyUtils.accMul
 * 		}
 * }
     */
    MoneyUtils: function () {
        var self = this;
        //对金额进行千位符的格式化
        self.toThousands = function (count) {
            var temp1;
            var temp2 = 0;
            try {
                temp1 = count.toString().split(".")[0];
                temp2 = count.toString().split(".")[1];
                var num = (temp1 || 0).toString(), result = '';
                while (num.length > 3) {
                    result = ',' + num.slice(-3) + result;
                    num = num.slice(0, num.length - 3);
                }
                if (num) {
                    if (temp2 != undefined) {
                        result = num + result + "." + temp2;
                    } else {
                        result = num + result;
                    }
                }
            } catch (e) {
                temp1 = count;
                var num = (temp1 || 0).toString(), result = '';
                while (num.length > 3) {
                    result = ',' + num.slice(-3) + result;
                    num = num.slice(0, num.length - 3);
                }
                if (num) {
                    result = num + result;
                }
            }
            return result;
        };
        //处理一下，解决js浮点型运算的问题。
        //将数字转换成xxx万 精确到分，小数点后6位
        self.encodeMoney = function (count) {
            var self = this;
            var money = self.accDiv(Number(count), 10000);
            var t;
            try {
                t = money.toString().split(".")[1].length;
            } catch (e) {
                t = 0;
            }
            if (t > 6) {
                //2016.4.13 增加toFixed()函数去掉自动补零的功能
                for (var i = 6; i > 0; i++) {
                    var num = money.toString().split(".")[1].substring(i - 1, i)
                    if (num == 0) {
                        return money.toFixed(i - 1);
                    } else {
                        return money.toFixed(i);
                    }
                }
                //return money.toFixed(6);
            } else {
                return money;
            }
        };
        //将xx万转换成数字
        self.decodeMoney = function (count) {
            var self = this;
            var p_money = count.toString().replace(",", "");
            return self.accMul(Number(p_money), 10000);
        };
        //处理利率问题
        //把数字转换成千分之多少
        self.encodeRate = function (rate) {
            return 100 * (Number(rate) * 100) / 100;
        };
        //把千分之多少转换成数字
        self.decodeRate = function (rate) {
            return (Number(rate) * 100) / (100 * 100);
        };
        //添加浮点型的加减乘除。解决js浮点型的bug
        //加法函数，用来得到精确的加法结果
        //说明：javascript的加法结果会有误差，在两个浮点数相加的时候会比较明显。这个函数返回较为精确的加法结果。
        //调用：accAdd(arg1,arg2)
        //返回值：arg1加上arg2的精确结果
        self.accAdd = function (arg1, arg2) {
            var r1, r2, m;
            try {
                r1 = arg1.toString().split(".")[1].length
            } catch (e) {
                r1 = 0
            }
            try {
                r2 = arg2.toString().split(".")[1].length
            } catch (e) {
                r2 = 0
            }
            m = Math.pow(10, Math.max(r1, r2))
            return (arg1 * m + arg2 * m) / m
        };
        //除法函数，用来得到精确的除法结果
        //说明：javascript的除法结果会有误差，在两个浮点数相除的时候会比较明显。这个函数返回较为精确的除法结果。
        //调用：accDiv(arg1,arg2)
        //返回值：arg1除以arg2的精确结果
        self.accDiv = function (arg1, arg2) {
            var t1 = 0, t2 = 0, r1, r2;
            try {
                t1 = arg1.toString().split(".")[1].length
            } catch (e) {
            }
            try {
                t2 = arg2.toString().split(".")[1].length
            } catch (e) {
            }
            with (Math) {
                r1 = Number(arg1.toString().replace(".", ""))
                r2 = Number(arg2.toString().replace(".", ""))
                return (r1 / r2) * pow(10, t2 - t1);
            }
        };
        //乘法函数，用来得到精确的乘法结果
        //说明：javascript的乘法结果会有误差，在两个浮点数相乘的时候会比较明显。这个函数返回较为精确的乘法结果。
        //调用：accMul(arg1,arg2)
        //返回值：arg1乘以arg2的精确结果
        self.accMul = function (arg1, arg2) {
            var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
            try {
                m += s1.split(".")[1].length
            } catch (e) {
            }
            try {
                m += s2.split(".")[1].length
            } catch (e) {
            }
            return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
        };
    }
};
/**
 * 封装ajax函数
 * @constructor
 */
function AjaxHelper() {
    this.ajax = function (url, type, dataType, data, callback) {
        $.ajax({
            url: url,
            type: type,
            dataType: dataType,
            data: data,
            success: callback,
            error: function (xhr, errorType, error) {
               // alert('Ajax request error, errorType: ' + errorType + ', error: ' + error)
            }
        })
    }
}
AjaxHelper.prototype.get = function (url, data, callback) {
    this.ajax(url, 'GET', 'json', data, callback)
};
AjaxHelper.prototype.post = function (url, data, callback) {
    this.ajax(url, 'POST', 'json', data, callback)
};

AjaxHelper.prototype.put = function (url, data, callback) {
    this.ajax(url, 'PUT', 'json', data, callback)
};

AjaxHelper.prototype.delete = function (url, data, callback) {
    this.ajax(url, 'DELETE', 'json', data, callback)
};

AjaxHelper.prototype.jsonp = function (url, data, callback) {
    this.ajax(url, 'GET', 'jsonp', data, callback)
};

AjaxHelper.prototype.constructor = AjaxHelper;
(function () {
    /**
     * 为Array对象原型添加数组去重函数
     * @returns {Array} 返回去重后的数组
     * @constructor
     */
    Array.prototype.noRepeat = function () {
        var self = this;
        var defaultArr2 = [];
        for (var i = 0; i < self.length; i++) {
            if (defaultArr2.indexOf(self[i]) < 0) {
                defaultArr2.push(self[i])
            }
        }
        return defaultArr2;
    };
    /**
     * 为Date对象原型添加时间格式化函数
     *
     * @param pattern 时间模式。y, M, d, H, m, s, S, w, W, q分别代表年、月、日、时、分、秒、毫秒、周（中文）、周（英文）、季度
     * @returns string 返回时间模式对应的时间字符串
     */
    Date.prototype.format = function (pattern) {
        var o = {
            "d+": this.getDate(),
            "H+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
            "q+": Math.floor((this.getMonth() + 3) / 3),
            "S": this.getMilliseconds()
        };
        if (/(y+)/.test(pattern)) pattern = pattern.replace(new RegExp(RegExp.$1, 'g'), (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        if (/(W+)/.test(pattern)) pattern = pattern.replace(new RegExp(RegExp.$1, 'g'), _getFormat('week_cn', RegExp.$1.length, this));
        if (/(M+)/.test(pattern)) pattern = pattern.replace(new RegExp(RegExp.$1, 'g'), _getFormat('month', RegExp.$1.length, this));
        if (/(w+)/.test(pattern)) pattern = pattern.replace(new RegExp(RegExp.$1, 'g'), _getFormat('week_en', RegExp.$1.length, this));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(pattern)) { //noinspection JSUnfilteredForInLoop
                pattern = pattern.replace(new RegExp(RegExp.$1, 'g'), (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        return pattern;
        function _getFormat(type, len, obj) {
            type = type.toLowerCase();
            if (type == 'week_cn') {
                var cn = [
                    '日', '一', '二', '三', '四', '五', '六'
                ];
                switch (len) {
                    case 1:
                        return cn[obj.getDay()];
                        break;
                    case 2:
                        return '周' + cn[obj.getDay()];
                        break;
                    case 3:
                    default:
                        return '星期' + cn[obj.getDay()];
                        break;
                }
            }
            if (type == 'week_en') {
                var en = {
                    abbreviation: ['Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat'],
                    full: [
                        "Sunday",
                        "Monday",
                        "Tuesday",
                        "Wednesday",
                        "Thursday",
                        "Friday",
                        "Saturday"
                    ]
                };
                switch (len) {
                    case 1:
                        return obj.getDay();
                        break;
                    case 2:
                        return en.abbreviation[obj.getDay()];
                        break;
                    case 3:
                    default:
                        return en.full[obj.getDay()];
                        break;
                }
            }
            if (type == 'month') {
                var month = {
                    abbreviation: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    full: [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ]
                };
                switch (len) {
                    case 1:
                        return obj.getMonth() + 1;
                        break;
                    case 2:
                        return ("00" + (obj.getMonth() + 1)).substr(("" + (obj.getMonth() + 1)).length);
                        break;
                    case 3:
                        return month.abbreviation[obj.getMonth() + 1];
                        break;
                    case 4:
                    default:
                        return month.full[obj.getMonth() + 1];
                        break;
                }
            }
        }
    };
    /**
     *
     * @param position 删除空格的位置
     * @param char  需要删除的字符串
     * @returns {string}
     */
    /*String.prototype.trim = function (position, char) {
        if (position == 'leftRight') {
            return this.replace(new RegExp("(^[\\s" + char + "]*)|([\\s" + char + "]*$)", 'g'), '');
        } else if (position == 'left') {
            return this.replace(new RegExp("(^[\\s" + char + "]*)", 'g'), '');
        } else if (position == 'right') {
            return this.replace(new RegExp("([\\s" + char + "]*$)", 'g'), '');
        }
    }*/
})();

