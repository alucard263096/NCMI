<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/modelmgr/GeneralTextXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new GeneralTextXmlModel("general.php");
  
	$smarty->assign("MyModule","website");

  if($action==""){

	$smarty->assign("MyMenuId","general_list");
	$model->ShowList($dbmgr,$smarty);

  }else if($action=="search"){

	$model->ShowSearchResult($dbmgr,$smarty,$_REQUEST);

  }else if($action=="add"){
	if($SysUser["is_admin"]!="Y"){
		echo "System Error";
		exit;
	}
	$smarty->assign("MyMenuId","general_add");
	$model->Add($dbmgr,$smarty);

  }else if($action=="edit"){
	$smarty->assign("MyMenuId","general_add");
	$model->Edit($dbmgr,$smarty,$_REQUEST["id"]);

  }else if($action=="save"){
  
	if($_REQUEST["primary_id"]==""&&$SysUser["is_admin"]!="Y"){
		echo "System Error";
		exit;
	}
	$result=$model->Save($dbmgr,$_REQUEST,$SysUser["id"]);
	echo $result;

  }
?>