<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  $action=$_REQUEST["action"];
  $model=new XmlModel("doctor","doctor.php");
  
  $smarty->assign("MyModule","doctor");
  $model->DefaultShow($smarty,$dbmgr,$action,"doctor",$_REQUEST);
?>