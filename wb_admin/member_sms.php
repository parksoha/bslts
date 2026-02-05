<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$add_ary = array("hp"=>"","name"=>"");
$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['member']);
if($Idx_Ary != 'all'){
if(strlen($Idx_Ary)>1) $Idx_Ary = str_replace(",","','",$Idx_Ary);
$rs_list->add_where("mb_num in ('".$Idx_Ary."') ");
}
$rs_list->add_order("mb_num DESC");
while($R=$rs_list->fetch()) {
	if(strlen($R[mb_tel2])<5) continue;
	$hp = str_replace("-","",$R[mb_tel2]);
	$add_ary[hp][] = $hp;
	$add_ary[name][] = $R[mb_name];/**/
}

$MENU_L='m2';
?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../include/style.css" rel="stylesheet" type="text/css">
<title>SMS 문자 메시지</title>
</head>
<body>
<form name="smsForm" method="post" action="member_sms_ok.php" style="padding:0; margin:0;">
<INPUT TYPE="hidden" name="mode" value="goods_send">
<input type="hidden" name="add_ary" value="<?=implode("/",$add_ary[hp])?>">
<table border=0 cellpadding=0 cellspacing=10 width=440>
<tr>
    <td width=50% valign=top align=center>
        <div style="width:160px; height:400px; background-color:#efefef; text-align:center; padding-top:10px;">

        <div style="margin:auto; width:145px; background-color:#F8F8F8; border:1px solid #ccc; text-align:center; margin-bottom:5px;">
        <div style="margin:auto; background-image:url('<?=$_path['sms']?>images/smsbg.gif'); width:120px; height:120px; margin-top:8px;">
            <textarea name='content' id='sms_message' style="font-family:굴림체; color:#000; line-height:15px;margin:auto; margin-top:20px; overflow: hidden; width:100px; height:88px; font-size: 9pt; border:0; background-color:#88C8F8;" cols="16" onkeyup="byte_check('sms_message', 'sms_bytes');"><?=$_GET['content']?></textarea>
        </div>
        <div style="text-align:center; margin:5px 0 5px 0;">
            <span id=sms_bytes>0</span> / 80 byte
        </div>
        </div>
        <table width="82" border="0" cellspacing="0" cellpadding="0" align=center>
        <tr> 
            <td width="18"><a href="Javascript:add('■')"><img src="<?=$_path['sms']?>images/c.gif" width="19" height="19" border=0></a></td>
            <td width="18"><a href="Javascript:add('□')"><img src="<?=$_path['sms']?>images/c1.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▣')"><img src="<?=$_path['sms']?>images/c2.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('◈')"><img src="<?=$_path['sms']?>images/c3.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('◆')"><img src="<?=$_path['sms']?>images/c4.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('◇')"><img src="<?=$_path['sms']?>images/c5.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♥')"><img src="<?=$_path['sms']?>images/c6.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♡')"><img src="<?=$_path['sms']?>images/c7.gif" width="19" height="19" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('●')"><img src="<?=$_path['sms']?>images/c8.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('○')"><img src="<?=$_path['sms']?>images/c9.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▲')"><img src="<?=$_path['sms']?>images/c10.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▼')"><img src="<?=$_path['sms']?>images/c11.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▶')"><img src="<?=$_path['sms']?>images/c12.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▷')"><img src="<?=$_path['sms']?>images/c13.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('◀')"><img src="<?=$_path['sms']?>images/c14.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('◁')"><img src="<?=$_path['sms']?>images/c15.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('☎')"><img src="<?=$_path['sms']?>images/c16.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('☏')"><img src="<?=$_path['sms']?>images/c17.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♠')"><img src="<?=$_path['sms']?>images/c18.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♤')"><img src="<?=$_path['sms']?>images/c19.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♣')"><img src="<?=$_path['sms']?>images/c20.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♧')"><img src="<?=$_path['sms']?>images/c21.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('★')"><img src="<?=$_path['sms']?>images/c22.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('☆')"><img src="<?=$_path['sms']?>images/c23.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('☞')"><img src="<?=$_path['sms']?>images/c24.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('☜')"><img src="<?=$_path['sms']?>images/c25.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('▒')"><img src="<?=$_path['sms']?>images/c26.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('⊙')"><img src="<?=$_path['sms']?>images/c27.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('㈜')"><img src="<?=$_path['sms']?>images/c28.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('№')"><img src="<?=$_path['sms']?>images/c29.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('㉿')"><img src="<?=$_path['sms']?>images/c30.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♨')"><img src="<?=$_path['sms']?>images/c31.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('™')"><img src="<?=$_path['sms']?>images/c32.gif" width="19" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('℡')"><img src="<?=$_path['sms']?>images/c33.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('∑')"><img src="<?=$_path['sms']?>images/c34.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('∏')"><img src="<?=$_path['sms']?>images/c35.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♬')"><img src="<?=$_path['sms']?>images/c36.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♪')"><img src="<?=$_path['sms']?>images/c37.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♩')"><img src="<?=$_path['sms']?>images/c38.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('♭')"><img src="<?=$_path['sms']?>images/c39.gif" width="19" height="18" border="0"></a></td>
        </tr>
        <tr>
            <td colspan=8 height=10></td>
        </tr>
        <tr> 
            <td width="36" colspan=2><a href="Javascript:add('*^^*')"><img src="<?=$_path['sms']?>images/i1.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('♡.♡')"><img src="<?=$_path['sms']?>images/i2.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('@_@')"><img src="<?=$_path['sms']?>images/i3.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('☞_☜')"><img src="<?=$_path['sms']?>images/i4.gif" width="36" height="18" border="0"></a></td>
        </tr>
        <tr>
            <td width="36" colspan=2><a href="Javascript:add('ㅠ ㅠ')"><img src="<?=$_path['sms']?>images/i5.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('Θ.Θ')"><img src="<?=$_path['sms']?>images/i6.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('^_~♥')"><img src="<?=$_path['sms']?>images/i8.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('~o~')"><img src="<?=$_path['sms']?>images/i7.gif" width="36" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="36" colspan=2><a href="Javascript:add('★.★')"><img src="<?=$_path['sms']?>images/i9.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('(!.!)')"><img src="<?=$_path['sms']?>images/i10.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('⊙.⊙')"><img src="<?=$_path['sms']?>images/i12.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('q.p')"><img src="<?=$_path['sms']?>images/i11.gif" width="36" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="73" colspan=4><a href="Javascript:add('┏( \'\')┛')"><img src="<?=$_path['sms']?>images/i13.gif" width="73" height="17" border="0"></a></td>
            <td width="73" colspan=4><a href="Javascript:add('@)-)--')"><img src="<?=$_path['sms']?>images/i14.gif" width="73" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="73" colspan=4><a href="Javascript:add('↖(^-^)↗')"><img src="<?=$_path['sms']?>images/i15.gif" width="73" height="18" border="0"></a></td>
            <td width="73" colspan=4><a href="Javascript:add('(*^-^*)')"><img src="<?=$_path['sms']?>images/i16.gif" width="73" height="18" border="0"></a></td>
        </tr>
        </table>

        </div>

    </td>
    <td width=50% valign=top style="line-height:25px;">
		<TABLE border="1" width="100%" cellpadding="3" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
			<TR>
				<TD colspan="2" align="center"><b>받는 사람</b></TD>
			</TR>
			<TR>
				<TD align="center">회신번호</TD>
				<TD><INPUT TYPE="text" NAME="from_num" value="<?=$_site_info['sms_from']?>" size="11" maxlength="13"></TD>
			</TR>
			<TR>
				<TD align="center">회신변경</TD>
				<TD>
					<select name="change_from_num" style="font-size:12px; width:100px;" onchange="javascript:this.form.from_num.value= this.value;">
						<option value="">직접입력</option>
						<option value="02-1234-1234" selected>대표번호1</option>
						<option value="02-1234-1234" <? if($rehand == "".$_site_info['sms_from']."") echo "selected"; ?>>대표이사(직통)</option>
					</select>
				</TD>
			</TR>
		</TABLE><BR>
		<TABLE border="0" cellpadding="0" cellspacing="0">
			<TR>
				<TD><input type=button value='  전 송 하 기  ' style="width:100px; height:30px;" onfocus="this.blur()" onclick="send()"></TD>
			</TR>
		</TABLE>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<TEXTAREA NAME=""style="width:210px;height:200px" readonly><?for($i=0;$i<count($add_ary[hp]);$i++){echo $add_ary[name][$i]." => ".$add_ary[hp][$i]."\r\n";}?></TEXTAREA>
				</td>
			</tr>
		</table>
	</td>
