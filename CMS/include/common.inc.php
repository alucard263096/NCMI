<?php
/*
 * Created on 2010-5-6
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//set include path and config


define('ROOT', str_replace("\\", '/', substr(dirname(__FILE__), 0, -8)));	// -9 = 0-strlen('includes')-1;
require ROOT.'/config/config.inc.php';
define('PEAR_HOME',ROOT."/libs/PEAR/");
define('SESSIONNAME',$CONFIG["SessionName"]);


//~ set php global variable to NULL, for security
unset($HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);



//~ session start
session_start();


//log start
require ROOT.'/classes/mgr/logger_mgr.cls.php';
define('LOGGER_INFO_FILE', ROOT."/".$CONFIG['logsavedir'] . "info/log_%y%m%d.txt");
define('LOGGER_ERROR_FILE', ROOT."/".$CONFIG['logsavedir'] . "error/log_%y%m%d.txt");
define('LOGGER_DEBUG_FILE', ROOT."/".$CONFIG['logsavedir'] . "debug/log_%y%m%d.txt");
define('LOGGER_IS_DEBUG', $CONFIG['solution_configuration']=="debug"?true:false);
set_error_handler('error_handler');//,$CONFIG['error_handler']

//image upload cofig
//define('MUILTI_FILE_UPLOAD','10');// define max upload file
define('MAX_SIZE_FILE_UPLOAD','2000000');//define max file size
define('ACTIVITY_IMAGE_UPLOAD_DIR','/images/activity/');//define upload path
define('HOTEL_IMAGE_UPLOAD_DIR','/images/hotel/');//define upload path
define('VENUE_IMAGE_UPLOAD_DIR','/images/venue/');//define upload path
define('HOUSE_MAINTAINCE_UPLOAD_DIR','/images/house/');//define upload path
$image_extention_arr=array('jpg','png','gif');

  
function error_handler($errno,$errmsg,$file,$line,$vars)
{
$errortype=array(1=>"Error",2=>"Warning",4=>"Parsing Error",8=>"Notice",
		16=>"Core Error",32=>"Core Warning",
		64=>"Compile Error",128=>"Compile Warning",
		256=>"User Error",512=>"User Warning",
		1024=>"User Notice",2048=>"Strict Notice");
		if($errno==4||$errno==2)
		{
			//logger_mgr::logInfo("[".$errortype[$errno]."]".$errmsg ."in file ".$file ." line ".$line);
		}
}



require ROOT.'/classes/mgr/common_function.php';

include ROOT.'/classes/mgr/'.$CONFIG['database']['provider'].'.cls.php';

include ROOT.'/classes/mgr/smarty.cls.php';

include ROOT.'/classes/modelmgr/XmlModel.cls.php';

include ROOT.'/include/lang.inc.php';



?>