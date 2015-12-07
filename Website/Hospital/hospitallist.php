<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/hospital.cls.php';
  require ROOT.'/classes/datamgr/category.cls.php';

  $search=$_REQUEST["search"];
  $smarty->assign("searchkeyword",$search);
  
  $currentpage=getPageNumber();
  $hospitallist=$hospitalMgr->getHospitalList($search,$currentpage);
  $smarty->assign("list",$hospitallist);

  
  $hospitalsum=$hospitalMgr->getHospitalListPageCount($search,$currentpage);
  $smarty->assign("hospital_count",$hospitalsum);
  $smarty->assign("current_page",$currentpage);
  $smarty->assign("lastpage",$currentpage);
  $smarty->assign("page_arr",getPageNumberCodeArray($hospitalsum,$currentpage,9));

  $category=$categoryMgr->getCategoryWithSubCategory();
  //print_r($category);
  $smarty->assign("category",$category);
  $smarty->assign("searchurl","/Hospital/hospitallist.php?");

  
  $smarty->display(ROOT.'/templates/Hospital/hospitallist.html');
  
?>