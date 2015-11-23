<?php
// --------------------------------------------------------------------------
// File name   :Ftp.class.php
// Description : FTP上传类
// Requirement : PHP5 (http://www.php.net)
// Copyright(C), gamezero.cn, 2008, All Rights Reserved.
// Author: Jipeng (jipeng001@hotmail.com)
// --------------------------------------------------------------------------
//R FTP 处理;
class FTP {
	var $ftpUrl = '127.0.0.1';
	var $ftpUser = '';
	var $ftpPass = '';
	var $ftpDir = '';
	var $ftpR = '/'; //R ftp资源;
	var $status = '';
	//R 1:成功;2:无法连接ftp;3:用户错误;
	function FTP($ftpUrl="", $ftpUser="", $ftpPass="", $ftpDir="") {
	if($ftpUrl){
	$this->ftpUrl=$ftpUrl;
	}
	if($ftpUser){
	$this->ftpUser=$ftpUser;
	}
	if($ftpPass){
	$this->ftpPass=$ftpPass;
	}
	if($ftpUrl){
	$this->ftpDir=$ftpDir;
	}
	   if ($this->ftpR = ftp_connect($this->ftpUrl, 21)) {
	     if (ftp_login($this->ftpR, $this->ftpUser, $this->ftpPass)) {
	     if (!empty($this->ftpDir)) {
	       ftp_chdir($this->ftpR, $this->ftpDir);
	     }
	     ftp_pasv($this->ftpR, true);//R 启用被动模式;
	     $this->status = 1;
	     } else {
	     $this->status = 3;
	     }
	   } else {
	     $this->status = 2;
	   }
	}
	//R 切换目录;
	function cd($dir) {
	   return ftp_chdir($this->ftpR, $dir);
	}
	//R 返回当前路劲;
	function pwd() {
	   return ftp_pwd($this->ftpR);
	}
	//R 创建目录
	function mkdir($directory) {
	   return ftp_mkdir($this->ftpR,$directory);
	}
	//R 删除目录
	function rmdir($directory) {
	   return ftp_rmdir($this->ftpR,$directory);
	}
	//R 上传文件;
	function put($localFile, $remoteFile = '') {
	   if ($remoteFile == '') {
	     $remoteFile = end(explode('/', $localFile));
	   }
	   $res = ftp_nb_put($this->ftpR, $remoteFile, $localFile, FTP_BINARY);
	   while ($res == FTP_MOREDATA) {
	     $res = ftp_nb_continue($this->ftpR);
	   }
	   if ($res == FTP_FINISHED) {
	     return true;
	   } elseif ($res == FTP_FAILED) {
	     return false;
	   }
	}
	//R 下载文件;
	function get($remoteFile, $localFile = '') {
	   if ($localFile == '') {
	     $localFile = end(explode('/', $remoteFile));
	   }
	   if (ftp_get($this->ftpR, $localFile, $remoteFile, FTP_BINARY)) {
	     $flag = true;
	   } else {
	     $flag = false;
	   }
	   return $flag;
	}
	//R 文件大小;
	function size($file) {
	   return ftp_size($this->ftpR, $file);
	}
	//R 文件是否存在;
	function isFile($file) {
	   if ($this->size($file) >= 0) {
	     return true;
	   } else {
	     return false;
	   }
	}
	//R 文件时间
	function fileTime($file) {
	   return ftp_mdtm($this->ftpR, $file);
	}
	//R 删除文件;
	function unlink($file) {
	   return ftp_delete($this->ftpR, $file);
	}
	function nlist($dir = '/service/resource/') {
	   return ftp_nlist($this->ftpR, $dir);
	}
	//R 关闭连接;
	function bye() {
	   return ftp_close($this->ftpR);
	}
}
/*
$f=new FTP("127.0.0.1","anonymous","","/");
echo $f->status;
$f->put("F://a.xlsx","a.xlsx");
if( $f->isFile("a.xlsx"))
{
	echo $f->unlink("a.xlsx");
}
$f->bye();
*/
?>