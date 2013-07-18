<?php
session_start();
@header('Content-type:text/html;charset=UTF-8');
if( isset($_SESSION['image_id'])) 
	$image_id = $_SESSION['image_id'];
else{
	echo "<h1>Sorry! No such image</h1>", "<meta http-equiv='refresh' content='1;url=../../history.html' />";
	exit;
}
	
if ( isset($_POST["description"] ) )
	$content = htmlspecialchars( $_POST["description"] );
else 
	exit('No description<a href="javascript:history.back(-1);">返回</a>');
	//echo $image_id, $content;
updateDiscription($image_id, $content);


function getImageDescriptionById( $image_id )
{
	$conn = connectToDB();
	$sql = "select * from resultimg where img_id='$image_id'";
	$image_resource = mysql_query($sql);
	$image_info = mysql_fetch_array( $image_resource );
	mysql_close( $conn );
	return $image_info['content'];
}

function connectToDB()
{
	$conn = @mysql_connect("localhost","root","");
	if (!$conn){
		die("Fail to connect database. Error:" . mysql_error());
	}
	mysql_query( 'SET NAMES UTF8' ); 
	mysql_select_db("em", $conn);
	return $conn;
}
	
function updateDiscription($image_id, $content)
{
	$conn = connectToDB();
	//echo $image_id, $content, $conn;
	$cmd = "UPDATE resultimg SET content='$content' WHERE img_id=$image_id";
	$result = mysql_query($cmd);
	//echo $image_id, $content, $cmd;
	//var_dump( $result );
	if( $result )
		echo "<h1>恭喜！描述成功</h1>","<meta http-equiv='refresh' content='1; url=../../history.php' >";
	else
		exit('<h1>对不起！添加描述失败<a href="javascript:history.back(-1);">返回</a></h1>');
}
?>
<link rel="stylesheet" href="css/basic.css" />