<?php

include 'utils.php';

if(is_array($_GET)&&count($_GET)>0)//判断是否有Get参数 
{ 
	if(check_param('exp') && check_param('type') && check_param('uid')){

	}
	else{
		echo 'Invalid param';
		exit;
	}
}
else{
  echo 'Empty param';
  exit;
}

// GET param : exp=EPD&type=FEE&uid=0
$DATA_DIR="./DATA";
$file = $DATA_DIR . "/" . $_GET["exp"] . "/" ; 
if($_GET['exp'] == 'EPD'){
	$file = $file . $_GET['type'] . 'Summary/';
	if($_GET['type'] == 'SiPM'){
		$uid = $_GET['uid'];
		$file = $file . 'Board' . (int)($uid/16) . '/SiPM' . ($uid%16) . '.root';
	}else{
		$file = $file . $_GET['type'] . $_GET['uid'] . '.root';
	}
}

download($file, 'text/xml');

?>
