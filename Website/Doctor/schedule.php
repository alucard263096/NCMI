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
  
	  $doctor_id=$_REQUEST["doctor_id"];
	  $first_day=$_REQUEST["first_day"];
	  $reserve=$doctorMgr->getDoctorReserve($doctor_id,$first_day);
	  $smarty->assign("reserve",$reserve);

	  $smarty->display(ROOT.'/templates/Doctor/schedule.html');
?>