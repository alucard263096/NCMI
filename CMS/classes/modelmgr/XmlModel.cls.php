<?php


class XmlModel
{
  private $XmlData;
  private $PageName;

  public function __construct($name,$pagename){
      GLOBAL $CONFIG,$SysLangCode;

	  $xmlstr=$this->loadXmlFile($name);
      $this->XmlData=$this->xmlToArray($xmlstr);
	  if($CONFIG["SupportMultiLanguage"]==true){
		$this->XmlData=ResetNameWithLang($this->XmlData,$SysLangCode);
	  }
	  $this->PageName=$pagename;
  }

  private function xmlToArray( $xml )
  {
     return json_decode(json_encode((array) simplexml_load_string($xml)), true);
  }
  
  private function loadXmlFile($name){
    $path=ROOT."/model/$name.xml";
    $fp = fopen($path,"r");
    $str = fread($fp,filesize($path));
    return $str;
  }
  
  public function ShowList($dbMgr,$smartyMgr){
  
    //$searchField=$this->XmlData["fields"];
	//print_r($this->XmlData);
	$dataWithFKey=$this->loadFKeyValue($dbMgr,$this->XmlData);

	$this->GetFListData($dbMgr,$smartyMgr);
    $smartyMgr->assign("ModelData",$dataWithFKey);
    $smartyMgr->assign("PageName",$this->PageName);
    $smartyMgr->display(ROOT.'/templates/model/list.html');
  }

  private function loadFKeyValue($dbMgr,$XmlDataEx){

	$fields=$XmlDataEx["fields"]["field"];
	$count=count($fields);
	for($i=0;$i<$count;$i++){
		if($fields[$i]["type"]=="fkey"){
			$options=$this->GetFKeyData($dbMgr,$fields[$i]["displayfield"],$fields[$i]["tablename"],$fields[$i]["ntbname"],$fields[$i]["condition"],$fields[$i]["fmutillang"]);
			$fields[$i]["options"]=$options;
		}
	}
	$XmlDataEx["fields"]["field"]=$fields;
	//print_r($XmlDataEx);
	return $XmlDataEx;
  }

  private function GetFKeyData($dbMgr,$displayfield,$tablename,$tablerename,$condition,$ismutillang){
	Global $CONFIG;
	if($ismutillang=="1"){
		$subsql=$this->GetLangTableSql($tablename,$tablerename);
		$sql="select oid id,$displayfield as name from $subsql where $condition ";
	}else{
		$sql="select id,$displayfield as name from $tablename as $tablerename where $condition";
	}
	$query = $dbMgr->query($sql);
	$result = $dbMgr->fetch_array_all($query); 

	return $result;
  }

