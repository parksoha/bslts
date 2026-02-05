<style type='text/css'> 
.id_blur { background: transparent url("<?=$skin_url?>images/login_bg.gif") top left} 
.id_focus { background: #ffffe0 ; color: #003300 } 
.pw_blur { background: transparent url("<?=$skin_url?>images/login_bg.gif") bottom left} 
.pw_focus { background: #ffffe0 ; color: #003300 } 
</style> 
<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="member_login_ok">
		<input type="hidden" name="ret_url" value="<?=$ret_url?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;로그인</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td align="center"><input type='text' name='mb_id' onFocus="if ( this.value == '' ) { this.className='id_focus input' }" onBlur="if ( this.value == '' ) { this.className='id_blur input' }" class='id_blur input' size="20" maxlength="20" hname="아이디" required tabindex="111" /></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td align="center"><input type='password' name='mb_pass' onFocus="this.className='pw_focus input'" onBlur="if ( this.value == '' ) { this.className='pw_blur input' }" class='pw_blur input' size="20" required hname="암호" tabindex="112" /></td>
				</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="5"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center"><input name="submit" type="submit" class="button" style="width:100" value="   로그인   " tabindex="113" />
				</td>
			</tr>
			<tr>
				<td height="5"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center">
				<input type="button" class="button" value="회원가입" onClick="location.href='<?=$join_url?>'">
				  <input type="button" class="button" value="암호찾기" onClick="location.href='<?=$password_url?>'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
