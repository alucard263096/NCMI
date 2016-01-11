<?php

class GeneralTextXmlModel extends XmlModel{
	
	public function __construct($pagename){
		parent::__construct("general",$pagename);
	}

	public function Save($dbMgr,$request,$sysuser){
	Global $SysLang; 
		if($request["primary_id"]==""){
			$key=$request["key"];
			$loginname=parameter_filter($key);
			$sql="select * from tb_general where `index_key`='$key' ";
			$query = $dbMgr->query($sql);
			$userRows = $dbMgr->fetch_array_all($query); 
			if(count($userRows)>0){
				return $SysLang["general"]["keyduplicate"];
			}
		}
		return parent::Save($dbMgr,$request,$sysuser);

	}

}

?>