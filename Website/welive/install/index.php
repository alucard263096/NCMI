<?php
error_reporting(E_ALL & ~E_NOTICE);
include('version.php');

$rootpath = '../';


// ############################## FUNCTIONS ##############################

function IsName($name){
	$entities_match		= array(',',';','$','!','@','#','%','^','&','*','_','(',')','+','{','}','|',':','"','<','>','?','[',']','\\',"'",'.','/','*','+','~','`','=');
	for ($i = 0; $i<count($entities_match); $i++) {
	     if(strpos($name, $entities_match[$i])){
               return false;
		 }
	}
   return true;
}

function IsPass($pass){
	return preg_match("/^[[:alnum:]]+$/i", $pass);
}

function PassGen($length = 8){
	$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0, $passwd = ''; $i < $length; $i++)
		$passwd .= substr($str, mt_rand(0, strlen($str) - 1), 1);
	return $passwd;
}

function DB_Query($sql){
	global $footer;

	$result = MYSQL_QUERY ($sql);
	if(!$result){
		$message  = "数据库访问错误\r\n\r\n";
		$message .= $sql . " \r\n";
		$message .= "错误内容: ". mysql_error() ." \r\n";
		$message .= "错误代码: " . mysql_errno() . " \r\n";
		$message .= "时间: ".gmdate('Y-m-d H:i:s', time() + (3600 * 8)). "\r\n";
		$message .= "文件: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		echo '<center><font class=ohredb><b>数据库访问错误!</b></font><br /><p><textarea rows="28" style="width:460px;">'.htmlspecialchars($message).'</textarea></p>
		<input type="button" name="back" value=" 返&nbsp;回 " onclick="history.back();return false;" />		
		</center><BR>';
		echo $footer;
		exit();
	}else{
		return true;
	}
}

// ############################## HEADER AND FOOTER ############################

echo '<html>
<head>
<title>WeLive在线客服系统 - 安装向导</title>
<link rel="stylesheet" href="./styles.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<table width="480" cellpadding="0" cellspacing="1" border="0" align="center" class="box">
<tr>
<td class="title">WeLive在线客服系统'.$WeLiveVersion.' - 安装向导</td>
</tr>
<tr>
<td valign="top" style="padding: 5px;">';

$footer = '</td></tr></table></body></html>';

// ################# CHECK IF ALREADY INSTALLED ##################

@include($rootpath . 'config/config.php');

if(defined('WELIVE')){
	echo '<font class=ohredb><b>WeLive在线客服系统已经安装!</b></font><BR><BR>
	如果您希望重新安装，请先删除config/目录下的config.php文件。<BR><BR>';

	echo $footer;
	exit();
}

// ############################### GET POST VARS ###############################

$servername      = isset($_POST['install']) ? trim($_POST['servername'])      : 'localhost';
$dbname          = isset($_POST['install']) ? trim($_POST['dbname'])          : '';
$dbusername      = isset($_POST['install']) ? trim($_POST['dbusername'])      : '';
$dbpassword      = isset($_POST['install']) ? trim($_POST['dbpassword'])      : '';
$tableprefix     = isset($_POST['install']) ? trim($_POST['tableprefix'])     : 'welive_';
$confirmprefix     = isset($_POST['install']) ? trim($_POST['confirmprefix'])     : '';

$username        = isset($_POST['install']) ? trim($_POST['username'])        : '';
$password        = isset($_POST['install']) ? trim($_POST['password'])        : '';
$confirmpassword = isset($_POST['install'])? trim($_POST['confirmpassword']) : '';

$tableprefix_err = 0;

// ############################ INSTALL #############################

