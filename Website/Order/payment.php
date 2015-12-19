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
  require ROOT.'/classes/datamgr/order.cls.php';
  
  $action=$_REQUEST["action"];

  if($action=="submit"){

  echo "RIGHT";
  exit;
  }else{
	  $id=$_REQUEST["id"];
	  $info=$orderMgr->getOrder($id);
	  $smarty->assign("info",$info);
	  $smarty->display(ROOT.'/templates/Order/payment.html');
  }
?>