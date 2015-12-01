<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/hospital.cls.php';

  $info=$hospitalMgr->getHospital($_REQUEST["id"]);
  if($info["count"]==""){
	$info["count"]=10000;
  }
  $smarty->assign("info",$info);
  
  $smarty->display(ROOT.'/templates/hospital.html');
  
?>