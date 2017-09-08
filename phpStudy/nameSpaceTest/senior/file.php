<html>
<body>

	<?php
		echo "文件读写功能";
//		以只读方式打开文件
		$file=fopen("welcome.txt","r");

		//feof() 函数检测是否已到达文件末尾（EOF）。
		// 读取文件每一行，直到文件结尾
		while(!feof($file))
		{
			echo fgets($file). "<br>";
		}
		//关闭文件
		fclose($file);
	?>
	<?php
		$file=fopen("welcome.txt","r") or exit("无法打开文件!");
		//逐字符地读取文件，直到文件末尾为止：
		while (!feof($file))
		{
			echo fgetc($file);
		}
		fclose($file);
		echo PHP_VERSION;
	?>
</body>
</html>