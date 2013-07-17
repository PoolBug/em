<?php
   session_start();

	$username = $_POST['userName'];
	$password = $_POST['userPwd'];
	$errHint = '';

	$conn = @mysql_connect("localhost","root","");
	if (!$conn){
		$errHint = $errHint."连接数据库失败：" . mysql_error();
	}
	
	mysql_query( 'SET NAMES UTF8' ); 
	mysql_select_db("em", $conn);

	$check_query = mysql_query("select u_id from users where u_name='$username'");
	if(mysql_fetch_array($check_query)){
		$errHint = $errHint.'错误：用户名 '.$username.' 已存在';
	}

	if( $errHint=='' )
	{
		$password = MD5($password);
		$sql = "INSERT INTO users (u_name,u_pwd) VALUES ('$username','$password')";
		if(@mysql_query($sql,$conn))
		{
			$check_query = mysql_query("select * from users where u_name='$username' and u_pwd='$password'");
			$result = @mysql_fetch_array($check_query);
			$_SESSION['u_id'] = $result['u_id'];
			echo "true";
		} 
		else 
		{
			echo '抱歉！添加数据失败：',mysql_error(),'<br />';
		}
	}
	else
	{
		echo $errHint;
	}
?>
