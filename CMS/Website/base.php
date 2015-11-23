<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/modelmgr/BaseSettingXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new BaseSettingXmlModel("base.php");
  
	$smarty->assign("MyModule","website");

	if($SysUser["is_admin"]!="Y"){
		echo "System Error";
		exit;
	}
  if($action==""){

	$smarty->assign("MyMenuId","base");
	$model->Edit($dbmgr,$smarty,1);

  }else if($action=="save"){
  
	$result=$model->Save($dbmgr,$_REQUEST,$SysUser["id"]);
	echo $result;

  }
?>