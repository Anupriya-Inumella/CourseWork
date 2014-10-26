<?php include('../check_login.php'); include('../db.php'); include('../css.php'); ?>
<html>
	<head>
	</head>

	<body>
		<a href="../logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br>
		<a href="home.php">&#2328;&#2352;</a><br>
		<a href="course_material_student.php?id=<?php echo $_GET['parent_id'];?>">&#x935;&#x93E;&#x92A;&#x938;</a><br><br>
			&#x932;&#x915;&#x94D;&#x937;&#x94D;&#x92F; :<br>
			<?php $file=fopen("../goals/".$_GET['level']."_".$_GET['level_id'],"r");while(!feof($file)){echo nl2br(fgets($file));}fclose($file);?>
		</form>
	</body>
</html>