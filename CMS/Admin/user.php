<?php
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  require ROOT.'/classes/modelmgr/UserXmlModel.cls.php';
  $action=$_REQUEST["action"];
  $model=new UserXmlModel("user.php");
  
  
	if($SysUser["is_admin"]!="Y"){
		echo "System Error";
		exit;
	}

  if($action==""){

	$smarty->assign("MyModule","admin");
	$smarty->assign("MyMenuId","user_list");
	$model->ShowList($dbmgr,$smarty);

  }else if($action=="search"){

	$model->ShowSearchResult($dbmgr,$smarty,$_REQUEST);

  }else if($action=="add"){

	$smarty->assign("MyModule","admin");
	$smarty->assign("MyMenuId","user_add");
	$model->Add($dbmgr,$smarty);

  }else if($action=="edit"){

	$smarty->assign("MyModule","admin");
	$smarty->assign("MyMenuId","user_add");
	$model->Edit($dbmgr,$smarty,$_REQUEST["id"]);

  }else if($action=="save"){

	$result=$model->Save($dbmgr,$_REQUEST,$SysUser["id"]);
	echo $result;

  }else if($action=="delete"){

	$result=$model->Delete($dbmgr,$_REQUEST["idlist"],$SysUser["id"]);
	echo $result;

  }
?>