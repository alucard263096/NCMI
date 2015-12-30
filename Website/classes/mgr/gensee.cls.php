<?php 
class GenseeMgr 
{ 
	
    var $site="";
    var $loginName ="";
    var $password="";
    var $organizerPwd="";

	function GenseeMgr($site, $loginName ,$password,$organizerPwd ) {
		$this->site=$site;
		$this->loginName=$loginName;
		$this->password=$password;
		$this->organizerPwd=$organizerPwd;
	}

	function createMeeting($doctor_name,$starttime,$endtime){
	//subject String 会议名称（最长为 250）  
	//organizerPwd String 组织者口令(如果没有由后台随即产生) 是 
	//attendeePwd String 参加者口令（如果没有由后台随即产生） 是 
	//effectiveDate String 生效时间（详见 3.3） 是 
	//invalidDate String 失效时间（详见 3.3） 是 
	//loginName String 登录名  password
	$site=$this->site;
	$loginName=$this->loginName;
	$password=$this->password;
	$organizerPwd=$this->organizerPwd;

	$subject="视频会诊_".$doctor_name.$starttime;
	$effectiveDate=date("Y-m-d h:i:s",strtotime($starttime)-60*1000*15);
	$invalidDate=date("Y-m-d h:i:s",strtotime($endtime)+60*1000*15);

	$url="http://$site/integration/site/mtg/created?loginName=$loginName&password=$password&organizerPwd=$organizerPwd";
	$url.="&subject=$subject&effectiveDate=$effectiveDate&invalidDate=$invalidDate";

	$str = file_get_contents("$url");
	$ret=json_decode($str,true);

	if($ret["code"]!="0"){
		logger_mgr::logError("GENSEE create meeting,url:$url :$str");
	}

	//id String 会议室ID  
	//number String 会议室编号  
	//organizerPwd String 组织者口令  
	//attendeePwd String 参加者口令  
	//effectiveDate int 会议室生效日期（详见3.3） 是 
	//invalidDate int 会议室失效日期（详见3.3） 是 
	//joinUrl String 会议室URL  
	//code String 返回结果代码（详情见3.5）  
	//message String 结果说明 
	
	return $ret;

	}


} 
$genseeMgr=new GenseeMgr($CONFIG["gensee"]["site"],  $CONFIG["gensee"]["loginName"],$CONFIG["gensee"]["password"],$CONFIG["gensee"]["organizerPwd"]);


?>