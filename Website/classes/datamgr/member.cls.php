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
		$sql="insert into tb_member (id,loginname,password,email,sexual,created_date,status) values 
		($id,'$loginname','$password','$email','$sexual',now(),'A') ";
		
		$query = $this->dbmgr->query($sql);

	}

	public function sentRegVerifyCode($email){
		$email=parameter_filter($email);
		$sql="select * from tb_member where  email='$email' 
		and ifnull(is_verify,'N')='N' 
		and (ifnull(verifysent_date,'')='' or TO_DAYS(NOW()) - TO_DAYS(verifysent_date) > 5)";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);

		if(count($result)>0){
			$verifycode=md5($email.date("Y-m-i"));
			$sql="update tb_member set 
			verifycode='$verifycode'
			,is_verify='N'
			,verifysent_date=now()
			where id=".$result[0]["id"];
			$this->dbmgr->query($sql);
			return $verifycode;
		}

		return "";
	}
	public function sentForgetVerifyCode($email){
		$email=parameter_filter($email);
		$sql="select * from tb_member where  email='$email' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);
		if($result["forget_verifycode"]==""){
			$verifycode=md5($email.date("Y-m-i"));
			$sql="update tb_member set 
			forget_verifycode='$verifycode'
			where id=".$result["id"];
			$this->dbmgr->query($sql);
			return $verifycode;
		}else{
			return $result["forget_verifycode"];
		}
	}
	public function verifyMember($email,$verficode){
		$email=parameter_filter($email);
		$verficode=parameter_filter($verficode);

		 $sql="select * from tb_member 
		where is_verify='N' 
		and verifycode='$verficode' 
		and email='$email' ";
		
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		if(count($result)>0){
				$id=$result[0]["id"];
				$sql="update tb_member set is_verify='Y' where id=$id ";
				$this->dbmgr->query($sql);

				return $result[0];
		}
		return null;
	}
	public function verifyForgetMember($email,$verficode){
		$email=parameter_filter($email);
		$verficode=parameter_filter($verficode);

		 $sql="select * from tb_member 
		where forget_verifycode='$verficode' 
		and email='$email' ";
		
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		if(count($result)>0){
			return $result[0];
		}
		return null;
	}

	public function loginMember($loginname){
		$loginname=parameter_filter($loginname);
		$sql="select * from tb_member 
		where loginname='$loginname' ";

		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);

		return $result;
	}
	public function resetPassword($id,$password){
		$password=md5(parameter_filter($password));
		$id=parameter_filter($id);
		$sql="update tb_member set password='$password',
		forget_verifycode='' where id=$id";
		$query = $this->dbmgr->query($sql);
	}

	public function getBaseInfo($id){
		$id=parameter_filter($id);

		$sql="select * from tb_member_base_info where member_id=$id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);

		if($result["member_id"]==""){
			$sql="insert into tb_member_base_info (member_id) values ($id)";
			$this->dbmgr->query($sql);
		}

		return $result;

	}

	public function updateBaseInfo($id,$request){
		$mobile=parameter_filter($request["mobile"]);
		$name=parameter_filter($request["name"]);
		$identity=parameter_filter($request["identity"]);
		$nation=parameter_filter($request["nation"]);
		$birth=parameter_filter($request["birth"]);
		$tel=parameter_filter($request["tel"]);
		$address=parameter_filter($request["address"]);

		$sql="update tb_member set mobile='$mobile' where id=$id ";
		$this->dbmgr->query($sql);

		$sql="update tb_member_base_info set name='$name'
		,identity='$identity'
		,nation='$nation'
		,birth='$birth'
		,tel='$tel'
		,address='$address' 
		where member_id=$id ";
		$this->dbmgr->query($sql);
	}
	
	public function getCaseList($member_id,$page){
		
		$startrow=($page-1)*3;
		if($startrow>0){
			$startrow=$startrow;
		}
		$sql="select a.*,d.name doctor_name from tb_member_case a
		inner join tb_doctor d on a.doctor_id=d.id
		where a.member_id=$member_id and a.status<>'D'
		order by a.meeting_date desc 
		limit $startrow,3 ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		
		return $result;
	}
	public function getCase($member_id,$id){
		$id=parameter_filter($id);
		$id=$id+0;
		$member_id=parameter_filter($member_id);
		
		$sql="select c.*
,d.name doc_name,h.name hospital_name,f.title file_name 
from tb_member_case c
inner join tb_doctor d on c.doctor_id=d.id
inner join tb_hospital h on c.hospital_id=h.id
inner join tb_member_file f on c.file_id=f.id
 where c.member_id=$member_id and c.id=$id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);

		return $result;
	}
	public function deleteCaseList($member_id,$caselist){
		if($caselist!=""){
			$caselist=parameter_filter($caselist);
			$sql="update tb_member_case set status='D',updated_date=now() where id in ($caselist) and member_id=$member_id";
			$this->dbmgr->query($sql);
		}
	}
	public function getCaseListPageCount($member_id){
	$searchsql=splitCodition($arrcol,$search);
		$sql="select sum(1) count from (select a.* from tb_member_case a
		inner join tb_doctor d on a.doctor_id=d.id
		where a.member_id=$member_id and a.status<>'D' ) dc";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		return $result["count"];
	}
	public function getFileList($member_id){
		$sql="select * from tb_member_file where member_id=$member_id and status='A' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		for($i=0;$i<count($result);$i++){
			$fill=0;
			$total=count($result[$i]);
			for($j=0;$j<$total;$j++){
				if(trim($result[$i][$j])!=""){
					$fill++;
				}
			}
			$result[$i]["finish"]=round($fill*100/($total/2),-1);
		}
		return $result;
	}
	public function deleteFileList($member_id,$filelist){
		$filelist=parameter_filter($filelist);
		$sql="update tb_member_file set status='D',updated_date=now() where id in ($filelist) and member_id=$member_id";
		$this->dbmgr->query($sql);
	}
	public function getFile($member_id,$id){
		$id=parameter_filter($id);
		$id=$id+0;
		$member_id=parameter_filter($member_id);
		
		$sql="select * from tb_member_file where member_id=$member_id and id=$id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);
		return $result;
	}
	public function saveFile($member_id,$request){
		$id=parameter_filter($request["id"]);
		$title=parameter_filter($request["title"]);
		$name=parameter_filter($request["name"]);
		$sexual=parameter_filter($request["sexual"]);
		$age=parameter_filter($request["age"]);
		$birth=parameter_filter($request["birth"]);
		$country=parameter_filter($request["country"]);
		$nation=parameter_filter($request["nation"]);
		$majority=parameter_filter($request["majority"]);
		$oriplace=parameter_filter($request["oriplace"]);
		$tel=parameter_filter($request["tel"]);
		$marriaged=parameter_filter($request["marriaged"]);
		$education=parameter_filter($request["education"]);
		$identity=parameter_filter($request["identity"]);
		$profession=parameter_filter($request["profession"]);
		$workspace=parameter_filter($request["workspace"]);
		$home_address=parameter_filter($request["home_address"]);
		$postcode=parameter_filter($request["postcode"]);
		$internal_code=parameter_filter($request["internal_code"]);
		$diagnosis_code=parameter_filter($request["diagnosis_code"]);
		$contact_people=parameter_filter($request["contact_people"]);
		$contact_relationship=parameter_filter($request["contact_relationship"]);
		$contact_tel=parameter_filter($request["contact_tel"]);
		$contact_address=parameter_filter($request["contact_address"]);
		$diagnosis=parameter_filter($request["diagnosis"]);
		$menstrual_history=parameter_filter($request["menstrual_history"]);
		$childbearing_history=parameter_filter($request["childbearing_history"]);
		$allergic_history=parameter_filter($request["allergic_history"]);
		$disease_history=parameter_filter($request["disease_history"]);
		$person_history=parameter_filter($request["person_history"]);
		$family_history=parameter_filter($request["family_history"]);
		$smoke=parameter_filter($request["smoke"]);
		$smoke_months=parameter_filter($request["smoke_months"]);
		$drink=parameter_filter($request["drink"]);
		$drink_months=parameter_filter($request["drink_months"]);
		$exercise=parameter_filter($request["exercise"]);
		$exercise_inweek=parameter_filter($request["exercise_inweek"]);
		$exercise_intime=parameter_filter($request["exercise_intime"]);
		$exercise_type=parameter_filter($request["exercise_type"]);
		$blood_type=parameter_filter($request["blood_type"]);
		$diet=parameter_filter($request["diet"]);
		$live=parameter_filter($request["live"]);
		$medical=parameter_filter($request["medical"]);
		$health=parameter_filter($request["health"]);
		$religion=parameter_filter($request["religion"]);
		$insurance=parameter_filter($request["insurance"]);
		$household=parameter_filter($request["household"]);
		$health_level=parameter_filter($request["health_level"]);
		$height=parameter_filter($request["height"]);
		$weight=parameter_filter($request["weight"]);
		$BMI=parameter_filter($request["BMI"]);
		$bust=parameter_filter($request["bust"]);
		$waistlines=parameter_filter($request["waistlines"]);
		$hip=parameter_filter($request["hip"]);
		$income=parameter_filter($request["income"]);
		$pingyin=parameter_filter($request["pingyin"]);
		$wubi=parameter_filter($request["wubi"]);
		$block=parameter_filter($request["block"]);
		$block_office=parameter_filter($request["block_office"]);
		$identity_type=parameter_filter($request["identity_type"]);
		$insurance_no=parameter_filter($request["insurance_no"]);
		$id=$id+0;
		if($id==0){
		
		$id=$this->dbmgr->getNewId("tb_member_file");
			$sql="
			INSERT INTO `tb_member_file`
(`id`,
`member_id`,
`title`,
`name`,
`sexual`,
`age`,
`birth`,
`country`,
`nation`,
`majority`,
`oriplace`,
`tel`,
`marriaged`,
`education`,
`identity`,
`profession`,
`workspace`,
`home_address`,
`postcode`,
`internal_code`,
`diagnosis_code`,
`contact_people`,
`contact_relationship`,
`contact_tel`,
`contact_address`,
`diagnosis`,
`menstrual_history`,
`childbearing_history`,
`allergic_history`,
`disease_history`,
`person_history`,
`family_history`,
`smoke`,
`smoke_months`,
`drink`,
`drink_months`,
`exercise`,
`exercise_inweek`,
`exercise_intime`,
`exercise_type`,
`blood_type`,
`diet`,
`live`,
`medical`,
`health`,
`religion`,
`insurance`,
`household`,
`health_level`,
`height`,
`weight`,
`BMI`,
`bust`,
`waistlines`,
`hip`,
`income`,
`pingyin`,
`wubi`,
`created_date`,
`updated_date`,
`status`,
`block`,
`block_office`,
`identity_type`,
`insurance_no`)
VALUES
($id,
$member_id,
'$title',
'$name',
'$sexual',
'$age',
'$birth',
'$country',
'$nation',
'$majority',
'$oriplace',
'$tel',
'$marriaged',
'$education',
'$identity',
'$profession',
'$workspace',
'$home_address',
'$postcode',
'$internal_code',
'$diagnosis_code',
'$contact_people',
'$contact_relationship',
'$contact_tel',
'$contact_address',
'$diagnosis',
'$menstrual_history',
'$childbearing_history',
'$allergic_history',
'$disease_history',
'$person_history',
'$family_history',
'$smoke',
'$smoke_months',
'$drink',
'$drink_months',
'$exercise',
'$exercise_inweek',
'$exercise_intime',
'$exercise_type',
'$blood_type',
'$diet',
'$live',
'$medical',
'$health',
'$religion',
'$insurance',
'$household',
'$health_level',
'$height',
'$weight',
'$BMI',
'$bust',
'$waistlines',
'$hip',
'$income',
'$pingyin',
'$wubi',
now(),
now(),
'A',
'$block',
'$block_office',
'$identity_type',
'$insurance_no');

			";
		}else{
$sql="
UPDATE `tb_member_file`
SET
`title` = '$title',
`name` = '$name',
`sexual` = '$sexual',
`age` = '$age',
`birth` = '$birth',
`country` = '$country',
`nation` = '$nation',
`majority` = '$majority',
`oriplace` = '$oriplace',
`tel` = '$tel',
`marriaged` = '$marriaged',
`education` = '$education',
`identity` = '$identity',
`profession` = '$profession',
`workspace` = '$workspace',
`home_address` = '$home_address',
`postcode` = '$postcode',
`internal_code` = '$internal_code',
`diagnosis_code` = '$diagnosis_code',
`contact_people` = '$contact_people',
`contact_relationship` = '$contact_relationship',
`contact_tel` = '$contact_tel',
`contact_address` = '$contact_address',
`diagnosis` = '$diagnosis',
`menstrual_history` = '$menstrual_history',
`childbearing_history` = '$childbearing_history',
`allergic_history` = '$allergic_history',
`disease_history` = '$disease_history',
`person_history` = '$person_history',
`family_history` = '$family_history',
`smoke` = '$smoke',
`smoke_months` = '$smoke_months',
`drink` = '$drink',
`drink_months` = '$drink_months',
`exercise` = '$exercise',
`exercise_inweek` = '$exercise_inweek',
`exercise_intime` = '$exercise_intime',
`exercise_type` = '$exercise_type',
`blood_type` = '$blood_type',
`diet` = '$diet',
`live` = '$live',
`medical` = '$medical',
`health` = '$health',
`religion` = '$religion',
`insurance` = '$insurance',
`household` = '$household',
`health_level` = '$health_level',
`height` = '$height',
`weight` = '$weight',
`BMI` = '$BMI',
`bust` = '$bust',
`waistlines` = '$waistlines',
`hip` = '$hip',
`income` = '$income',
`pingyin` = '$pingyin',
`wubi` = '$wubi',
`updated_date` = now(),
`block` = '$block',
`block_office` = '$block_office',
`identity_type` = '$identity_type',
`insurance_no` = '$insurance_no'
WHERE 
`id` = $id and 
`member_id` = $member_id;
";
		}
		$this->dbmgr->query($sql);
		return $id;
	}
 }
 
 $memberMgr=MemberMgr::getInstance();
 $memberMgr->dbmgr=$dbmgr;
 
 
 
 
?>