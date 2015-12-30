<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class OrderMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new OrderMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}

	public function getOrder($id){
	
		$id=parameter_filter($id);

		$sql="select o.*,d.name doctor_name from tb_order o
		inner join tb_doctor d on o.doctor_id=d.id
		 where o.id=$id";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 

		return $result;

	}

	public function updateOrderPayment($id){
		$id=parameter_filter($id);

		$sql="update tb_order set status='A' where id=$id";
		$query = $this->dbmgr->query($sql);
	}
	public function updateMeetingInfo($id,$ret){
		$meeting_id=parameter_filter($ret["id"]);
		$meeting_number=parameter_filter($ret["number"]);
		$meeting_organizerPwd=parameter_filter($ret["organizerPwd"]);
		$meeting_attendeePwd=parameter_filter($ret["attendeePwd"]);
		$meeting_effectiveDate=parameter_filter($ret["effectiveDate"]);
		$meeting_invalidDate=parameter_filter($ret["invalidDate"]);
		$meeting_joinUrl=parameter_filter($ret["joinUrl"]);

		$sql="update tb_order set meeting_id='$meeting_id'
		,meeting_number='$meeting_number'
		,meeting_organizerPwd='$meeting_organizerPwd'
		,meeting_attendeePwd='$meeting_attendeePwd'
		,meeting_effectiveDate='$meeting_effectiveDate'
		,meeting_invalidDate='$meeting_invalidDate'
		,meeting_joinUrl='$meeting_joinUrl' where id=$id";
		$query = $this->dbmgr->query($sql);
	}
 }
 
 $orderMgr=OrderMgr::getInstance();
 $orderMgr->dbmgr=$dbmgr;
 
 
 
 
?>