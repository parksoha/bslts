<?php
 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}

	$test = explode(".", rawurldecode($headers['file_name']));
	$name = str_replace("\0", "", time().'-'.rand(0,100).'.'.$test[1]);
	
	$file = new stdClass;

	
	srand(time());
	$timed = substr(time(),5,5);
	for($h=0;$h<3;$h++)
	{
		$ascd=rand()%26+65;
		$cd.=chr($ascd);
	}
	$iparrd = explode(".",$REMOTE_ADDR);
	$njf=$cd.$timed.$iparrd[3];


	//$file->name = str_replace("\0", "", rawurldecode($name));

	function strToHex($string){
		$hex = '';
		for ($i=0; $i<strlen($string); $i++){
			$ord = ord($string[$i]);
			$hexCode = dechex($ord);
			$hex .= substr('0'.$hexCode, -2);
		}
		return strToUpper($hex);
	}



	$imgnamesd = explode(".", rawurldecode($headers['file_name']));
	$imgnamesd2= strToHex($imgnamesd[0]);
	$file->name = rawurldecode(rawurldecode($imgnamesd2.$name));
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);
		
		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=/smarteditor/upload/".$file->name;
		}
		
		echo $sFileInfo;
	}
?>