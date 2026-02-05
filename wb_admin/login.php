<?
	include_once("../wb_include/lib.php");
	include("_header.php");

	if($ret_url) {
		$return_url = $ret_url;
	} else {
		$return_url = $_url['admin']."index.php";
	}
?>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">  
  <tr>
    <td height="100">&nbsp;</td>
  </tr>
  <tr>
    <td height="500" align="center" valign="top" background="images/login_bg.gif" style="padding-top:160px; background-repeat:repeat-x">
		<form name="login_form" method="post" action="<?=$_url['member']?>login.php" onSubmit="return validate(this)" enctype="multipart/form-data">
		<input type="hidden" name="form_mode" value="member_login_ok">
		<input type="hidden" name="back_url_login" value="<?=$_url['admin']?>index.php">
		<input type="hidden" name="ret_url" value="<?=$return_url?>">
			<table align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td height="40" valign="top"> <img src="images/logo_text.gif" border="0"></td>
				</tr>
				<tr>
					<td><table align="center" border="0" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
                        <tr>
                          <td height="30" align="right"> ID&nbsp;</span></td>
                          <td><input type="text" name="mb_id" size="20" maxlength="20" minlength="2" required="required" hname="아이디" class="input" /></td>
                          <td width="40" align="center">pw</td>
                          <td><input type="password" name="mb_pass" size="20" maxlength="20" required="required" hname="암호" class="input" /></td>
                          <td style="padding-left:5px"><input type="image" src="images/btn_ok.gif" value=" 확 인 "/></td>
                        </tr>
						<tr>
                          <td colspan="5" height="70" align="center" valign="middle"><a href="http://wbg.co.kr" target="_blank">POWERED BY WEBBRIDGE</a></td>
                        </tr>
                      </table></td>
				  </tr>
				</table>               
</form>		</td>
  </tr>
</table>


<script language='Javascript'>
	document.login_form.mb_id.focus();
</script>

<? include("_footer.php"); ?>