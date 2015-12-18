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
inner join tb_hospital h on d.hospital_id=h.id 
inner join tb_department dp on d.department_id=dp.id 
inner join tb_college c on dp.college_id=c.id 
		where d.status='A' and d.id=$id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result;
	}

	public function getDoctorListSearchSql(){
		$sql="select distinct d.id,d.name,d.photo,d.position
from tb_doctor d
inner join tb_hospital h on d.hospital_id=h.id and h.status='A'
inner join tb_department dp on d.department_id=dp.id and dp.status='A'
inner join tb_college c on dp.college_id=c.id and c.status='A'
inner join rc_department_subcategory rc_ds on dp.id=rc_ds.pid
inner join tb_subcategory s on rc_ds.fid=s.id
inner join tb_category cat on cat.id=s.category_id ";
		
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
	

	public function getFollowDoctorList($member_id,$search,$page,$member_id){
		
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
				$arr["tac"]=$t;
				$tac[]=$arr;
			}
			$ret[]=$tac;
		}
		return $ret;
	}

 }
 
 $doctorMgr=DoctorMgr::getInstance();
 $doctorMgr->dbmgr=$dbmgr;
 
 
 
 
?>