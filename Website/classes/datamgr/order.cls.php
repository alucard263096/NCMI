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

		$sql="select o.*,d.name doctor_name,c.tel mobile from tb_order o
		inner join tb_member_case c on o.case_id=c.id
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
		$meeting_organizerJoinUrl=parameter_filter($ret["organizerJoinUrl"]);
		$meeting_organizerToken=parameter_filter($ret["organizerToken"]);
		$meeting_panelistJoinUrl=parameter_filter($ret["panelistJoinUrl"]);
		$meeting_panelistToken=parameter_filter($ret["panelistToken"]);

		$sql="update tb_order set meeting_id='$meeting_id'
		,meeting_number='$meeting_number'
		,meeting_organizerJoinUrl='$meeting_organizerJoinUrl'
		,meeting_organizerToken='$meeting_organizerToken'
		,meeting_panelistJoinUrl='$meeting_panelistJoinUrl'
		,meeting_panelistToken='$meeting_panelistToken' where id=$id";
		$query = $this->dbmgr->query($sql);
	}
 }
 
 $orderMgr=OrderMgr::getInstance();
 $orderMgr->dbmgr=$dbmgr;
 
 
 
 
?>