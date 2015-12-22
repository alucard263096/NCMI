<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class OrderMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new OrderMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}

	public function getOrder($id){
	
		$id=parameter_filter($id);

		$sql="select * from tb_order where id=$id";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 

		return $result;

	}

	public function updateOrderPayment($id){
		$id=parameter_filter($id);

		$sql="update tb_order set status='A' where id=$id";
		$query = $this->dbmgr->query($sql);
	}
 }
 
 $orderMgr=OrderMgr::getInstance();
 $orderMgr->dbmgr=$dbmgr;
 
 
 
 
?>