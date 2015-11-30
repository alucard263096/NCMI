<?php
/*
 * Created on 2011-2-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
 class CategoryMgr
 {
 	private static $instance = null;
	public static $dbmgr = null;
	public static function getInstance() {
		return self :: $instance != null ? self :: $instance : new CategoryMgr();
	}

	private function __construct() {
		
	}
	
	public  function __destruct ()
	{
		
	}
	
	public function getCategoryWithSubCategory()
	{
		$category=$this->getCategory();
		$subcategory=$this->getSubCategory();
		for($i=0;$i<count($category);$i++){
			foreach($subcategory as $value){
				if($category[$i]["id"]==$value["category_id"]){
					$category[$i]["subcategory"][]=$value;
				}
			}
		}
		return $category;
	}

	public function getCategory(){
	
		$sql="select * from tb_category where status='A' order by seq ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query); 
		return $result;
	}

	
	public function getSubCategory(){
	
		$sql="select tb_subcategory.* from tb_subcategory 
		inner join tb_category on tb_category.id=tb_subcategory.category_id and tb_category.status='A' 
		where tb_subcategory.status='A' order by tb_subcategory.seq ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		
		return $result;
	}

 }
 
 $categoryMgr=CategoryMgr::getInstance();
 $categoryMgr->dbmgr=$dbmgr;
 
 
 
 
?>