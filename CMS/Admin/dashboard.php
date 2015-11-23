<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/datamgr/statistics.cls.php';
  
  $smarty->assign("MyModule","admin");
  $smarty->assign("MyMenuId","dashboard");

  $reminderList=$businessMgr->getReminderAll($SysUser["id"]);
  $smarty->assign("ReminderList",$reminderList);
  $smarty->assign("ReminderListCount",count($reminderList));

  
  $StatisticsItem=$statisticsMgr->getDataForDashboard($SysUser["id"]);
  $smarty->assign("StatisticsItem",$StatisticsItem);
  $smarty->assign("StatisticsItemCount",count($StatisticsItem));


  $smarty->display(ROOT.'/templates/dashboard.html');
  
?>