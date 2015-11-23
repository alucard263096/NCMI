<?php
/*
 * Created on 2011-1-22
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once ROOT."/libs/fileupload.cls.php";
 require_once ROOT."/libs/ftp.cls.php";
 
define('UPLOAD_ROOT',ROOT."/".$CONFIG['fileupload']['upload_path']);
define('FTP_URL',$CONFIG['fileupload']['ftp_url']);
define('FTP_USER',$CONFIG['fileupload']['ftp_user']);
define('UPLOAD_PASSWORD',$CONFIG['fileupload']['ftp_password']);
define('UPLOAD_DIR',$CONFIG['fileupload']['ftp_dir']);
define('UPLOAD_TRY_TIME',$CONFIG['fileupload']['try_time']);
define('UPLOAD_TRY_INTERVAL',$CONFIG['fileupload']['try_interval']);
define('nt_check',$CONFIG['fileupload']['nt_check']);

 class Upload{
 	private $file=null;
 	private $name=null;
 	private $folder=null;
 	function __construct($fi,$rename,$folder,$is_full_path)
 	{
 		$this->file=$fi;
 		if($rename=="")
 		{
 			$this->name=$fi["name"];
 		}
 		else
 		{
 			$this->name=$rename;
 		}
 		
 		if($is_full_path==true)
 		{
 			$this->folder=$folder;
 		}
 		else
 		{
 			$this->folder=UPLOAD_ROOT.$folder."/";
 		}
 		
 		
 	}
 	
	public function getType()
	{
		return $this->file["type"];
	}
	
	public function getSize()
	{
		return $this->file["size"];
	}
	public function getFullName()
	{
		return $this->folder.$this->name;
	}
	
	public function upload()
	{
		global $fileUploadMgr;
		return $fileUploadMgr->upload($this->file,$this->folder,$this->name);
	}
	public function unlink()
	{
		return unlink($this->folder.$this->name);
	}
	
	public function safetyUpload()
	{
		$ret=$this->upload();
		if($ret=="success")
		{
			if(nt_check)
			{
				$f=new FTP(FTP_URL,FTP_USER,UPLOAD_PASSWORD,UPLOAD_DIR);
				if($f->status==1)
				{
					$f->put($this->folder.$this->name,$this->name);
					$i=0;
					$has=false;
					while ($i<UPLOAD_TRY_TIME) {
						
						sleep(UPLOAD_TRY_INTERVAL);
						if( $f->isFile($this->name))
						{
							$has=true;
							//echo $f->unlink($this->name);
						}
						$i++;
					}
					$f->bye();
					if($has)
					{
						return "success";
					}
					else
					{
						return "not saft";
					}
				}
				else
				{
					unlink($this->folder.$this->name);
					return "ftp_unconnect";
				}
			}else {
				return $ret;
			}
			
		}
		else
		{
			return $ret;
		}
	}
	
 }
 
 
 
 
 
 
?>