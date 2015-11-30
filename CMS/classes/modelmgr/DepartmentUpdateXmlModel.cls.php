<?php

class DepartmentUpdateXmlModel extends XmlModel{
	
	public function __construct($model,$pagename){
		parent::__construct($model,$pagename);
	}

	public function Save($dbMgr,$request,$sysuser){
	Global $SysLang; 
		

		 $ret=parent::Save($dbMgr,$request,$sysuser);
		 if(substr($ret,0,5)=="right"){
			$sql="select id,subcategory_list from tb_department where status='A' ";
			$query = $dbMgr->query($sql);
				$result=$dbMgr->fetch_array_all($query);
				foreach($result as $subval){
					$id=$subval["id"];
					$subcategory_list=$subval["subcategory_list"];
					if(trim($subcategory_list)!=""){
						$sql="select concat(a.name,'-',b.name) name from tb_category a
				inner join tb_subcategory b on a.id=b.category_id
				where b.id in ($subcategory_list)";
					$query = $dbMgr->query($sql);
					$subcat=$dbMgr->fetch_array_all($query);
					$str="";
					foreach($subcat as $val){
						$str.=",".$val["name"];
					}
					$sql="update tb_department set subcategory_str='$str' where id=$id";
					$query = $dbMgr->query($sql);
				}
			
			}
		 }
		 return $ret;
	}

}

?>