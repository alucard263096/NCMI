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
  require ROOT.'/classes/mgr/mail.cls.php';

  $email=$_REQUEST["email"];
  if($memberMgr->checkEmailUsed($email))
  {
	$smarty->assign("email",$email);
	$verifycode=$memberMgr->sentRegVerifyCode($email);
	//故意的
	if($verifycode!=""){
		$mailMgr->sentVerifyEmail($email,$CONFIG['URL']."/Member/reg_verify.php?email=$email&verifycode=$verifycode");
	}
	$smarty->display(ROOT.'/templates/reg_sent.html');
  }else{
	WindowRedirect("reg.php");
  }
?>