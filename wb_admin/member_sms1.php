<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$add_ary = array("hp"=>"","name"=>"");
$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['member']);
if($id=="1" && $re == ""){
	if($Idx_Ary != 'all'){
	if(strlen($Idx_Ary)>1) $Idx_Ary = str_replace(",","','",$Idx_Ary);
	$rs_list->add_where("mb_num in ('".$Idx_Ary."') ");
	}
}else if($id=="1" && $re != ""){
	if($Idx_Ary != 'all'){
		if($num_ord=="1"){
			$rs_list->add_where("mb_num in ('".$Idx_Ary."') group by mb_tel2");
		}else{
			$rs_list->add_where("mb_num in ('".$Idx_Ary."')");
		}

	}
}else if($id=="2" && $re == ""){
	if($Idx_Ary2 != 'all'){
	if(strlen($Idx_Ary2)>1) $Idx_Ary2 = str_replace(",","','",$Idx_Ary2);
	$rs_list->add_where("mb_num in ('".$Idx_Ary2."') ");
	}
}else if($id=="2" && $re != ""){
	if($Idx_Ary2 != 'all'){
		if($num_ord=="1"){
			$rs_list->add_where("mb_num in ('".$Idx_Ary2."') group by mb_tel2");
		}else{
			$rs_list->add_where("mb_num in ('".$Idx_Ary2."')");
		}		
	}	
}

$rs_list->add_order("mb_num DESC");
while($R=$rs_list->fetch()) {
	if(strlen($R[mb_tel2])<5) continue;
	$hp = str_replace("-","",$R[mb_tel2]);
	$add_ary[hp][] = $hp;
	$add_ary[name][] = $R[mb_name];/**/
}





$ary = explode("','",$Idx_Ary);
$ary=count($ary);


$ary2 = explode("','",$Idx_Ary2);
$ary2=count($ary2);

$n_cnt=count($add_ary[hp]);

if($id=="1"){
	$n_cnt2=$ary - $n_cnt;	
}else if($id=="2"){
	$n_cnt2=$ary2 - $n_cnt;	
}

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

	sw=678;    //띄울 창의 넓이
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

<div style="width:618px; height:877px; float:left; background:url('images/phone2.png') center no-repeat; position:relative;">
<span style="width:95%; height:40px; float:left; color:red; font-size:12px; padding-left:5%; margin-top:27px; letter-spacing:-1px;">※ 대량 SMS, LMS 발송시스템</br>- 회원관리에서 거래처 구분후 대량 문자를 발송가능하게 구성했습니다. (마케팅,고객관리용으로 이용가능)  
</span>
<a href="javascript:maglist();" style="position:absolute; right:5px; top:5px;"><img src="images/msg_go.png"></a>

<div style="width:539px; height:718px; float:left; margin:0 40px 79px 39px;">


<div style="width:100%; float:left; height:320px;">
<form name="smsForm" method="post" action="member_sms_ok2.php" style="padding:0; margin:0;">
<INPUT TYPE="hidden" name="mode" value="goods_send">
<input type="hidden" name="strTelList" value="<?=implode("/",$add_ary[hp])?>">



<div style="width:200px; height:auto; float:left; background-color:#efefef; text-align:center; padding:10px 0 10px 0; margin:20px 0 0 20px;">

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

