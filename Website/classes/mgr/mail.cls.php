<?php 
require ROOT."/libs/smtp.php";
class mail extends smtp
{ 
    var $sitename="";
	var $from="";


	function sentVerifyEmail($to ,$url){
	$sitename=$this->sitename;
	$from=$this->from;
	$subject="$sitename��Աע����֤";
	$body="
<p>��������� $sitename ���͵ġ�</p>
<br />
<p>���յ�����ʼ����������� $sitename ��ȡ�����û�ע���ַʹ�� ����������ַ���������û�з��ʹ� $sitename����û�н���������������� ������ʼ���������Ҫ�˶������������һ���Ĳ�����</p>
<br />
<br />
<p>----------------------------------------------------------------------</p>
<p>���û�ע��˵��</p>
<p>----------------------------------------------------------------------</p>
<br />
<p>������� $sitename �����û��������޸�����ע�� Email ʱʹ���˱���ַ��������Ҫ�����ĵ�ַ��Ч�Խ�����֤�Ա��������ʼ����ַ�����á�</p>
<br />
<p>��ֻ������������Ӽ��ɽ����û�ע�ᣬ����������Ч��Ϊ5�졣���ڿ�������������һ���µ��ʼ���֤��</p>
<p><a href='$url'>$url<a/></p>
<p>(������治��������ʽ���뽫�õ�ַ�ֹ�ճ�����������ַ���ٷ���)</p>
<br />
<p>��л���ķ��ʣ�ף��ʹ����죡</p>
<br />
<p>����</p>
<p>$sitename �����Ŷ�.</p>";

		$this->sendmail($to, $from, $subject , $body , "HTML");
	}

} 
$mailMgr=new mail($siteinfo["emailserver"],  465,false,$siteinfo["emailaccount"],$siteinfo["emailpassword"]);
$mailMgr->sitename=$siteinfo["website_name"];
$mailMgr->from=$siteinfo["email"];

?>