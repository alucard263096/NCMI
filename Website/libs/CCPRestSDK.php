<?php
/*
 *  Copyright (c) 2014 The CCP project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a Beijing Speedtong Information Technology Co.,Ltd license
 *  that can be found in the LICENSE file in the root of the web site.
 *
 *   http://www.yuntongxun.com
 *
 *  An additional intellectual property rights grant can be found
 *  in the file PATENTS.  All contributing project authors may
 *  be found in the AUTHORS file in the root of the source tree.
 */


class REST {
	private $AccountSid;
	private $AccountToken;
	private $AppId;
	private $SubAccountSid;
	private $SubAccountToken;
	private $VoIPAccount;
	private $VoIPPassword;  
	private $ServerIP;
	private $ServerPort;
	private $SoftVersion;
	private $Batch;  //时间戳
	private $BodyType = "xml";//包体格式，可填值：json 、xml
	private $enabeLog = true; //日志开关。可填值：true、
	private $Filename="../log.txt"; //日志文件
	private $Handle; 
	function __construct($ServerIP,$ServerPort,$SoftVersion)	
	{
		$this->Batch = date("YmdHis");
		$this->ServerIP = $ServerIP;
		$this->ServerPort = $ServerPort;
		$this->SoftVersion = $SoftVersion;
        $this->Handle = fopen($this->Filename, 'a');
	}

   /**
    * 设置主帐号
    * 
    * @param AccountSid 主帐号
    * @param AccountToken 主帐号Token
    */    
    function setAccount($AccountSid,$AccountToken){
      $this->AccountSid = $AccountSid;
      $this->AccountToken = $AccountToken;   
    }
    
   /**
    * 设置子帐号
    * 
    * @param SubAccountSid 子帐号
    * @param SubAccountToken 子帐号Token
    * @param VoIPAccount VoIP帐号
    * @param VoIPPassword VoIP密码
    */    
    function setSubAccount($SubAccountSid,$SubAccountToken,$VoIPAccount,$VoIPPassword){
      $this->SubAccountSid = $SubAccountSid;
      $this->SubAccountToken = $SubAccountToken;
      $this->VoIPAccount = $VoIPAccount;
      $this->VoIPPassword = $VoIPPassword;     
    }
    
   /**
    * 设置应用ID
    * 
    * @param AppId 应用ID
    */
    function setAppId($AppId){
       $this->AppId = $AppId; 
    }
    
   /**
    * 打印日志
    * 
    * @param log 日志内容
    */
    function showlog($log){
      if($this->enabeLog){
         fwrite($this->Handle,$log."\n");  
      }
    }
    
    /**
     * 发起HTTPS请求
     */
     function curl_post($url,$data,$header,$post=1)
     {
       //初始化curl
       $ch = curl_init();
       //参数设置  
       $res= curl_setopt ($ch, CURLOPT_URL,$url);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt ($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_POST, $post);
       if($post)
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
       $result = curl_exec ($ch);
       //连接失败
       if($result == FALSE){
          if($this->BodyType=='json'){
             $result = "{\"statusCode\":\"172001\",\"statusMsg\":\"网络错误\"}";
          } else {
             $result = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><Response><statusCode>172001</statusCode><statusMsg>网络错误</statusMsg></Response>"; 
          }    
       }

       curl_close($ch);
       return $result;
     } 

    /**
    * 创建子帐号
    * @param friendlyName 子帐号名称
    */
	  function createSubAccount($friendlyName)
	  {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->BodyType=="json"){
           $body= "{'appId':'$this->AppId','friendlyName':'$friendlyName'}";
        }else{
           $body="<SubAccount>
                    <appId>$this->AppId</appId>
                    <friendlyName>$friendlyName</friendlyName>
                  </SubAccount>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数  
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/SubAccounts?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐号Id + 英文冒号 + 时间戳
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头 
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
	  }
        
    /**
    * 获取子帐号
    * @param startNo 开始的序号，默认从0开始
    * @param offset 一次查询的最大条数，最小是1条，最大是100条
    */
    function getSubAccounts($startNo,$offset)
    {   
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        $body="
            <SubAccount>
              <appId>$this->AppId</appId>
              <startNo>$startNo</startNo>  
              <offset>$offset</offset>
            </SubAccount>";
        if($this->BodyType=="json"){
           $body= "{'appId':'$this->AppId','startNo':'$startNo','offset':'$offset'}";
        }else{
        	 $body="
            <SubAccount>
              <appId>$this->AppId</appId>
              <startNo>$startNo</startNo>  
              <offset>$offset</offset>
            </SubAccount>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数  
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/GetSubAccounts?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头 
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
    }
        
   /**
    * 子帐号信息查询
    * @param friendlyName 子帐号名称
    */
    function querySubAccount($friendlyName)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        
        if($this->BodyType=="json"){
           $body= "{'appId':'$this->AppId','friendlyName':'$friendlyName'}";
        }else{
        	 $body="
            <SubAccount>
              <appId>$this->AppId</appId>
              <friendlyName>$friendlyName</friendlyName>
            </SubAccount>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数  
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/QuerySubAccountByName?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头 
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas; 
    }

   /**
    * 发送短信
    * @param to 短信接收彿手机号码集合,用英文逗号分开
    * @param body 短信正文
    */
    function sendSMS($to,$smsBody)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体    
        if($this->BodyType=="json"){
           $body= "{'to':'$to','body':'$smsBody','appId':'$this->AppId'}";
        }else{
           $body="<SMSMessage>
                    <to>$to</to> 
                    <body>$smsBody</body>
                    <appId>$this->AppId</appId>
                  </SMSMessage>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数 
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL        
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/SMS/Messages?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐号Id + 英文冒号 + 时间戳
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        } 
        return $datas; 
    }
    
