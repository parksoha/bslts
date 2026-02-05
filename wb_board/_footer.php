<?
	if(file_exists($skin_path."footer.php")) include($skin_path."footer.php");

	echo $_bbs_info['footer_tag'];
	if(file_exists($_bbs_info['footer_file'])) include($_bbs_info['footer_file']);
	if(file_exists($_group_info['gr_footer_file'])) include($_group_info['gr_footer_file']);
?>
<? 
if(substr($bbs_code,0,2)=="c_"){
	include('../c_include/footer.php');
}else if(substr($bbs_code,0,2)=="m_"){
	include('../include/footer.php');
}else{
	if($bsc[2] == "e"){
		include('../include/footer3_e.php'); 
	}else if($bsc[2] == "j"){
		include('../include/footer3_j.php');
	}else{
		include('../include/footer3.php');
	}


}
?>
<script>
set_url('<?=$_url['bbs']?>','<?=$_url['member']?>','<?=$skin_path?>');
</script>