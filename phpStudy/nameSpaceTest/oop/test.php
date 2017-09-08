<?php

	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-23
	 * Time: 11:35
	 */
	class test{
	}
	class Site {
		/* 成员变量 */
		var $url;
		var $title;

		/* 成员函数 */
		function setUrl($par){
			$this->url = $par;
		}

		function getUrl(){
			echo $this->url . PHP_EOL;
		}

		function setTitle($par){
			$this->title = $par;
		}

		function getTitle(){
			echo $this->title . PHP_EOL;
		}
	}
	//创建三个对象
	$baidu = new Site;
	$taobao = new Site;
	$google = new Site;
	//调用成员函数，设置url
	$baidu ->setUrl("http://www.baidu.com");
	$taobao ->setUrl("http://www.taobao.com");
	$google ->setUrl("http://www.google.hk.com");
//	调用成员函数，设置Title
	echo "百度网址为：";
	$baidu ->getUrl();
	echo "<br>";
	echo "淘宝网址为：";
	$taobao ->getUrl();
	echo "<br>";
	echo "谷歌网址为：";
	$google ->getUrl();
	echo "<br>";
?>