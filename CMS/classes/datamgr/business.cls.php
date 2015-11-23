<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class BusinessMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static $webServiceClient = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new BusinessMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getReminderCount($user_id)
	{
		$sum=0;
		
		//$sql="select count(1) from dr_tb_member_vaccine_order where status='C' and h_status='P' ";
		//$query = $this->dbmgr->query($sql);
		//$result = $this->dbmgr->fetch_array($query); 
		//$sum=$sum+ $result[0];

		
		
		return $sum;
	}

	public function getReminderAll($user_id){
		Global $CONFIG;
		$Array=Array();

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
 
 $businessMgr=BusinessMgr::getInstance();
 $businessMgr->dbmgr=$dbmgr;
 
 
 
 
?>