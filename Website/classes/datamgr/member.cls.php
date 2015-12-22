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
	public function isFollowDoctor($member_id,$doctor_id){
		$member_id=parameter_filter($member_id);
		$doctor_id=parameter_filter($doctor_id);

		$sql="select 1 from tb_member_follow_doctor where member_id=$member_id and doctor_id=$doctor_id";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		return count($result)>0?"1":"0";
	}
	public function followDoctor($member_id,$doctor_id){
		$member_id=parameter_filter($member_id);
		$doctor_id=parameter_filter($doctor_id);

		$sql="insert into tb_member_follow_doctor (member_id,doctor_id)
		values ($member_id,$doctor_id)";
		$this->dbmgr->query($sql);
	}
	public function unfollowDoctor($member_id,$doctor_id){
		$member_id=parameter_filter($member_id);
		$doctor_id=parameter_filter($doctor_id);

		$sql="delete from tb_member_follow_doctor where member_id=$member_id and doctor_id=$doctor_id";
		$this->dbmgr->query($sql);
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
		$photo=parameter_filter($request["photo"]);

		$sql="update tb_member set mobile='$mobile' where id=$id ";
		$this->dbmgr->query($sql);

		$sql="update tb_member_base_info set name='$name'
		,identity='$identity'
		,nation='$nation'
		,birth='$birth'
		,tel='$tel'
		,address='$address' 
		,photo='$photo' 
		where member_id=$id ";
		$this->dbmgr->query($sql);
	}
	
	public function getCaseList($member_id,$page){
		
		$startrow=($page-1)*3;
		if($startrow>0){
			$startrow=$startrow;
		}
		$sql="select a.*,d.name d_name from tb_member_case a
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
,d.name doctor
from tb_member_case c
inner join tb_doctor d on c.doctor_id=d.id
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
	
	
	public function saveCaseInMember($member_id,$request){
		$id=parameter_filter($request["id"]);
		$apply_hospital=parameter_filter($request["apply_hospital"]);
		$apply_date=parameter_filter($request["apply_date"]);
		$name=parameter_filter($request["name"]);
		$sexual=parameter_filter($request["sexual"]);
		$age=parameter_filter($request["age"]);
		$tel=parameter_filter($request["tel"]);
		$contact=parameter_filter($request["contact"]);
		$contact_tel=parameter_filter($request["contact_tel"]);
		$contact_address=parameter_filter($request["contact_address"]);
		$apply_history=parameter_filter($request["apply_history"]);
		$apply_situation=parameter_filter($request["apply_situation"]);
		$apply_report=parameter_filter($request["apply_report"]);
		$apply_procedure=parameter_filter($request["apply_procedure"]);
		$apply_first_result=parameter_filter($request["apply_first_result"]);
		$apply_department=parameter_filter($request["apply_department"]);
		$apply_doctor=parameter_filter($request["apply_doctor"]);
		
		$id=$id+0;
		
$sql="
UPDATE `tb_member_case`
SET
apply_hospital='$apply_hospital',
apply_date='$apply_date',
name='$name',
sexual='$sexual',
age='$age',
tel='$tel',
contact='$contact',
contact_tel='$contact_tel',
contact_address='$contact_address',
apply_history='$apply_history',
apply_situation='$apply_situation',
apply_report='$apply_report',
apply_procedure='$apply_procedure',
apply_first_result='$apply_first_result',
apply_department='$apply_department',
apply_doctor='$apply_doctor'
where 
`id` = $id and 
`member_id` = $member_id;
";
		$this->dbmgr->query($sql);
		return $id;
	}
	public function createCase($member_id,$doctor_id,$file_id,$request){
		$id=$this->dbmgr->getNewId("tb_member_case");
$apply_hospital=parameter_filter($request["apply_hospital"]);
$apply_date=parameter_filter($request["apply_date"]);
$name=parameter_filter($request["name"]);
$sexual=parameter_filter($request["sexual"]);
$age=parameter_filter($request["age"]);
$category=parameter_filter($request["category"]);
$way=parameter_filter($request["way"]);
$urgent=parameter_filter($request["urgent"]);
$necessary=parameter_filter($request["necessary"]);
$meeting_date=parameter_filter($request["meeting_date"]);
$first_result=parameter_filter($request["first_result"]);
$acresult=parameter_filter($request["result"]);
$checking=parameter_filter($request["checking"]);
$solution=parameter_filter($request["solution"]);
$caution=parameter_filter($request["caution"]);
$signature=parameter_filter($request["signature"]);
$status=parameter_filter($request["status"]);
$summary=parameter_filter($request["summary"]);
$contact=parameter_filter($request["contact"]);
$apply_department=parameter_filter($request["apply_department"]);
$apply_doctor=parameter_filter($request["apply_doctor"]);
$apply_history=parameter_filter($request["apply_history"]);
$apply_situation=parameter_filter($request["apply_situation"]);
$apply_report=parameter_filter($request["apply_report"]);
$apply_procedure=parameter_filter($request["apply_procedure"]);
$apply_first_result=parameter_filter($request["apply_first_result"]);
$contact_tel=parameter_filter($request["contact_tel"]);
$contact_address=parameter_filter($request["contact_address"]);
$hospital=parameter_filter($request["hospital"]);
$department=parameter_filter($request["department"]);
$tel=parameter_filter($request["tel"]);
$tac=parameter_filter($request["tac"]);
$meeting_time=parameter_filter($request["meeting_time"]);

		$meeting_date_mon=getmon(strtotime($meeting_date));
		$dayshort=getDayShortName($meeting_date);

		$dayshorttac=$dayshort."_".$tac;
		$sql="select d.duty_$dayshorttac duty,ifnull(dr.$dayshorttac,0) `use`  from tb_doctor d
left join tb_doctor_reserve dr on d.id=dr.doctor_id and dr.first_day='$meeting_date_mon'
where d.id=$doctor_id ";


		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);
		if($result["duty"]<=$result["use"]){
			return "FULLRESERVE";
		}

		$meetweek=getmonsun(strtotime($meeting_date));
		$mon=$meetweek["mon_str_t"];
		$sun=$meetweek["sun_str_t"];
		$sql="select * from tb_order
where doctor_id=$doctor_id and status='T' and meeting_date>='$mon 0:0:0' and meeting_date<='$sun 23:59:59'";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		if(count($result)>0){
			return "RESERVEINWEEK";
		}

		$sql="select 1 from tb_order where doctor_id=$doctor_id and meeting_date='$meeting_date' and meeting_time='$meeting_time'";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		if(count($result)>0){
			return "RESERVED";
		}


		
		$sql="INSERT INTO `tb_member_case`
