<?php
	include('../check_login.php');
	include('../db.php');
	include('../css.php');
?>
<html>
	<head>
	</head>
	<body>
		<a href="/logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br/>
		<a href="home.php">&#2328;&#2352;</a><br/>
		<a href="course_registration.php">&#x92A;&#x902;&#x91C;&#x940;&#x915;&#x943;&#x924; &#x928;&#x90F; &#x92A;&#x93E;&#x920;&#x94D;&#x92F;&#x915;&#x94D;&#x930;&#x92E;</a><br/><br>
		&#x909;&#x92A;&#x92F;&#x94B;&#x917;&#x915;&#x930;&#x94D;&#x924;&#x93E; &#x926;&#x94D;&#x935;&#x93E;&#x930;&#x93E; &#x92A;&#x902;&#x91C;&#x940;&#x915;&#x943;&#x924; &#x92A;&#x93E;&#x920;&#x94D;&#x92F;&#x915;&#x94D;&#x930;&#x92E;:<br/>
		<?php
			$student_id=$_COOKIE['user_id'];
			
			$query1 = mysql_query("SELECT * FROM student_courses where student_id='$student_id'");
			while($info1 = mysql_fetch_assoc( $query1 )) 
			{
				$course_id=$info1['course_id'];
				$query2=mysql_query("SELECT * from teacher_courses WHERE course_id='$course_id' and language='hindi'");
				if($info2 = mysql_fetch_assoc($query2))
				{
  			?>	<a href="course_material_student.php?id=<?php echo $info2['course_id'] ?>"><?php echo $info2['course_name']?></a>
				<a href="delete_course_student_php.php?id=<?php echo $info2['course_id'] ?>">&#x905;&#x92A;&#x902;&#x91C;&#x940;&#x915;&#x944;&#x924;</a><?php
				echo $course_name.'<br/>';
				}
			}
		?>
	</body>
</html>
