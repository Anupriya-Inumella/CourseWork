<?php include('check_login.php');include('css.php');?>
<html>
	<body>
		<a href="logout.php">Log out</a><br>
		<a href="home.php">Home</a><br>
		<a href="course_material_student.php?id=<?php echo $_GET['parent_id'];?>">Back</a><br>
		Instruction Materials:<br>
		<?php
			$address="";
			$file=fopen("instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "r");
     		while(!feof($file)){$address=fgets($file);
     			?><a href="<?php echo $address;?>"><?php echo nl2br($address)?></a><?php;}    
      		fclose($file);
      	?>
	</body>
</html>