<?php include('check_login.php'); include('db.php'); include('css.php'); ?>
<html>
	<head>
		<script src="goal_selection.js"></script>
		<script src="create_goals.js"></script>
	</head>

	<body>
		<a href="logout.php">Log out</a><br>
		<a href="home.php">Home</a><br>
		<a href="course_material_student.php?id=<?php echo $_GET['parent_id'];?>">Back</a><br><br>
			Goals :<br>
			<?php $file=fopen("goals/".$_GET['level']."_".$_GET['level_id'],"r");while(!feof($file)){echo nl2br(fgets($file));}fclose($file);?>
		</form>
	</body>
</html>