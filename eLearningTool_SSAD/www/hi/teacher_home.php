<?php include('../check_login.php'); include('../db.php'); include('../css.php');$depth=array("teacher","course","chapter","section","subsection");?>
<html>
	<head>
		<script src="keyboard.js"></script>
	</head>
	<body>
		<a href="/logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br>
		<a href="/hi/home.php">&#2328;&#2352;</a><br><br>
		&#x906;&#x92A;&#x915;&#x947; &#x926;&#x94D;&#x935;&#x93E;&#x930;&#x93E; &#x91C;&#x94B;&#x921;&#x93C;&#x93E; &#x92A;&#x93E;&#x920;&#x94D;&#x92F;&#x915;&#x94D;&#x930;&#x92E; &#x939;&#x948;&#x902;:<br>
		<?php
		function putspace($index)
		{
			for($i=0;$i<$index;$i++)
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
		function funcname($depth,$index,$id,$get_parent,$get_level)
		{
			if($index>=4)
				return;
			$data = mysql_query("SELECT * FROM ".$depth[$index]."_".$depth[$index+1]."s WHERE ".$depth[$index]."_id='$id' AND language='hindi'");
			while($info = mysql_fetch_assoc( $data ))
			{
				putspace($index);
				echo $info[$depth[$index+1].'_name']; ?>
				<a href="/hi/create_goals.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>">&#2354;&#2325;&#2381;&#2359;&#2381;&#2351;</a>
				<a href="/hi/create_instruction.php?level=<?php echo $depth[$index+1];?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>">&#x905;&#x928;&#x941;&#x926;&#x947;&#x936; &#x938;&#x93E;&#x92E;&#x917;&#x94D;&#x930;&#x940;</a>
				<a href="/delete_course_teacher_php.php?level=<?php echo $index;?>&level_id=<?php echo $info[$depth[$index+1].'_id'];?>&language=hindi">&#x92E;&#x93F;&#x91F;&#x93E;&#x928;&#x93E;</a><br>
	<?php		funcname($depth,$index+1,$info[$depth[$index+1].'_id'],$get_parent,$get_level);
			}
			if($get_level==$depth[$index+1] and $get_parent==$id)
			{?>
				<form action="teacher_home_php.php?level=<?php echo $get_level; ?>&parent=<?php echo $get_parent;?>&parent_name=<?php echo $depth[$index];?>" method='post'>
					<?php
						putspace($index);
						echo '<script>CreateCustomHindiTextBox("create_name","",40,true,"'.$depth[$index+1].'");</script>';?>
				</form>	
	<?php 	}
			else
			{?>
				<form action="teacher_home.php?level=<?php echo $depth[$index+1];?>&parent=<?php echo $id; ?>" method="post">
					<?php 
						putspace($index);
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