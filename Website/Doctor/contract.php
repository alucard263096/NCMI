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
  
  $doctor_id=$_REQUEST["id"]+0;
  if($action=="submit"){
	
  }else{
	  $doctor=$doctorMgr->getDoctor($doctor_id);
	  $smarty->assign("doctor",$doctor);

	  $files=$memberMgr->getFileList($member["id"]);
	  $smarty->assign("files",$files);
	  $smarty->display(ROOT.'/templates/Doctor/contract.html');
  }
?>