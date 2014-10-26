<?php
	include('check_not_login.php');
	include('db.php');
	$user_name=$_POST['register_user_name'];
	$email=$_POST['register_email'];
	$password=MD5($_POST['register_password']);
	$sex=$_POST['register_sex'];
	if(mysql_num_rows(mysql_query("SELECT * from user_info WHERE user_name='$user_name'")) == 0)
	{
		mysql_query("insert into user_info values('','$user_name','$sex','$email','$password')");
		setcookie("registered","yes",time()+2);
		header ("Location: index.php");
	}
?>
<html>
	<head>
	</head>
	<body>
		<p>Sorry, this username is already taken!</p>
		<a href="register.php">back</a>
	</body>
</html>