<?php

require ROOT.'/libs/CCPRestSDK.php';

class SmsMgr
{
	//logger_mgr::logDebug("sql :$sql");
	
	private	$accountSid;
	private	$accountToken;
	private	$appId;
	private	$serverIP;
	private	$serverPort;
	private	$softVersion;
	private	$timeout;
	public static $dbmgr = null;

	private $rest;
	
	private static $instance = null;
	
	public static function getInstance() 
	{
		return self::$instance!=null ? self::$instance : new SmsMgr();
	}
	
	private function __construct()
	{
		Global $CONFIG;
		$this->accountSid=$CONFIG["sms"]["AccountSid"];
		$this->accountToken=$CONFIG["sms"]["AccountToken"];
		$this->appId=$CONFIG["sms"]["AppId"];
		$this->serverIP=$CONFIG["sms"]["ServerIP"];
		$this->serverPort=$CONFIG["sms"]["ServerPort"];
		$this->softVersion=$CONFIG["sms"]["SoftVersion"];
		$this->timeout=$CONFIG["sms"]["timeout"];
	}

	private function resetSDK(){
		$this->rest = new REST($this->serverIP,$this->serverPort,$this->softVersion);
		 $this->rest->setAccount($this->accountSid,$this->accountToken);
		 $this->rest->setAppId($this->appId);
	}

	public function SendQueryConfirm($mobile,$doctor_name,$order_date){
	Global $CONFIG;

		$templeteId=$CONFIG["sms"]["templeteid"]["bookingsuccess"];
		$arr=Array($doctor_name,$order_date);
		$result=$this->Send($mobile,$arr,$templeteId);
	}
	

	private function Send($to,$arr,$templeteId){
	Global $CONFIG;
	if($CONFIG['solution_configuration']=="debug"){
		return true;
	}
	//return true;
		$this->resetSDK();

		$result = $this->rest->sendTemplateSMS($to,$arr,$templeteId);

		if($result->statusCode!=0) {
			 $str= "error code :" . $result->statusCode . " ";
			 $str.= "error msg :" . $result->statusMsg . " ";
			 $res=outResult($result->statusCode ,$result->statusMsg);
				outputXml($res);
			 logger_mgr::logError("sms :$str");
			 //echo $str;
			 //TODO ��Ӵ������߼�
			 return false;
		 }else{
			 $str= "Sendind TemplateSMS success! ";
			 // ��ȡ������Ϣ
			 $smsmessage = $result->TemplateSMS;
			 $str.= "dateCreated:".$smsmessage->dateCreated." ";
			 $str.=  "smsMessageSid:".$smsmessage->smsMessageSid."";
			 //TODO ��ӳɹ������߼�
			 logger_mgr::logInfo("sms :$str");
			 //echo $str;
			 return true;
		 }
		return false;
	}

	public function SendTest($to){

		$this->resetSDK();

		$arr=array('3','10');
		$result = $this->rest->sendTemplateSMS($to,$arr,"1");

		if($result->statusCode!=0) {
			 $str= "error code :" . $result->statusCode . " ";
			 $str.= "error msg :" . $result->statusMsg . " ";
			 logger_mgr::logError("sms :$str");
			 //TODO ��Ӵ������߼�
		 }else{
			 $str= "Sendind TemplateSMS success! ";
			 // ��ȡ������Ϣ
			 $smsmessage = $result->TemplateSMS;
			 $str.= "dateCreated:".$smsmessage->dateCreated." ";
			 $str.=  "smsMessageSid:".$smsmessage->smsMessageSid."";
			 //TODO ��ӳɹ������߼�
			 logger_mgr::logDebug("sms :$str");
		 }

	}
  
}




$smsMgr = SmsMgr::getInstance();
$smsMgr->dbmgr=$dbmgr;

?>