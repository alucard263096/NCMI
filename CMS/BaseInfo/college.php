<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  $action=$_REQUEST["action"];
  $model=new XmlModel("college","college.php");
  
  $smarty->assign("MyModule","baseinfo");
  $model->DefaultShow($smarty,$dbmgr,$action,"college",$_REQUEST);
?>