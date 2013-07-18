<?php 
	session_start();
	session_destroy();
?>
<h1>Thanks for using</h1>
<?php
	echo "<meta http-equiv='refresh' content='1;url=../../index.html' />";
?>