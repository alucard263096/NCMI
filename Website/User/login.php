<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/user.cls.php';
  
  $action=$_REQUEST["action"];
  $loginname=$_REQUEST["loginname"];
  $password=$_REQUEST["password"];
  if($action=="submit"){
	$ret=$userMgr->loginUser($loginname);
	if($ret["id"]==""){
		echo "NO_MEMBER";
		exit;
	}else if($ret["status"]!="A"){
		echo "INACTIVE_USER";
		exit;
	}else{
		$_SESSION[SESSIONNAME]["user"]=$ret;
		echo "RIGHT";
	}
  }else{
	$smarty->display(ROOT.'/templates/User/login.html');
  }
?>