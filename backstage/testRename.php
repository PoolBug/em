<?php
	//image rename and save to result directory
	$u_id = '14';
	$newName = "new.jpg";
	
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
?>