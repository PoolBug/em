<?php 
	session_start();
	if( isset($_SESSION['u_id']))
		$u_id = $_SESSION['u_id'];
	else
	{
		$u_id = "tempUser";	
		echo "please <a href='index.html'>login</a> first";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Images You Make before</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/history.css" />
	<link rel="stylesheet" href="css/basic.css" />
</head>
<body>
	<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">EM</a>
            <div class="nav-collapse">
				<ul class="nav">
				  <li><a href="home.php">Home</a></li>
				  <li class="active"><a href="#">History</a></li>
				  <li><a href="help.html" target="_blank">Help</a></li>
				  <li><a href="#">Contact Us</a></li>
				</ul>
				<div class="btn"><a href="server/php/logout.php">Sign out</a></div>
            </div>
        </div>
    </div>
</div>
	<div class="container">
		<div class="row-fluid">
			<div class="page-header">
			<h1>History</h1>
			</div>
			<ul class="thumbnails">
			<?php 
				$conn = @mysql_connect("localhost","root","");
				if (!$conn){
					die("Fail to connect database. Error:" . mysql_error());
				}
				
				mysql_query( 'SET NAMES UTF8' ); 
				mysql_select_db("em", $conn);
				
				// get and show imgs by u_id
				$sql = "select * from resultimg where u_id='$u_id'";
				$imgs_resource = mysql_query($sql);
				$img_info = mysql_fetch_array( $imgs_resource );
				while( $img_info )
				{
					$img_path = "server/php/users/" . $u_id . "/result/" . $img_info["img_id"] . ".jpg";
					$content = $img_info["content"];
			?>
				
			  <li class="span3">
			    <div class="thumbnail">
			      <img src="<?= $img_path ?>" />
			      <textarea disabled="disabled" rows="3"><?= $content ?></textarea><br />
			      <a href="server/php/editImageDescription.php?image_id=<?=$img_info['img_id'] ?>"><button class="btn">Edit</button></a>
			      <button class="btn" onclick="destroyResultImage(<?=$img_info['img_id'] ?>);">Destroy</button>
			    </div>
			  </li>
	
			<?php 
					$img_info = mysql_fetch_array( $imgs_resource );
				}
			?>
			</ul>
		</div>
	</div>
<?php 
	function connectDB()
	{
		$conn = @mysql_connect("localhost","root","");
		if (!$conn){
			die("������ݿ�ʧ�ܣ�" . mysql_error());
		}
		
		mysql_query( 'SET NAMES UTF8' ); 
		mysql_select_db("em", $conn);
	}
?>
<script src="js/history.js"></script>
<script src="js/jquery.min.js"></script>

</body>
</html>