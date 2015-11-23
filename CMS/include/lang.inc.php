<?php

$SysLangCode=$CONFIG['lang'];
if(isset($_REQUEST["lang"])){
	$SysLangCode=$_REQUEST["lang"];
	$_SESSION[SESSIONNAME]["LangCode"]=$SysLangCode;
}

if(isset($_SESSION[SESSIONNAME]["LangCode"])){
	$SysLangCode=$_SESSION[SESSIONNAME]["LangCode"];
}

//lang init
if($CONFIG['solution_configuration']!="debug"&&isset($_SESSION[SESSIONNAME]["Lang"])){
	$SysLang=$_SESSION[SESSIONNAME]["Lang"];
}else{
$path=ROOT."/lang/$SysLangCode.xml";
$fp = fopen($path,"r");
$str = fread($fp,filesize($path));
$SysLang=json_decode(json_encode((array) simplexml_load_string($str)), true);
$_SESSION[SESSIONNAME]["Lang"]=$SysLang;
}

//lang config init
if($CONFIG['solution_configuration']!="debug"&&isset($_SESSION[SESSIONNAME]["LangConfig"])){
	$SysLangConfig=$_SESSION[SESSIONNAME]["LangConfig"];
}else{
$path=ROOT."/lang/config.xml";
$fp = fopen($path,"r");
$str = fread($fp,filesize($path));
$SysLangConfig=json_decode(json_encode((array) simplexml_load_string($str)), true);
$_SESSION[SESSIONNAME]["LangConfig"]=$SysLangConfig;
}



if($smarty!=null){

	$smarty->assign("SysLang",$SysLang);
	$smarty->assign("SysLangConfig",$SysLangConfig);
	$smarty->assign('SysLangCode',$SysLangCode);

}

?>