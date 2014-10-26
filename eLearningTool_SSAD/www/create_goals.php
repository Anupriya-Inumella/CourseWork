<?php include('check_login.php'); include('db.php'); include('css.php'); ?>
<html>
	<head>
		<script src="goal_selection.js"></script>
		<script src="create_goals.js"></script>
	</head>

	<body>
		<a href="home.php">Home</a>
		<a href="teacher_home.php">Back</a>
		<a href="logout.php">Log out</a>
		<form action="create_goals_php.php?level_id=<?php echo $_GET['level_id']; ?>&level=<?php echo $_GET['level']; ?>" id="goals_form" method="POST">
			<label>
				level: <select id="level" name="level" ></select><br>
			</label>
			<label>
				Overview :<br><textarea name="text" id="overview" rows="6" cols="70" ></textarea><br>
			</label>
			<label>
				Verbs for writing Objectives :<br><select id="verb" name="verb" size="6"></select><br>
			</label>
			Example Objectives :<br>
			<textarea name="text" id="example_objective" rows="6" cols="70" >
			</textarea><br>
			Goals :<br>
			<textarea name="create_goals_goal_list" id="create_goals_goal_list" rows="6" cols="70" ><?php $file=fopen("goals/".$_GET['level']."_".$_GET['level_id'],"r");while(!feof($file)){echo fgets($file);}fclose($file);?></textarea><br>
			<input type="submit" value="save goals"><br>
		</form>
	</body>
</html>