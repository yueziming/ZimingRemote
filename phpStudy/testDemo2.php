<?php
	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-22
	 * Time: 10:50
	 */
	$x = 6;
	$y = 8;
	function myTest(){
		/*global $x,$y;
		$y = $x+$y;*/
		$GLOBALS['y'] =$GLOBALS['x']+$GLOBALS['y'];
	}
	myTest();
	echo $y;
?>
<?php
	function myTest2()
	{
		static $x=0;
		echo "<br>";
		echo $x;
		$x++;
	}
	myTest2();
	myTest2();
	myTest2();
?>
<?php
	echo "<h2>PHP 很有趣!</h2>";
	echo "Hello world!<br>";
	echo "我要学 PHP!<br>";
	echo "这是一个", "字符串，", "使用了", "多个", "参数。";
?>
<?php
	$txt1 = "这是Php字符串变量输出的";
	$language = array("PHP","java","c#","c++");
	echo $txt1;
	echo "<br>";
	echo "这是用 {$language[0]} 语言写的";
?>
<?php
	print "<h2>PHP 很有趣!</h2>";
	print "Hello world!<br>";
	print "我要学习 PHP!";
?>
<?php
	$x = 5985;
	var_dump($x);
	echo "<br>";
	$x = -345; // 负数
	var_dump($x);
	echo "<br>";
	$x = 0x8C; // 十六进制数
	var_dump($x);
	echo "<br>";
	$x = 047; // 八进制数
	var_dump($x);
?>
<?php
	$x = 10.365;
	var_dump($x);
	echo "<br>";
	$x = 2.4e3;
	var_dump($x);
	echo "<br>";
	$x = 8E-5;
	var_dump($x);
?>
<?php
	$cars=array("Volvo","BMW","Toyota");
	var_dump($cars);
?>
<?php
	$x="Hello world!";
	$x=null;
	var_dump($x);
?>
<?php
	// 区分大小写的常量名
	define("GREETING", "欢迎访问 Runoob.com",true);
	echo GREETING;    // 输出 "欢迎访问 Runoob.com"
	echo '<br>';
	echo greeting;   // 输出 "greeting"
?>
<?php
	$txt1="Hello world!";
	$txt2="What a nice day!";
	echo $txt1 . "   "  .  $txt2, PHP_EOL;
	echo "字符串长度为：<br>";
	echo strlen($txt1 . ""  .  $txt2);
?>
<?php
	echo strpos("Hello world!","world");
?>
<?php
	$x=10;
	$y=6;
	echo ($x + $y); // 输出16
	echo '<br>';  // 换行

	echo ($x - $y); // 输出4
	echo '<br>';  // 换行

	echo ($x * $y); // 输出60
	echo '<br>';  // 换行

	echo ($x / $y); // 输出1.6666666666667
	echo '<br>';  // 换行

	echo ($x % $y); // 输出4
	echo '<br>';  // 换行

	echo -$x;
?>
