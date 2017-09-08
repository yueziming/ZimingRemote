<?php

	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-5-23
	 * Time: 11:48
	 */
	class test2{
	}
	class site{
		//变量url和title
		var $url;
		var $title;
		function __construct($arg1,$arg2){
			$this->url = $arg1;
			$this->title = $arg2;
		}
		/*function  site($arg1,$arg2){
			$this -> url = $arg1;
			$this -> title = $arg2;
		}*/
		function setUrl($per){
			$this -> url = $per;
		}
		function setTitle($per){
			$this -> title = $per;
		}
		function getUrl(){
			echo $this -> url;
			echo "<br>";
		}
		function getTitle(){
			echo $this -> title;
			echo "<br>";
		}
	}
	class Child_site extends site{
		var $category;

			function setCate($arg){
				$this->category = $arg;
			}
			function getCate(){
				echo $this -> category;
				echo "<br>";
			}
	}
	$baidu = new Child_site("http://www.baidu.com","百度搜索");
	$facebook = new Child_site("http://www.facebook.com","脸书");

	echo "百度的网址为：";
	$baidu -> getUrl();
	echo "百度别名为：";
	$baidu -> getTitle();
	echo "facebook的网址为：";
	$facebook -> getUrl();
	echo "facebook别名为：";
	$facebook -> getTitle();
?>