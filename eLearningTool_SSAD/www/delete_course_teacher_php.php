<?php
include('check_login.php');
include('db.php');
$depth=array("teacher","course","chapter","section","subsection");
function funcname($depth,$index,$id)
{
	if($index>=4)
		return;
	unlink("goals/".$depth[$index+1]."_".$id);
	array_map('unlink', glob("instruction/".$depth[$index+1]."_".$id."*"));
	mysql_query("delete from ".$depth[$index]."_".$depth[$index+1]."s where ".$depth[$index+1]."_id=".$id);
	if(index==0)
		mysql_query("delete from student_courses where course_id=".$id);
	if($index==3)
		return;
	$data=mysql_query("select * from ".$depth[$index+1]."_".$depth[$index+2]."s where ".$depth[$index+1]."_id=".$id);
	while($info=mysql_fetch_assoc($data ))
		funcname($depth,$index+1,$info[$depth[$index+2].'_id']);
	return;
}
funcname($depth,$_GET['level'],$_GET['level_id']);
if($_GET['language']=="english")
	header("Location:/teacher_home.php");
if($_GET['language']=="hindi")
	header("Location:/hi/teacher_home.php");
?>
