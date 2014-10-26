<?php
include('../db.php');
include('../check_login.php');
$user_id=$_COOKIE['user_id'];
$course_id=$_GET['id'];
mysql_query("delete from student_courses where course_id='$course_id' and student_id='$user_id'");
header("Location:student_home.php");
?>
