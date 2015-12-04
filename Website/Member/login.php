<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  
  $action=$_REQUEST["action"];

  if($action=="submit"){
	
  }else{
	$smarty->display(ROOT.'/templates/login.html');
  }
?>