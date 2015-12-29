<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/include/user.inc.php';
  require ROOT.'/classes/datamgr/user.cls.php';
  $action=$_REQUEST["action"];
  if($action=="submit"){
	  $ret = $userMgr->updateVacation($user["id"],$_REQUEST["year"],$_REQUEST["month"],$_REQUEST["days"]);
	  echo $ret;
	  exit;
  }else{
  
	$smarty->display(ROOT.'/templates/User/scheduleupdate.html');
  }
  
?>