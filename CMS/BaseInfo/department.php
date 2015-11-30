<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/modelmgr/DepartmentXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new DepartmentXmlModel("department.php");
  
  $smarty->assign("MyModule","baseinfo");
  $model->DefaultShow($smarty,$dbmgr,$action,"department",$_REQUEST);
?>