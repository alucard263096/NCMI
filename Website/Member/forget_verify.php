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

  $email=$_REQUEST["email"];
  $verifycode=$_REQUEST["verifycode"];

  $member=$memberMgr->verifyForgetMember($email,$verifycode);

  if($member!=null){
	$action=$_REQUEST["action"];
	$password=$_REQUEST["password"];
	if($action=="submit"){
		$memberMgr->resetPassword($member["id"],$password);
		$member["password"]=md5($password);
		$_SESSION[SESSIONNAME]["member"]=$member;
		echo "RIGHT";
		exit;
	}else{
		$smarty->assign("verifycode",$verifycode);
		$smarty->assign("email",$email);
		$smarty->assign("loginname",$member["loginname"]);
		$smarty->display(ROOT.'/templates/Member/reset_password.html');
	}
  }else{
	if($_SESSION[SESSIONNAME]["member"]["id"]==""){
		WindowRedirect("info.php");
	}else{
		WindowRedirect("login.php");
	}
  }
  
?>