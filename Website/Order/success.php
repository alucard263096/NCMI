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
  require ROOT.'/classes/datamgr/order.cls.php';
  require ROOT.'/classes/mgr/gensee.cls.php';
  
  $action=$_REQUEST["action"];

  if($action=="submit"){

  echo "RIGHT";
  exit;
  }else{
	  $id=$_REQUEST["id"];
	  $info=$orderMgr->getOrder($id);
	  $orderMgr->updateOrderPayment($id);
	  $meeting_time=explode("-",$info["meeting_time"]);
	  $meetingret=$genseeMgr->createMeeting($doctor_name,$info["meeting_date"]." ".$meeting_time[0],$info["meeting_date"]." ".$meeting_time[1]);
	  $smarty->assign("info",$info);
	  if($meetingret["code"]!="0"){
		
		$smarty->assign("reason","预约会诊失败");
		$smarty->assign("reason_message","请联系管理员或者客服帮你重新设置预约，十分感谢你的支持。");
		$smarty->display(ROOT.'/templates/Order/fail.html');
	  }else{
		$orderMgr->updateMeetingInfo($id,$meetingret);
		$smarty->display(ROOT.'/templates/Order/success.html');
	  }

  }
?>