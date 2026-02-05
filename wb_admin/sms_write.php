<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../include/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<title>SMS 문자 메시지</title>
<style>
div, ul, li{margin:0; padding:0; list-style:none;}
</style>
<script language="javascript" src="../wb_js/msg.js"></script>

<script>
function maglist(){

	cw=screen.availWidth;     //화면 넓이
	ch=screen.availHeight;    //화면 높이

	sw=658;    //띄울 창의 넓이
	sh=887;    //띄울 창의 높이

	ml=((cw-sw)/2)+340;        //가운데 띄우기위한 창의 x위치
	mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치
	

window.open("member_sms_mag.php","메세지리스트","scrollbars=yes,left="+ml+",top="+mt+",width="+sw+",height="+sh);
}

function textchk(valtext){
	if(valtext=='90byte 초과시 자동으로 2000byte로 전환되어 LMS로 발송됩니다.'){
		$('#sms_message').val('');
	}
}

</script>
</head>
<body>



<div style="width:450px; height:639px; float:left; background:url('images/phone3.png') center no-repeat; position:relative;">
<a href="javascript:maglist();" style="position:absolute; top:3px; right:3px;"><img src="images/msg_go2.png"></a>
<div style="width:393px; height:524px; float:left; margin:58px 29px 57px 28px;">

<form name='smsForm' method='post' action='member_sms_ok2.php' style="padding:0; margin:0;">
<INPUT TYPE="hidden" name="mode" value="send">

<div style="width:100%; float:left;">
	 <div style="width:200px; height:auto; float:left; background-color:#efefef; text-align:center; padding:10px 0 10px 0; margin:0 0 10px 100px;">

		<div style="margin:auto; width:185px; background-color:#F8F8F8; border:1px solid #ccc; text-align:center; margin-bottom:5px;">
		<div style="margin:auto; background-image:url('<?=$_path['sms']?>images/smsbg.gif'); width:160px; height:120px; margin-top:8px;">
			<textarea name='strData' id='sms_message' style="font-family:굴림체; color:#000; line-height:15px;margin:auto; margin-top:20px; overflow: hidden; width:140px; height:88px; font-size: 9pt; border:0; background-color:#88C8F8;" cols="16" onchange="ChkLen()" onkeyup="ChkLen()" onclick="textchk(this.value);">90byte 초과시 자동으로 2000byte로 전환되어 LMS로 발송됩니다.<?=$_GET['content']?></textarea>
		</div>
		<div style="text-align:center; margin:5px 0 5px 0;">
			<input type="text" name="strDataCount" id="sdcoun" size="3" style="border:0; background-color:#F8F8F8; text-align:right;" maxlength="3" value="0" readonly> / <div id="maxLength" style="display:inline;">90</div> byte
			<div id="msgType" style="display:inline; color:red; font-weight:bold;">SMS</div>
		</div>
		</div>
		
		<table width="82" border="0" cellspacing="0" cellpadding="0" align=center>
		
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
</div>



<div style="width:100%; float:left;">
	<div style="width:200px; height:auto; float:left; border:1px solid #000; margin:0 10px 0 100px;">
		<ul id="divLmsTitle" style="width:100%; height:auto; float:left; border-bottom:1px solid #000; display: none;">
			<li style="width:30%; height:auto; line-height:35px; float:left; text-align:center;">제목입력</li>
			<li style="width:69%; height:35px; float:left; padding:5px 0 5px 0; border-left:1px solid #000;">
			<INPUT TYPE="text" NAME="strSubject" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
			</li>
		</ul>
		<!--//? if($username) { ?>
		<ul style="width:100%; height:auto; float:left; border-bottom:1px solid #000;">
			<li style="width:30%; height:auto; float:left; line-height:30px; text-align:center;">수신인</li>
			<li style="width:69%; height:30px; float:left; border-left:1px solid #000; padding:5px 0 5px 0;">
			<INPUT TYPE="text" NAME="hs_name" value="<?=$username?>" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
			</li>
		</ul>
		<--?}?-->
		<ul style="width:100%; height:auto; float:left; border-bottom:1px solid #000;">
			<li style="width:30%; height:auto; float:left; line-height:30px; text-align:center; font-size:12px;">수신번호</li>
			<li style="width:69%; height:30px; float:left; border-left:1px solid #000; padding:5px 0 5px 0;">
			<INPUT TYPE="text" NAME="strTelList" value="<?=$hand?>" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
			</li>
		</ul>
		
		<ul style="width:100%; height:auto; float:left; border-bottom:1px solid #000;">
			<li style="width:30%; height:auto; float:left; line-height:30px; text-align:center; font-size:12px;">발신번호</li>
			<li style="width:69%; height:30px; float:left; border-left:1px solid #000; padding:5px 0 5px 0;">
			<INPUT TYPE="text" NAME="strCallBack" value="<?=$_site_info['sms_from']?>" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
			</li>
		</ul>
		<ul style="width:100%; height:auto; float:left;">
			<li style="width:30%; height:auto; float:left; line-height:30px; text-align:center; font-size:12px;">발신변경</li>
			<li style="width:69%; height:30px; float:left; border-left:1px solid #000; padding:5px 0 5px 0;">
			
			<select name="change_from_num" style="width:96%; height:25px; float:left; margin-left:2%;" onchange="javascript:this.form.strCallBack.value= this.value;">
				<option value="">직접입력</option>
				<?if($_site_info['sms_from'] != ""){?>
				<option value="<?=$_site_info['sms_from']?>">대표전화(<?=$_site_info['sms_from']?>)</option>
				<?}?>
				<?if($_site_info['sms_from1'] != ""){?>
				<option value="<?=$_site_info['sms_from1']?>">대표전화(<?=$_site_info['sms_from1']?>)</option>
				<?}?>
			</select>

			</li>
		</ul>
	</div>
	<div style="width:100%; height:auto; float:left; margin:10px 0 0 0; text-align:center;"><input type=button value='  전 송 하 기  ' style="width:100px; height:30px; cursor:pointer;" onfocus="this.blur()" onclick="send()"></div>
</div>

</form>







</div>
</div>


</body>
</html>

<SCRIPT LANGUAGE="JavaScript">
<!--
function send() 
{
	var form=document.smsForm;
	
	if(!form.strData.value){
		alert('메세지를 입력해주세요.');
		form.sms_message.focus();
		
    }else if (document.getElementById("divLmsTitle").style.display != "none" && !form.strSubject.value) {		
		alert('제목을 입력해주세요.');
		form.strSubject.focus();		
	}else{		
		form.submit();
	}
}


//-->
</SCRIPT>