<?php

include 'utils.php';

// GET param : exp=EPD&type=[RXB|SiPM]&uid=0
// For RXB : &test=[noise/signal]
// FOr SiPM: &test=visual
if(is_array($_GET)&&count($_GET)>0)//判断是否有Get参数 
{ 
	if(check_param('exp') && check_param('type') && check_param('uid') && check_param('test')){

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

$DATA_DIR="./DATA";
$file = $DATA_DIR . "/" . $_GET["exp"] . "/" ; 
if($_GET['exp'] == 'EPD'){
	if($_GET['type'] == 'SiPM'){
    if($_GET['test'] != 'visual'){
      echo 'Invalid param';
      exit;
    }
    $file = $file . 'SiPM-Visual/';
		$uid = $_GET['uid'];
		$file = $file . (int)($uid/16) . '#B/'. ($uid%16) . '.bmp';
	}else{
		$file = $file . $_GET['type'] . $_GET['uid'] . '.root';
	}
}

download($file, 'application/x-bmp');

?>
