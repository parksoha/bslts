<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

include_once($_path['sms']."mw.sms.lib.php");
/*********************************
$_bbs_info[bbs_ext1] SMS 사용여부
$_bbs_info[bbs_ext2] SMS 회신번호
$_bbs_info[bbs_ext3] SMS 발신번호
$_bbs_info[bbs_ext4] SMS 발신내용
**********************************/

if($_bbs_info[bbs_ext1] == "y" && $_bbs_info[bbs_ext2] && $_bbs_info[bbs_ext3] && $mode == "write") {

	//$hps, $callback, $msg
	$sms_from =  $_bbs_info[bbs_ext2];   // 회신번호
	$sms_to = $_bbs_info[bbs_ext3];      // 발신번호
	$sms_content = "{$bd_name} 님 견적 요청-{$bd_subject}";
	//$sms_content = $_bbs_info[bbs_ext4]; // 발신내용

	mw_sms_send($sms_to, $sms_from, $sms_content);
}
?>