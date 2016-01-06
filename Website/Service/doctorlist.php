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
  require ROOT.'/classes/datamgr/category.cls.php';

  $search=$_REQUEST["search"];
  $smarty->assign("searchkeyword",$search);
  
  $currentpage=getPageNumber();
  $doctorlist=$doctorMgr->getServiceDoctorList($member["id"],$search,$currentpage);
  $smarty->assign("list",$doctorlist);

  
  $doctorsum=$doctorMgr->getServiceDoctorListPageCount($member["id"],$search,$currentpage);
  $smarty->assign("doctor_count",$doctorsum);
  $smarty->assign("current_page",$currentpage);
  $smarty->assign("lastpage",$currentpage);
  $smarty->assign("page_arr",getPageNumberCodeArray($doctorsum,$currentpage,2));

  $smarty->assign("menuid","doctor");
  $smarty->assign("pagename","doctorlist");

  
  $category=$categoryMgr->getCategoryWithSubCategory();
  //print_r($category);
  $smarty->assign("category",$category);
  $smarty->assign("searchurl","/Service/doctorlist.php?");
  
  $smarty->display(ROOT.'/templates/Service/doctorlist.html');
  
?>