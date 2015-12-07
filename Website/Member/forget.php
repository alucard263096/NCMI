<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/member.cls.php';
  
  $action=$_REQUEST["action"];
  $loginname=$_REQUEST["loginname"];
  $verifycode=$_REQUEST["verifycode"];
  $email=$_REQUEST["email"];

  if($action=="submit"){
	if($verifycode!=$_SESSION[SESSIONNAME]['verifycode']){
		echo "INVALID_VERIFYCODE";
		exit;
	}
	$ret=$memberMgr->loginMember($loginname);
	if($ret["id"]==""){
		echo "NO_MEMBER";
		exit;
	}else if($ret["status"]!="A"){
		echo "INACTIVE_MEMBER";
		exit;
	}else if($ret["email"]!=$email){
		echo "EMAIL_INCORRECT";
		exit;
	}else{
		$_SESSION[SESSIONNAME]["member"]=$ret;
		echo "RIGHT";
	}
  }else{
	$smarty->display(ROOT.'/templates/forget.html');
  }
?>