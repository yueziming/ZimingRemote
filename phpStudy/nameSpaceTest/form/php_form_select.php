<?php
	$q = isset($_GET['q'])? htmlspecialchars($_GET['q']) : '';
//	$q = isset($_POST['q'])? $_POST['q'] : '';
	if($q) {
		if($q =='RUNOOB') {
			echo '菜鸟教程<br>http://www.runoob.com';
		} else if($q =='GOOGLE') {
			echo 'Google 搜索<br>http://www.google.com';
		} else if($q =='TAOBAO') {
			echo '淘宝<br>http://www.taobao.com';
		}
	} else {
		?>
		<form action="" method="get">
			<select name="q">
				<option value="">选择一个站点:</option>
				<option value="RUNOOB">Runoob</option>
				<option value="GOOGLE">Google</option>
				<option value="TAOBAO">Taobao</option>
			</select>
			<input type="submit" value="提交">
		</form>
		<?php
	}
?>
<?php
	$q2 = isset($_POST['q2'])? $_POST['q2'] : '';
	if(is_array($q2)) {
		$sites = array(
			'RUNOOB' => '菜鸟教程: http://www.runoob.com',
			'GOOGLE' => 'Google 搜索: http://www.google.com',
			'TAOBAO' => '淘宝: http://www.taobao.com',
		);
		foreach($q2 as $val) {
			// PHP_EOL 为常量，用于换行
			echo $sites[$val] . PHP_EOL;
		}

	} else {
		?>
		<form action="" method="post">
			<select multiple="multiple" name="q2[]">
				<option value="">选择一个站点:</option>
				<option value="RUNOOB">Runoob</option>
				<option value="GOOGLE">Google</option>
				<option value="TAOBAO">Taobao</option>
			</select>
			<input type="submit" value="提交">
		</form>
		<?php
	}
?>
<?php
	$q3 = isset($_GET['q3'])? htmlspecialchars($_GET['q3']) : '';
	if($q3) {
		if($q3 =='RUNOOB') {
			echo '菜鸟教程<br>http://www.runoob.com';
		} else if($q3 =='GOOGLE') {
			echo 'Google 搜索<br>http://www.google.com';
		} else if($q3 =='TAOBAO') {
			echo '淘宝<br>http://www.taobao.com';
		}
	} else {
		?><form action="" method="get">
			<input type="radio" name="q3" value="RUNOOB" />Runoob
			<input type="radio" name="q3" value="GOOGLE" />Google
			<input type="radio" name="q3" value="TAOBAO" />Taobao
			<input type="submit" value="提交">
		</form>
		<?php
	}
?>
<?php
	$q4 = isset($_POST['q4'])? $_POST['q4'] : '';
	if(is_array($q4)) {
		$sites = array(
			'RUNOOB' => '菜鸟教程: http://www.runoob.com',
			'GOOGLE' => 'Google 搜索: http://www.google.com',
			'TAOBAO' => '淘宝: http://www.taobao.com',
		);
		foreach($q4 as $val) {
			// PHP_EOL 为常量，用于换行
			echo $sites[$val] . PHP_EOL;
		}

	} else {
		?><form action="" method="post">
			<input type="checkbox" name="q4[]" value="RUNOOB"> Runoob<br>
			<input type="checkbox" name="q4[]" value="GOOGLE"> Google<br>
			<input type="checkbox" name="q4[]" value="TAOBAO"> Taobao<br>
			<input type="submit" value="提交">
		</form>
		<?php
	}

?>
