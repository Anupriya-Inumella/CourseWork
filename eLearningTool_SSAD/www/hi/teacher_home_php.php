<?php
	include("../db.php");
	$level=$_GET['level'];
	$create_name=$_POST['create_name'];
	$parent=$_GET['parent'];
	$level_parent=$_GET['parent_name'];
	if($create_name!='' and mysql_num_rows(mysql_query("SELECT * from ".$level_parent."_".$level."s WHERE ".$level."_name='$create_name' AND ".$level_parent."_id='$parent'")) == 0)
	{
		mysql_query("insert into ".$level_parent."_".$level."s values('','$create_name','hindi','$parent')");
		$data=mysql_query("SELECT * from ".$level_parent."_".$level."s WHERE ".$level."_name='$create_name' AND ".$level_parent."_id='$parent'");
		$info=mysql_fetch_assoc($data);
		$file=fopen("../instruction/".$level."_".$info[$level.'_id']."_instructions.txt", "w");			
		fclose($file);
		$file=fopen("../goals/".$level."_".$info[$level.'_id'], "w");
		fwrite($file,"&#x907;&#x938; &#x92A;&#x93E;&#x920; &#x915;&#x947; &#x905;&#x902;&#x924; &#x92E;&#x947;&#x902; &#x906;&#x92A; &#x915;&#x930;&#x928;&#x947; &#x92E;&#x947;&#x902; &#x938;&#x915;&#x94D;&#x937;&#x92E; &#x939;&#x94B; &#x91C;&#x93E;&#x90F;&#x917;&#x93E;:");
		fclose($file);
	}
	header("Location: teacher_home.php");
?>