<?php

//$file 被下载文件的地址
//$retbyte = return bytes, else return status
function download($file, 
  $filetype = 'application/octet-stream', $retbytes = true){
	if(!file_exists($file)){
		echo '404';
		exit;
	}
    //header('Content-Type:application/octet-stream');
	header('Content-Type:' . $filetype);
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

// Check if param exist and satisfy the limitation
function check_param($opt){
	if(isset($_GET[$opt]))//判断所需要的参数是否存在，isset用来检测变量是true or false 
	{ 
	  // Verify input param - only num, char and '_'
	  if(preg_match("/^[A-Za-z0-9_-]+$/u", $_GET[$opt])){
		  return true;
	  }
	}
	return false;
}
?>