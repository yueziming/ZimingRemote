<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>第一个php网页</title>
</head>
<body>
	<?php
	echo "Hello World!";
	?>
	<?php
	//这是一个注释行
	?>
	<?php
		$x = 5;
		$y = 3;
		$z = $x+$y;
		echo $z;
	?>
	<?php
		$a = 5;//全局变量
		function myTest(){
			$b = 3;//局部变量
			echo "<p>测试函数内变量</p>";
			echo "变量 a 的值为：$a";
			echo "<br>";
			echo "变量 b 的值为：$b";
		}
		myTest();
		echo "<p>测试函数外变量</p>";
		echo "变量 a 的值为：$a";
		echo "<br>";
		echo "变量 b 的值为：$b";
	?>
</body>
</html>
