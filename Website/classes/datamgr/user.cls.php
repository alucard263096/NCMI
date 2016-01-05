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
	public function inSchedule($dates,$date,$col){
		for($i=0;$i<count($dates);$i++){
			if(date('Y-m-d', strtotime($dates[$i][$col]))==$date){
				return true;
			}
		}
		return false;
	}
	public function getVacation($doctor_id,$year,$month){
		
		$sql="select distinct vacation from tb_doctor_vacation 
		where doctor_id=$doctor_id 
		and ( vacation>='$year-$month-1' and vacation<=DATE_ADD('$year-$month-1',INTERVAL 1 MONTH) )";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	public function getMeeting($doctor_id,$date){
		$doctor_id=parameter_filter($doctor_id);
		$date=parameter_filter($date);
		$sql="select o.*,c.sexual,c.status case_status from tb_order o
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

	public function getMeetingList($doctor_id,$from,$to,$page){
		$startrow=($page-1)*15;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		$sql="select o.*,c.sexual,c.age,c.result,c.name,c.status case_status from tb_order o
inner join tb_member_case c on o.case_id=c.id
where o.doctor_id=$doctor_id and o.status<>'D' ";
		if($from!=""){
			$sql.=" and o.meeting_date>='$from'";
		}
		if($to!=""){
			$sql.=" and o.meeting_date<='$to'";
		}
		$sql.=" order by o.meeting_date desc,o.meeting_time desc
		limit $startrow,15";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 


		return $result;
	}

	public function getMeetingListPageCount($doctor_id,$from,$to){
		$sql="select o.id from tb_order o
inner join tb_member_case c on o.case_id=c.id
where o.doctor_id=$doctor_id and o.status<>'D' ";
		if($from!=""){
			$sql.=" and o.meeting_date>='$from'";
		}
		if($to!=""){
			$sql.=" and o.meeting_date<='$to'";
		}

		$sql="select sum(1) count from 
		( $sql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["count"];

	}
	
	public function getMeetingCase($order_id){
		$order_id=parameter_filter($order_id);
		$sql="select o.id order_id,c.* from tb_order o
inner join tb_member_case c on o.case_id=c.id
where o.id=$order_id   ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 

		return $result;
	}
	
	public function getCase($doctor_id,$case_id){
		$case_id=parameter_filter($case_id);
		$sql="select * from tb_member_case
where id=$case_id and doctor_id=$doctor_id  ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		$result["attachment"]=$this->getCaseAttachment($case_id);
		return $result;
	}

	public function getCaseAttachment($case_id){
		$case_id=parameter_filter($case_id);
		$sql="select * from tb_member_case_attachment
where case_id=$case_id   ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}
	public function updateCase($doctor_id,$case_id,$request){
		$doctor_id=parameter_filter($doctor_id);
		$case_id=parameter_filter($case_id);
		$caution=parameter_filter($request["caution"]);
		$solution=parameter_filter($request["solution"]);
		$checking=parameter_filter($request["checking"]);
		$result=parameter_filter($request["result"]);
		$this->dbmgr->begin_trans();
		$sql="update tb_member_case set caution='$caution',solution='$solution',checking='$checking',result='$result'
		,status='F'
where id=$case_id and doctor_id=$doctor_id  ";
		$this->dbmgr->query($sql);
		$sql="update tb_order set status='F'
where case_id=$case_id and doctor_id=$doctor_id  ";
		$this->dbmgr->query($sql);
		$this->dbmgr->commit_trans();

		return $result;
	}
	public function updateCaseInMeeting($doctor_id,$case_id){
		$doctor_id=parameter_filter($doctor_id);
		$case_id=parameter_filter($case_id);
		$sql="update tb_member_case set status='M'
where id=$case_id and doctor_id=$doctor_id  ";
		$this->dbmgr->query($sql);

		return $result;
	}
	public function updateVacation($doctor_id,$year,$month,$days){
		$doctor_id=parameter_filter($doctor_id);
		$this->dbmgr->begin_trans();

		$days=explode(",",$days);
		foreach ($days as $day) {
			if(trim($day)!=""){
			$date="$year-$month-$day";
			$date=parameter_filter($date);
			
			$sql="select 1 from tb_doctor_vacation where doctor_id=$doctor_id and vacation='$date'";
			$query = $this->dbmgr->query($sql);
			$result = $this->dbmgr->fetch_array_all($query);
			if(count($result)>0){
				$sql="delete from tb_doctor_vacation where doctor_id=$doctor_id and vacation='$date'";
				$query = $this->dbmgr->query($sql);
			}else{
				$sql="insert into tb_doctor_vacation (doctor_id,vacation) values ($doctor_id,'$date')";
				$this->dbmgr->query($sql);
			}


			}
		}
		$this->dbmgr->commit_trans();
		return "RIGHT";
	}
 }
 
 $userMgr=UserMgr::getInstance();
 $userMgr->dbmgr=$dbmgr;
 
 
 
 
?>