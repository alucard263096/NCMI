<?php
 require 'include/common.inc.php';
 require ROOT.'/classes/obj/upload.php';
 $field=$_REQUEST["field"];
 $module=$_REQUEST["module"];
 if($module==""){
 $module="default";
 $field="upload";
 }
 $file=$_FILES[$field];
 if($file==""){
	echo "Fils is empty";
	exit;
 }
 $orifilename=$file["name"];
 $filearr=explode(".",$file["name"]);
 $fileext=$filearr[count($filearr)-1];
 $filename=md5(date('ymdHIs').$file["name"]).".".$fileext;
 $folder=ROOT."/".$CONFIG['fileupload']['upload_path']."/$module/";
 if(!file_exists($folder)){
	mkdir($folder,0777);
 }
 $file=new Upload($file,$filename,$folder,true);
 echo $file->safetyUpload();
 echo "|~~|".$filename."|~~|".$orifilename;



?>