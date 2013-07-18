<html>
<head>
	<link rel="stylesheet" href="css/basic.css" />
</head>
<?php
	session_start();
	@header('Content-type:text/html;charset=UTF-8');

	$username = htmlspecialchars( $_POST['userName'] );
	$password = MD5( $_POST['userPwd'] );

	$conn = @mysql_connect("localhost","root","");
	if (!$conn){
		die("Fail to connect DB: " . mysql_error());
	}
	
	mysql_query( 'SET NAMES UTF8' ); 
	mysql_select_db("em", $conn);

	$check_query = mysql_query("select * from users where u_name='$username' and u_pwd='$password'");

	if($result = mysql_fetch_array($check_query)){
		//登录成功
		$_SESSION['u_id'] = $result['u_id'];
		echo "<h1>Login succeed!</h1>","<meta http-equiv='refresh' content='1; url=../../home.php' >";
	} 
	else 
	{
		exit('<h1>用户名或密码错误！<a href="javascript:history.back(-1);">返回</a></h1>');
	}
?>