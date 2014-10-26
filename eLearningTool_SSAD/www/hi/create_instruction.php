<?php include('../check_login.php');include('../css.php');?>
<html>
	<body>
		<a href="/logout.php">&#2354;&#2377;&#2327;&#2310;&#2313;&#2335;</a><br>
		<a href="/hi/home.php">&#2328;&#2352;</a><br>
		<a href="/hi/teacher_home.php">&#x92A;&#x940;&#x91B;&#x947; &#x91C;&#x93E;&#x928;&#x93E;</a><br><br>
		&#x905;&#x928;&#x941;&#x926;&#x947;&#x936; &#x938;&#x93E;&#x92E;&#x917;&#x94D;&#x930;&#x940; :<br>
		<?php
		$address="";
		$file=fopen("../instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "r");
		while(!feof($file)){$address=fgets($file);
		?><a href="<?php echo $address;?>"><?php echo nl2br($address)?></a><?php;}    
		fclose($file);
		?>


		<form action="/hi/create_instruction_php.php?level_id=<?php echo $_GET['level_id']; ?>&level=<?php echo $_GET['level']; ?>" method="post" enctype="multipart/form-data">
			<label for="file">&#x926;&#x938;&#x94D;&#x924;&#x93E;&#x935;&#x947;&#x91C;&#x93C;</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="419430404" />
			<input type="file" name="file" id="file"> <br>	
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>