<?php

include 'utils.php';

// GET param : exp=EPD&type=[RXB|SiPM]&uid=0
// For RXB : &test=[Noise/Signal]&channel=[0..15]
// FOr SiPM: &test=Visual
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
    if($_GET['test'] != 'Visual'){
      echo 'Invalid param';
      exit;
    }
    $file = $file . 'SiPM-Visual/';
		$uid = $_GET['uid'];
		$file = $file . (int)($uid/16) . '#B/'. ($uid%16) . '.jpg';
	}else if($_GET['type'] == 'RXB' && check_param('channel')){
		$file = $file . 'RXBSummary/RXB' . $_GET['uid'] . '/' . $_GET['test'] . $_GET['channel'] . '.png';
	}else{
		echo "Invalid  param - type";
		exit;
	}
}else{
	echo "Invalid param - exp";
	exit;
}

$info = pathinfo($file);
download($file, 'image/' . $info['extension']);

?>
