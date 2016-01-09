<?php


  require ROOT.'/classes/datamgr/website.cls.php';
  $siteinfo=$websiteMgr->getWebsiteInfo();
  $smarty->assign("SITEINFO",$siteinfo);
  $member=$_SESSION[SESSIONNAME]["member"];
  if($member!=null&&$member["id"]!=""){
	$smarty->assign("MEMBER",$member);
	$smarty->assign("LOGINED","Y");
  }
  $user=$_SESSION[SESSIONNAME]["user"];
  if($user!=null&&$user["id"]!=""){
	$smarty->assign("USER",$user);
	$smarty->assign("USERLOGINED","Y");
  }

?>