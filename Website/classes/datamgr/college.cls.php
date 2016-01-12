<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class CollegeMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new CollegeMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getCollegeAll()
	{
		$sql="select id,name from tb_college
where status='A'
order by seq ";
		
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return $result;
	}

	public function getCollegeList($search){

		$arrcol=array();
		$arrcol[]="d.name";
		$arrcol[]="c.name";
		$arrcol[]="s.name";
		$arrcol[]="cat.name";
		$arrcol[]="dc.name";
		$arrcol[]="h.name";
		$arrcol[]="h.shortname";
		$arrcol[]="h.level";
		$arrcol[]="h.property";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select distinct c.id,c.name from 
 tb_college c 
inner join tb_department d on c.id=d.college_id and d.status='A'
left join rc_department_subcategory rc_ds on d.id=rc_ds.pid 
left join tb_subcategory s on rc_ds.fid=s.id
left join tb_category cat on s.category_id=cat.id
left join rc_hospital_college rc_hc on c.id=rc_hc.fid
left join tb_hospital h on rc_hc.pid=h.id
left join tb_doctor dc on h.id=dc.hospital_id and dc.status='A'
where c.status='A' 
and $searchsql
order by c.seq ";

		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		$departments=$this->getDepartmentList($search);

		for($i=0;$i<count($result);$i++){

			foreach($departments as $dep){
				if($result[$i]["id"]==$dep["college_id"]){
					$result[$i]["departments"][]=$dep;
				}
			}

		}

		return $result;
	}
	
	public function getDepartmentList($search){

		$arrcol=array();
		$arrcol[]="d.name";
		$arrcol[]="c.name";
		$arrcol[]="s.name";
		$arrcol[]="cat.name";
		$arrcol[]="dc.name";
		$arrcol[]="h.name";
		$arrcol[]="h.shortname";
		$arrcol[]="h.level";
		$arrcol[]="h.property";
		$searchsql=splitCodition($arrcol,$search);
		$sql="select distinct d.id, d.college_id,d.name from 
 tb_college c 
inner join tb_department d on c.id=d.college_id and d.status='A'
left join rc_department_subcategory rc_ds on d.id=rc_ds.pid 
left join tb_subcategory s on rc_ds.fid=s.id
left join tb_category cat on s.category_id=cat.id
left join rc_hospital_college rc_hc on c.id=rc_hc.fid
left join tb_hospital h on rc_hc.pid=h.id
left join tb_doctor dc on h.id=dc.hospital_id and dc.status='A'
where c.status='A' 
and $searchsql
order by c.seq ";

		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		
		return $result;
	}
 }
 
 $collegeMgr=CollegeMgr::getInstance();
 $collegeMgr->dbmgr=$dbmgr;
 
 
 
 
?>