</table>

</form>
</body>
</html>

<SCRIPT LANGUAGE="JavaScript">
<!--
function send() 
{
	var form=document.smsForm;
	
	if(!form.content.value){
		alert('메세지를 입력해주세요.');
		form.sms_message.focus();
		return;
    }

	form.submit();
}

function add(str) {
	var conts = document.getElementById('sms_message');
	var bytes = document.getElementById('sms_bytes');
	conts.focus();
	conts.value+=str; 
	byte_check('sms_message', 'sms_bytes');
	return;
}

function byte_check(sms_message, sms_bytes)
{
	var conts = document.getElementById(sms_message);
	var bytes = document.getElementById(sms_bytes);

	var i = 0;
	var cnt = 0;
	var exceed = 0;
	var ch = '';

	for (i=0; i<conts.value.length; i++) 
	{
		ch = conts.value.charAt(i);
		if (escape(ch).length > 4) {
			cnt += 2;
		} else {
			cnt += 1;
		}
	}

	bytes.innerHTML = cnt;

	if (cnt > 80) 
	{
		exceed = cnt - 80;
		alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
		var tcnt = 0;
		var xcnt = 0;
		var tmp = conts.value;
		for (i=0; i<tmp.length; i++) 
		{
			ch = tmp.charAt(i);
			if (escape(ch).length > 4) {
				tcnt += 2;
			} else {
				tcnt += 1;
			}

			if (tcnt > 80) {
				tmp = tmp.substring(0,i);
				break;
			} else {
				xcnt = tcnt;
			}
		}
		conts.value = tmp;
		bytes.innerHTML = xcnt;
		return;
	}
}

byte_check('sms_message', 'sms_bytes');
document.getElementById('sms_message').focus();
//-->
</SCRIPT>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>