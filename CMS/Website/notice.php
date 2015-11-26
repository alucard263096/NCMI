<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/classes/modelmgr/NoticeXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new DoctorRecomXmlModel("notice","notice.php");
  
  $smarty->assign("MyModule","website");
  $model->DefaultShow($smarty,$dbmgr,$action,"notice",$_REQUEST);
?>