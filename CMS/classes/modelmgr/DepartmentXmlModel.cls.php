<?php

class DepartmentXmlModel extends XmlModel{
	
	public function __construct($pagename){
		parent::__construct("department",$pagename);
	}

	public function Save($dbMgr,$request,$sysuser){
	Global $SysLang; 
		

		 $ret=parent::Save($dbMgr,$request,$sysuser);
		 if(substr($ret,0,5)=="right"){
			$id=substr($ret,5);
			$subcategory_list=$request["subcategory_list"];
			if(trim($subcategory_list)!=""){
				$sql="select concat(a.name,'-',b.name) name from tb_category a
        inner join tb_subcategory b on a.id=b.category_id
        where b.id in ($subcategory_list)";
				$query = $dbMgr->query($sql);
				$result=$dbMgr->fetch_array_all($query);
				$str="";
				foreach($result as $val){
					$str.=",".$val["name"];
				}
				$sql="update tb_department set subcategory_str='$str' where id=$id";
				$query = $dbMgr->query($sql);
			}
		 }
		 return $ret;
	}

}

?>