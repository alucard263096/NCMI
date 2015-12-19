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
  if($action=="submit"){
  $memberMgr->saveCaseInMember($member["id"],$_REQUEST);
  echo "RIGHT";
  exit;
  }else{
  $id=$_REQUEST["id"];
   $info=$memberMgr->getCase($member["id"],$id);

   $smarty->assign("info",$info);
	$smarty->assign("menuid","case");
	$smarty->display(ROOT.'/templates/Member/case.html');
  }
?>