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
  require ROOT.'/classes/paymentmgr/payment.interface.php';
  require ROOT.'/classes/paymentmgr/alipay.cls.php';
  
  
	  $id=$_REQUEST["id"];
	  $info=$orderMgr->getOrder($id);
	  if($info["status"]!="T"){
		
			WindowRedirect("success.php?id=".$info["id"]);
	  }
	$url=$CONFIG['URL']."/Order/payment.php?id=".$info["id"];
	 $alipay=new AlipayMgr();
	$alipay->submit($url,$info["order_no"],"ЪгЦЕЛсея".$info["order_no"],$info["price"],"");
?>