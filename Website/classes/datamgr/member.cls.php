<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class MemberMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new MemberMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function checkLoginNameUsed($loginname){
		$loginname=parameter_filter($loginname);
		$sql="select 1 from tb_member where  loginname='$loginname' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return count($result)>0;
	}
	
	public function checkEmailUsed($email){
		$email=parameter_filter($email);
		$sql="select 1 from tb_member where  email='$email' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return count($result)>0;
	}

	public function insertMember($loginname,$password,$email,$sexual){
		
		$loginname=parameter_filter($loginname);
		$password=md5(parameter_filter($password));
		$email=parameter_filter($email);
		$sexual=parameter_filter($sexual);
		$id=$this->dbmgr->getNewId("tb_member");
		$verify_code=md5($loginname.$password);
		$sql="insert into tb_member (id,loginname,password,email,sexual,created_date) values 
		($id,'$loginname','$password','$email','$sexual',now()) ";
		
		$query = $this->dbmgr->query($sql);

	}

 }
 
 $memberMgr=MemberMgr::getInstance();
 $memberMgr->dbmgr=$dbmgr;
 
 
 
 
?>