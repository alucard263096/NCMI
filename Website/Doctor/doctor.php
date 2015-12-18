<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/doctor.cls.php';
  require ROOT.'/classes/datamgr/member.cls.php';

  $action=$_REQUEST["action"];
  $doctor_id=$_REQUEST["id"]+0;
  $member=$_SESSION[SESSIONNAME]["member"];
  $member_id=$member["id"]+0;
  if($action=="submit"){
	if($member_id==0){
		echo "NO_MEMBER";
		exit;
	}else{
		$type=$_REQUEST["type"];
		if($type=="follow"){
			$memberMgr->followDoctor($member_id,$doctor_id);
		}elseif($type=="unfollow"){
			$memberMgr->unfollowDoctor($member_id,$doctor_id);
		}
		echo "RIGHT";
		exit;
	}
  }else{
	  if($member_id==0){
		$smarty->assign("follow",0);
	  }else{
		$follow=$memberMgr->isFollowDoctor($member_id,$doctor_id);
		$smarty->assign("follow",$follow);
	  }
	  $info=$doctorMgr->getDoctor($doctor_id);
	  $smarty->assign("info",$info);


	  $schedultarr=array();
	  $time=time();
	  for($i=0;$i<4;$i++){
		$schedultarr[]=getmonsun($time+$i*86400*7);
	  }
	  $smarty->assign("schedule",$schedultarr);

	  
	  $reserve=$doctorMgr->getDoctorReserve($doctor_id,$schedultarr[0]["first_day"]);
	  $smarty->assign("reserve",$reserve);

	  $smarty->display(ROOT.'/templates/Doctor/doctor.html');
  }
?>