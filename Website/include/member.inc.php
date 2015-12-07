<?php


  $member=$_SESSION[SESSIONNAME]["member"];
  if($member==null||$member["id"]==""){
		WindowRedirect($CONFIG['URL']."/Member/login.php");
  }

?>