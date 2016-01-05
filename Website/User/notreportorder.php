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

  $date=date("Y-m-d");
  $meetinglist=$userMgr->getMeeting($user["id"],$date);
  $ret="";
  for($i=0;$i<count($meetinglist);$i++){
	$info=$meetinglist[$i];
    $order_time=explode("-",$info["meeting_time"]);
    $order_date=$info["meeting_date"]." ".$order_time;
	if(time()>strtotime($order_date)&&($info["case_status"]!="F"&&$info["case_status"]!="M")){
		$ret.=",".$info["id"];
	}
  }
  echo $ret;
?>