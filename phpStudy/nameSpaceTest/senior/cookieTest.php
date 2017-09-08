<?php
	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-24
	 * Time: 11:12
	 */
	//设置一个30秒过期的cookie
	setcookie("user", "yueziming", time()+30);
	echo $_COOKIE["user"];
	print_r($_COOKIE);
	if (isset($_COOKIE["user"]))
		echo "欢迎 " . $_COOKIE["user"] . "!<br>";
	else
		echo "普通访客!<br>";
	// 设置 cookie 过期时间为过去 1 小时,删除cookie的方法
	//setcookie("user", "", time()-3600);
?>