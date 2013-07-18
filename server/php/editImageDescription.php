<?php 
	session_start();
	if( isset($_SESSION["u_id"]) )
		$user_id = $_SESSION["u_id"];
	else 
		echo "<h1>Please login first.</h1>", "<meta http-equiv='refresh' content='1;url=../../index.html' />";
		
	if( isset($_GET["image_id"]) )
		$image_id = $_GET["image_id"];
	else if ( isset($_SESSION["image_id"]) )
		$image_id = $_SESSION["image_id"];
	else 
	{
		echo "<h1>Sorry! No such image</h1>", "<meta http-equiv='refresh' content='1;url=../../history.php' />";
		//exit;
	}
	if( imageBelongsToUser( $user_id, $image_id ) ){
		$_SESSION["image_id"] = $image_id;
	}
	else {
		echo "<h1>Sorry! No such image</h1>", "<meta http-equiv='refresh' content='1;url=../../history.php' />";
		//exit;
	}
	
	$image_src = "users/" . $user_id . "/result/" . $image_id . ".jpg";
	$image_description = getImageDescriptionById( $image_id );
?>

<!DOCTYPE>
<html>
<head>
	<title>EM - Edit Image Info</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/basic.css">
</head>
<body>
	<div class="thumbnail">
		<h1>Result of merge</h1>
		<img src="<?= $image_src ?>" alt="" class="img-rounded"/>
		<form action="updateImageDescription.php" method="post" enctype="multipart/form-data">
			<h4>Description of the Image:</h4>
			<textarea name="description" rows="3"><?= $image_description ?></textarea><br />
			<button type="submit" class="btn">Submit</button>
			<p class="btn" onclick="giveUpEdit()">Back</p>
		</form>
	</div>
</body>
<script>
function giveUpEdit()
{
	if( confirm("Are you sure to give up eidt?") ){
		location.href = "../../history.php";
	}
}
</script>
</html>

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

function getImageDescriptionById( $image_id )
{
	$conn = connectToDB();
	$sql = "select * from resultimg where img_id='$image_id'";
	$image_resource = mysql_query($sql);
	$image_info = mysql_fetch_array( $image_resource );
	mysql_close( $conn );
	return htmlspecialchars_decode( $image_info['content'] );
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