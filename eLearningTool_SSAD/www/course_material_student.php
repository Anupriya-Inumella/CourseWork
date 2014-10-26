<?php
include('check_login.php');
include('db.php');
include('css.php');
$depth=array("teacher","course","chapter","section","subsection");
$user_id=$_COOKIE['user_id'];
$course_id=$_GET['id'];?>
<html>
<head>
	<?php include('css.php');?>
</head>
	<body>
		<a href="logout.php">Log out</a><br>
		<a href="home.php">Home</a><br>
		<a href="student_home.php">Back</a><br><br>
<?php
		function funcname($depth,$index,$id,$parent_id)
		{
			if($index>=4)
				return;
			$data = mysql_query("SELECT * FROM ".$depth[$index]."_".$depth[$index+1]."s WHERE ".$depth[$index]."_id='$id' AND language='english'");
			while($info = mysql_fetch_assoc( $data ))
			{
				for($i=0;$i<$index;$i++)
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo $info[$depth[$index+1].'_name'];?>
				<a href="/view_goals.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&parent_id=<?php echo $parent_id;?>">goals</a>
				<a href="/view_instruction.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&parent_id=<?php echo $parent_id;?>">instruction material</a><br>
	<?php		funcname($depth,$index+1,$info[$depth[$index+1].'_id'],$parent_id);
			}
			return;
		}
		$data = mysql_query("SELECT * FROM teacher_courses WHERE course_id='$course_id' AND language='english'");
		$info=mysql_fetch_assoc($data);
				echo $info['course_name'];?>
				<a href="/view_goals.php?level=course&level_id=<?php echo $info['course_id'];?>&parent_id=<?php echo $info['course_id'];?>">goals</a>
				<a href="/view_instruction.php?level=course&level_id=<?php echo $info['course_id'];?>&parent_id=<?php echo $info['course_id'];?>">instruction material</a><br>
	<?php	funcname($depth,1,$course_id,$info['course_id']);
	?>
</body>
</html>
