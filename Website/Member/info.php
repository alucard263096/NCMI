<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/include/member.inc.php';
  require ROOT.'/classes/datamgr/member.cls.php';
  $action=$_REQUEST["action"];

  $base_info=$memberMgr->getBaseInfo($member["id"]);
  $smarty->assign("base_info",$base_info);
  $smarty->assign("menuid","info");
  $smarty->display(ROOT.'/templates/Member/info.html');
?>