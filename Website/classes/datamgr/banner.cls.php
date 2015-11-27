<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class BannerMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new BannerMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getIndexBannerList()
	{
		$sql="select title,link,pic from tb_banner where  status='A' and index_key like 'index_banner_%' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return $result;
	}

 }
 
 $bannerMgr=BannerMgr::getInstance();
 $bannerMgr->dbmgr=$dbmgr;
 
 
 
 
?>