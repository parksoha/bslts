<?
if(!eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])) exit('접근불가!');
include_once("../wb_include/lib.php");



$dtsd = date("Y-m-d");




$b_tel=$b_tel1."-".$b_tel2."-".$b_tel3;




$sql_forms = "select * from wb_tb_free_form WHERE free_form_name='$b_name' and free_form_hpno='$b_tel' and left(free_form_datetime, 10)='$dtsd' and free_form_ip='$_SERVER[REMOTE_ADDR]'";
$result_forms = mysql_query($sql_forms);


$forms_rows = mysql_num_rows($result_forms);
$forms = mysql_fetch_array($result_forms);




$rs = "insert into wb_tb_free_form (free_select,free_form_name,free_form_hpno,b_sty,b_str2,free_form_datetime,free_form_ip) select '$free_select','$b_name','$b_tel','1','1',now(),'$_SERVER[REMOTE_ADDR]' FROM DUAL WHERE NOT EXISTS (SELECT * FROM wb_tb_free_form WHERE free_form_name='$b_name' and free_form_hpno='$b_tel' and left(free_form_datetime, 10)='$dtsd' and free_form_ip='$_SERVER[REMOTE_ADDR]') ";


mysql_query($rs);







if($forms_rows >= '1'){
			
	echo "2";
}else{
	
	include_once($_path['sms']."mw.sms.lib.php");

	//담당

	$sms_from_b = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
	$sms_to_b = str_replace('-', '', trim($_site_info['sms_to']));       // 수신자 번호

	if($b_name) {
	$sms_free_form_text1_b = rg_cut_string($b_name, 40);
	}
	$sms_content_b = "빠른상담접수 - {$sms_free_form_text1_b} / {$b_tel}";
	$sms_content_b = iconv('utf-8', 'euc-kr', $sms_content_b);

	mw_sms_send($sms_to_b, $sms_from_b, $sms_content_b);



	//담당2
	if($_site_info['sms_to1'] != ""){
		$sms_to_b2 = str_replace('-', '', trim($_site_info['sms_to1']));       // 수신자 번호
		mw_sms_send($sms_to_b2, $sms_from_b, $sms_content_b);
	}


	//고객
	$sms_from2_b = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
	$sms_to2_b = str_replace('-', '', trim($b_tel));       // 수신자 번호

	$sms_content2_b = "정상적으로 온라인문의가 신청되었습니다. -".$_site_info['company_names']."-";
	$sms_content2_b = iconv('utf-8', 'euc-kr', $sms_content2_b);

	mw_sms_send($sms_to2_b, $sms_from2_b, $sms_content2_b);
	

	echo "1";


}











?>