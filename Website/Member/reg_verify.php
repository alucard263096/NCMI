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

  $member=$memberMgr->verifyMember($email,$verifycode);

  if($member!=null){
	$member["is_verify"]='Y';
	$_SESSION[SESSIONNAME]["member"]=$member;
	WindowRedirect("info.php");
  }else{
	WindowRedirect("login.php");
  }
  
?>