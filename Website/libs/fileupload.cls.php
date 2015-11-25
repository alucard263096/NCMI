<?php
/*
 * Created on 2011-1-22
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class FileUpload
{
	private static $instance = null;
	
	public static function getInstance() 
	{
		return self::$instance!=null ? self::$instance : new FileUpload();
	}
	
	
	public function Upload($file,$path,$name)
	{
		 if ($file["error"] > 0)
	    {
	    	logger_mgr::logError("Return Code: " . $file["error"]);
	    	return "error";
	    }
	  	else
	    {
	    	logger_mgr::logDebug( "Upload: " . $file["name"] );
	    	logger_mgr::logDebug( "Type: " . $file["type"] );
	    	logger_mgr::logDebug( "Size: " . $file["size"] );
	    	logger_mgr::logDebug( "Temp file: " . $file["tmp_name"]);
	
	   		if (file_exists($path . $name))
		    {
		      	logger_mgr::logError($path . $name . " already exists. ");
		      	return "exists";
		    }
		   	else
		    {
		     	 move_uploaded_file($file["tmp_name"],
		      	$path . $name);
		      	logger_mgr::logDebug( "Stored in: " . $path . $name );
		      	return "success";
		    }
		}
	}
	
}

$fileUploadMgr = FileUpload::getInstance();

?>
