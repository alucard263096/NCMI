<?php 
class smtp 
{ 
    /* Public Variables */ 
    var $smtp_port; 
    var $time_out; 
    var $host_name; 
    var $log_file; 
    var $relay_host; 
    var $debug; 
    var $auth; 
    var $user; 
    var $pass; 

    /* Private Variables */  
    var $sock; 

    /* Constractor */ 
    function smtp($relay_host = "", $smtp_port = 25,$auth = false,$user,$pass) 
    { 
        $this->debug = FALSE; 
        $this->smtp_port = $smtp_port; 
        $this->relay_host = $relay_host; 
        $this->time_out = 30; //is used in fsockopen()  
        $this->auth = $auth;//auth 
        $this->user = $user; 
        $this->pass = $pass; 
        $this->host_name = "localhost"; //is used in HELO command  
        $this->log_file = ""; 
        $this->sock = FALSE; 
} 

    /* Main Function */ 
    function sendmail($to, $from, $subject = "", $body = "", $mailtype, $cc = "", $bcc = "", $additional_headers = "") 
    { 
        $mail_from = $this->get_address($this->strip_comment($from)); 
        $body = ereg_replace("(^|(\r\n))(\.)", "\1.\3", $body); 
        $header .= "MIME-Version:1.0\r\n"; 
        if($mailtype=="HTML") 
        { 
            $header .= "Content-Type:text/html\r\n"; 
        } 
        $header .= "To: ".$to."\r\n"; 
        if ($cc != "")  
        { 
            $header .= "Cc: ".$cc."\r\n"; 
        } 
        $header .= "From: $from<".$from.">\r\n"; 
        $header .= "Subject: ".$subject."\r\n"; 
        $header .= $additional_headers; 
        $header .= "Date: ".date("r")."\r\n"; 
        $header .= "X-Mailer:By Redhat (PHP/".phpversion().")\r\n"; 
        list($msec, $sec) = explode(" ", microtime()); 
        $header .= "Message-ID: <".date("YmdHis", $sec).".".($msec*1000000).".".$mail_from.">\r\n"; 
        $TO = explode(",", $this->strip_comment($to)); 

        if ($cc != "")  
        { 
            $TO = array_merge($TO, explode(",", $this->strip_comment($cc))); 
            } 
        if ($bcc != "")  
        { 
            $TO = array_merge($TO, explode(",", $this->strip_comment($bcc))); 
        } 
        $sent = TRUE; 
        foreach ($TO as $rcpt_to)  
        { 
            $rcpt_to = $this->get_address($rcpt_to); 
            if (!$this->smtp_sockopen($rcpt_to))  
            { 
                $this->log_write("Error: Cannot send email to ".$rcpt_to."\n"); 
                $sent = FALSE; 
                continue; 
            } 
            if ($this->smtp_send($this->host_name, $mail_from, $rcpt_to, $header, $body))  
            { 
                $this->log_write("E-mail has been sent to <".$rcpt_to.">\n"); 
            }  
            else  
            { 
                $this->log_write("Error: Cannot send email to <".$rcpt_to.">\n"); 
                $sent = FALSE; 
            } 
            fclose($this->sock); 
            $this->log_write("Disconnected from remote host\n"); 
        } 
        return $sent; 
    } 

    /* Private Functions */ 
    function smtp_send($helo, $from, $to, $header, $body = "") 
    { 
        if (!$this->smtp_putcmd("HELO", $helo))  
        { 
            return $this->smtp_error("sending HELO command"); 
        } 

        #auth 
        if($this->auth) 
        { 
            if (!$this->smtp_putcmd("AUTH LOGIN", base64_encode($this->user)))  
            { 
                return $this->smtp_error("sending HELO command"); 
            } 
            if (!$this->smtp_putcmd("", base64_encode($this->pass)))  
            { 
                return $this->smtp_error("sending HELO command"); 
            } 
        } 
        if (!$this->smtp_putcmd("MAIL", "FROM:<".$from.">"))  
        { 
            return $this->smtp_error("sending MAIL FROM command"); 
        } 
        if (!$this->smtp_putcmd("RCPT", "TO:<".$to.">"))  
        { 
            return $this->smtp_error("sending RCPT TO command"); 
        } 
        if (!$this->smtp_putcmd("DATA")) 
        { 
            return $this->smtp_error("sending DATA command"); 
        } 
        if (!$this->smtp_message($header, $body))  
        { 
            return $this->smtp_error("sending message"); 
        } 
        if (!$this->smtp_eom()) 
        { 
            return $this->smtp_error("sending <CR><LF>.<CR><LF> [EOM]"); 
        } 
        if (!$this->smtp_putcmd("QUIT"))  
        { 
            return $this->smtp_error("sending QUIT command"); 
        } 
        return TRUE; 
    } 

    function smtp_sockopen($address) 
    { 
        if ($this->relay_host == "")  
        { 
            return $this->smtp_sockopen_mx($address); 
        }  
        else 
        { 
            return $this->smtp_sockopen_relay(); 
        } 
    } 

