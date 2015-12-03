<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require 'include/common.inc.php';
  require ROOT.'/classes/mgr/verifycode.cls.php';
  
$_vc = new VerifyCode();  //实例化一个对象
$_vc->doimg();  
$_SESSION[SESSIONNAME]['verifycode'] = $_vc->getCode();//验证码保存到SESSION中
  
?>