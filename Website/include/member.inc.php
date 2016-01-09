<?php


  $member=$_SESSION[SESSIONNAME]["member"];
  if($member==null||$member["id"]==""){
	$_SESSION[SESSIONNAME]["url_request"]="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	WindowRedirect($CONFIG['URL']."/Member/login.php");
  }else{
	if($member["is_verify"]!="Y"){
		$email=$member["email"];
		WindowRedirect($CONFIG['URL']."/Member/reg_sent.php?email=$email");
	}
  }
  
	if(isset($_SESSION[SESSIONNAME]["url_request"]))
	{
		$url_request=$_SESSION[SESSIONNAME]["url_request"];
		unset($_SESSION[SESSIONNAME]["url_request"]);
		WindowRedirect($url_request);
	}
?>