<?php
include('../check_login.php');
include('../db.php');
include('../css.php');
$depth=array("teacher","course","chapter","section","subsection");
$user_id=$_COOKIE['user_id'];
$course_id=$_GET['id'];?>
<html>
<head>
</head>
	<body>
		<a href="/logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br/>
		<a href="home.php">&#2328;&#2352;</a><br/>
		<a href="student_home.php">&#x935;&#x93E;&#x92A;&#x938;</a><br><br>
<?php
		function funcname($depth,$index,$id,$parent_id)
		{
			if($index>=4)
				return;
			$data = mysql_query("SELECT * FROM ".$depth[$index]."_".$depth[$index+1]."s WHERE ".$depth[$index]."_id='$id' AND language='hindi'");
			while($info = mysql_fetch_assoc( $data ))
			{
				for($i=0;$i<$index;$i++)
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo $info[$depth[$index+1].'_name'];?>
				<a href="view_goals.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&parent_id=<?php echo $parent_id;?>">&#x932;&#x915;&#x94D;&#x937;&#x94D;&#x92F;</a>
				<a href="view_instruction.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&parent_id=<?php echo $parent_id;?>">&#x905;&#x928;&#x941;&#x926;&#x947;&#x936; &#x938;&#x93E;&#x92E;&#x917;&#x94D;&#x930;&#x940;</a><br>
	<?php		funcname($depth,$index+1,$info[$depth[$index+1].'_id'],$parent_id);
			}
			return;
		}
		$data = mysql_query("SELECT * FROM teacher_courses WHERE course_id='$course_id' AND language='hindi'");
		$info=mysql_fetch_assoc($data);
				echo $info['course_name'];?>
				<a href="view_goals.php?level=course&level_id=<?php echo $info['course_id'];?>&parent_id=<?php echo $info['course_id'];?>">&#x932;&#x915;&#x94D;&#x937;&#x94D;&#x92F;</a>
				<a href="view_instruction.php?level=course&level_id=<?php echo $info['course_id'];?>&parent_id=<?php echo $info['course_id'];?>">&#x905;&#x928;&#x941;&#x926;&#x947;&#x936; &#x938;&#x93E;&#x92E;&#x917;&#x94D;&#x930;&#x940;</a><br>
	<?php	funcname($depth,1,$course_id,$info['course_id']);
	?>
</body>
</html>