if(isset($_POST['install'])){
	// check for errors
	@chmod('../config/', 0777);
	@chmod('../cache/', 0777);

	if (!is_writable('../cache/'))
		$installerrors[] = '请将cache文件夹的属性设置为: 777';

	if (!is_writable('../config/'))
		$installerrors[] = '请将config文件夹的属性设置为: 777';

	if(!is_writeable('../config/settings.php')) {
		$installerrors[] = '请将系统配置文件config/settings.php设置为可写, 即属性设置为: 777';
	}

	if(strlen($username) == 0){
		$installerrors[] = '请输入系统管理用户名.';
	}else if(!IsName($username)){
		$installerrors[] = '用户名中含有非法字符.';
	}

	if(strlen($password) == 0){
		$installerrors[] = '请输入系统管理密码.';
	}else if(!IsPass($password)){
		$installerrors[] = '密码中含有非法字符.';
	}

	if($password != $confirmpassword)
		$installerrors[] = '管理密码与确认密码不匹配.';

	if(strlen($tableprefix) == 0){
		$installerrors[] = '请输入数据库表前缀.';
	}else if(!preg_match('/^[A-Za-z0-9]+_$/', $tableprefix)){
		$installerrors[] = '数据库表前缀只能是英文字母或数字, 而且必需以 _ 结尾.';
	}


	// Determine if MySql is installed
	if(function_exists('mysql_connect')){
		// attempt to connect to the database
		if($connection = @MYSQL_CONNECT($servername, $dbusername, $dbpassword)){

			$sqlversion = @mysql_get_server_info();
			if(empty($sqlversion)) $sqlversion='5.0';

			if($sqlversion >= '4.1'){
				mysql_query("set names 'utf8'");
				mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
				mysql_query("ALTER DATABASE $dbname DEFAULT CHARACTER SET utf8 COLLATE 'utf8_general_ci'");           
			}

			if($sqlversion >= '5.0'){
				mysql_query("SET sql_mode=''");
			}

			// connected, now lets select the database
			if($dbname){
				if(!@MYSQL_SELECT_DB($dbname, $connection)){
					// The database does not exist... try to create it:
					if(!@DB_Query("CREATE DATABASE $dbname")){
						$installerrors[] = '创建数据库 "' . $dbname . '" 失败! 您的用户名可能没有创建数据库的权限.<br />' . mysql_error();
					}else{
						if($sqlversion >= '4.1'){
							mysql_query("set names 'utf8'");
							mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
							mysql_query("ALTER DATABASE $dbname DEFAULT CHARACTER SET utf8 COLLATE 'utf8_general_ci'");           
						}

						if($sqlversion >= '5.0'){
							mysql_query("SET sql_mode=''");
						}
						// Success! Database created
						MYSQL_SELECT_DB($dbname, $connection);
					}
				}
			}else{
				$installerrors[] = '请输入数据库名称.';
			}
		}else{
			// could not connect
			$installerrors[] = '无法连接MySql数据库服务器, 信息:<br />' . mysql_error();
		}
	}else{
		// mysql extensions not installed
		$installerrors[] = '网站服务器环境不支持MySql数据库.';
	}

	if(!isset($installerrors)){
		$SqlLines = @file('WeLive.sql');
		if (!$SqlLines) {
			$installerrors[] = '无法加载数据文件: install/WeLive.sql';
		} else {
			if(!$confirmprefix) {
				if($query = mysql_query("SHOW TABLES FROM $dbname")) {
					while($row = mysql_fetch_row($query)) {
						if(preg_match("/^$tableprefix/", $row[0])) {
							$tableprefix_err = 1;
							break;
						}
					}
				}
			}

			if(!$tableprefix_err){
				$sql = implode('', $SqlLines);

				/* 删除SQL行注释，行注释不匹配换行符 */
				$sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);

				/* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
				$sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);

				/* 删除SQL串首尾的空白符 */
				$sql = trim($sql);

				/* 替换表前缀 */
				$sql = preg_replace('/((TABLE|INTO|IF EXISTS) )welive_/', '${1}' . $tableprefix, $sql);

				/* 解析查询项 */
				$sql = str_replace("\r", '', $sql);
				$query_items = explode(";\n", $sql);

				foreach ($query_items AS $query_item){
					/* 如果查询项为空，则跳过 */
					if (!$query_item){
						continue;
					}else{
						DB_Query($query_item);
					}
				}

				DB_Query ("INSERT INTO " . $tableprefix . "user VALUES (NULL, 1, 0, '$username', 1, '".md5($password)."', 1, 0, '系统管理员', 'Administrator', '', '', '', '', '".time()."') ");
				DB_Query ("INSERT INTO " . $tableprefix . "user VALUES (NULL, 2, 1, 'mszhang', 1, '".md5($password)."', 1, 0, '张小娟', 'Ms.Zhang', '姓名: 张小娟', 'Name: Ms. Zhang', '广告', 'Adv.', 0) ");
				DB_Query ("INSERT INTO " . $tableprefix . "user VALUES (NULL, 2, 2, 'msli', 1, '".md5($password)."', 1, 0, '李晴晴', 'Ms.Li', '姓名: 李晴晴', 'Name: Ms. Li', '广告', 'Adv.', 0) ");
				DB_Query ("INSERT INTO " . $tableprefix . "user VALUES (NULL, 3, 3, 'mrzhao', 1, '".md5($password)."', 1, 0, '赵利铭', 'Mr.Zhao', '姓名: 赵利铭', 'Name: Mr. Zhao', '广告', 'Adv.', 0) ");
				DB_Query ("INSERT INTO " . $tableprefix . "user VALUES (NULL, 3, 4, 'mrwang', 1, '".md5($password)."', 1, 0, '王  炯', 'Mr.Wang', '姓名: 王  炯', 'Name: Mr. Wang', '广告', 'Adv.', 0) ");

				$filename = $rootpath . "config/settings.php";
				$fp = @fopen($filename, 'rb');
				$contents = @fread($fp, filesize($filename));
				@fclose($fp);
				$contents =  trim($contents);
				$contents = preg_replace("/[$]_CFG\['cAppVersion'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['cAppVersion'] = '$WeLiveVersion';", $contents);
				$contents = preg_replace("/[$]_CFG\['cKillRobotCode'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['cKillRobotCode'] = '".md5(microtime())."';", $contents);

				$fp = @fopen($filename, 'w');
				@fwrite($fp, $contents);
				@fclose($fp);

				// write config file last off in case installation fails
				$configfile="<?php

\$servername  = '$servername';
\$dbname      = '$dbname';
\$dbusername  = '$dbusername';
\$dbpassword  = '$dbpassword';

define('WELIVE', true);
define('TABLE_PREFIX', '".$tableprefix."');
define('COOKIE_KEY', '".PassGen(12)."');
define('WEBSITE_KEY', '".PassGen(12)."');
define('BASEPATH', dirname(dirname(__FILE__)).'/');

?>";

				// write the config file
				$filenum = fopen ($rootpath . "config/config.php","w");
				ftruncate($filenum, 0);
				fwrite($filenum, $configfile);
				fclose($filenum);

				echo '<font class=ohblueb>恭喜: 您的WeLive在线客服系统 安装成功!</font><br /><br />请在删除WeLive安装目录(./install/)后继续!
					<br /><br />
					1).&nbsp;<a href="' . $rootpath . 'demo.html" target="_blank"><b>浏览客服小面板演示页面!</b></a>
					<br /><br />
					2).&nbsp;<a href="' . $rootpath . 'index.php" target="_blank"><b>点击这里进入管理面板!</b></a><br /><br />';
			}
		}
	}
}


