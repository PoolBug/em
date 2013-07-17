<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<style>
			form { text-align:center; }
			img { height: 400px; margin:30px;}
			body { background-color:#E6E8FA; text-align: center; }
			input {     color:#fff;
					vertical-align:middle;
					background:-webkit-gradient(linear,left top, left bottom, from(#008fd5), to(#0085c6));
					background: -moz-linear-gradient(left, #008fd5, #0085c6); 
					background: -o-linear-gradient(left,#008fd5, #0085c6); 
					border:1px solid #bbbbbb;
					border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.1);
					border-bottom-color:#a2a2a2;

					font-size:18px;}
		</style>
	</head>
<?php
	//precondition: the path of images 
	//postcondition: the number of images in $path directory

	function getAllImg($path)
	{
		if( file_exists($path) )
		{
			$handler = opendir($path);
			while ( ($filename = readdir($handler)) !== false ) 
				if ($filename != "." && $filename != "..") 
					$fileArr[] = $filename ;  
					
			closedir($handler);
     
			$handler = fopen( $path."/data.txt", 'w');
			if( $handler )
			{
				foreach ($fileArr as $value) 
					fwrite( $handler, $path."/".$value."\r\n" );	
			}
		}
	
		return count( $fileArr );
	}
	
	function callExe()
	{		
		if( isset( $_SESSION['u_id']) )
			$u_id = $_SESSION['u_id'];
		else
			$u_id = 'tempUser';
	
		$path = 'users/'.$u_id.'/tempImgs';
		$imgNum = getAllImg($path);
		//call exe here
		$cmd = "program\\auto_joiner.exe ".$imgNum." ".$path."/data.txt ".$path."/result.jpg";

		exec($cmd, $output);
		if( file_exists($path."\\result.jpg") )
		{
			//echo "<img src='".$path."/result.jpg'>";
			$img = reNameImg($u_id);
			echo "<img src='".$img."'>";
			?>
			
			<form action="updateDiscription.php" method="post" enctype="multipart/form-data">
				<div>添加描述：</div>
				<textarea id="description" name="description" rows="5" cols='30'></textarea><br />
				<input type="submit" value="提交" />
			</form>
			
			<?php
		}
		else
			echo "<h1>Sorry! Merge Fail!<br />Your images may not have enough common point to be merged.<br />You can try again.</h1>", "<meta http-quiv='refresh' content='1, ../home.php' />";
			
		//echo $imgNum;
	}
	
	//return img_id
	function initDiscription($u_id)
	{
		$conn = @mysql_connect("localhost","root","");
		if (!$conn){
			die("连接数据库失败：" . mysql_error());
		}
		
		mysql_query( 'SET NAMES UTF8' ); 
		mysql_select_db("em", $conn);
		
		$sql = "INSERT INTO resultimg (u_id,content) VALUES ('$u_id',' ')";
		if( mysql_query($sql,$conn) )
		{
			return mysql_insert_id();
		}
		return "test";
	}
	
	function reNameImg($u_id)
	{
		$img_id = initDiscription($u_id);
		$_SESSION['img_id'] = $img_id;
		//updateDiscription($img_id, "new result image");
		$newName = $img_id.'.jpg';
	
		$img_path = 'users/'.$u_id.'/tempImgs';
		$img_oldName = $img_path."/result.jpg";
		$img_newName = $img_path."/".$newName;
		$toPath = 'users/'.$u_id.'/result';
	
		if( file_exists($img_oldName) )
		{	
			rename($img_oldName,$img_newName);
		}
	
		if( file_exists($toPath) )
		{
			copy($img_newName,$toPath.'/'.$newName);
		}
		else
		{
			@chmod( '.', 0777);
			@mkdir( $toPath );
			copy($img_newName,$toPath.'/'.$newName);
		}
		
		return $toPath.'/'.$newName;
	}
	
	function updateDiscription($img_id, $content)
	{
		$conn = @mysql_connect("localhost","root","");
		if (!$conn){
			die("连接数据库失败：" . mysql_error());
		}
		
		mysql_query( 'SET NAMES UTF8' ); 
		mysql_select_db("em", $conn);
		
		$sql = "UPDATE resultimg SET content='$content' WHERE img_id='$img_id'";	
		mysql_query($sql,$conn);
	}
?>

</html>