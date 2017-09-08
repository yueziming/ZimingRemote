<?php
	//数组变量记录允许的文件名后缀
	$allowedExts = array("gif","jpeg","jpg","png");
	//将文件名以.分割分成一个数组
	$temp = explode(".",$_FILES["file"]["name"]);
	//取出文件后缀名并保存
	$extension = end($temp);
	if((($_FILES["file"]["type"]=="image/gif")
	|| ($_FILES["file"]["type"]=="image/jpeg")
	|| ($_FILES["file"]["type"]=="image/jpg")
	|| ($_FILES["file"]["type"]=="image/pjpeg")
	|| ($_FILES["file"]["type"]=="image/x-png")
	|| ($_FILES["file"]["type"]=="image/png"))
	&&($_FILES["file"]["size"]<204800)&&in_array($extension,$allowedExts)){
		if($_FILES["file"]["error"]>0){
			echo "错误：" . $_FILES["file"]["error"] . "<br>";
		}
		else{
			echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
			echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
			echo "文件大小: " . $_FILES["file"]["size"] /1024 . " kB<br>";
			echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] ."<br>";

			//判断文件是否存在
			if(file_exists("upload/" . $_FILES["file"]["name"])){
				echo "文件:" . $_FILES["file"]["name"] . "已存在";
			}
			//保存文件到upload文件夹目录下
			else{
				//move_uploaded_file第一个参数临时文件名，第二个参数存放目录名
				move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
				echo "文件上传成功，存放在" . "upload/" . $_FILES["file"]["name"] . "目录下";
			}
		}
	}
	else{
		echo "非法的文件格式";
	}
?>