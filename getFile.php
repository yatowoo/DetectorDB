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

download("/home/yato/Downloads/ct.root");

?>