<?php
	namespace MyProject;

	echo '命名空间为："', __NAMESPACE__, '"'; // 输出 "MyProject"
	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-23
	 * Time: 9:38
	 */
	/**
	 * 魔术变量.
	 */
//	文件中的当前行号
	echo '这是第 " '  . __LINE__ . ' " 行';
//	文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名
	echo '<br/>';
	echo '该文件位于:' . __FILE__ . '。';
//	文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。
	echo '<br/>';
	echo '该文件目录为:' . __DIR__ . '。';
//	函数名称
	function test() {
		echo '<br/>';
		echo  '函数名为：' . __FUNCTION__ ;
	}
	test();
//	类的名称
	class test {
		function _print() {
			echo '类名为：'  . __CLASS__ . "<br>";
			echo  '函数名为：' . __FUNCTION__ ;
		}
	}
	$t = new test();
	$t->_print();
//	从基类继承的成员被插入的 SayWorld Trait 中的 MyHelloWorld 方法所覆盖。其行为 MyHelloWorld 类中定义的方法一致。优先顺序是当前类中的方法会覆盖 trait 方法，而 trait 方法又覆盖了基类中的方法。
	class Base {
		public function sayHello() {
			echo 'Hello ';
		}
	}

	trait SayWorld {
		public function sayHello() {
			parent::sayHello();
			echo 'World!';
		}
	}

	class MyHelloWorld extends Base {
		use SayWorld;
	}

	$o = new MyHelloWorld();
	$o->sayHello();
?>