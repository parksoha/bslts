<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

	$rs->clear();
	$rs->set_table($_table['form_set']);
	$rs->select();
	$data=$rs->fetch();

	$form_text1 = explode("|", $data[form_text1_use]);
	$form_textarea1 = explode("|", $data[form_textarea1_use]);
	$form_sendmail = explode("|", base64_decode($data[form_sendmail_use]));

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update") {
		$datetime = time();
		$updatetime = date("Y-m-d H:i:s", $datetime);

		if(!$form_id) rg_href($_path[admin].'free_form_set.php','폼 아이디를 입력해 주세요.','');
		
		if($form_text1_chk == "1") $form_text1_name = "";
		$form_text1_use = $form_text1_name."|".$form_text1_chk;
		
		if($form_textarea1_chk == "1") $form_textarea1_name = "";
		$form_textarea1_use = $form_textarea1_name."|".$form_textarea1_chk;
		
		if($form_sendmail_use == "2") {
			if(!$form_sendmail_addr){
				rg_href($_path[admin].'free_form_set.php','메일 주소를 입력해 주세요.','');
			} else {
				$form_sendmail_addr = base64_encode($form_sendmail_addr);
			}
		} else {
			$form_sendmail_addr = "";
		}

		$rs->clear();
		$rs->set_table($_table['form_set']);
		$rs->add_field("form_id","$form_id");
		$rs->add_field("form_name_use","$form_name_use");
		$rs->add_field("form_jumin_use","$form_jumin_use");
		$rs->add_field("form_sex_use","$form_sex_use");
		$rs->add_field("form_email_use","$form_email_use");
		$rs->add_field("form_telno_use","$form_telno_use");
		$rs->add_field("form_hpno_use","$form_hpno_use");
		$rs->add_field("form_addr_use","$form_addr_use");
		$rs->add_field("form_profile_use","$form_profile_use");
		$rs->add_field("form_select_use","$form_select_use");
		$rs->add_field("form_radio_use","$form_radio_use");
		$rs->add_field("form_checkbox_use","$form_checkbox_use");
		$rs->add_field("form_sendmail_use","$form_sendmail_use");
		$rs->add_field("form_sendmail_addr","$form_sendmail_addr");
		$rs->add_field("form_sms_use","$form_sms_use");
		$rs->add_field("form_user_use","$form_user_use");
		$rs->add_field("form_stipulation","$form_stipulation");
		$rs->add_field("form_text1_use","$form_text1_use");
		$rs->add_field("form_text2_use","$form_text2_use");
		$rs->add_field("form_text3_use","$form_text3_use");
		$rs->add_field("form_text4_use","$form_text4_use");
		$rs->add_field("form_text5_use","$form_text5_use");
		$rs->add_field("form_textarea1_use","$form_textarea1_use");
		$rs->add_field("form_textarea2_use","$form_textarea2_use");
		$rs->add_field("form_textarea3_use","$form_textarea3_use");
		$rs->add_field("form_textarea4_use","$form_textarea4_use");
		$rs->add_field("form_textarea5_use","$form_textarea5_use");
		$rs->add_field("form_updatetime","$updatetime");
		
		if(!$data) {
			$rs->insert();
		} else {
			$rs->update();
		}

		rg_href('?');
	}

	$MENU_L='m10';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td bgcolor="#F7F7F7">폼 항목설정</td>
	</tr>
</table>
<br>

