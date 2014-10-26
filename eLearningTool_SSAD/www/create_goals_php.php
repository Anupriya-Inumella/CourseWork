<?php
include('check_login.php');
include('db.php');
$file=fopen("goals/".$_GET['level']."_".$_GET['level_id'], "w");
fwrite($file,$_POST['create_goals_goal_list']);
fclose($file);
header("Location:/teacher_home.php");
?>