   /**
    * 发送模板短信
    * @param to 短信接收彿手机号码集合,用英文逗号分开
    * @param datas 内容数据
    * @param $tempId 模板Id
    */       
    function sendTemplateSMS($to,$datas,$tempId)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->BodyType=="json"){
           $data="";
           for($i=0;$i<count($datas);$i++){
              $data = $data. "'".$datas[$i]."',"; 
           }
           $body= "{'to':'$to','templateId':'$tempId','appId':'$this->AppId','datas':[".$data."]}";
        }else{
           $data="";
           for($i=0;$i<count($datas);$i++){
              $data = $data. "<data>".$datas[$i]."</data>"; 
           }
           $body="<TemplateSMS>
                    <to>$to</to> 
                    <appId>$this->AppId</appId>
                    <templateId>$tempId</templateId>
                    <datas>".$data."</datas>
                  </TemplateSMS>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数 
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL        
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/SMS/TemplateSMS?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        //重新装填数据
        if($datas->statusCode==0){
         if($this->BodyType=="json"){
            $datas->TemplateSMS =$datas->templateSMS;
            unset($datas->templateSMS);   
          }
        }
 
        return $datas; 
    } 
  
    /**
    * 双向回呼
    * @param from 主叫电话号码
    * @param to 被叫电话号码
    * @param customerSerNum 被叫侧显示的客服号码  
    * @param fromSerNum 主叫侧显示的号码
    * @param promptTone 第三方自定义回拨提示音    
    */
	  function callBack($from,$to,$customerSerNum,$fromSerNum,$promptTone)
	  {   
        //子帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->subAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体 
        if($this->BodyType=="json"){
           $body= "{'from':'$from','to':'$to','customerSerNum':'$customerSerNum','fromSerNum':'$fromSerNum','promptTone':'$promptTone'}";
        }else{
           $body= "<CallBack>
                     <from>$from</from>
                     <to>$to</to>
                     <customerSerNum>$customerSerNum</customerSerNum>
                     <fromSerNum>$fromSerNum</fromSerNum>
                     <promptTone>$promptTone</promptTone>
                   </CallBack>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数  
        $sig =  strtoupper(md5($this->SubAccountSid . $this->SubAccountToken . $this->Batch));
        // 生成请求URL
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/SubAccounts/$this->SubAccountSid/Calls/Callback?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：子帐号Id + 英文冒号 + 时间戳 
        $authen=base64_encode($this->SubAccountSid . ":" . $this->Batch);
        // 生成包头 
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
	}
    

    
    /**
    * 营销外呼
    * @param to 被叫号码
    * @param mediaName 语音文件名称，格式 wav。与mediaTxt不能同时为空。当不为空时mediaTxt属性失效。
    * @param mediaTxt 文本内容
    * @param displayNum 显示的主叫号码
    * @param playTimes 循环播放次数，1－3次，默认播放1次。
    * @param respUrl 营销外呼状态通知回调地址，云通讯平台将向该Url地址发送呼叫结果通知。
    */
    function landingCall($to,$mediaName,$mediaTxt,$displayNum,$playTimes,$respUrl)
    {   
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        } 
        // 拼接请求包体
        if($this->BodyType=="json"){
           $body= "{'playTimes':'$playTimes','mediaTxt':'$mediaTxt','mediaName':'$mediaName','to':'$to','appId':'$this->AppId','displayNum':'$displayNum','respUrl':'$respUrl'}";
        }else{
           $body="<LandingCall>
                    <to>$to</to>
                    <mediaName>$mediaName</mediaName>
                    <mediaTxt>$mediaTxt</mediaTxt> 
                    <appId>$this->AppId</appId>
                    <displayNum>$displayNum</displayNum>
                    <playTimes>$playTimes</playTimes>
                    <respUrl>$respUrl</respUrl>
                  </LandingCall>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL  
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/Calls/LandingCalls?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
    }
    
    /**
    * 语音验证码
    * @param verifyCode 验证码内容，为数字和英文字母，不区分大小写，长度4-8位
    * @param playTimes 播放次数，1－3次
    * @param to 接收号码
    * @param displayNum 显示的主叫号码
    * @param respUrl 语音验证码状态通知回调地址，云通讯平台将向该Url地址发送呼叫结果通知
    */
    function voiceVerify($verifyCode,$playTimes,$to,$displayNum,$respUrl)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->BodyType=="json"){
           $body= "{'appId':'$this->AppId','verifyCode':'$verifyCode','playTimes':'$playTimes','to':'$to','respUrl':'$respUrl','displayNum':'$displayNum'}";
        }else{
           $body="<VoiceVerify>
                    <appId>$this->AppId</appId>
                    <verifyCode>$verifyCode</verifyCode>
                    <playTimes>$playTimes</playTimes>
                    <to>$to</to>
                    <respUrl>$respUrl</respUrl>
                    <displayNum>$displayNum</displayNum>
                  </VoiceVerify>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL  
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/Calls/VoiceVerify?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
    }
      
   /**
    * IVR外呼
    * @param number   待呼叫号码，为Dial节点的属性
    * @param userdata 用户数据，在<startservice>通知中返回，只允许填写数字字符，为Dial节点的属性
    * @param record   是否录音，可填项为true和false，默认值为false不录音，为Dial节点的属性
    */
    function ivrDial($number,$userdata,$record)
    {
       //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        } 
       // 拼接请求包体
        $body=" <Request>
                  <Appid>$this->AppId</Appid>
                  <Dial number='$number'  userdata='$userdata' record='$record'></Dial>
                </Request>";
        $this->showlog("request body = ".$body);
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL  
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/ivr/dial?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/xml","Content-Type:application/xml;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        $datas = simplexml_load_string(trim($result," \t\n\r"));
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;
    }
    
   /**
    * 话单下载
    * @param date     day 代表前一天的数据（从00:00 – 23:59）;week代表前一周的数据(周一 到周日)；month表示上一个月的数据（上个月表示当前月减1，如果今天是4月10号，则查询结果是3月份的数据）
    * @param keywords   客户的查询条件，由客户自行定义并提供给云通讯平台。默认不填忽略此参数
    */
    function billRecords($date,$keywords)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->BodyType=="json"){
           $body= "{'appId':'$this->AppId','date':'$date'}";
        }else{
           $body="<BillRecords>
                    <appId>$this->AppId</appId>
                    <date>$date</date>
                    <keywords>$keywords</keywords>
                  </BillRecords>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL  
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/BillRecords?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas; 
   } 
   
  /**
    * 主帐号信息查询
    */
   function queryAccountInfo()
   {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL  
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/AccountInfo?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头  
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,"",$header,0);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
           $datas=json_decode($result); 
        }else{ //xml格式
           $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
      //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误'; 
//        }
        return $datas;  
   }

  /**
    * 子帐号鉴权
    */   
   function subAuth()
   {
       if($this->ServerIP==""){
            $data = new stdClass();
            $data->statusCode = '172004';
            $data->statusMsg = 'IP为空';
          return $data;
        }
        if($this->ServerPort<=0){
            $data = new stdClass();
            $data->statusCode = '172005';
            $data->statusMsg = '端口错误（小于等于0）';
          return $data;
        }
        if($this->SoftVersion==""){
            $data = new stdClass();
            $data->statusCode = '172013';
            $data->statusMsg = '版本号为空';
          return $data;
        } 
        if($this->SubAccountSid==""){
            $data = new stdClass();
            $data->statusCode = '172008';
            $data->statusMsg = '子帐号为空';
          return $data;
        }
        if($this->SubAccountToken==""){
            $data = new stdClass();
            $data->statusCode = '172009';
            $data->statusMsg = '子帐号令牌为空';
          return $data;
        }
        if($this->AppId==""){
            $data = new stdClass();
            $data->statusCode = '172012';
            $data->statusMsg = '应用ID为空';
          return $data;
        }  
   }
   
  /**
    * 主帐号鉴权
    */   
   function accAuth()
   {
       if($this->ServerIP==""){
            $data = new stdClass();
            $data->statusCode = '172004';
            $data->statusMsg = 'IP为空';
          return $data;
        }
        if($this->ServerPort<=0){
            $data = new stdClass();
            $data->statusCode = '172005';
            $data->statusMsg = '端口错误（小于等于0）';
          return $data;
        }
        if($this->SoftVersion==""){
            $data = new stdClass();
            $data->statusCode = '172013';
            $data->statusMsg = '版本号为空';
          return $data;
        } 
        if($this->AccountSid==""){
            $data = new stdClass();
            $data->statusCode = '172006';
            $data->statusMsg = '主帐号为空';
          return $data;
        }
        if($this->AccountToken==""){
            $data = new stdClass();
            $data->statusCode = '172007';
            $data->statusMsg = '主帐号令牌为空';
          return $data;
        }
        if($this->AppId==""){
            $data = new stdClass();
            $data->statusCode = '172012';
            $data->statusMsg = '应用ID为空';
          return $data;
        }   
   }
}
?>
