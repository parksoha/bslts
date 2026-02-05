<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$content_len = strlen($content);
if($content_len >80)
{
	MsgView("메세지의 길이는 80 byte 를 초과할 수 없습니다.\\n\\n현재 길이 : $content_len byte",-1);
	exit;
}
else
{

	switch($mode){
		case"goods_send":$SMS_PART = "goods_send"; break;
	}
	include "../sms/smsclient.php";
	OnlyMsgView("메세지 전송을 완료 하였습니다.");
	
	echo "
	<script>
		opener.location.reload();
		window.close();
	</script>
	";
	


}
?>