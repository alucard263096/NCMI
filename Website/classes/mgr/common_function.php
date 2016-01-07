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
function ArrayToString($arr){
	$str="";
	foreach($arr as $key=>$value){
		$str.="<$key:$value>
		";
	}
	return $str;
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
function spliteArray($array,$count){
	$ret=array();
	$group=0;
	for($i=0;$i<count($array);$i++){
		if($i>0&&$i%$count==0){
			$group++;
		}
		$ret[$group][]=$array[$i];
	}
	return $ret;
}
function randArray($array,$count){
	if(count($array)<$count){
		return $array;
	}
	$res=array_rand($array,$count);
	$arr=array();
	foreach($res as  $value){
		$arr[]=$array[$value];
	}
	return $arr;
}
function getPageNumber(){
	$page=$_REQUEST["page"];
	$page=$page+0;
	if($page==0){
		$page=1;	
	}
	return $page;
}
function getPageNumberCodeArray($sum,$curpage,$eachincount){
	$pagecount=$sum/$eachincount;
	$pagecount=intval($pagecount);
	if($eachincount*$pagecount<$sum){
		$pagecount++;
	}
	$ret=array();
	$ret["pagecount"]=$pagecount;
	$arr=array();
	if($pagecount<=5){
		for($i=1;$i<=5&&$i<=$pagecount;$i++){
			$arr[]=$i;
		}
	}else{
		if($pagecount-$curpage<=2){
			$arr[]=$pagecount-4;
			$arr[]=$pagecount-3;
			$arr[]=$pagecount-2;
			$arr[]=$pagecount-1;
			$arr[]=$pagecount;
		}else if($curpage<=3){
			$arr[]=1;
			$arr[]=2;
			$arr[]=3;
			$arr[]=4;
			$arr[]=5;
		}else{
			$arr[]=$curpage-2;
			$arr[]=$curpage-1;
			$arr[]=$curpage;
			$arr[]=$curpage+1;
			$arr[]=$curpage+2;
		}
	}
	$ret["pages"]=$arr;
	return $ret;
}

function splitCodition($cols,$keyword){
	$ret="(1=2 ";
	$condition=explode(" ",$keyword);
	foreach($cols as $col){
		foreach($condition as $v){
			$ret=$ret." or $col like '%".parameter_filter($v)."%' 
			";
		}
	}
	$ret.=" )";
	return $ret;
}
function getmonsun($curtime){
$curweekday = date('w',$curtime);
//为0是 就是 星期七
$curweekday = $curweekday?$curweekday:7;
$curmon = $curtime - ($curweekday-1)*86400;
$cursun = $curtime + (7 - $curweekday)*86400;
$cur['mon'] = $curmon;
$cur['mon_str'] =date('Y年m月d日',$curmon);
$cur['mon_str_t'] =date('Y-m-d',$curmon);
$cur['first_day'] =date('Y-m-d',$curmon);
$cur['sun'] = $cursun;
$cur['sun_str'] = date('Y年m月d日',$cursun);;
$cur['sun_str_t'] = date('Y-m-d',$cursun);;
return $cur;
}
function getmon($curtime){
$curweekday = date('w',$curtime);
$curweekday = $curweekday?$curweekday:7;
$curmon = $curtime - ($curweekday-1)*86400;
return date('Y-m-d',$curmon);;
}
function getDayShortName($str){
	$time=strtotime($str);
	$curweekday = date('w',$time);
	$curweekday = $curweekday?$curweekday:7;
	switch($curweekday){
		case 1:return "mon";
		case 2:return "tue";
		case 3:return "wed";
		case 4:return "thu";
		case 5:return "fri";
		case 6:return "sat";
		case 7:return "sun";
	}

}
function checkDataInList($arr,$val){
	foreach($arr as $v){
		if($v[0]==$val){
			return true;
		}
	}
	return false;
}
function is_date($date)
{
 if($date == date('Y-m-d H:i:s',strtotime($date))){
  return true;
 }else{
  return false;
 }
 
}
?>
