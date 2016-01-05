<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/member.cls.php';


  $member=$_SESSION[SESSIONNAME]["member"];
  if($member==null||$member["id"]==""){
	exit;
  }
  $date=date("Y-m-d");
  $meetinglist=$memberMgr->getMeeting($member["id"],$date);
  foreach($meetinglist as $val){
	$order_date=$val["meeting_date"]." ".$val["meeting_time_start"];
	if((strtotime($order_date)-time())/60<=15){
		echo $val["meeting_panelistJoinUrl"];
		exit;
	}
  }
?>