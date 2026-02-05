<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

include_once($_path['sms']."mw.sms.lib.php");

if($_SERVER['REQUEST_METHOD']=='POST' && $free_form_mode=='free_form_ok') {


	$hponsd=$free_form_hpno1."-".$free_form_hpno2."-".$free_form_hpno3;


	
	//담당
	$sms_from = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
	$sms_to = str_replace('-', '', trim($_site_info['sms_to']));       // 수신자 번호
	
	if($free_form_text1) {
	$sms_free_form_text1 = "[".rg_cut_string($free_form_text1, 40)."]";
	}
	$sms_content = "온라인상담접수 - {$free_form_name} / {$hponsd}";
	$sms_content = iconv('utf-8', 'euc-kr', $sms_content);

	mw_sms_send($sms_to, $sms_from, $sms_content);

	//담당2
	if($_site_info['sms_to1'] != ""){
		$sms_to_b2 = str_replace('-', '', trim($_site_info['sms_to1']));       // 수신자 번호
		mw_sms_send($sms_to_b2, $sms_from, $sms_content);
	}



	//고객
	$hpon=$free_form_hpno1.$free_form_hpno2.$free_form_hpno3;

	if($hpon != ""){

		$sms_from2 = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
		$sms_to2 = $hpon;       // 수신자 번호
		
		$sms_content2 = "정상적으로 온라인문의가 신청되었습니다. -".$_site_info['company_names']."-";
		$sms_content2 = iconv('utf-8', 'euc-kr', $sms_content2);

		mw_sms_send($sms_to2, $sms_from2, $sms_content2);
	}
}
?>