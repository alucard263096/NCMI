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
  $id=$_REQUEST["id"];
  if($action=="submit"){
  $userMgr->updateCase($user["id"],$id,$_REQUEST);
  echo "RIGHT";
  exit;
  }else{
  
   $info=$userMgr->getCase($user["id"],$id);
   $order_time=explode("-",$info["meeting_time"]);
   $order_date=$info["meeting_date"]." ".$order_time;
   if($info["status"]!="F"&&($_REQUEST["setm"]=="Y"||time()>strtotime($order_date))){
		$userMgr->updateCaseInMeeting($user["id"],$id);
		$info["status"]="M";
   }
   $smarty->assign("info",$info);
   $smarty->display(ROOT.'/templates/User/case.html');
  }
?>