<div style="width:200px; height:auto; float:right; border:1px solid #000; margin:30px 50px 0 0;">



	<ul style=" width:100%; height:auto; float:left; border-bottom:1px solid #000;">
		<li style="width:100%; height:auto; float:left; text-align:center; padding:5px 0 5px 0; font-size:12px;">발신자</li>
	</ul>

	<ul id="divLmsTitle" style="width:100%; height:auto; float:left; border-bottom:1px solid #000; display: none;">
		<li style="width:30%; height:auto; line-height:35px; float:left; text-align:center; font-size:12px;">제목입력</li>
		<li style="width:69%; height:35px; float:left; padding:5px 0 5px 0; border-left:1px solid #000;">
		<INPUT TYPE="text" NAME="strSubject" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
		</li>
	</ul>
	
	<ul style="width:100%; height:auto; float:left; border-bottom:1px solid #000;">
		<li style="width:30%; height:auto; line-height:35px; float:left; text-align:center; font-size:12px;">발신번호</li>
		<li style="width:69%; height:35px; float:left; padding:5px 0 5px 0; border-left:1px solid #000;">
		<INPUT TYPE="text" NAME="strCallBack" value="<?=$_site_info['sms_from']?>" style="width:96%; height:25px; float:left; margin-left:2%;" maxlength="13">
		</li>
	</ul>
	<ul style="width:100%; height:auto; float:left;">
		<li style="width:30%; height:auto; float:left; line-height:35px; text-align:center; font-size:12px;">발신변경</li>
		<li style="width:69%; height:35px; float:left; padding:5px 0 5px 0; border-left:1px solid #000;">
		
		<select name="change_from_num" style="width:96%; height:25px; float:left; margin-left:2%;" onchange="javascript:this.form.strCallBack.value= this.value;">
			<option value="">직접입력</option>
			<?if($_site_info['sms_from'] != ""){?>
			<option value="<?=$_site_info['sms_from']?>">대표전화(<?=$_site_info['sms_from']?>)</option>
			<?}?>
			<?if($_site_info['sms_from1'] != ""){?>
			<option value="<?=$_site_info['sms_from1']?>">대표전화(<?=$_site_info['sms_from1']?>)</option>
			<?}?>
			<!--option value="02-1234-1234" <? if($rehand == "".$_site_info['sms_from']."") echo "selected"; ?>>대표이사(직통)</option-->
		</select>
		</li>
	</ul>
</div>

<div style="width:200px; height:auto; float:right; margin:20px 50px 0 0; text-align:center; padding-left:50px;"><input type=button value='  전 송 하 기  ' style="width:100px; height:30px;" onfocus="this.blur()" onclick="send()"></div>

</form>


<div style="width:200px; height:auto; float:right; margin:20px 50px 0 0; font-size:14px; text-align:center;"><?=count($add_ary[hp])?>명이 선택되었습니다.</div>


<form name="smsForm2" method="post" action="member_sms1.php?id=<?=$id?>&re=1" style="padding:0; margin:0;">
<?if($id=="1"){?>
<input type="hidden" value="<?=$Idx_Ary?>" name="Idx_Ary">
<?}else if($id=="2"){?>
<input type="hidden" value="<?=$Idx_Ary2?>" name="Idx_Ary2">
<?}?>
<div style="width:200px; height:auto; float:right; margin:10px 50px 0 0; font-size:14px; text-align:center;">중복전화번호 체크<input type="checkbox" name="num_ord" value='1' <?if($num_ord=='1'){echo "checked"; }?>><input type="button" value="확인" onclick="number_j();">

<?if($num_ord=='1'){?>
<div style="width:200px; height:auto; float:right; font-size:14px; text-align:center;"><?=$n_cnt2?>명이 중복되었습니다.</div>
<?}?>

</div>
</form>	

</div>

<div style="width:100%; height:auto; float:left;">
	<div style="width:97%; height:auto; float:left; padding-left:3%; margin-top:10px; font-size:14px; font-weight:bold;">
	* 수신자&nbsp;&nbsp;&nbsp;<span style="color:red; font-weight:normal; font-size:12px;">※ 5천명이상 발송시 지연될수 있으니 화면이동 하시면 안됩니다.</span>
	</div>
	<div style="width:90%; height:250px; float:left; margin:10px 0 0 4%; padding:1%; border:1px solid #000; overflow:auto;">
	<?for($i=0;$i<count($add_ary[hp]);$i++){
	echo "<span style='min-width:100px; float:left; max-width:auto;'>".$add_ary[name][$i]."</span> - ".$add_ary[hp][$i]."</br>";
	}?>
	</div>

	<div style="width:98%; height:auto; float:left; padding:10px 1% 0 1%; letter-spacing:-1px; font-size:11px;">
	* 발신번호 사전등록을 해야 서비스 이용이 가능합니다.</br>
	* 정보통신망법 의거 야간시간(오후9 ~ 다음날8시)에 영리목적의 사전동의 없는 대량문자 발송은 과태료 부과 대상 입니다.
	</div>



</div>

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
		
    }else if(form.strData.value=='90byte 초과시 자동으로 2000byte로 전환되어 LMS로 발송됩니다.'){
		alert('메세지를 입력해주세요.');
		form.sms_message.focus();
		
    }else if (document.getElementById("divLmsTitle").style.display != "none" && !form.strSubject.value) {		
		alert('제목을 입력해주세요.');
		form.strSubject.focus();		
	}else{		
		form.submit();
	}
}


function number_j(){
var form2=document.smsForm2;
 form2.submit();
}





//-->
</SCRIPT>
