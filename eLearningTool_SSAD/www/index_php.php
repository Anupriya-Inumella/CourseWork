<?php
	include('check_not_login.php');
	include('db.php');
	include('css.php');
/*			variables from  index.php for validating login		*/
	$password=MD5($_POST['index_password']);
	$user_name=$_POST['index_user_name'];

/*			validating user credentials with our database			*/	
	if(mysql_num_rows(mysql_query("SELECT * FROM user_info WHERE user_name='$user_name' and password='$password'"))==1)
	{
		$query=mysql_query("SELECT * from user_info WHERE user_name='$user_name'");
		$user_id_tupple=mysql_fetch_assoc($query);
		$user_id=$user_id_tupple['user_id'];
		setcookie("user_id",$user_id,time()+3600,"/");
		header("location:/home.php");
	}
?>
<html>
<head>
</head>
<body>
Wrong username or password!
<br/>
<a href="/index.php">back</a>
</body>
</html>
