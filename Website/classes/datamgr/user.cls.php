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

	public function getMeeting($doctor_id,$date){
		$doctor_id=parameter_filter($doctor_id);
		$loginname=parameter_filter($date);
		$sql="select o.*,c.sexual from tb_order o
inner join tb_member_case c on o.case_id=c.id
where o.doctor_id=$doctor_id 
and o.meeting_date='$date'
order by o.meeting_time  ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		for($i=0;$i<count($result);$i++){
			$meeting_time_start=explode("-",$result[$i]["meeting_time"]);
			$meeting_time_start=$meeting_time_start[0];
			$result[$i]["meeting_time_start"]=$meeting_time_start;
		}


		return $result;
	}

 }
 
 $userMgr=UserMgr::getInstance();
 $userMgr->dbmgr=$dbmgr;
 
 
 
 
?>