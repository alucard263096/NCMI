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
  require ROOT.'/classes/datamgr/college.cls.php';
  require ROOT.'/classes/datamgr/category.cls.php';

  $search=$_REQUEST["search"];
  $smarty->assign("searchkeyword",$search);

  
  $collegelist=$collegeMgr->getCollegeList($search);
  $smarty->assign("list",$collegelist);
  $smarty->assign("count",count($collegelist));


  $category=$categoryMgr->getCategoryWithSubCategory();
  //print_r($category);
  $smarty->assign("category",$category);
  $smarty->assign("searchurl","/Hospital/college.php?");

  
  $smarty->display(ROOT.'/templates/Hospital/college.html');
  
?>