<form name=form_set method=post action="?" onSubmit="return validate(this)">
<input type=hidden name=mode value="update">
<input type=hidden name=form_num value="<?=$data[form_num]?>">
<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
	<tr>
		<td class="a_sub_title">폼 항목설정 (수정시간 <?=$data[form_updatetime]?>)</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb1">
  	<col width="130" align="right" />
    <col width="210" align="left" />
	<col align="left" />
	<tr>
		<td>폼 아이디&nbsp;</td>
		<td colspan="2">&nbsp;
			<input type=text name='form_id' value='<?=$data[form_id]?>' size=15 maxlength=20 class=input18n_ph hname='폼 아이디(영문입력)'>
		</td>
	</tr>
	<tr>
		<td>이름&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_name_use' value='1' <?if($data[form_name_use] == '1') echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_name_use' value='2' <?if($data[form_name_use] == '2') echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_name_use' value='3' <?if($data[form_name_use] == '3') echo "checked"; ?>>필수 사용
		</td>
	</tr>
	<tr>
		<td>이메일&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_email_use' value='1' <?if($data[form_email_use] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_email_use' value='2' <?if($data[form_email_use] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_email_use' value='3' <?if($data[form_email_use] == "3") echo "checked"; ?>>필수 사용
		</td>
	</tr>
	<tr>
		<td>전화번호&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_telno_use' value='1' <?if($data[form_telno_use] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_telno_use' value='2' <?if($data[form_telno_use] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_telno_use' value='3' <?if($data[form_telno_use] == "3") echo "checked"; ?>>필수 사용
		</td>
	</tr>
	<tr>
		<td>핸드폰번호&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_hpno_use' value='1' <?if($data[form_hpno_use] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_hpno_use' value='2' <?if($data[form_hpno_use] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_hpno_use' value='3' <?if($data[form_hpno_use] == "3") echo "checked"; ?>>필수 사용
		</td>
	</tr>
	<tr>
		<td>주소&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_addr_use' value='1' <?if($data[form_addr_use] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_addr_use' value='2' <?if($data[form_addr_use] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_addr_use' value='3' <?if($data[form_addr_use] == "3") echo "checked"; ?>>필수 사용
		</td>
	</tr>
	<!--tr>
		<td>메일 수신&nbsp;</td>
		<? 
		if($data[form_sendmail_use] == "2") {
			$display = "block";
			$colspan = "";
		} else {
			$display = "none";
			$colspan = "colspan =2";
		}?>
		<td colspan="2">
			<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
				<TR>
					<TD width="140">
						<input type=radio name='form_sendmail_use' value='1' <?if($data[form_sendmail_use] == "1") echo "checked"; ?> onclick="javascript:hidden_btn();">사용 안함&nbsp;
						<input type=radio name='form_sendmail_use' value='2' <?if($data[form_sendmail_use] == "2") echo "checked"; ?> onclick="javascript:show_btn();">사용&nbsp;
					</TD>
					<TD id="detail_search" style='display:<?=$display?>'>&nbsp;&nbsp;&nbsp;메일주소&nbsp;<input type=text name='form_sendmail_addr' value='<?=base64_decode($data[form_sendmail_addr])?>' size=25 maxlength=40 class=input18n_ph title='메일 주소 입력'></TD>
				</TR>
			</TABLE>
		</td>
	</tr>
	<tr>
		<td>SMS 수신&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_sms_use' value='1' <?if($data[form_sms_use] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_sms_use' value='2' <?if($data[form_sms_use] == "2") echo "checked"; ?>>사용&nbsp;
		</td>
	</tr-->
	<tr>
		<td>사용자&nbsp;</td>
		<td colspan="2">
			<input type=radio name='form_user_use' value='2' <?if($data[form_user_use] == "2") echo "checked"; ?>>일반인&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type=radio name='form_user_use' value='3' <?if($data[form_user_use] == "3") echo "checked"; ?>>회원&nbsp;
		</td>
	</tr>
	<tr>
		<td><input type=text name='form_text1_name' value='<?=$form_text1[0]?>' size=15 maxlength=20 class=input18n_ph title='텍스트1 타이틀명'>&nbsp;</td>
		<td>
			<input type=radio name='form_text1_chk' value='1' <?if($form_text1[1] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_text1_chk' value='2' <?if($form_text1[1] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_text1_chk' value='3' <?if($form_text1[1] == "3") echo "checked"; ?>>필수 사용
		</td>
		<td>&nbsp;(단문사용시)</td>
	</tr>
	<tr>
		<td><input type=text name='form_textarea1_name' value='<?=$form_textarea1[0]?>' size=15 maxlength=20 class=input18n_ph title='코멘트1 타이틀명'>&nbsp;</td>
		<td>
			<input type=radio name='form_textarea1_chk' value='1' <?if($form_textarea1[1] == "1") echo "checked"; ?>>사용 안함&nbsp;
			<input type=radio name='form_textarea1_chk' value='2' <?if($form_textarea1[1] == "2") echo "checked"; ?>>사용&nbsp;
			<input type=radio name='form_textarea1_chk' value='3' <?if($form_textarea1[1] == "3") echo "checked"; ?>>필수 사용
		</td>
		<td>&nbsp;(장문사용시)</td>
	</tr>
	<tr>
		<td>약관내용&nbsp;</td>
		<td colspan="2"><textarea name='form_stipulation' rows='7' style='width:95%;' title="약관 내용을 입력하세요"><?=$data[form_stipulation]?></textarea></td>
	</tr>
</table>
<br>
<table width="100%" align="center">
	<tr>
		<td align=center><input type="submit" value=" 설 정 " class="button"></td>
	</tr>
</table>
</form>

<script> 
function show_btn(){
	if(detail_search.style.display == "none")
		detail_search.style.display = "block";
}

function hidden_btn(){
	if(detail_search.style.display == "block")
		detail_search.style.display = "none";
}
</script>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>