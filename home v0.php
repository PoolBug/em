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
	<title>EM - EnJoin Your Image</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<script src='uploadFront.js'></script>
	<script type="test/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/home.css" />
	<link rel="stylesheet" href="css/basic.css" />
</head>
<body>
	<div class="navbar">
	  <div class="navbar-inner">
	    <a class="brand" href="#">EM</a>
	    <ul class="nav">
	      <li class="active"><a href="#">Home</a></li>
	      <li><a href="history.php">History</a></li>
	      <li><a href="help.html" target="_blank">Help</a></li>
	      <li><a href="#">Contact Us</a></li>
	    </ul>
	    <div class="btn"><a href="">Sign out</a></div>
	  </div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<h1>Upload your image</h1>
			<div class="">							
				<form action="backstage/saveImg.php" method="post" enctype="multipart/form-data">
				<div id='imgField'>
					<div class='aImgField span3'>
						<input class='upfile' type='file' name='upfile[]' style='display:none' accept='image/gif,image/jpg,image/jpeg' onchange='imagePreview(this)' />
						<img class='imgPlace img-rounded' src='symbolAdd.png' onclick='clickUploadFile( this )' /><br />
						<input class='delBtn btn span4' type='button' value='Delete' onclick='deleteAImgField(this)' />
					</div>	
				</div>
				<div class="span12">
					<input class="btn btn-primary btn-large" type='button' value='Submit' id="submitBtn" />
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>