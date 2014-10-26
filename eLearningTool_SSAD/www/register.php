<?php include('check_not_login.php'); ?>
<html>
	<head>
	</head>
	<body>
		<form action="register_php.php" method="post" >

			<label for="register_user_name">Username :</label>
			<input type="text" name="register_user_name" id="register_user_name"><br>
			
			<label for="register_email">Email :</label>
			<input type="email" name="register_email" id="register_email"><br>
			
			<label for="register_password">Password :</label>
			<input type="password" name="register_password" id="register_password"><br>
			
			<label for="register_retype_password">Retype Password :</label>
			<input type="password" name="register_retype_password" id="register_retype_password"><br>
			
			Sex :
			<label for="register_male">male</label>
  			<input type="radio" name="register_sex" id="register_male" value="male"><br>
  			<label for="register_female">female</label>
  			<input type="radio" name="register_sex" id="register_female" value="female"><br><br>
			
			<input type="submit" value="Register">
		</form>
</body>
