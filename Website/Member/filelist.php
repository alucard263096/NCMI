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
  $filelist=$_REQUEST["filelist"];
  $memberMgr->deleteFileList($member["id"],$filelist);
  echo "RIGHT";
  exit;
  }else{
  
   $filelist=$memberMgr->getFileList($member["id"]);
   $smarty->assign("filelist",$filelist);
	$smarty->assign("menuid","file");
	$smarty->display(ROOT.'/templates/Member/filelist.html');
  }
?>