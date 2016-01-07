<?php

#[Root]
$CONFIG['rootpath']		= '/NCMI';  
//$CONFIG['charset']		= 'utf-8'; 
$CONFIG['URL']="http://www.myhkdoc.com/NCMI";
$CONFIG["SessionName"]="NCMI";

$CONFIG['smarty']['rootpath']		= '/NCMI'; 
$CONFIG['solution_configuration']='release';
$CONFIG['server']		= 'windows';   //windows or linux

#[Smarty config]
$CONFIG['smarty']['compile_check']=true; 
$CONFIG['smarty']['debugging']=false; 
$CONFIG['smarty']['caching']=false; 
$CONFIG['smarty']['cache_lifetime']=3600; //second,-1 is always on 


#[log]
$CONFIG['logsavedir'] 		= 'logs/';	
$CONFIG['error_handler'] ="E_ALL";




#[Database]
$CONFIG['database']['provider']	= 'mysql';  //mssql,sqlsrv
$CONFIG['database']['host']		= '120.24.239.49';  
$CONFIG['database']['database']	= 'NCMI151123';  
$CONFIG['database']['user']		= 'root';  
$CONFIG['database']['psw']		= 'root'; 


#[File upload]
$CONFIG['fileupload']['upload_path']	= "upload";
$CONFIG['fileupload']['nt_check']		= false;
$CONFIG['fileupload']['ftp_url']		= "127.0.0.1";
$CONFIG['fileupload']['ftp_user']		= "anonymous";
$CONFIG['fileupload']['ftp_password']		= "";
$CONFIG['fileupload']['ftp_dir']		= "/";
$CONFIG['fileupload']['try_time']		= "3";
$CONFIG['fileupload']['try_interval']		= "1";//second


#[Excel]
$CONFIG['excel']['version']	= "Excel2007";//2003:Excel5,2007:Excel2007



#[Gensee]
$CONFIG["gensee"]["site"]="jwyk.gensee.com";  
$CONFIG["gensee"]["loginName"]="admin@jwyk.com";
$CONFIG["gensee"]["password"]="mfg-19780425";
$CONFIG["gensee"]["organizerPwd"]="888888";



#[SMS]
$CONFIG["sms"]["AccountSid"]="aaf98f894bfd8efd014c0c06c970099e";
$CONFIG["sms"]["AccountToken"]="cdcb39a689d242f2af537b5ea4a86f61";
$CONFIG["sms"]["AppId"]="8a48b5514fa577af014fa675e7840459";
$CONFIG["sms"]["ServerIP"]="sandboxapp.cloopen.com";
$CONFIG["sms"]["ServerPort"]="8883";
$CONFIG["sms"]["SoftVersion"]="2013-12-26";
$CONFIG["sms"]["templeteid"]["bookingsuccess"]="35125";

#[ALIPAY]
$CONFIG["alipay"]["partner"]="2088911304846017";
$CONFIG["alipay"]["seller_email"]="jwyk301@126.com";
$CONFIG["alipay"]["key"]="cha5gtfcloiij38bu7kukx1kjmpfh0a3";
$CONFIG["alipay"]["notify_url"]=$CONFIG['URL']."/Order/notify.php";;
$CONFIG["alipay"]["call_back_url"]=$CONFIG['URL']."/Order/success.php";

?>