    function smtp_sockopen_relay() 
    { 
        $this->log_write("Trying to ".$this->relay_host.":".$this->smtp_port."\n"); 
        $this->sock = @fsockopen($this->relay_host, $this->smtp_port, $errno, $errstr, $this->time_out); 
        if (!($this->sock && $this->smtp_ok()))  
        { 
            $this->log_write("Error: Cannot connenct to relay host ".$this->relay_host."\n"); 
            $this->log_write("Error: ".$errstr." (".$errno.")\n"); 
            return FALSE; 
        } 
        $this->log_write("Connected to relay host ".$this->relay_host."\n"); 
        return TRUE;; 
    } 

    function smtp_sockopen_mx($address) 
    { 
        $domain = ereg_replace("^.+@([^@]+)$", "\1", $address); 
        if (!@getmxrr($domain, $MXHOSTS))  
        { 
            $this->log_write("Error: Cannot resolve MX \"".$domain."\"\n"); 
            return FALSE; 
        } 
        foreach ($MXHOSTS as $host)  
        { 
            $this->log_write("Trying to ".$host.":".$this->smtp_port."\n"); 
            $this->sock = @fsockopen($host, $this->smtp_port, $errno, $errstr, $this->time_out); 
            if (!($this->sock && $this->smtp_ok()))  
            { 
                $this->log_write("Warning: Cannot connect to mx host ".$host."\n"); 
                $this->log_write("Error: ".$errstr." (".$errno.")\n"); 
                continue; 
            } 
            $this->log_write("Connected to mx host ".$host."\n"); 
            return TRUE; 
        } 
        $this->log_write("Error: Cannot connect to any mx hosts (".implode(", ", $MXHOSTS).")\n"); 
        return FALSE; 
    } 

    function smtp_message($header, $body) 
    { 
        fputs($this->sock, $header."\r\n".$body); 
        $this->smtp_debug("> ".str_replace("\r\n", "\n"."> ", $header."\n> ".$body."\n> ")); 
        return TRUE; 
    } 

    function smtp_eom() 
    { 
        fputs($this->sock, "\r\n.\r\n"); 
        $this->smtp_debug(". [EOM]\n"); 
        return $this->smtp_ok(); 
    } 

    function smtp_ok() 
    { $fuck=fgets($this->sock, 512);
        $response = str_replace("\r\n", "", $fuck); 
        $this->smtp_debug($response."\n"); 
        if (!ereg("^[23]", $response))  
        { 
            fputs($this->sock, "QUIT\r\n"); 
            fgets($this->sock, 512); 
            $this->log_write("Error: Remote host returned \"".$response."\"\n"); 
            return FALSE; 
        } 
        return TRUE; 
    } 

    function smtp_putcmd($cmd, $arg = "") 
    { 
        if ($arg != "")  
        { 
            if($cmd=="")  
            { 
                $cmd = $arg; 
            } 
            else 
            { 
                $cmd = $cmd." ".$arg; 
            } 
        } 
        fputs($this->sock, $cmd."\r\n"); 
        $this->smtp_debug("> ".$cmd."\n"); 
        return $this->smtp_ok(); 
    } 

    function smtp_error($string) 
    { 
        $this->log_write("Error: Error occurred while ".$string.".\n"); 
        return FALSE; 
    } 

    function log_write($message) 
    { 
        logger_mgr::logError("[MAIL]:$message");
        return TRUE; 
    } 

    function strip_comment($address) 
    { 
        $comment = "\([^()]*\)"; 
        while (ereg($comment, $address))  
        { 
            $address = ereg_replace($comment, "", $address); 
        } 
        return $address; 
    } 

    function get_address($address) 
    { 
        $address = ereg_replace("([ \t\r\n])+", "", $address); 
        $address = ereg_replace('^.*<(.+)>.*$', '\1', $address); 
        return $address; 
    } 

    function smtp_debug($message) 
    { 
        if ($this->debug)  
        { 
            echo $message; 
        } 
    } 

	function sentVerifyEmail(){
	$content="论坛注册地址

这封信是由 AnyChat技术支持论坛 发送的。

您收到这封邮件，是由于在 AnyChat技术支持论坛 获取了新用户注册地址使用 了这个邮箱地址。如果您并没有访问过 AnyChat技术支持论坛，或没有进行上述操作，请忽 略这封邮件。您不需要退订或进行其他进一步的操作。


----------------------------------------------------------------------
新用户注册说明
----------------------------------------------------------------------

如果您是 AnyChat技术支持论坛 的新用户，或在修改您的注册 Email 时使用了本地址，我们需 要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。

您只需点击下面的链接即可进行用户注册，以下链接有效期为3天。过期可以重新请求发送一封新的邮件验证：
http://bbs.anychat.cn/member.php?mod=register&hash=e4f1yjNUR6NBrtPwXvYMPyVOGQRYMDxHDJt7YxSTFVESIzy%2F%2BnZ%2Fu9OxDbnb5mD%2FJB%2FWaFAQSq7Z7hFarg&email=alucard263096@126.com 
(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)

感谢您的访问，祝您使用愉快！

此致
AnyChat技术支持论坛 管理团队.";
	}

} 
$smtpMgr=new smtp($siteinfo["emailserver"],  25,false,$siteinfo["emailaccount"],$siteinfo["emailpassword"]);


?>