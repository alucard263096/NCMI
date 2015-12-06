<?php 
require_once(ROOT."/libs/PHPMailer/class.phpmailer.php");
require_once(ROOT."/libs/PHPMailer/class.smtp.php"); 
class mail 
{ 
    var $sitename="";
	var $from="";
	var $mail;
	function mail($relay_host = "", $smtp_port = 25,$auth = true,$user,$pass) {
	
		$this->mail  = new PHPMailer(); 

		$this->mail->CharSet    ="UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
		$this->mail->IsSMTP();                            // 设定使用SMTP服务
		$this->mail->SMTPAuth   = $auth;                   // 启用 SMTP 验证功能
		$this->mail->SMTPSecure = "ssl";                  // SMTP 安全协议
		$this->mail->Host       = $relay_host;       // SMTP 服务器
		$this->mail->Port       = $smtp_port;                    // SMTP服务器的端口号
		$this->mail->Username   = $user;  // SMTP服务器用户名
		$this->mail->Password   = $pass;        // SMTP服务器密码
		

	}


	function sentVerifyEmail($to ,$url){
	$sitename=$this->sitename;
	$from=$this->from;
	$this->mail->setFrom($from, $sitename);    // 设置发件人地址和名称
	$this->mail->AddReplyTo($from,$sitename); 
													// 设置邮件回复人地址和名称
	




	$subject="$sitename会员注册验证";
	$body="
<p>这封信是由 $sitename 发送的。</p>
<br />
<p>您收到这封邮件，是由于在 $sitename 获取了新用户注册地址使用 了这个邮箱地址。如果您并没有访问过 $sitename，或没有进行上述操作，请忽 略这封邮件。您不需要退订或进行其他进一步的操作。</p>
<br />
<br />
<p>----------------------------------------------------------------------</p>
<p>新用户注册说明</p>
<p>----------------------------------------------------------------------</p>
<br />
<p>如果您是 $sitename 的新用户，或在修改您的注册 Email 时使用了本地址，我们需要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。</p>
<br />
<p>您只需点击下面的链接即可进行用户注册，以下链接有效期为5天。过期可以重新请求发送一封新的邮件验证：</p>
<p><a href='$url'>$url<a/></p>
<p>(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>
<br />
<p>感谢您的访问，祝您使用愉快！</p>
<br />
<p>此致</p>
<p>$sitename 管理团队.</p>";

		$this->mail->Subject    = $subject;                     // 设置邮件标题
		$this->mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
														// 可选项，向下兼容考虑
		$this->mail->MsgHTML($body);                         // 设置邮件内容
		$this->mail->AddAddress($to, $sitename);
			//$mail->AddAttachment("images/phpmailer.gif"); // 附件 
		if(!$this->mail->Send()) {
			logger_mgr::logError("MAIL :sent $to fail, ".$this->mail->ErrorInfo);
		} else {
			logger_mgr::logDebug("MAIL :sent $to");
		}
	}

} 
$mailMgr=new mail($siteinfo["emailserver"],  465,false,$siteinfo["emailaccount"],$siteinfo["emailpassword"]);

$mailMgr->sitename=$siteinfo["website_name"];
$mailMgr->from=$siteinfo["email"];

?>