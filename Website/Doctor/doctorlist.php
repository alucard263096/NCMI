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
  require ROOT.'/classes/datamgr/category.cls.php';
  
  $currentpage=getPageNumber();
  $doctorlist=$doctorMgr->getDoctorList($currentpage);
  $smarty->assign("list",$doctorlist);

  
  $doctorsum=$doctorMgr->getDoctorListPageCount($currentpage);
  $smarty->assign("doctor_count",$doctorsum);
  $smarty->assign("current_page",$currentpage);
  $smarty->assign("lastpage",$currentpage);
  $smarty->assign("page_arr",getPageNumberCodeArray($doctorsum,$currentpage,18));

  $category=$categoryMgr->getCategoryWithSubCategory();
  //print_r($category);
  $smarty->assign("category",$category);

  
  $smarty->display(ROOT.'/templates/doctorlist.html');
  
?>