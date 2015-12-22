<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
  include ROOT.'/include/init.inc.php';
  include ROOT.'/include/user.inc.php';
  require ROOT.'/classes/datamgr/user.cls.php';
  
  $year=$_REQUEST["year"];
  if($year==""){
	$year=date('Y');
  }
  $month=$_REQUEST["month"];
  if($month==""){
	$month=date('m');
  }

  $meetdates=$userMgr->getMeetingDateInMonth($user["id"],$year,$month);

  $firstday = "$year-$month-01";
  $dayofweek=date('w', strtotime("$firstday"));
  $dayofweek=$dayofweek==0?7:$dayofweek;
  $lastday = date('d', strtotime("$firstday +1 month -1 day"));
  $firstday=1;
  $table=array();
  $start=false;
  $day=0;
  for($i=0;$i<6;$i++){
	$arr=array();
	$haveday=false;
	for($j=1;$j<=7;$j++){
		$dt=array();
		if($dayofweek==$j){
			$start=true;
		}
		if($start==true){
			if($day<$lastday){
				$day++;
				$haveday=true;
				$value=$day;
				if(strlen($value)==1){
					$value="0".$value;
				}
				$dt=array();
				$dt["day"]=$value;
				$dt["isday"]="isday";
				if(date("Y-m-d")=="$year-$month-$value"){
					$dt["today"]="today";
				}
				if($userMgr->haveMeeting($meetdates,"$year-$month-$value")){
					$dt["meeting"]="meeting";
				}
			}
		}
		$arr[$j]=$dt;
	}
	if($haveday==true){
		$table[]=$arr;
	}
  }
  //print_r($table);
  $smarty->assign("table",$table);
  $smarty->assign("month",$month);
  $smarty->assign("year",$year);
  
  $smarty->display(ROOT.'/templates/User/schedule.html');
?>