// ############################### INSTALL FORM ################################

if(!isset($_POST['install']) OR isset($installerrors) OR $tableprefix_err){
	if(isset($installerrors)){
		echo '<table width="97%" border="0" cellpadding="5" cellspacing="0" align="center">
		<tr>
		<td style="border: 1px solid #FF0000; font-size: 12px;" bgcolor="#FFE1E1">
		<u><b>安装错误!</b></u><br /><br />
		安装过程中发现以下错误:<br />';

		for($i = 0; $i < count($installerrors); $i++){
			echo '<b>' . ($i + 1) . ') ' . $installerrors[$i] . '</b><br />';
		}
		echo '</td></tr></table><br />';
	}

	echo '<table width="96%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
	<td valign="top" align="right"><u>WeLive ' .$WeLiveVersion. ' 简体中文版(UTF-8)</u></td>
	</tr>  
	</table>
	<br />
	<b>1) 填写WeLive数据库连接信息:</b><br /><br />
	<form method="post" action="index.php" name="installform">
	<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center" class="maintable">
	<tr>
	<td valign="middle">数据库服务器地址:</td>
	<td valign="middle" align="right"><input type="text" name="servername" value="' . $servername . '" /></td>
	</tr>
	<tr>
	<td valign="middle">数据库名:</td>
	<td valign="middle" align="right"><input type="text" name="dbname" value="' . $dbname . '" /></td>
	</tr>
	<tr>
	<td valign="middle">数据库用户名:</td>
	<td valign="middle" align="right"><input type="text" name="dbusername" value="' . $dbusername . '" /></td>
	</tr>
	<tr>
	<td valign="middle">数据库密码:</td>
	<td valign="middle" align="right"><input type="text" name="dbpassword" value="' . $dbpassword . '" /></td>
	</tr>
	<tr>
	<td valign="middle">数据库表前缀:</td>
	<td valign="middle" align="right"><input type="text" name="tableprefix" value="' . $tableprefix . '" /></td>
	</tr>';

	if($tableprefix_err OR $confirmprefix){
		echo '<tr>
		<td valign="middle"><font class=ohredb><B>强制安装:</B><BR>当前数据库当中已经含有相同表前缀的数据表, 您可以重填"表前缀"来避免删除旧的数据, 或者选择强制安装。强制安装将删除原有相同表前缀的数据库表, 且无法恢复!</font></td>
		<td valign="middle"><input type="checkbox" name="confirmprefix" value="1"' . ($confirmprefix ? ' checked="checked"' : ''). ' /> 删除数据, 强制安装 !!!</td>
		</tr>';
	}

	echo '</table>
	<br /><br />
	<b>2) 创建WeLive系统管理帐号:</b><br /><br />
	<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center" class="maintable">
	<tr>
	<td valign="middle">用户名:</td>
	<td valign="middle" align="right"><input type="text" name="username" value="' . $username . '" /></td>
	</tr>
	<tr>
	<td valign="middle">密码:</td>
	<td valign="middle" align="right"><input type="text" name="password" value="' . $password . '" /></td>
	</tr>
	<tr>
	<td valign="middle">确认密码:</td>
	<td valign="middle" align="right"><input type="text" name="confirmpassword" value="' . $confirmpassword . '" /></td>
	</tr>
	<tr>
	</table>
	<br /><br /><center><input type="submit" name="install" value="安装 WeLive" /></center>
	</form><script type="text/JavaScript">document.getElementById("installform").dbname.focus();</script>';
}

// ############################### PRINT FOOTER ################################

echo $footer;

?>