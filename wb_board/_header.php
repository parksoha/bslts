
<? 
if(substr($bbs_code,0,2)=="c_"){
	include('../c_include/header_bbs.php');
}else if(substr($bbs_code,0,2)=="m_"){
	include('../include/header_bbs.php');
}else{
	include('../include/header_bbs.php');
}
?>

<?
	if(file_exists($_group_info['gr_header_file'])) include($_group_info['gr_header_file']);
	if(file_exists($_bbs_info['header_file'])) include($_bbs_info['header_file']);
	echo $_bbs_info['header_tag'];

	if(file_exists($skin_path."header.php")) include($skin_path."header.php");
?>