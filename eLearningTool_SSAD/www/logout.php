<?php
	include('check_login.php');
	setcookie("user_id","",time()-3600,"/");
	header("location:/index.php");
?>
