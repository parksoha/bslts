<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	$wdate=time();
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");

	$upFile="vid".$name[0].$wdate;
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$upFile;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
			
		$newPath = $uploadDir.urlencode($upFile.".".$filename_ext);
			
		@move_uploaded_file($tmp_name, $newPath);
			
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($upFile.".".$filename_ext));
		$url .= "&sFileURL=/smarteditor/upload/".urlencode(urlencode($upFile.".".$filename_ext));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>