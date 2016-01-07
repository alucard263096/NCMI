<?php

class AlipayMgr implements IPayment  {
	private	$alipay_config;
	private $notify_url;
	private $call_back_url;



	public function __construct()
	{
		Global $CONFIG;

		$this->alipay_config['partner']		= $CONFIG["alipay"]["partner"];

		$this->alipay_config['seller_email']	= $CONFIG["alipay"]["seller_email"];

		$this->alipay_config['key']			= $CONFIG["alipay"]["key"];

		$this->alipay_config['sign_type']    = 'MD5';

		$this->alipay_config['input_charset']= 'utf-8';

		$this->alipay_config['cacert']    = ROOT.'/libs/alipay_lib/key/cacert.pem';

		$this->alipay_config['transport']    = 'http';

		$this->notify_url=$CONFIG["alipay"]["notify_url"];
		$this->call_back_url=$CONFIG["alipay"]["call_back_url"];

	}

	public function submit($merchant_url,$trade_no,$subject,$total_fee,$pin_code){
		require_once(ROOT.'/libs/alipay_lib/alipay_submit.class.php');

		//支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = $this->notify_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = $this->call_back_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        $out_trade_no = $trade_no;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = $subject;
        //必填
        //付款金额
        $total_fee = $total_fee;
        //必填
        //订单描述
        $body = "";
        //商品展示地址
        $show_url = $merchant_url;
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($this->alipay_config['partner']),
		"seller_email" => trim($this->alipay_config['seller_email']),
		"payment_type"	=> $payment_type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"show_url"	=> $show_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($this->alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;
exit;


	}

	public function callback(){
		require_once(ROOT.'/libs/alipay_lib/alipay_notify.class.php');
		
		$alipayNotify = new AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		$ret=Array();

		$ret["out_trade_no"]= $_REQUEST['out_trade_no'];
		$ret["trade_no"]= $_REQUEST['trade_no'];

		if($verify_result){
			if($trade_status == 'TRADE_SUCCESS'
				||$trade_status == 'TRADE_FINISHED'){
					$ret["result"]="SUCCESS";
				}else{
					$ret["result"]="FAIL";
				}
		}else{
			$ret["result"]="FAIL";
		}
		return $ret;

	}

	public function notify(){
		require_once(ROOT."/libs/alipay_lib/alipay_notify.class.php");
		$alipayNotify = new AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		$ret=Array();
		if($verify_result) {
			$doc = new DOMDocument();	
			if ($this->alipay_config['sign_type'] == 'MD5') {
				$doc->loadXML($_POST['notify_data']);
			}
	
			if ($this->alipay_config['sign_type'] == '0001') {
				$doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
			}
	
			if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
				$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
				$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
				$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;

				
				$ret["out_trade_no"]= $out_trade_no;
				$ret["trade_no"]= $trade_no;


				if($trade_status == 'TRADE_SUCCESS'
				||$trade_status == 'TRADE_FINISHED'){
					$ret["result"]="SUCCESS";
				}else{
					$ret["result"]="FAIL";
				}
			}else{
				$ret["result"]="FAIL";
			}
			
			
		}else{
			$ret["result"]="FAIL";
		}
		return $ret;
	}
}
 
 
 
 
?>