  public function GetLangTableSql($tablename,$tablenickname){
	Global $CONFIG;
	$subsql="  (select * from $tablename ".$tablenickname."_a 
							left join ".$tablename."_lang ".$tablenickname."_b 
							on ".$tablenickname."_a.id=".$tablenickname."_b.oid and ".$tablenickname."_b.lang='".$CONFIG["lang"]."'  ) $tablenickname ";
	return $subsql;
  }

  public function GetSearchSql($request){
	Global $CONFIG;
	//echo "a";
	//print_r($request);
	$sql="select r_main.id";
	$fields=$this->XmlData["fields"]["field"];
	foreach ($fields as $value){
		if($value["displayinlist"]=="1"){
			if($value["type"]=="flist"&&$value["relatetable"]!=""){
				$table=$value["relatetable"];
				
				$sql=$sql." ,'' ".$value["key"];
			}else if($value["type"]=="select"){

				$sql=$sql." ,case   r_main.".$value["key"]." ";
				foreach ($value["options"]["option"] as $option){
					$sql=$sql." when '".$option["value"]."' then '".$option["name"]."'";
				}
				$sql=$sql." else 'unknow' ";
				$sql=$sql." end as ".$value["key"];

			}else if($value["type"]=="check"){

				$sql=$sql." ,case   r_main.".$value["key"]." when 'Y' then '".$value["yvalue"]."' else '".$value["nvalue"]."' ";
				$sql=$sql." end as ".$value["key"];

			}else if($value["type"]=="fkey"){
			
				$sql=$sql." ,".$value["ntbname"].".".$value["displayfield"]." ".$value["key"];

			}else{

				$sql=$sql." ,r_main.".$value["key"];

			}
		}
	}
	
	//$sql=$sql." from ".$this->XmlData["tablename"]." as r_main ";
	if($this->XmlData["ismutillang"]=="1"){
		$subsql=$this->GetLangTableSql($this->XmlData["tablename"],"r_main");
		$sql=$sql." from $subsql ";
	}else{
		$sql=$sql." from ".$this->XmlData["tablename"]." as r_main ";
	}

	foreach ($fields as $value){
		if($value["displayinlist"]=="1"){
			if($value["type"]=="fkey"){
				if($value["fmutillang"]=="1"){
					$subsql=$this->GetLangTableSql($value["tablename"],$value["ntbname"]);
					$sql=$sql." left join $subsql on r_main.".$value["key"]."=".$value["ntbname"].".id ";
				}else{
				
					$sql=$sql." left join ".$value["tablename"]." ".$value["ntbname"]." on r_main.".$value["key"]."=".$value["ntbname"].".id ";
				}
			}
		}
	}

	$sql=$sql."  where  ".$this->XmlData["searchcondition"];
	foreach ($fields as $value){
		
		if($value["search"]=="1"){

			if($value["type"]=="datetime"){

				if($request[$value["key"]."_from"]!=""){

					$sql=$sql." and r_main.".$value["key"].">='".parameter_filter($request[$value["key"]."_from"])."'";

				}

				if($request[$value["key"]."_to"]!=""){

					$sql=$sql." and r_main.".$value["key"]."<='".parameter_filter($request[$value["key"]."_to"])."'";

				}

			}else if($value["type"]=="fkey"){

				if($request[$value["key"]]!="0"&&$request[$value["key"]]!=""){
					$sql=$sql." and r_main.".$value["key"]."=".parameter_filter($request[$value["key"]])."";
				}


			}else{
				if($request[$value["key"]]!=""
				&&$request[$value["key"]]!="no-value"){

					$sql=$sql." and r_main.".$value["key"]." like '%".parameter_filter($request[$value["key"]])."%'";
					
				}
			}

		}

	}

	$sql=$sql." order by r_main.updated_date desc ";

	return $sql;
  }

  public function GetFListData($dbMgr,$smartyMgr){
	Global $CONFIG;

	$Array=Array();
	$fields=$this->XmlData["fields"]["field"];
	foreach ($fields as $value){
		if($value["type"]=="flist"){
			//ismutillang
			$tablename=$value["tablename"];
			$tablerename=$value["ntbname"];
			$displayfield=$value["displayfield"];
			$condition=$value["condition"];
			$ismutillang=$value["fmutillang"];

			$arrayvalue=$this->GetFKeyData($dbMgr,$displayfield,$tablename,$tablerename,$condition,$ismutillang);
			
			$Arr=Array();
			$Arr["key"]=$value["key"];
			$Arr["value"]=$arrayvalue;
			$Array[]=$Arr;
		}
	}
	
    $smartyMgr->assign("FListArr",$Array);
  }


  public function ShowSearchResult($dbMgr,$smartyMgr,$request){
	
	$sql=$this->GetSearchSql($request);
	$query = $dbMgr->query($sql);
	$result = $dbMgr->fetch_array_all($query);
	$result=$this->ClearData($result);

	$result=$this->ReloadFListData($dbMgr,$result);

    $smartyMgr->assign("ModelData",$this->XmlData);
    $smartyMgr->assign("PageName",$this->PageName);
    $smartyMgr->assign("result",$result);
    $smartyMgr->display(ROOT.'/templates/model/result.html');

  }

  public function ReloadFListData($dbMgr,$result){
	$fields=$this->XmlData["fields"]["field"];
	foreach ($fields as $value){
		if($value["type"]=="flist"){
			$rtable=$value["relatetable"];
			if($rtable!=""){
				for($i=0;$i<count($result);$i++){
					$sql="select pid,fid from $rtable where pid=".$result[$i]["id"];
					$query = $dbMgr->query($sql);
					$rs = $dbMgr->fetch_array_all($query);

					$isfirst=1;
					$str="";
					foreach($rs as $v){
						if($isfirst==0){
							$str.=",";
						}
						$isfirst=0;
						$str.=$v["fid"];
					}
					$result[$i][$value["key"]]=$str;
				}
			}
		}
	}
	return $result;
  }

  public function ClearData($result){
	$count=count($result);
	for($i=0;$i<$count;$i++){
		for($j=0;$j<count($result[$i]);$j++){
			$value=$result[$i][$j];
			if($value instanceof DateTime){
				$result[$i][$j]= $value->format('Y-m-d H:i:s');
			}
		}
	}
	return $result;
  }

  public function ShowGridResult($dbMgr,$smartyMgr,$request,$parenturl){
	$sql=$this->GetSearchSql($request);

	$query = $dbMgr->query($sql);
	$result = $dbMgr->fetch_array_all($query); 
	$result=$this->ClearData($result);

	$result=$this->ReloadFListData($dbMgr,$result);
	
	$this->GetFListData($dbMgr,$smartyMgr);
    $smartyMgr->assign("ModelData",$this->XmlData);
    $smartyMgr->assign("PageName",$this->PageName);
    $smartyMgr->assign("parenturl",$parenturl);
    $smartyMgr->assign("result",$result);
    $smartyMgr->display(ROOT.'/templates/model/grid.html');

  }

  
  public function Add($dbMgr,$smartyMgr,$request){
   $dataWithFKey=$this->loadFKeyValue($dbMgr,$this->XmlData);
	$this->GetFListData($dbMgr,$smartyMgr);
	

	$smartyMgr->assign("ParentKey",$request["key"]);
	$smartyMgr->assign("ParentId",$request["id"]);

    $smartyMgr->assign("ModelData",$dataWithFKey);
    $smartyMgr->assign("PageName",$this->PageName);
    $smartyMgr->assign("action","add");
    $smartyMgr->display(ROOT.'/templates/model/detail.html');
  }
  
  public function Edit($dbMgr,$smartyMgr,$id){

	$sql="select * from ".$this->XmlData["tablename"]." where id=$id";
	$query = $dbMgr->query($sql);
	$result = $dbMgr->fetch_array_all($query); 

	$result=$this->ClearData($result);
	$result=$this->ReloadFListData($dbMgr,$result);

	$result=$result[0];

	if($this->XmlData["ismutillang"]=="1"){
	$sql="select * from ".$this->XmlData["tablename"]."_lang where oid=$id";
	$query = $dbMgr->query($sql);
	$langresult = $dbMgr->fetch_array_all($query); 
	}

	$XmlDataWithInfo=$this->assignWithInfo($this->XmlData,$result,$langresult);
    $dataWithFKey=$this->loadFKeyValue($dbMgr,$XmlDataWithInfo);
	
	$this->GetFListData($dbMgr,$smartyMgr);
    $smartyMgr->assign("ModelData",$dataWithFKey);
    $smartyMgr->assign("PageName",$this->PageName);
    $smartyMgr->assign("id",$id);
    $smartyMgr->assign("action","edit");
    $smartyMgr->display(ROOT.'/templates/model/detail.html');
  }

  private function assignWithInfo($XmlDataEx,$info,$langresult){
	
	$fields=$XmlDataEx["fields"]["field"];
	$count=count($fields);
	for($i=0;$i<$count;$i++){
		if($fields[$i]["ismutillang"]=="1"){
			$valarray=Array();
			foreach ($langresult as $rs){
				$arr=Array();
				$arr["code"]=$rs["lang"];
				$arr["value"]=$rs[$fields[$i]["key"]];
				$valarray[]=$arr;
			}
			$fields[$i]["value"]=$valarray;
		}else{
			$fields[$i]["value"]=$info[$fields[$i]["key"]];
		}
	}
	$XmlDataEx["fields"]["field"]=$fields;
	//print_r($XmlDataEx);
	return $XmlDataEx;
  }
  public function Save($dbMgr,$request,$sysuser){
	Global $SysLangConfig;
	//print_r($request);
    $sql="";
	$dbMgr->begin_trans();
	$haveMutilLang=false;
	if($request["primary_id"]==""){
	
		$id=$dbMgr->getNewId($this->XmlData["tablename"]);

		$haveMutilLang=false;

		$sql="insert into ".$this->XmlData["tablename"]." (id";
		$fields=$this->XmlData["fields"]["field"];
		foreach ($fields as $value){
			if($value["ismutillang"]=="1"){
				$haveMutilLang=true;
				continue;
			}
			if($value["type"]=="grid"){
				continue;
			}
			if($value["type"]=="flist"&&$value["relatetable"]!=""){
				continue;
			}
			if($value["nosave"]=="1"){
				continue;
			}
			$sql=$sql.",".$value["key"]."";
		}
		$sql=$sql.",created_date,created_user,updated_date,updated_user ) values (";
		$sql=$sql.$id;
		foreach ($fields as $value){
			
			
			if($value["type"]=="grid"
			||$value["ismutillang"]){
				continue;
			}
			if($value["type"]=="flist"&&$value["relatetable"]!=""){
				continue;
			}
			if($value["nosave"]=="1"){
				continue;
			}

			if($value["type"]=="password"){
				$sql=$sql.",'".md5($request[$value["key"]])."'";
			}else{
				$sql=$sql.",'".parameter_filter($request[$value["key"]])."'";
			}
		}
		$sql=$sql.",".$dbMgr->getDate().",$sysuser,".$dbMgr->getDate().",$sysuser )";
		$query = $dbMgr->query($sql);
		
	}else{
		$haveMutilLang=false;
		$id=$request["primary_id"];
		$sql="update ".$this->XmlData["tablename"]." set updated_date=".$dbMgr->getDate().",updated_user=$sysuser";
		$fields=$this->XmlData["fields"]["field"];
		foreach ($fields as $value){
			if($value["ismutillang"]=="1"){
				$haveMutilLang=true;
				continue;
			}
			if($value["type"]=="grid"
			||$value["type"]=="password"){
				continue;
			}
			if($value["type"]=="flist"&&$value["relatetable"]!=""){
				continue;
			}
			if($value["nosave"]=="1"){
				continue;
			}
			$sql=$sql.", ".$value["key"]."='".parameter_filter($request[$value["key"]])."'";
		}
		$sql=$sql." where id=$id";
		$query = $dbMgr->query($sql);

		foreach ($fields as $value){
			if($value["type"]=="password"){
				$sql="update ".$this->XmlData["tablename"]." set ";
				$sql=$sql." ".$value["key"]."='".md5($request[$value["key"]])."'";
				$sql=$sql." where id=$id and ".$value["key"]."<>'".parameter_filter($request[$value["key"]])."'";
				$query = $dbMgr->query($sql);
			}
			if($value["type"]=="flist"&&$value["relatetable"]!=""){
				$relatetable=$value["relatetable"];
				$sql="delete from $relatetable where pid=$id";
				$query = $dbMgr->query($sql);
				$arr=explode(",",$request[$value["key"]]);
				if(count($arr)>0){
					$sql="insert into $relatetable (pid,fid) values";
					$isfirst=1;
					foreach($arr as $v){
						if($isfirst==0){
							$sql.=",";
						}
						$isfirst=0;
						$sql.=" ($id,$v)";
					}
					$query = $dbMgr->query($sql);
				}
			}
		}
		if($haveMutilLang){
			foreach ($SysLangConfig["langs"]["lang"] as $lang){
				$sql="update ".$this->XmlData["tablename"]."_lang set lang='".$lang["code"]."'";
				foreach ($fields as $value){
					if($value["ismutillang"]=="1"){
						$sql=$sql.", ".$value["key"]."='".parameter_filter($request[$value["key"]."_".$lang["code"]])."'";
					}
				}
				$sql=$sql." where oid=$id and lang='".$lang["code"]."'";
				$query = $dbMgr->query($sql);
			}
		}
	}

	if($haveMutilLang){
			$sql="delete from ".$this->XmlData["tablename"]."_lang where oid=$id ";
				$query = $dbMgr->query($sql);
			foreach ($SysLangConfig["langs"]["lang"] as $lang){
				$sql="insert into ".$this->XmlData["tablename"]."_lang (oid,lang";
				$fields=$this->XmlData["fields"]["field"];
				foreach ($fields as $value){
					if($value["ismutillang"]=="1"){
					$sql=$sql.",".$value["key"]."";
					}
				}
				$sql=$sql." ) values ( $id ,'".$lang["code"]."' ";
				foreach ($fields as $value){
					if($value["ismutillang"]=="1"){
						$sql=$sql.",'".parameter_filter($request[$value["key"]."_".$lang["code"]])."'";
					}
				}
				$sql=$sql." )";
				$query = $dbMgr->query($sql);
			}
		}

	$dbMgr->commit_trans();
	return "right".$id;
  }

  public function Delete($dbMgr,$idlist,$sysuser){
    
	$sql="update ".$this->XmlData["tablename"]." set status='D',updated_user=$sysuser,updated_date=".$dbMgr->getDate()." where id in ($idlist)";
	$query = $dbMgr->query($sql);
	return "success";
  }

  public function DefaultShow($smarty,$dbmgr,$action,$menuId,$request){
	Global $SysUser;
	  if($action==""){
		$smarty->assign("MyMenuId",$menuId."_list");
		$this->ShowList($dbmgr,$smarty);

	  }else if($action=="search"){
		$this->ShowSearchResult($dbmgr,$smarty,$request);
	  }else if($action=="getgrid"){

		$this->ShowGridResult($dbmgr,$smarty,$request,$request["parenturl"]);

	  }else if($action=="add"){

		$smarty->assign("MyMenuId",$menuId."_add");

		$this->Add($dbmgr,$smarty,$request);

	  }else if($action=="edit"){
		$smarty->assign("MyMenuId",$menuId."_add");
		$this->Edit($dbmgr,$smarty,$request["id"]);
	  }else if($action=="save"){
		$result=$this->Save($dbmgr,$request,$SysUser["id"]);
		echo $result;
	  }else if($action=="delete"){
		$result=$this->Delete($dbmgr,$request["idlist"],$SysUser["id"]);
		echo $result;
	  }

 }

 
  public function ShowAPIList($dbMgr){
  
    $sql=$this->GetSearchSql($request);
	$query = $dbMgr->query($sql);
	$result = $dbMgr->fetch_array_all($query); 

	outputXml($result);
  }
  public function DetailApi($dbMgr,$id,$lang){
	if($this->XmlData["ismutillang"]=="1"){
		$sql="select * from ".$this->XmlData["tablename"]." m
		inner join ".$this->XmlData["tablename"]."_lang ml on m.id=ml.oid and code='$lang' where id=$id";
		$query = $dbMgr->query($sql);
		$result = $dbMgr->fetch_array_all($query);
	}else{
		$sql="select * from ".$this->XmlData["tablename"]." where id=$id";
		$query = $dbMgr->query($sql);
		$result = $dbMgr->fetch_array_all($query);
	}

	outputXml($result);
  }
	  
  public function DefaultShowAPI($dbmgr,$action,$request){
	  if($action==""){
		$this->ShowAPIList($dbmgr);
	  }if($action=="detail"){
		$this->DetailApi($dbmgr,$request["id"],$request["lang"]);
	  }else if($action=="save"){
		$result=$this->Save($dbmgr,$request,-1);
		echo $result;
	  }else if($action=="delete"){
		$result=$this->Delete($dbmgr,$request["idlist"],-1);
		echo $result;
	  }
  }

}

?>