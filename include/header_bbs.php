<? 
$bsc = explode("_",$bbs_code);

$bsc2 = substr($bsc[0],3);
if($bsc[2] == "e"){
	include("../include/header_e.php"); 
}else if($bsc[2] == "j"){
	include("../include/header_j.php"); 
}else{
	include("../include/header.php"); 
}

?>
