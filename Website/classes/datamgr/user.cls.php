<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class UserMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new UserMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function loginUser($loginname)
	{
		$loginname=parameter_filter($loginname);
		$sql="select * from tb_doctor where status='A' and loginname='$loginname' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 

		return $result;
	}

	public function getMeetingDateInMonth($doctor_id,$year,$month){
		
		$sql="select distinct meeting_date from tb_order 
		where status='A' 
		and doctor_id=$doctor_id 
		and ( meeting_date>='$year-$month-1' and meeting_date<=DATE_ADD('$year-$month-1',INTERVAL 1 MONTH) )";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}
	public function haveMeeting($meetdates,$date){
		for($i=0;$i<count($meetdates);$i++){
			if(date('Y-m-d', strtotime($meetdates[$i]["meeting_date"]))==$date){
				return true;
			}
		}
		return false;
	}

 }
 
 $userMgr=UserMgr::getInstance();
 $userMgr->dbmgr=$dbmgr;
 
 
 
 
?>