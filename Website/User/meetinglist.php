<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/include/user.inc.php';
  require ROOT.'/classes/datamgr/user.cls.php';
  
  $currentpage=getPageNumber();

  $from=$_REQUEST["from"];
  $to=$_REQUEST["to"];
  $smarty->assign("from",$from);
  $smarty->assign("to",$to);

  $meetinglist=$userMgr->getMeetingList($user["id"],$from,$to,$currentpage);
  $list=array();
  for($i=0;$i<15;$i++){
	$list[$i]=$meetinglist[$i];
  }
  $smarty->assign("list",$list);

  
  $sum=$userMgr->getMeetingListPageCount($user["id"],$from,$to);
  $smarty->assign("count",$sum);
  $smarty->assign("current_page",$currentpage);
  $smarty->assign("lastpage",$currentpage);
  $smarty->assign("page_arr",getPageNumberCodeArray($sum,$currentpage,15));

  $smarty->display(ROOT.'/templates/User/meetinglist.html');
?>