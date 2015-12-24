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
  require ROOT.'/classes/datamgr/doctor.cls.php';
  require ROOT.'/classes/datamgr/user.cls.php';
  
  $doctor=$doctorMgr->getDoctor($user["id"]);
  $smarty->assign("doctor",$doctor);
  $case=$userMgr->getCase($user["id"],$_REQUEST["id"]);
  $smarty->assign("info",$case);
  $smarty->display(ROOT.'/templates/User/contract.html');
?>