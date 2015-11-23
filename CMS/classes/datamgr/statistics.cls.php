<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class StatisticsMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static $webServiceClient = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new StatisticsMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	

	public function getDataForDashboard($user_id){
		Global $CONFIG;
		$Array=Array();

		$arr=Array();
		$arr["name"]="疫苗完成数量";
		$arr["percent"]=34;
		$arr["link"]=$CONFIG['rootpath']."/Appointment/appiontment.php";
		$Array[]=$arr;

		
		$arr=Array();
		$arr["name"]="疫苗检查数量";
		$arr["percent"]=25;
		$arr["link"]=$CONFIG['rootpath']."/Appointment/appiontment.php";
		$Array[]=$arr;

		
		$arr=Array();
		$arr["name"]="疫苗有效数量";
		$arr["percent"]=45;
		$arr["link"]=$CONFIG['rootpath']."/Appointment/appiontment.php";
		$Array[]=$arr;

		//$arr=Array();
		//$arr["name"]="疫苗预约取消";
		//$user_id=parameter_filter($user_id);
		//$sql="select  m.id,m.name as first,
 //m.mobile  as second,m.order_date  as third 
//from dr_tb_member_vaccine_order m
		//where status='C' and h_status='P'
        //order by m.updated_date desc
		//limit 0,3 ";
		//$query = $this->dbmgr->query($sql);
		//$result = $this->dbmgr->fetch_array_all($query); 
		//$arr["result"]=$result;
		//$arr["first"]="客户姓名";
		//$arr["second"]="手机号码";
		//$arr["third"]="预约日期";
		//$arr["count"]=count($result);
		//$arr["link"]=$CONFIG['rootpath']."/Appointment/appiontment.php";
		//$Array[]=$arr;

		

		return $Array;

	}
	
 }
 
 $statisticsMgr=StatisticsMgr::getInstance();
 $statisticsMgr->dbmgr=$dbmgr;
 
 
 
 
?>