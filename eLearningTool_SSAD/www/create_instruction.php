<?php include('check_login.php');include('css.php');?>
<html>
	<body>
		<a href="logout.php">Log out</a><br>
		<a href="home.php">Home</a><br>
		<a href="teacher_home.php">Back</a><br><br>
		Instruction Materials:<br>
		<?php
			$address="";
			$file=fopen("instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "r");
     		while(!feof($file)){$address=fgets($file);
     			?><a href="<?php echo $address;?>"><?php echo nl2br($address)?></a><?php;}    
      		fclose($file);
      	?>


		<form action="create_instruction_php.php?level_id=<?php echo $_GET['level_id']; ?>&level=<?php echo $_GET['level']; ?>" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="419430404" />
			<input type="file" name="file" id="file"> <br>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>