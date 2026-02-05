<?
session_start();
include "../wb_include/config.php";
include "../wb_include/function.php";
$admin_row = $MySQL->fetch_array("select *from admin");
$sms       = $MySQL->fetch_array("select *from smsinfo");
if(!defined(__DESIGN_ROW))
{
	define(__DESIGN_ROW,"TRUE");
	$design=$MySQL->fetch_array("select *from design limit 0,1");
}
$adminTel = explode("-",$sms[adminTel])
?>
<html>
<head>
<title>sms 보내기</title>
<style>
<?=$design[css]?>
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language=javascript src="../script/admin.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function smsSendit()
{
	var form=document.smsForm;
	if(form.content.value=="")
	{
		alert("메세지를 입력해 주십시오.");
		form.content.focus();
	}
	else
	{
		form.submit();
	}
}
//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin='10' leftmargin='10' marginwidth="10" marginheight="10">
<table width="360" border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='4'><img src='../image/sub/table_tleft.gif'></td>
		<td width='352' background='../image/sub/table_tbg.gif'></td>
		<td width='4'><img src='../image/sub/table_tright.gif'></td>
	</tr>
	<tr>
		<td background='image/bg.gif' colspan='3' align='center'>
			<table width="355" border="0" cellspacing="0" cellpadding="0" align="center">
			<form name="smsForm" method="post" action="sms_ok.php">
			<input type="hidden" name="hand" value="<?=$hand?>">
				<tr>
					<td colspan='2' align='center'><img src="image/top.gif"></td>
				</tr>
				<tr>
					<td width="90"><img src="../email/image/tel.gif"></td>
					<td height="30"> <B><?=$hand?></B></td>
				</tr>
				<tr>
					<td colspan="2" background="image/dot.gif" height="1"></td>
				</tr>
				<tr>
					<td width="90"><img src="image/tel01.gif"></td>
					<td height="30"> <input type="text" name="adminTel1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$adminTel[0]?>"> - <input type="text" name="adminTel2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$adminTel[1]?>"> - <input type="text" name="adminTel3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$adminTel[2]?>"></td>
				</tr>
				<tr>
					<td colspan="2" background="image/dot.gif" height="1"></td>
				</tr>
				<tr>
					<td width="90"><img src="image/tel02.gif"></td>
					<td height="30">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" background="image/dot.gif" height="1"></td>
				</tr>
				<tr>
					<td colspan="2" height="140"> <div align="center"> <textarea name="content" cols="45" rows="8"></textarea></div></td>
				</tr>
				<tr>
					<td colspan="2" height="50"><div align="center"><a href="javascript:smsSendit();"><img src="image/btn.gif" border="0"></a></div></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src='../image/sub/table_bleft.gif'></td>
		<td background='../image/sub/table_bbg.gif'></td>
		<td><img src='../image/sub/table_bright.gif'></td>
	</tr>
</table>
</body>
</html>