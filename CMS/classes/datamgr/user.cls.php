<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class UserMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static $webServiceClient = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new UserMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getUserByName($loginname)
	{
		$loginname=parameter_filter($loginname);
		$sql="select * from tb_user where login_id='$loginname' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}
	
	public function changsePassword($user_id,$current_password,$new_password)
	{
		$new_password=parameter_filter($new_password);
		$user=$this->getUser($user_id);
		if($current_password!=$user["password"])
		{
			return "current_password_diff";
		}
		
		$sql="update tb_user set password='$new_password',updated_user=$user_id,updated_date=".$dbMgr->getDate()." where user_id=$user_id";
		$query = $this->dbmgr->query($sql);
		
		return "success";
	}
	
	public function resetPassword($user_id,$password,$sysUser_id)
	{
		$password=parameter_filter($password);
		
		$sql="update tb_user set password='$password',updated_user=$sysUser_id,updated_date=".$dbMgr->getDate()." where user_id=$user_id";
		$query = $this->dbmgr->query($sql);
	}
	
 }
 
 $userMgr=UserMgr::getInstance();
 $userMgr->dbmgr=$dbmgr;
 
 
 
 
?>