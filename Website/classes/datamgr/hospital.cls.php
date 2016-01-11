<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class HospitalMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new HospitalMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getHospitalAll()
	{
		$sql="select * from tb_hospital where status='A' order by seq";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}
	
	public function getHospital($id)
	{
		$id=parameter_filter($id);
		$sql="select * from tb_hospital where status='A' and id=$id";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result;
	}
	public function upHospitalCount($id)
	{
		$id=parameter_filter($id);
		$sql="update tb_hospital set count=ifnull(count,10000)+1 where  id=$id";
		$query = $this->dbmgr->query($sql);
	}

	
	public function getHospitalList($search,$page){
		
		$startrow=($page-1)*18;
		if($startrow>0){
			//$startrow=$startrow-1;
		}
		
		$arrcol=array();
		$arrcol[]="h.name";
		$arrcol[]="h.shortname";
		$arrcol[]="h.content";
		$arrcol[]="d.name";
		$arrcol[]="dp.name";
		$arrcol[]="c.name";
		$arrcol[]="s.name";
		$arrcol[]="cat.name";
		$arrcol[]="h.level";
		$arrcol[]="h.property";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select distinct h.id,h.name,h.photo,h.shortname
from  tb_hospital h 
inner join rc_hospital_college rc_hc on h.id=rc_hc.pid
inner join tb_college c on rc_hc.fid=c.id and c.status='A'
inner join tb_department dp on c.id=dp.college_id and dp.status='A'
inner join rc_department_subcategory rc_ds on dp.id=rc_ds.pid
inner join tb_subcategory s on rc_ds.fid=s.id
inner join tb_category cat on cat.id=s.category_id
inner join tb_doctor d on h.id=d.hospital_id and d.status='A'
 where h.status='A' 
 and $searchsql
  order by d.seq
		limit $startrow,9";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		return $result;
	}

	public function getHospitalListPageCount($search){
		$arrcol=array();
		$arrcol[]="h.name";
		$arrcol[]="h.shortname";
		$arrcol[]="h.content";
		$arrcol[]="d.name";
		$arrcol[]="dp.name";
		$arrcol[]="c.name";
		$arrcol[]="s.name";
		$arrcol[]="cat.name";
		$arrcol[]="h.level";
		$arrcol[]="h.property";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select sum(1) hospital_count from (select  distinct h.id
from  tb_hospital h 
inner join rc_hospital_college rc_hc on h.id=rc_hc.pid
inner join tb_college c on rc_hc.fid=c.id and c.status='A'
inner join tb_department dp on c.id=dp.college_id and dp.status='A'
inner join rc_department_subcategory rc_ds on dp.id=rc_ds.pid
inner join tb_subcategory s on rc_ds.fid=s.id
inner join tb_category cat on cat.id=s.category_id
inner join tb_doctor d on h.id=d.hospital_id and d.status='A'
 where d.status='A'  
 and $searchsql ) a";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["hospital_count"];
	}

 }
 
 $hospitalMgr=HospitalMgr::getInstance();
 $hospitalMgr->dbmgr=$dbmgr;
 
 
 
 
?>