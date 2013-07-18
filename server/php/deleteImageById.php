<?php 
	session_start();
	if( isset($_SESSION["u_id"]) )
		$user_id = $_SESSION["u_id"];
	else 
		echo "<h1>Please login first.</h1>", "<meta http-equiv='refresh' content='1;url=../../index.html' />";
		
	if( isset($_POST["image_id"]) )
		$image_id = $_POST["image_id"];
	else {
		echo "<h1>Sorry! No such image</h1>", "<meta http-equiv='refresh' content='1;url=../../history.html' />";
		exit;
	}
	if( imageBelongsToUser( $user_id, $image_id ) ){
		$_SESSION["image_id"] = $image_id;
	}
	else {
		echo "<h1>Sorry! No such image</h1>", "<meta http-equiv='refresh' content='1;url=../../history.html' />";
		exit;
	}
	
	//$image_src = "users/" . $user_id . "/result/" . $image_id . ".jpg";
	$delete_success = deleteImageById( $image_id );
	if ($delete_success){
		echo "Delete succeed!";
	} else {
		echo "Sorry! Fail to delete this.";
	}
?>

<?php 
function imageBelongsToUser( $user_id, $image_id )
{
	$conn = connectToDB();
	$sql = "select * from resultimg where img_id='$image_id'";
	$image_resource = mysql_query($sql);
	$image_info = mysql_fetch_array( $image_resource );
	mysql_close( $conn );
	
	if( $user_id == $image_info['u_id'] )
		return true;
	else
		return false;
}

function deleteImageById( $image_id )
{
	$conn = connectToDB();
	$sql = "delete from resultimg where img_id='$image_id'";
	$result = mysql_query($sql);

	mysql_close( $conn );
	return $result;
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
?>