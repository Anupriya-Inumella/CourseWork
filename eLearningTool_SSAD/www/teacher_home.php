<?php include('check_login.php'); include('db.php'); include('css.php');$depth=array("teacher","course","chapter","section","subsection");?>
<html>
	<head>
	</head>
	<body>
		<a href="/logout.php">Log out</a><br>
		<a href="/home.php">Home</a><br><br>
		Courses added by you are:<br>
		<?php
		function funcname($depth,$index,$id,$get_parent,$get_level)
		{
			if($index>=4)
				return;
			$data = mysql_query("SELECT * FROM ".$depth[$index]."_".$depth[$index+1]."s WHERE ".$depth[$index]."_id='$id' AND language='english'");
			while($info = mysql_fetch_assoc( $data ))
			{
				for($i=0;$i<$index;$i++)
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo $info[$depth[$index+1].'_name'];?>
				<a href="/create_goals.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>">goals</a>
				<a href="/create_instruction.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>">instruction material</a>
				<a href="/delete_course_teacher_php.php?level=<?php echo $index;?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&language=english">delete</a><br>
	<?php		funcname($depth,$index+1,$info[$depth[$index+1].'_id'],$get_parent,$get_level);
			}
			if($get_level==$depth[$index+1] and $get_parent==$id)
			{?>
				<form action="teacher_home_php.php?level=<?php echo $get_level; ?>&parent=<?php echo $get_parent;?>&parent_name=<?php echo $depth[$index];?>" method='post'>
					<?php
						for($i=0;$i<$index;$i++)
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?>
					<input type="text" name="create_name" autofocus="autofocus">
					<input type="submit" value="create<?php echo " ".$depth[$index+1]; ?>">
				</form>	
	<?php	}
			else
			{?>
				<form action="teacher_home.php?level=<?php echo $depth[$index+1];?>&parent=<?php echo $id; ?>" method="post">
					<?php 
						for($i=0;$i<$index;$i++)
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?>
					<input type="submit" value="  +  ">
				</form>
	<?php 	}
			return;
		}
		funcname($depth,0,$_COOKIE['user_id'],$_GET['parent'],$_GET['level']);
	?>
	</body>
</html>