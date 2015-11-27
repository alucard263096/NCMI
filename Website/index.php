<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require 'include/common.inc.php';
  require ROOT.'/classes/datamgr/notice.cls.php';
  require ROOT.'/classes/datamgr/banner.cls.php';
  require ROOT.'/classes/datamgr/college.cls.php';
  require ROOT.'/classes/datamgr/doctor.cls.php';
  require ROOT.'/classes/datamgr/hospital.cls.php';
  

  $notice=$noticeMgr->getNoticeContent();
  $smarty->assign("notice",$notice);

  
  $bannerlist=$bannerMgr->getIndexBannerList();
  $smarty->assign("bannerlist",$bannerlist);

  $collegelist=$collegeMgr->getCollegeList();
  $collegelistgroup=spliteArray($collegelist,2);
  $smarty->assign("collegelistgroup",$collegelistgroup);

  $doctor_list=$doctorMgr->getRecommandDoctor();
  for($i=0;$i<count($doctor_list);$i++){
	$doctor_list[$i]["content"]=strip_tags($doctor_list[$i]["content"]);
	$strlen= mb_strlen($doctor_list[$i]["content"],"utf-8")."<br />";
	if($strlen>50){
		$doctor_list[$i]["content"]=mb_substr($doctor_list[$i]["content"],0,50,"utf-8")."...";
	}
  }

  $doctor_list=randArray($doctor_list,3);
  //print_r($doctor_list);
  $smarty->assign("doctor_list",$doctor_list);

  
  $hospital_list=$hospitalMgr->getHospital();
  $smarty->assign("hospital_list",$hospital_list);
  
  
  $smarty->display(ROOT.'/templates/index.html');
  
?>