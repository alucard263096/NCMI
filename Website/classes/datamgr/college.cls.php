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
	
	public function getCollegeList()
	{
		$sql="select id,name from tb_college
where status='A'
order by seq ";
		
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return $result;
	}

 }
 
 $collegeMgr=CollegeMgr::getInstance();
 $collegeMgr->dbmgr=$dbmgr;
 
 
 
 
?>