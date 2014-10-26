<?php
mysql_connect("localhost", "root", "admin") or die ("Could not connect to mysql because ".mysql_error());
mysql_select_db("proj") or die ("Could not select database because ".mysql_error());
?>
