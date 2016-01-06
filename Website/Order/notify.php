<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/order.cls.php';
  require ROOT.'/classes/mgr/gensee.cls.php';
  require ROOT.'/classes/mgr/sms.cls.php';
  require ROOT.'/classes/paymentmgr/payment.interface.php';
  require ROOT.'/classes/paymentmgr/alipay.cls.php';
  





  
	  $id=$_REQUEST["id"];
	  $info=$orderMgr->getOrder($id);
	  $meeting_time=explode("-",$info["meeting_time"]);
	  
	   if($info["status"]!="A"&&$info["status"]!="F"){



	  logger_mgr::logInfo("notify alipay start :".$_SERVER["REQUEST_URI"]);
   logger_mgr::logInfo("notify alipay parameter".ArrayToString($_REQUEST));
  $alipay=new AlipayMgr();
  $ret=$alipay->notify();
  
   logger_mgr::logInfo("notify alipay verify return ".ArrayToString($ret));

	  if($ret["result"]!="SUCCESS"){
			exit;
	  }

	  if($info["meeting_id"]==""){
		$meetingret=$genseeMgr->createMeeting($info["doctor_name"],$info["meeting_date"]." ".$meeting_time[0],$info["meeting_date"]." ".$meeting_time[1]);
		$orderMgr->updateMeetingInfo($id,$meetingret);
		if($meetingret["code"]!="0"){
			exit;
		 }
	  }
	  if($info["status"]!="A"){
		$orderMgr->updateOrderPayment($id);
		$smsMgr->SendQueryConfirm($info["mobile"],$info["doctor_name"],$info["meeting_date"]." ".$meeting_time[0]);
	  }

	  }
?>