<?
include "../lib/config.php";
include "../lib/function.php";
$admin_row = $MySQL->fetch_array("select * from admin");
$sms	   = $MySQL->fetch_array("select * from smsinfo");
$content_len =  strlen($content);
if($content_len >80)
{
	MsgView("메세지의 길이는 80 byte 를 초과할 수 없습니다.\\n\\n현재 길이 : $content_len byte",-1);
	exit;
}
else
{
	$SMS_PART = "permember";
	$adminTel = $adminTel1.$adminTel2.$adminTel3;
	$hand = str_replace("-","",$hand);
	include "../sms/smsclient.php";
	OnlyMsgView("메세지 전송을 완료 하였습니다.");
	echo"<script language='javascript'>
	window.close();
	</script>";
}
?>