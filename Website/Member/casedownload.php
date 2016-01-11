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

   $id=$_REQUEST["id"];
   $info=$memberMgr->getCase($member["id"],$id);

   $smarty->assign("info",$info);
   $smarty->display(ROOT.'/templates/Member/casedownload.html');
?>