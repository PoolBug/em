<?php
	//echo count($_FILES['upfile']['name']);
	//var_dump( $_FILES );
	@header('Content-type:text/html;charset=UTF-8');
	
	//precondition:dirName必须是一个存在的目录的名字
	function removeDir( $dirName )
	{
		@chmod( $dirName, 0777);
		
		$handle = opendir($dirName);
		while( ($file=readdir($handle)) != false )
		{
			if( $file!='.' && $file!='..')
			{
				$dir = $dirName . '/'.$file;
				@chmod( $dir, 0777);
				@unlink($dir);
			}
		}
		closedir($handle);
		
		return @rmdir($dirName);
	}
	
	session_start();
	if( isset( $_SESSION['u_id']) )
	{
		$u_id = $_SESSION['u_id'];
	}
	else
	{
		$u_id = 'tempUser';
	}
	
	$folder = 'users';	
	$user_folder = 'users/'.$u_id;
	$img_folder = 'users/'.$u_id.'/tempImgs';
	if( file_exists($folder) )
	{	
		if( file_exists($user_folder) )
		{
			if( file_exists($img_folder) )
				removeDir( $img_folder );
		}
		else
		{
			@chmod( $folder, 0777);
			@mkdir( $user_folder );
		}
	}
	else
	{
		@chmod( ".", 0777);
		@mkdir( $folder );
		@chmod( $folder, 0777);
		@mkdir( $user_folder );		
	}
	
	@chmod( $user_folder, 0777);
	@mkdir( $img_folder );	
	
	@chmod( $img_folder, 0777);
	foreach( $_FILES['upfile']['error'] as $key => $error )
	{
		if( $error == UPLOAD_ERR_OK )
		{
			$tmp_name = $_FILES['upfile']['tmp_name'][$key];
			$fileName = $_FILES['upfile']['name'][$key];
			$uploadfile = $img_folder.'/'.$key.$fileName;
			
			@move_uploaded_file($tmp_name, $uploadfile);
		}
	}
	
	include_once "exeCall.php";
	callExe();
	
	/*
	include_once "getAllImg.php";
		$path = "images";
		$imgNum = getAllImg($path);
		echo $imgNum;
	*/
	?>