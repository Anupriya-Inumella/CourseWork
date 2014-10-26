<?php
	include('check_not_login.php');
	include('db.php');
	include('css.php');
?>
<html>
	<body>
		<form action="/index_php.php" method="post">
			<label for="index_user_name">Username :</label>
			<input type="text" name="index_user_name" id="index_user_name"><br>
			<label for="index_password">Password :</label>
			<input type="password" name="index_password" id="index_password"><br>
			<input type="submit" name="login" value="login"><br>
		</form>
		<form action="/register.php">
			<input type="submit" name="register" value="register"><br>
		</form>
	</body>
</html>
