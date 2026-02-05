<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

include_once($_path['sms']."mw.sms.lib.php");

if($_SERVER['REQUEST_METHOD']=='POST' && $mode=='send') {

	// SMS 발신자 번호 $sms_from;
	// SMS 수신자 번호 $sms_to;
	// SMS 발송 내용    $sms_content;

	mw_sms_send($sms_to, $sms_from, $sms_content);
}
?>