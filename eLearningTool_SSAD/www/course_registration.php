<?php
include('db.php');
include('check_login.php');
include 'css.php';
?>
<html>
<head>
</head>
<body>
<a href="logout.php">Log out</a><br/>
<a href="home.php">Home</a><br/>
<a href="student_home.php">Back</a><br/>
list of courses.
<form action='course_registration_php.php' method='post'>
<?php
$data1 = mysql_query("SELECT * FROM teacher_courses where language='english'");
$student_id=$_COOKIE['user_id'];
while($info1 = mysql_fetch_assoc( $data1 )) 
{
	$course_name=$info1['course_name'];
	$course_id=$info1['course_id'];
	if(mysql_num_rows(mysql_query("SELECT * FROM student_courses where 	student_id='$student_id' and course_id='$course_id'"))==0)
	{?>
		<label><input type="checkbox" name=<?php echo $course_id ?> value=<?php echo $course_id ?>><?php echo$course_name ?></label><br/>
	<?php
	}
}?>
<input type="submit"  name="submit" value="submit"/>
</form>

</body>
</html>
