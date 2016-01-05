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

		$site=$this->site;
		$loginName=$this->loginName;
		$password=$this->password;
		$organizerPwd=$this->organizerPwd;

		$subject="【视频会诊】".$doctor_name.$starttime;
		$startTime=date("Y-m-d h:i:s",strtotime($starttime)-60*15);
		$endTime=date("Y-m-d h:i:s",strtotime($endtime)+60*15);
		$url="http://$site/integration/site/webcast/created?loginName=$loginName&password=$password&organizerPwd=$organizerPwd";
		$url.="&subject=$subject&startTime=$startTime&endTime=$endTime";
		$url.="&opened=true&switchClient=true";
		$url.="&realtime=true&organizerToken=888888&panelistToken=888888&attendeeToken=888888";
		//$url.="&subject=$subject&startTime=$startTime&endTime=$endTime";
		//$url.="&subject=$subject&startTime=$startTime&endTime=$endTime";
		//$url.="&subject=$subject&startTime=$startTime&endTime=$endTime";
		$url=str_replace(" ", "%20", $url);
		$str = file_get_contents("$url");
		$ret=json_decode($str,true);

		if($ret["code"]!="0"){
			logger_mgr::logError("GENSEE create meeting,url:$url :$str");
		}else{
			logger_mgr::logDebug("GENSEE create meeting,url:$url :$str");
		}

	
		return $ret;

	}


} 
$genseeMgr=new GenseeMgr($CONFIG["gensee"]["site"],  $CONFIG["gensee"]["loginName"],$CONFIG["gensee"]["password"],$CONFIG["gensee"]["organizerPwd"]);


?>