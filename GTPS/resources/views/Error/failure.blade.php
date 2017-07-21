<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="<{$waitSecond}>; url=<{$jumpUrl}>">-->
    <title>{{$code}}:{{$message}}</title>
    <style>
        html, body{
            width       : 100%;
            margin      : 0;
            padding     : 0;
            font-family : '微软雅黑', serif;
        }

        #dialog{
            width         : 500px;
            margin        : 100px auto 0;
            box-shadow    : rgba(80, 80, 80, 0.20) 0 0 5px 5px;
            border-radius : 5px;
            position      : relative;
            padding       : 20px;
            z-index       : 2;
            background    : #FCFCFC;
        }

        #icon{
            background-color : #AC2925;
            width            : 100px;
            height           : 100px;
            border-radius    : 50%;
            text-align       : center;
            font-size        : 50px;
            color            : white;
            box-shadow       : 0 15px 10px -15px #000;
            float            : left;
            font-family      : 'Segoe Print', serif;
        }

        #message{
            width       : 350px;
            margin-left : 50px;
            float       : left;
            font-size   : 18px;
            color       : darkgray;
        }

        #jump{
            width       : 350px;
            margin-left : 50px;
            margin-top  : 10px;
            float       : left;
            font-size   : 14px;
            color       : darkgray;
        }

        .clean_float{
            clear : both;
        }

        @keyframes rotate-y{
            0%{ transform : rotateY(90deg) rotateX(-90deg) }
            15%{ transform : rotateY(15deg) rotateX(-15deg) }
            85%{ transform : rotateY(-15deg) rotateX(15deg) }
            100%{ transform : rotateY(-90deg) rotateX(90deg) }
        }

        @-webkit-keyframes rotate-y{
            0%{ -webkit-transform : rotateY(90deg) rotateX(-90deg) }
            15%{ -webkit-transform : rotateY(15deg) rotateX(-15deg) }
            85%{ -webkit-transform : rotateY(-15deg) rotateX(15deg) }
            100%{ -webkit-transform : rotateY(-90deg) rotateX(90deg) }
        }

        @-moz-keyframes rotate-y{
            0%{ -moz-transform : rotateY(90deg) rotateX(-90deg) }
            15%{ -moz-transform : rotateY(15deg) rotateX(-15deg) }
            85%{ -moz-transform : rotateY(-15deg) rotateX(15deg) }
            100%{ -moz-transform : rotateY(-90deg) rotateX(90deg) }
        }

        @-o-keyframes rotate-y{
            0%{ -o-transform : rotateY(90deg) rotateX(-90deg) }
            15%{ -o-transform : rotateY(15deg) rotateX(-15deg) }
            85%{ -o-transform : rotateY(-15deg) rotateX(15deg) }
            100%{ -o-transform : rotateY(-90deg) rotateX(90deg) }
        }

        .rotateY{
            animation         : rotate-y {{$wait_second}}s ease both;
            -moz-animation    : rotate-y {{$wait_second}}s ease both;
            -webkit-animation : rotate-y {{$wait_second}}s ease both;
            -o-animation      : rotate-y {{$wait_second}}s ease both;
        }

        @keyframes move-y{
            0%{ transform : translateY(-100px) }
            10%{ transform : translateY(10px) }
            15%{ transform : translateY(0) }
            85%{ transform : translateY(0) }
            90%{ transform : translateY(5px) }
            100%{ transform : translateY(-100px) }
        }

        @-webkit-keyframes move-y{
            0%{ -webkit-transform : translateY(-100px) }
            10%{ -webkit-transform : translateY(10px) }
            15%{ -webkit-transform : translateY(0) }
            85%{ -webkit-transform : translateY(0) }
            90%{ -webkit-transform : translateY(5px) }
            100%{ -webkit-transform : translateY(-100px) }
        }

        @-moz-keyframes move-y{
            0%{ -moz-transform : translateY(-100px) }
            10%{ -moz-transform : translateY(10px) }
            15%{ -moz-transform : translateY(0) }
            85%{ -moz-transform : translateY(0) }
            90%{ -moz-transform : translateY(5px) }
            100%{ -moz-transform : translateY(-100px) }
        }

        @-o-keyframes move-y{
            0%{ -o-transform : translateY(-100px) }
            10%{ -o-transform : translateY(10px) }
            15%{ -o-transform : translateY(0) }
            85%{ -o-transform : translateY(0) }
            90%{ -o-transform : translateY(5px) }
            100%{ -o-transform : translateY(-100px) }
        }

        .moveY{
            animation         : move-y {{$wait_second}}s ease both;
            -moz-animation    : move-y {{$wait_second}}s ease both;
            -webkit-animation : move-y {{$wait_second}}s ease both;
            -o-animation      : move-y {{$wait_second}}s ease both;
        }

        #foot{
            width         : 400px;
            margin        : 0 auto;
            box-shadow    : rgba(90, 90, 90, 0.10) 0 3px 3px 3px;
            border-radius : 5px;
            position      : relative;
            padding       : 5px;
            color         : grey;
            z-index       : 1;
            font-size     : 12px;
        }

        a[href]{
            text-decoration : none;
        }
    </style>
</head>
<body>
    <div id="dialog">
        <div id="icon" class="rotateY">×</div>
        <div id="message">{{$message}}</div>
        <div id="jump">
            <span id="wait">{{$wait_second}}</span>秒后会自动跳转<br> 若页面无响应请点击<a href="{{$return_page}}">此处</a>
        </div>
        <div class="clean_float"></div>
    </div>
    <div id="foot" class="moveY">
        Copyright ©2017-2018 Quasar All Rights Reserved<br> Email:
        <a href="mailto:lelouchcctony@163.com">lelouchcctony@163.com</a>
    </div>
    <script>
        (function(){
            var wait     = document.getElementById('wait'), href = '{{$return_page}}';
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time<=0){
                    clearInterval(interval);
                    location.href = href;
                }
            }, 1000);
        })();
    </script>
</body>
</html>