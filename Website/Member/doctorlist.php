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

  $search=$_REQUEST["search"];
  $smarty->assign("searchkeyword",$search);
  
  $currentpage=getPageNumber();
  $doctorlist=$doctorMgr->getOrderDoctorList($member["id"],$search,$currentpage);
  $smarty->assign("list",$doctorlist);

  
  $doctorsum=$doctorMgr->getOrderDoctorListPageCount($member["id"],$search,$currentpage);
  $smarty->assign("doctor_count",$doctorsum);
  $smarty->assign("current_page",$currentpage);
  $smarty->assign("lastpage",$currentpage);
  $smarty->assign("page_arr",getPageNumberCodeArray($doctorsum,$currentpage,18));

  $smarty->assign("menuid","doctor");
  $smarty->assign("pagename","doctorlist");
  
  $smarty->display(ROOT.'/templates/Member/doctorlist.html');
  
?>