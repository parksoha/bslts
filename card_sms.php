<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

include_once($_path['sms']."mw.sms.lib.php");

//담당
$sms_from = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
$sms_to = str_replace('-', '', trim($_site_info['sms_to']));       // 수신자 번호


$sms_content = "[{$sndOrdername}]님께서 카드결제하셨습니다. [금액 : ".number_format($amt)."]";
$sms_content = iconv('utf-8', 'euc-kr', $sms_content);

mw_sms_send($sms_to, $sms_from, $sms_content);



//고객문자발송

$sms_from2 = str_replace('-', '', trim($_site_info['sms_from'])); // 발신자 번호
$sms_to2 = $sndMobile;       // 수신자 번호

$sms_content2 =  "[".$sndOrdername."]"." / 카드결제 접수 [금액 : ".number_format($amt)."]";
$sms_content2 = iconv('utf-8', 'euc-kr', $sms_content2);

mw_sms_send($sms_to2, $sms_from2, $sms_content2);
?>
