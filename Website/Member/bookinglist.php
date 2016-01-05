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
  require ROOT.'/classes/datamgr/member.cls.php';
  
  $action=$_REQUEST["action"];

  if($action=="submit"){
  //$caselist=$_REQUEST["caselist"];
  //$memberMgr->deleteCaseList($member["id"],$caselist);
  echo "RIGHT";
  exit;
  }else{
	  $doctorlist=$memberMgr->getOrderDoctor($member["id"]);
	  $smarty->assign("doctorlist",$doctorlist);

	  $doctor_id=$_REQUEST["doctor_id"];
	  $from=$_REQUEST["from"];
	  $to=$_REQUEST["to"];
	  $smarty->assign("doctor_id",$doctor_id);
	  $smarty->assign("from",$from);
	  $smarty->assign("to",$to);


	  $currentpage=getPageNumber();
	  $bookinglist=$memberMgr->getBookingList($member["id"],$doctor_id,$from,$to,$currentpage);
	  $list=array();
	  for($i=0;$i<15;$i++){
		$list[$i]=$bookinglist[$i];
	  }
	  $smarty->assign("list",$list);
	  $sum=$memberMgr->getBookingListPageCount($member["id"],$doctor_id,$from,$to);
	  $smarty->assign("count",$sum);
	  $smarty->assign("current_page",$currentpage);
	  $smarty->assign("lastpage",$currentpage);
	  $smarty->assign("page_arr",getPageNumberCodeArray($sum,$currentpage,15));


	  $smarty->assign("list",$list);
	  $smarty->assign("menuid","booking");
	  $smarty->display(ROOT.'/templates/Member/bookinglist.html');
  }
?>