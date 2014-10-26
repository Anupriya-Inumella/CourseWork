<?php  include('../check_login.php'); include('../css.php'); ?>
<html>
	<head>
		<script src="keyboard.js"></script>
		<script src="goal_selection.js"></script>
		<script src="create_goals.js"></script>
	</head>

		<body>
		<a href="home.php">&#2328;&#2352;</a>
		<a href="teacher_home.php">&#x92A;&#x940;&#x91B;&#x947; &#x91C;&#x93E;&#x928;&#x93E;</a>
		<a href="../logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a>
		<form action="create_goals_php.php?level_id=<?php echo $_GET['level_id']; ?>&level=<?php echo $_GET['level']; ?>" id="goals_form" method="POST">
			<label>
				&#x938;&#x94D;&#x924;&#x930; :<select id="level" name="level" ></select><br>
			</label>
			<label>
				&#x938;&#x93F;&#x902;&#x939;&#x93E;&#x935;&#x932;&#x94B;&#x915;&#x928; :<br><textarea name="text" id="overview" rows="6" cols="70" ></textarea><br>
			</label>
			<label>
				&#x909;&#x926;&#x94D;&#x926;&#x947;&#x936;&#x94D;&#x92F; &#x932;&#x93F;&#x916;&#x928;&#x947; &#x915;&#x947; &#x932;&#x93F;&#x90F; &#x915;&#x94D;&#x930;&#x93F;&#x92F;&#x93E; :<br><select id="verb" name="verb" size="6"></select><br>
			</label>
			&#x909;&#x926;&#x93E;&#x939;&#x930;&#x923; &#x909;&#x926;&#x94D;&#x926;&#x947;&#x936;&#x94D;&#x92F; :<br>
			<textarea name="text" id="example_objective" rows="6" cols="70" >
			</textarea><br>
			&#x932;&#x915;&#x94D;&#x937;&#x94D;&#x92F; :<br>
			
			<?php $file=fopen("../goals/".$_GET["level"]."_".$_GET["level_id"],"r");?>
			<script language="javascript">CreateCustomHindiTextArea("create_goals_goal_list","",90,5,true);</script><?php while(!feof($file)){echo fgets($file);}fclose($file);?></textarea><br>
			<input type="submit" value="&#x932;&#x915;&#x94D;&#x937;&#x94D;&#x92F;&#x94B;&#x902; &#x915;&#x94B; &#x938;&#x941;&#x930;&#x915;&#x94D;&#x937;&#x93F;&#x924; &#x915;&#x930;&#x928;&#x947; &#x915;&#x947; &#x932;&#x93F;&#x90F;"><br>
		</form>
	</body>
</html>