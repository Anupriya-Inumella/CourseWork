		<?php
			include('check_login.php');
			include('db.php');
			include('css.php');
		?>
<html>
	<head>
	</head>
	<body>
		<a href="logout.php">Log out</a><br/>
		<a href="home.php">Home</a><br/>
		<a href="course_registration.php">Register New Course(s)</a><br/><br>
		courses registered by the user<br/>
		<?php
			$student_id=$_COOKIE['user_id'];
			
			$query1 = mysql_query("SELECT * FROM student_courses where student_id='$student_id'");
			while($info1 = mysql_fetch_assoc( $query1 )) 
			{
				$course_id=$info1['course_id'];
				$query2=mysql_query("SELECT * from teacher_courses WHERE course_id='$course_id' and language='english'");
  			if($info2 = mysql_fetch_assoc($query2))
				{
  			?>	<a href="course_material_student.php?id=<?php echo $info2['course_id'] ?>"><?php echo $info2['course_name']?></a>
				<a href="delete_course_student_php.php?id=<?php echo $info2['course_id'] ?>">unregister</a><?php
				echo $course_name.'<br/>';
				}
			}
		?>
	</body>
</html>
