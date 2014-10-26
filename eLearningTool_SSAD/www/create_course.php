<?php include('check_login.php'); include('db.php');include('css.php');?>
<html>
	<head>
<!--		<script src="goal_selection.js"></script>
		<script src="create_course.js"></script>-->
	</head>

	<body>
		<a href="logout.php">Log out</a><br>
		<a href="home.php">Home</a><br>
		<a href="teacher_home.php">Back</a><br><br>
		<form action="create_goals.php" id="goals_form" method="POST">
			<label>
				course name :<input type="text" id="create_courses_course_name" name="create_courses_course_name" autofocus="autofocus"><br><br>
			</label>
			<input type="submit" value="create course"><br>
		</form>
	</body>
</html>
