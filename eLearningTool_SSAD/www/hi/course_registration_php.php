<?php
include('../check_login.php');
include('../db.php');
$data1 = mysql_query("SELECT * FROM teacher_courses where language='hindi'");
$student_id=$_COOKIE['user_id'];
while($info1 = mysql_fetch_assoc( $data1 )) 
{
	$course_id=$info1['course_id'];
	if($_POST[$course_id])
	{
		mysql_query("INSERT INTO student_courses values ('$student_id','$course_id')");
	}
}
header("Location:student_home.php");
?>
