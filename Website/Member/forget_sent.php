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
	$verifycode=$memberMgr->sentForgetVerifyCode($email);
	$url=$CONFIG['URL']."/Member/forget_verify.php?email=$email&verifycode=$verifycode";
	$mailMgr->sentForgetEmail($email,$url);
	
	$smarty->display(ROOT.'/templates/forget_sent.html');
  }else{
	WindowRedirect("reg.php");
  }
?>