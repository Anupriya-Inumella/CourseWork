<?php
  $allowedExts = array("jpg", "jpeg", "gif", "png");
  $extension = end(explode(".", $_FILES["file"]["name"]));
  if ($_FILES["file"]["error"] > 0)
  {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  }
  else
  {

    if (file_exists("../instruction/".$_GET['level']."_".$_GET['level_id']."_".$_FILES["file"]["name"]))
    {
      echo $_FILES["file"]["name"] . " already exists. ";
    }
    else
    {
      move_uploaded_file($_FILES["file"]["tmp_name"],"../instruction/".$_GET['level']."_".$_GET['level_id']."_".$_FILES["file"]["name"]);
      $address="";
      $file=fopen("../instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "r");
      while(!feof($file)){$address=$address.fgets($file);}      
      fclose($file);
      $file=fopen("../instruction/".$_GET['level']."_".$_GET['level_id']."_instructions.txt", "w");
      $address=$address."../instruction/".$_GET['level']."_".$_GET['level_id']."_".$_FILES["file"]["name"]."\n";
      fwrite($file,$address);
      fclose($file);
      header("Location: create_instruction.php?level=".$_GET['level']."&level_id=".$_GET['level_id']);
    }
  }
?>