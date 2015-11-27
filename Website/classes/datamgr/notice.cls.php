<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class NoticeMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new NoticeMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getNoticeContent()
	{
		$ret="暂无公告";
		
		$sql="select content from tb_notice where id=1 and status='A' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 

		if(count($result)>0){
			return $result[0]["content"];
		}

		return $ret;
	}

 }
 
 $noticeMgr=NoticeMgr::getInstance();
 $noticeMgr->dbmgr=$dbmgr;
 
 
 
 
?>