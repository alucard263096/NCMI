<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require 'include/common.inc.php';

  if($_REQUEST["action"]=="login"){
	if(trim($_REQUEST["login_id"])==""){
		$smarty->assign("ErrorMsg",$SysLang["index"]["logincannotbenull"]);
	}else{
		$smarty->assign("login_id",$_REQUEST["login_id"]);
	}
	if(trim($_REQUEST["password"])==""){
		$smarty->assign("ErrorMsg",$SysLang["index"]["pswcannotbenull"]);
	}else{
		$smarty->assign("password",$_REQUEST["password"]);
	}
	require ROOT.'/classes/datamgr/user.cls.php';
	$login_id=$_REQUEST["login_id"];
	$password=$_REQUEST["password"];
	$userRows=$userMgr->getUserByName($login_id);

	if(count($userRows)==0||$userRows[0]["status"]!="A"){
		$smarty->assign("ErrorMsg",$SysLang["index"]["invaliduser"]);
	}else{
		$user=$userRows[0];
		if(md5($password)!=$user["password"]){
			$smarty->assign("ErrorMsg",$SysLang["index"]["incorrectpsw"]);
		}else{
			$_SESSION[SESSIONNAME]["SysUser"]=$user;
			if($_REQUEST["language"]!=""){
				$_SESSION[SESSIONNAME]["LangCode"]=$_REQUEST["language"];
			}
			WindowRedirect($CONFIG['smarty']['rootpath']."/Admin/about.php");
			exit();
		}
	}
  }
  
  $smarty->display(ROOT.'/templates/index.html');
  
?>