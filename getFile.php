<?php
//$file 被下载文件的地址
function download($file){
	if(!file_exists($file)){
		echo '404';
		exit;
	}
    //header('Content-Type:application/octet-stream');
	header('Content-Type:text/xml');
	$fileName=basename($file);
	header('Content-Disposition:attachment;filename="'.$fileName.'"');
	$buffer='';
	$cnt=0;
	$handle=fopen($file,'rb');
	if($handle===false){
		return false;
	}
	while(!feof($handle)){
		$buffer=fread($handle,1024*1024);
		echo $buffer;
		ob_flush();
		flush();
		if($retbytes){
			$cnt+=strlen($buffer);
		}
	}
	$status=fclose($handle);
	if($retbytes&&$status){
		return $cnt;
	}
	return $status;
}

function check_param($opt){
	if(isset($_GET[$opt]))//判断所需要的参数是否存在，isset用来检测变量是true or false 
	{ 
	  // Verify input param - only num, char and '_'
	  if(preg_match("/^[A-Za-z0-9_]+$/u", $_GET[$opt])){
		  return true;
	  }
	}
	return false;
}

// GET param : exp=EPD&type=FEE&uid=0
$DATA_DIR="/home/yato/DATA";

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

download($DATA_DIR . "/" . $_GET["exp"] . "/" . $_GET["type"] . $_GET["uid"] . ".root");

?>