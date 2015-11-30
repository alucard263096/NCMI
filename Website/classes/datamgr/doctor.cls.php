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

	public function getDoctorList($search,$page){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			$startrow=$startrow-1;
		}
		
		$arrcol=array();
		$arrcol[]="d.name";
		$arrcol[]="h.name";
		$arrcol[]="dp.name";
		$arrcol[]="c.name";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select d.id,d.name,d.photo,d.photo,
h.name hospital,dp.name department,c.name college 
from tb_doctor d
inner join tb_hospital h on d.hospital_id=h.id and h.status='A'
inner join tb_department dp on d.department_id=dp.id and dp.status='A'
inner join tb_college c on dp.college_id=c.id and c.status='A'
 where d.status='A' 
 and $searchsql
  order by d.seq
		limit $startrow,18";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	public function getDoctorListPageCount($search){
		$arrcol=array();
		$arrcol[]="d.name";
		$arrcol[]="h.name";
		$arrcol[]="dp.name";
		$arrcol[]="c.name";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select sum(1) doctor_count from tb_doctor d
inner join tb_hospital h on d.hospital_id=h.id and h.status='A'
inner join tb_department dp on d.department_id=dp.id and dp.status='A'
inner join tb_college c on dp.college_id=c.id and c.status='A'
 where d.status='A'  
 and $searchsql";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}


 }
 
 $doctorMgr=DoctorMgr::getInstance();
 $doctorMgr->dbmgr=$dbmgr;
 
 
 
 
?>