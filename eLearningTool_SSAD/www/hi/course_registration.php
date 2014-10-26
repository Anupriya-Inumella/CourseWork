<?php
include('../db.php');
include('../check_login.php');
include '../css.php';
?>
<html>
<head>
</head>
<body>
<a href="/logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br/>
<a href="home.php">&#2328;&#2352;</a><br/>
<a href="student_home.php">&#x935;&#x93E;&#x92A;&#x938;</a><br/>
&#x92A;&#x93E;&#x920;&#x94D;&#x92F;&#x915;&#x94D;&#x930;&#x92E;&#x94B;&#x902; &#x915;&#x940; &#x938;&#x942;&#x91A;&#x940;:
<form action='course_registration_php.php' method='post'>
<?php
$data1 = mysql_query("SELECT * FROM teacher_courses where language='hindi'");
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
}
?>
<input type="submit"  name="submit" value="submit"/>
</form>

</body>
</html>
