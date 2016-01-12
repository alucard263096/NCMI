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

  if($action=="submit"){
	$verifycode=$_REQUEST["verifycode"];
	$loginname=$_REQUEST["loginname"];
	$email=$_REQUEST["email"];
	$password=$_REQUEST["password"];
	$sexual=$_REQUEST["sexual"];
	if(strtolower($verifycode)!=strtolower($_SESSION[SESSIONNAME]['verifycode'])){
		echo "INVALID_VERIFYCODE";
		exit;
	}elseif($memberMgr->checkLoginNameUsed($loginname)){
		echo "DUPLIC_LOGINNAME";
		exit;
	}elseif($memberMgr->checkEmailUsed($email)){
		echo "DUPLIC_EMAIL";
		exit;
	}else{
		$memberMgr->insertMember($loginname,$password,$email,$sexual);
		echo "RIGHT";
		exit;
	}
  }else{
	if($_REQUEST["parenturl"]!=""){
		$_SESSION[SESSIONNAME]["url_request"]=base64_decode($_REQUEST["parenturl"]);
	}
	$smarty->display(ROOT.'/templates/Member/reg.html');
  }
?>