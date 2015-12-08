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
 }
 
 $memberMgr=MemberMgr::getInstance();
 $memberMgr->dbmgr=$dbmgr;
 
 
 
 
?>