<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		unset($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($member_form));
		$rs->add_where("ss_name='member_form'");
		$rs->update();
		
		$rs->commit();
		
		rg_href('?');
	}

	// 사이트 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","member_form");
		$rs->insert();
		$rs->commit();
		
		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
		
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">기본정보 &gt; 회원항목설정</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">회원항목설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb1">
  	<col width="110" align="right" />
    <col align="left" />


	



	<tr>
      <td height="30">&nbsp;&nbsp;회원구분</td>
      <td colspan="3" height="30">&nbsp;<label><input type="radio" name="member_form[licen]" value="1" <?if($member_form[licen] == '1'){echo "checked";}?>>사용</label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="member_form[licen]" value="2" <?if($member_form[licen] == '2'){echo "checked";}?>>미사용</label></td>
		</td>
    </tr>


	<tr>
      <td height="30">&nbsp;&nbsp;이메일인증</td>
      <td colspan="3" height="30">&nbsp;<label><input type="radio" name="member_form[email_cnfrm]" value="1" <?if($member_form[email_cnfrm] == '1'){echo "checked";}?>>사용</label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="member_form[email_cnfrm]" value="2" <?if($member_form[email_cnfrm] == '2'){echo "checked";}?>>미사용</label></td>

    </tr>





	<tr>
      <td height="30">&nbsp;&nbsp;본인인증</td>
      <td width="300" height="30">&nbsp;<label><input type="radio" name="member_form[cnfrm]" value="1" <?if($member_form[cnfrm] == '1'){echo "checked";}?>>사용</label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="member_form[cnfrm]" value="2" <?if($member_form[cnfrm] == '2'){echo "checked";}?>>미사용</label></td>


		
	   <td width="110" height="30">&nbsp;&nbsp;회원사코드</td>
	   <td height="30">&nbsp;<input type="text" name="member_form[cnfrm2]" value="<?=$member_form[cnfrm2]?>" style="width:200px; float:left; height:23px; margin-left:10px; border:1px solid #000;"></td>
    </tr>



<?
	$i=0;
	if(is_array($_const['member_forms'])) 
	foreach($_const['member_forms'] as $k => $v) {
		$i++;
?>
    <tr>
      <td height="30">&nbsp;&nbsp;<?=$v?></td>
      <td colspan="3" height="30">&nbsp;<?=rg_html_radio("member_form[{$k}]",$_const['member_form_state'],$member_form[$k])?></td>
    </tr>
<?
	}
?>




		<tr>
		  <td>&nbsp;&nbsp;이용약관</td>
		  <td colspan="3"><textarea style="width:98%; height:200px; float:left; margin:1%; border:1px solid #000;" name="member_form[agree1]"><?=$member_form[agree1]?></textarea></td>
		</tr>


		<tr>
		  <td>&nbsp;&nbsp;개인정보취급방침</td>
		  <td colspan="3"><textarea style="width:98%; height:200px; float:left; margin:1%; border:1px solid #000;" name="member_form[agree2]"><?=$member_form[agree2]?></textarea></td>
		</tr>




	</table>
  <br>
  <table width="100%" align="center">
    <tr>
      <td align=center><input type="submit" value=" 설 정 " class="button">
      </td>
    </tr>
  </table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
