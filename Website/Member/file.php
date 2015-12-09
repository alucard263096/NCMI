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
  $id=$memberMgr->saveFile($member["id"],$_REQUEST);
  echo "RIGHT$id";
  exit;
  }else{
  $id=$_REQUEST["id"];
   $file=$memberMgr->getFile($member["id"],$id);
   $smarty->assign("info",$file);
	$smarty->assign("menuid","file");
	$smarty->display(ROOT.'/templates/Member/file.html');
  }
?>