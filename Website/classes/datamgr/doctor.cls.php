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

	public function getDoctorList($page){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			$startrow=$startrow-1;
		}
		$sql="select * from tb_doctor where 
		status='A' 
		order by seq
		limit $startrow,18";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	public function getDoctorListPageCount(){
		$sql="select sum(1) doctor_count from tb_doctor where 
		status='A' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["doctor_count"];
	}


 }
 
 $doctorMgr=DoctorMgr::getInstance();
 $doctorMgr->dbmgr=$dbmgr;
 
 
 
 
?>