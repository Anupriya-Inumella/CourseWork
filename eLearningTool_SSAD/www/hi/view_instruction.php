<?php include('../check_login.php');include('../css.php');?>
<html>
	<body>
		<a href="../logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br>
		<a href="home.php">&#2328;&#2352;</a><br>
		<a href="course_material_student.php?id=<?php echo $_GET['parent_id'];?>">&#x935;&#x93E;&#x92A;&#x938;</a><br><br>
		&#x936;&#x93F;&#x915;&#x94D;&#x937;&#x923; &#x938;&#x93E;&#x92E;&#x917;&#x94D;&#x930;&#x940;:<br>
		<?php
			$address="";
			$file=fopen("../instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "r");
     		while(!feof($file)){$address=fgets($file);
     			?><a href="<?php echo $address;?>"><?php echo nl2br($address)?></a><?php;}    
      		fclose($file);
      	?>
	</body>
</html>