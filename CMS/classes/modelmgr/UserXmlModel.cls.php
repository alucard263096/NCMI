<?php

class UserXmlModel extends XmlModel{
	
	public function __construct($pagename){
		parent::__construct("user",$pagename);
	}

	public function Save($dbMgr,$request,$sysuser){
	Global $SysLang; 
		if($request["primary_id"]==""){
			$login_id=$request["login_id"];
			$loginname=parameter_filter($login_id);
			$sql="select * from tb_user where login_id='$login_id' ";
			$query = $dbMgr->query($sql);
			$userRows = $dbMgr->fetch_array_all($query); 
			if(count($userRows)>0){
				return $SysLang["user"]["loginnameduplicate"];
			}
		}

		return parent::Save($dbMgr,$request,$sysuser);

	}

}

?>