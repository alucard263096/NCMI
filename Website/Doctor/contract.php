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
  require ROOT.'/classes/datamgr/doctor.cls.php';
  require ROOT.'/classes/datamgr/member.cls.php';
  
  $doctor_id=$_REQUEST["doctor_id"]+0;
  $action=$_REQUEST["action"];
  if($action=="submit"){
	$file_id=$_REQUEST["file_id"]+0;
	$caseid=$memberMgr->createCase($member["id"],$doctor_id,$file_id,$_REQUEST);
	echo $caseid;
	exit;
  }elseif($action=="loadfile"){
	$file_id=$_REQUEST["file_id"]+0;
	$file=$memberMgr->getFile($member["id"],$file_id);
	echo $str=json_encode($file);
	exit;
  }else{
	  $doctor=$doctorMgr->getDoctor($doctor_id);
	  $smarty->assign("doctor",$doctor);
	  $smarty->assign("date",$_REQUEST["date"]);
	  $tac=$_REQUEST["tac"];
	  $smarty->assign("tac",$tac);
	  $smarty->assign("tac_str",$tac=="m"?"上午":"下午");

	  $files=$memberMgr->getFileList($member["id"]);
	  $smarty->assign("files",$files);
	  $smarty->display(ROOT.'/templates/Doctor/contract.html');
  }
?>