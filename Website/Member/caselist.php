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
  $caselist=$_REQUEST["caselist"];
  $memberMgr->deleteCaseList($member["id"],$caselist);
  echo "RIGHT";
  exit;
  }else{
	  $currentpage=getPageNumber();
	  $list=$memberMgr->getCaseList($member["id"],$currentpage);
	  $sum=$memberMgr->getCaseListPageCount($member["id"]);
	  $smarty->assign("count",$sum);
	  $smarty->assign("current_page",$currentpage);
	  $smarty->assign("lastpage",$currentpage);
	  $smarty->assign("page_arr",getPageNumberCodeArray($sum,$currentpage,3));


	  $smarty->assign("list",$list);
	  $smarty->assign("menuid","case");
	  $smarty->display(ROOT.'/templates/Member/caselist.html');
  }
?>