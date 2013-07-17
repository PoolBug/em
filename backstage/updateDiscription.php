<?php
session_start();
@header('Content-type:text/html;charset=UTF-8');
if( isset($_SESSION['img_id'])) 
	$img_id = $_SESSION['img_id'];
else
	$img_id = 'test';
	
if( isset($_POST['description']))
	$content = $_POST['description'];
else
	$content = "result image.";

	updateDiscription($img_id, $content);
	
function updateDiscription($img_id, $content)
{
	$conn = @mysql_connect("localhost","root","");
	if (!$conn){
		die("连接数据库失败：" . mysql_error());
	}
		
	mysql_query( 'SET NAMES UTF8' ); 
	mysql_select_db("em", $conn);
		
	$sql = "UPDATE resultimg SET content='$content' WHERE img_id='$img_id'";	
	if( mysql_query($sql,$conn) )
		echo "描述成功！","<meta http-equiv='refresh' content='1; url=../home.php' >";
	else
		exit('描述失败<a href="javascript:history.back(-1);">返回</a>');
}
?>