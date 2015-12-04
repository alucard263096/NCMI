<?php 
require ROOT."/libs/smtp.php";
class mail extends smtp
{ 
    var $sitename="";
	var $from="";


	function sentVerifyEmail($to ,$url){
	$sitename=$this->sitename;
	$from=$this->from;
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

		$this->sendmail($to, $from, $subject , $body , "HTML");
	}

} 
$mailMgr=new mail($siteinfo["emailserver"],  465,false,$siteinfo["emailaccount"],$siteinfo["emailpassword"]);
$mailMgr->sitename=$siteinfo["website_name"];
$mailMgr->from=$siteinfo["email"];

?>