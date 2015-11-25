<?php

class DoctorRecomXmlModel extends XmlModel{
	
	public function __construct($name,$pagename){
		parent::__construct($name,$pagename);
		$sql="select 1 from tb_doctor_recom where id=1 ";
		$query = $dbMgr->query($sql);
		$result = $dbMgr->fetch_array_all($query);
		if(count($result)==0){
			$sql="insert into tb_doctor_recom (id) value (1) ";
			$dbMgr->query($sql);
		}
	}

	public function Save($dbMgr,$request,$sysuser){
	Global $SysLang; 

		$request["primary_id"]=1;
		return parent::Save($dbMgr,$request,$sysuser);

	}

}

?>