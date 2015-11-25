<?php
/*
 * Created on 2010-5-11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function encode($str)
{
	return mb_convert_encoding($str,'UTF-8');
}
function parameter_filter($param)
{
	$arr=array("'"=>"''");
	$param = strtr($param,$arr);
	$param = mysql_escape_string($param);
	return $param;
}
function ParentRedirect($url)
{
	//Header("Location: $url");
	echo "<script languate=\"javascript\">";
	echo "parent.location.href='".$url."'";
	echo "</script>";
	exit();
}
function WindowRedirect($url)
{
	//Header("Location: $url");
	echo "<script languate=\"javascript\">";
	echo "window.location.href='".$url."'";
	echo "</script>";
	exit();
}

/*
 function name：remote_file_exists
 function：valid remote file is exists
 params： $url_file - remote file URL
 return：exists return true，else return false
 */
function remote_file_exists($url_file){
	if(@fclose(@fopen($url_file,"r")))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function getMenuJson($menu){
	
	
$item["current"]=true;
$item["title"]="管理工具";
$item["link"]="#";
foreach ($menu as $val){
	
	$sm=$val["sub_function"];
	$subitemcontent=null;
	foreach ($sm as $vc){
		$url=null;
		$url["name"]=$vc["function_name"];
		$url["urlPathinfo"]=$vc["function_link"];
		$subitemcontent[$vc["function_link"]]=$url;
	}
	$list[$val["function_name"]]=$subitemcontent;
	
	
}
$item["list"]=$list;

return json_encode($item);
}

function ResetNameWithLang($arr,$lang){
	
	if(isset($arr["name"])&&isset($arr["name_".$lang])){
		$arr["name"]=$arr["name_".$lang]."aaa";
	}

	foreach ($arr as $key => $value){
		if(is_array($arr[$key])){
			$arr[$key]=ResetNameWithLang($arr[$key],$lang);
		}
	}
	return $arr;

}

function outputXml($result){
header("Content-type: text/xml");
  $str="<?xml version=\"1.0\" encoding=\"utf-8\" ?><table>";
  $row_count=count($result);
  for($i=0;$i<$row_count;$i++){
	$str.="<row>";
	$j=0;
	foreach($result[$i] as $key => $value){
		if($j%2==1){ 
			//echo "~".$value."!";
			if($value instanceof DateTime){
				$value= $value->format('Y-m-d H:i:s');
			}

			$value_change = array('&'=>'&amp;'
			,'#'=>'&#35;'
			,'<'=>'&lt;'
			,chr(0x0)=>''
			,'>'=>'&gt;'
			,'\''=>'&apos;'
			,'"'=>'&quot;');
			$value = utf8_for_xml($value);
			$str.="<$key>".strtr($value,$value_change)."</$key>";
		}
		$j++;
	}
	$str.="</row>";
  }
  $str.="</table>";
  echo $str;
  exit;
}
function utf8_for_xml($string)
{
    $ret= preg_replace ('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string);
	return $ret;
}
function outResult($num,$message,$return=""){
	$array=Array();
	$arr=Array();
	$arr[0]=$num;
	$arr["id"]=$num;
	$arr[1]=$message;
	$arr["result"]=$message;
	$arr[2]=$return;
	$arr["return"]=$return;
	$array[]=$arr;
	return $array;
}
?>
