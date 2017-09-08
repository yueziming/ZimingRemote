<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>php  Demo3</title>
	<link rel="stylesheet" type="text/css" href="css/demo03.css">
</head>
<body>
	<?php
		/**
		 * Created by PhpStorm.
		 * User: 0967
		 * Date: 2017-5-22
		 * Time: 15:18
		 */
		$t = date("H");
		if($t<"12"){
			echo "good morning!";
		}
		else{
			echo "good afternoon";
		}
	?>
	<?php
		$cars=array("Volvo","BMW","Toyota");
		echo PHP_EOL;
		echo count($cars);
	?>
	<?php
		$fruit=array("apple","banana","Toyota");
		$arrlength=count($cars);

		for($x=0;$x<$arrlength;$x++)
		{
			echo $cars[$x];
			echo "<br>";
		}
	?>
	<p>代码展示：</p>
	<ol>
		<li>
			<code>&lt?php</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;$fruit=array("apple","banana","Toyota");</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;$arrlength=count($cars);</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;for($x=0;$x<$arrlength;$x++){</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;&nbsp;&nbsp;echo $cars[$x];</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;&nbsp;&nbsp;echo "&ltbr&gt";</code>
		</li>
		<li>
			<code>&nbsp;&nbsp;}</code>
		</li>
		<li>
			<code>?></code>
		</li>
	</ol>
	<?php
		$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
		echo "Peter is " . $age['Peter'] . " years old.";
	?>
	<?php
//		当前执行脚本的文件名，与 document root 有关。
		echo $_SERVER['PHP_SELF'];
		echo "<br>";
//		ip地址
		echo $_SERVER['SERVER_ADDR'];
		echo "<br>";
//		当前运行脚本所在的服务器的主机名
		echo $_SERVER['SERVER_NAME'];
		echo "<br>";
		echo $_SERVER['HTTP_HOST'];
		echo "<br>";
		/*echo $_SERVER['HTTP_REFERER'];
		echo "<br>";*/
		echo $_SERVER['HTTP_USER_AGENT'];
		echo "<br>";
		echo $_SERVER['SCRIPT_NAME'];
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		Name: <input type="text" name="fname">
		<input type="submit">
	</form>
	<?php
		$name = $_REQUEST['fname'] ?  $_REQUEST['fname'] : '';
//		$name = $_REQUEST['fname'];
		echo $name;
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		Name: <input type="text" name="fname">
		<input type="submit">
	</form>

	<?php
		$name = $_POST['fname'];
		echo $name;
	?>
</body>

