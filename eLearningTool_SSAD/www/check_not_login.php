<?php
if(isset($_COOKIE['user_id']))
{
	header("location:/home.php");
}
else if(isset($_COOKIE["registered"]))
{
	echo "registered successfully!! Login to continue";
}
?>
