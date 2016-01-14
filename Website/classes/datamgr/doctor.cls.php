<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class DoctorMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new DoctorMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getRecommandDoctor()
	{
		
		$sql="select doctor_list from tb_doctor_recom where status='A' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		if(count($result)>0&&$result[0]["doctor_list"]!=""){
			$doctor_ids=$result[0]["doctor_list"];
			$sql="select * from tb_doctor where id in ($doctor_ids) and status='A'";
		}else{
		
			$sql="select * from tb_doctor where status='A'";
		}
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	public function getDoctor($id){
		$id=parameter_filter($id);
		$sql="select d.*,h.name hospital,c.name college,dp.name department 
		from tb_doctor d
left join tb_hospital h on d.hospital_id=h.id 
left join tb_department dp on d.department_id=dp.id 
left join tb_college c on dp.college_id=c.id 
		where d.status='A' and d.id=$id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result;
	}

	public function getDoctorListSearchSql(){
		$sql="select distinct d.id,d.name,d.photo,d.position,h.name hospital,d.expert,dp.name department
from tb_doctor d
left join tb_hospital h on d.hospital_id=h.id and h.status='A'
left join tb_department dp on d.department_id=dp.id and dp.status='A'
left join tb_college c on dp.college_id=c.id and c.status='A'
left join rc_department_subcategory rc_ds on dp.id=rc_ds.pid
left join tb_subcategory s on rc_ds.fid=s.id
left join tb_category cat on cat.id=s.category_id ";
		
		return $sql;
	}

	public function getDoctorListSearchCondition($search){
		$arrcol=array();
		$arrcol[]="d.name";
		$arrcol[]="d.position";
		$arrcol[]="d.content";
		$arrcol[]="h.name";
		$arrcol[]="dp.name";
		$arrcol[]="c.name";
		$arrcol[]="s.name";
		$arrcol[]="cat.name";
		$arrcol[]="h.level";
		$arrcol[]="h.property";
		$searchsql=splitCodition($arrcol,$search);

		return $searchsql;
	}

	public function getDoctorList($search,$page,$member_id){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		
		
		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$sql="$realsql
 and $searchsql
 where d.status='A'
  order by d.seq
		limit $startrow,18";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}

	public function getDoctorListPageCount($search){
		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$sql="select sum(1) doctor_count from 
		( $realsql  
 where d.status='A'
 and $searchsql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}
	

	public function getFollowDoctorList($member_id,$search,$page){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		
		
		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_follow_doctor mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="$realsql
 and $searchsql
 where d.status='A'
  order by d.seq
		limit $startrow,18";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}

	public function getFollowDoctorListPageCount($member_id,$search){

		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_follow_doctor mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="select sum(1) doctor_count from 
		( $realsql  
 where d.status='A'
 and $searchsql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}

	public function getDoctorReserve($doctor_id,$first_day){
		$first_day=parameter_filter($first_day);
		$doctor_id=parameter_filter($doctor_id);
	 $sql="select d.duty_mon_m,d.duty_mon_a, 
d.duty_tue_m,d.duty_tue_a, 
d.duty_wed_m,d.duty_wed_a,
d.duty_thu_m,d.duty_thu_a, 
d.duty_fri_m,d.duty_fri_a, 
d.duty_sat_m,d.duty_sat_a,
d.duty_sun_m,d.duty_sun_a,
dr.mon_m,dr.mon_a, DATE_ADD('$first_day',INTERVAL 0 DAY) mon_date,
dr.tue_m,dr.tue_a, DATE_ADD('$first_day',INTERVAL 1 DAY) tue_date, 
dr.wed_m,dr.wed_a, DATE_ADD('$first_day',INTERVAL 2 DAY) wed_date,
dr.thu_m,dr.thu_a, DATE_ADD('$first_day',INTERVAL 3 DAY) thu_date, 
dr.fri_m,dr.fri_a, DATE_ADD('$first_day',INTERVAL 4 DAY) fri_date, 
dr.sat_m,dr.sat_a, DATE_ADD('$first_day',INTERVAL 5 DAY) sat_date,
dr.sun_m,dr.sun_a, DATE_ADD('$first_day',INTERVAL 6 DAY) sun_date from tb_doctor d
left join tb_doctor_reserve dr on d.id=dr.doctor_id and dr.first_day='$first_day'
where id=$doctor_id and status='A'
";


		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 

		$vacations=$this->getVacation($doctor_id,$first_day);

		$t_arr= Array();
		$t_arr[]="m";
		$t_arr[]="a";

		$d_arr= Array();
		$d_arr[]="mon";
		$d_arr[]="tue";
		$d_arr[]="wed";
		$d_arr[]="thu";
		$d_arr[]="fri";
		$d_arr[]="sat";
		$d_arr[]="sun";

		$ret=Array();
		foreach($t_arr as $t){
			$tac= Array();
			foreach($d_arr as $val){
				$arr=Array();
				$arr["dut"]=$result["duty_".$val."_$t"]+0;
				$arr["use"]=$result[$val."_$t"]+0;
				$arr["day"]=$result[$val."_date"];
				if(date("Y-m-d")<date("Y-m-d",strtotime($arr["day"]))){
					$arr["active"]="Y";
				}
				if($this->inSchedule($vacations,$arr["day"],"vacation")){
					$arr["onvacation"]="Y";
				}
				$arr["tac"]=$t;
				$tac[]=$arr;
			}
			$ret[]=$tac;
		}
		//print_r($ret);
		return $ret;
	}
	
	public function inSchedule($dates,$date,$col){
		for($i=0;$i<count($dates);$i++){
			if(date('Y-m-d', strtotime($dates[$i][$col]))==$date){
				return true;
			}
		}
		return false;
	}
	
	public function getVacation($doctor_id,$first_day){
		
		$sql="select distinct vacation from tb_doctor_vacation 
		where doctor_id=$doctor_id 
		and ( vacation>='$first_day' and vacation<=DATE_ADD('$first_day',INTERVAL 6 DAY) )";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	public function getMeetingTime($doctor_id,$date,$tac){
		
		$minute=0;
		$start="";
		if($tac=="m"){
			$minute=240;
			$start="08:00";
		}else{
			$minute=180;
			$start="14:00";
		}

		$ret=array();
		$shortday=getDayShortName($date);

		$sql="select duty_".$shortday."_$tac count from tb_doctor where id=$doctor_id";
		
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		$count=$result["count"];

		$interval=$minute/$count;


		$sql="select meeting_time from tb_order where doctor_id=$doctor_id and meeting_date='$date' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		for($i=0;$i<$count;$i++){
			$item=array();
			$str=date("H:i",strtotime("2015-1-1 $start:00")+$i*$interval*60)."-".date("H:i",strtotime("2015-1-1 $start:00")+($i+1)*$interval*60);
			if(!checkDataInList($result,$str)){
				$item["val"]=date("H:i",strtotime("2015-1-1 $start:00")+$i*$interval*60);
				$item["str"]=$str;
				$ret[]=$item;
			}
		}
		return $ret;
	}
	

	public function getOrderDoctorList($member_id,$search,$page){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		
		
		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_case mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="$realsql
 and $searchsql
 where d.status='A'
  order by d.seq
		limit $startrow,18";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}

	public function getOrderDoctorListPageCount($member_id,$search){

		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_case mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="select sum(1) doctor_count from 
		( $realsql  
 where d.status='A'
 and $searchsql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}


	

	public function getServiceDoctorList($member_id,$search,$page){
		
		$startrow=($page-1)*2;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		
		
		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_case mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="$realsql
 and $searchsql
 where d.status='A'
  order by d.seq
		limit $startrow,2";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}

	public function getServiceDoctorListPageCount($member_id,$search){

		$searchsql=$this->getDoctorListSearchCondition($search);
		$realsql=$this->getDoctorListSearchSql();
		$realsql="$realsql
inner join tb_member_case mfd on mfd.doctor_id=d.id and mfd.member_id=$member_id";

		$sql="select sum(1) doctor_count from 
		( $realsql  
 where d.status='A'
 and $searchsql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}
 }
 
 $doctorMgr=DoctorMgr::getInstance();
 $doctorMgr->dbmgr=$dbmgr;
 
 
 
 
?>