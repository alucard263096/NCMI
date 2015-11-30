<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class WebsiteMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new WebsiteMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getWebsiteInfo()
	{
		$sql="select * from tb_website_base where id=1 ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);
		
		return $result;
	}

 }
 
 $websiteMgr=WebsiteMgr::getInstance();
 $websiteMgr->dbmgr=$dbmgr;
 
 
 
 
?>