(`id`,
`member_id`,`file_id`,`title`,`doctor_id`,`apply_hospital`,`apply_date`,
`name`,`sexual`,`age`,`category`,`way`,`urgent`,`necessary`,`meeting_date`,
`first_result`,`position`,`result`,`checking`,`solution`,`caution`,`signature`,`status`,`created_date`,
`updated_date`,`summary`,`contact`,`apply_department`,`apply_doctor`,`apply_history`,`apply_situation`,
`apply_report`,`apply_procedure`,`apply_first_result`,`contact_tel`,`contact_address`,`hospital`,`department`,`tel`,`meeting_time`)
VALUES
($id,
$member_id,$file_id,'申请单$meeting_date',$doctor_id,'$apply_hospital',
'$apply_date','$name','$sexual','$age','$category','$way','$urgent','$necessary',
'$meeting_date','$first_result','$position','$acresult','$checking','$solution','$caution','$signature','T',
now(),now(),'$summary','$contact','$apply_department','$apply_doctor','$apply_history',
'$apply_situation','$apply_report','$apply_procedure','$apply_first_result',
'$contact_tel','$contact_address','$hospital','$department','$tel','$meeting_time');
";
		$this->dbmgr->begin_trans();
		$this->dbmgr->query($sql);
		
		$uploadfiles=explode("<||>",$request["uploadfiles"]);
		
		$attid=$this->dbmgr->getNewId("tb_member_case_attachment");
		foreach ($uploadfiles as $value){
			if($value!=""){
				$uploadfile=explode("<~>",$value);
				$filesavename=parameter_filter($uploadfile[0]);
				$filename=parameter_filter($uploadfile[1]);
				$sql="insert into tb_member_case_attachment (id,case_id,filesavename,filename)
				values ($attid,$id,'$filesavename','$filename')";
				$this->dbmgr->query($sql);
				$attid++;
			}
		}
		$case_id=$id;

		$sql="select 1 from tb_doctor_reserve where doctor_id=$doctor_id and first_day='$meeting_date_mon'";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array_all($query);
		if(count($result)==0){
			$sql="insert into tb_doctor_reserve (doctor_id,first_day) values ($doctor_id,'$meeting_date_mon')";
			$this->dbmgr->query($sql);
		}

		$sql="select price from tb_doctor where id=$doctor_id ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query);
		$price=$result["price"];

		
		$id=$this->dbmgr->getNewId("tb_order");
		$order_no=$this->genOrderNo("PT");
		$sql="insert into tb_order 
		(id,case_id,price,submit_date,meeting_date,tac,status,
		created_date,created_user,updated_date,updated_user,
		order_no,doctor_id,meeting_time) values 
		($id,$case_id,$price,now(),'$meeting_date','$tac','T',
		now(),1,now(),1,
		'$order_no',$doctor_id,'$meeting_time' )";
		$this->dbmgr->query($sql);

		$sql="update tb_doctor_reserve set $dayshorttac=ifnull($dayshorttac,0)+1 
		where doctor_id=$doctor_id and first_day='$meeting_date_mon' ";
		$this->dbmgr->query($sql);

		$this->dbmgr->commit_trans();
		return "RIGHT".$id;
		
	}

	
	public function genOrderNo($prefix){
		
		$d=date('Ym',time());
		$sql="select seq from tb_order_no_gen
		where prefix='$prefix' and datemark='$d' ";
		$query = $this->dbmgr->query($sql);
		$result = $this->dbmgr->fetch_array($query); 
		$seq= $result[0];
		if($seq==""){
			$sql="insert into tb_order_no_gen (prefix,datemark,seq) values ('$prefix','$d',2)";
			$query = $this->dbmgr->query($sql);
			$seq= 1;
		}else{
			$sql="update tb_order_no_gen set seq=seq+1 where prefix='$prefix' and datemark='$d' ";
			$query = $this->dbmgr->query($sql);
		}
		return $prefix.$d.sprintf("%06d", $seq);

	}
 }
 
 $memberMgr=MemberMgr::getInstance();
 $memberMgr->dbmgr=$dbmgr;
 
 
 
 
?>