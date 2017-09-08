<?php
	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-23
	 * Time: 10:14
	 */
	declare(encoding='UTF-8'); //定义多个命名空间和不包含在命名空间中的代码
	namespace nameSpaceTest{
		const CONNECT_OK = 1;
		class Connection { /* ... */ }
		function connect() { /* ... */  }
	}
	namespace { // 全局代码
		session_start();
		$a = MyProject\connect();
		echo MyProject\Connection::start();
	}
?>