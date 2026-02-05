<?
if($bbs_code) $file_name=$bbs_code; else $file_name=basename($_SERVER['PHP_SELF']);

if($bbs_code != "" || str_replace($file_name,"",$_SERVER['PHP_SELF'])=="/wb_member/"){
	$site_path='../';
	$site_url='../';
}else{
	$site_path='./';
	$site_url='./';
}

include_once($site_path."wb_include/lib.php");
include_once($site_path."include/menu_info_j.php");



if($bbs_code != ""){

	$sql_dbname = "select * from wb_tb_bbs_cfg where bbs_db='".$bbs_code."'";
	$result_dbname = mysql_query($sql_dbname);
	$dbname = mysql_fetch_array($result_dbname);

	if($dbname[bbsnpage] == '1'){

		$markers = Hn_googleMap($_site_info[lat],$_site_info[lng],$_site_info[address],$_site_info[address]);//지도 좌표


		$bbs_code2=explode("_",$bbs_code);
		$bbs_code3=substr($bbs_code2[0],3);


		$menu_num=$bbs_code3;
		$sub_num=$bbs_code2[1];
		$cur_menu=$menu_names[$bbs_code3-1];
		$cur_sub= $dbname[bbs_name];
		$add_class="";
	}

}



if($_site_info[site_types] == '1'){
	include_once($site_path."include/header1.php");
}else if($_site_info[site_types] == '2'){
	include_once($site_path."include/header2_j.php");
}else if($_site_info[site_types] == '3'){
	include_once($site_path."include/header3.php");
}else if($_site_info[site_types] == '4'){
	include_once($site_path."include/header4.php");
}

?>

