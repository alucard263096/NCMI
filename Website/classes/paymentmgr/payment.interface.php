<?php

interface IPayment{


	public function submit($merchant_url,$trade_no,$subject,$total_fee,$pin_code);

	public function callback();

	public function notify();
}
 
 
 
 
?>