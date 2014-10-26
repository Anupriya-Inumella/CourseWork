<?php
	include("db.php");
	$level=$_GET['level'];
	$create_name=$_POST['create_name'];
	$parent=$_GET['parent'];
	$level_parent=$_GET['parent_name'];
	if($create_name!='' and mysql_num_rows(mysql_query("SELECT * from ".$level_parent."_".$level."s WHERE ".$level."_name='$create_name' AND ".$level_parent."_id='$parent'")) == 0)
	{
		mysql_query("insert into ".$level_parent."_".$level."s values('','$create_name','english','$parent')");
		$data=mysql_query("SELECT * from ".$level_parent."_".$level."s WHERE ".$level."_name='$create_name' AND ".$level_parent."_id='$parent'");
		$info=mysql_fetch_assoc($data);
		$file=fopen("instruction/".$level."_".$info[$level.'_id']."_instructions.txt", "w");			
		fclose($file);
		$file=fopen("goals/".$level."_".$info[$level.'_id'], "w");
		fwrite($file,"At the end of this lesson, you will be able to:");
		fclose($file);
	}
	header("Location: teacher_home.php");
?>