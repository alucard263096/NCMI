<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/classes/modelmgr/DoctorRecomXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new DoctorRecomXmlModel("doctorrecom","doctorrecom.php");
  
  $smarty->assign("MyModule","doctor");
  $model->DefaultShow($smarty,$dbmgr,$action,"doctorrecom",$_REQUEST);
?>