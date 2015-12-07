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
  $password=$_REQUEST["password"];
  if($action=="submit"){
	$ret=$memberMgr->loginMember($loginname);
	if($ret["id"]==""){
		echo "NO_MEMBER";
		exit;
	}else if($ret["status"]!="A"){
		echo "INACTIVE_MEMBER";
		exit;
	}else if($ret["password"]!=md5($password)){
		echo "PASSWORD_INCORRECT";
		exit;
	}else if($ret["is_verify"]!='Y'){
		echo "NEED_VERIFY".$ret["email"];
		exit;
	}else{
		$_SESSION[SESSIONNAME]["member"]=$ret;
		echo "RIGHT";
	}
  }else{
	$smarty->display(ROOT.'/templates/Member/login.html');
  }
?>