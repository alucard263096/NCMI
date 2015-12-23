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
  

  $info=$userMgr->getMeetingCase($_REQUEST["id"]+0);

  $smarty->assign("info",$info);
  
  $smarty->display(ROOT.'/templates/User/meetingdetail.html');
?>