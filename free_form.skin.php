

<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="100%">
	<? if($data[form_name_use] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;회사명</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input maxlength=20 size=20 id="" name="free_form_name" class="onsc_font3" value="<?=$_mb[mb_name]?>" style='<? if ($_mb) { echo "background-color:#ffffff;"; } ?>' <?=$required['form_name_use']?> <? if ($_mb) { echo "readonly"; } ?>><? if ($_mb=='') { echo "<span style='float:left; padding:8px 0 0 2%;'>(공백없이 한글만 입력 가능)</span>"; } ?>
		</td>
	</tr>
	<?}?>

	<? if($data[form_email_use] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;E-mail</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<? $form_email = explode("@", $_mb[mb_email]);?>
		<input type=text name='free_form_email1' class="onsc_font4" style=" margin-left:2%;" value='<?=$form_email[0]?>' size=15 maxlength=20 <?=$required['form_email_use']?> hname='이메일 ID'>
		<span class="gmbs">@</span>

		<input type=text name='free_form_email2' class="onsc_font4" value='<?=$form_email[1]?>' size=15 maxlength=50 <?=$required['form_email_use']?> hname='이메일 도메인' >  
		


		<select name="xxx_mail_server" class="onsc_font5" onChange="javascript:this.form.free_form_email2.value=this.value;">
			<option value="">직접입력</option>
			<option value="naver.com">naver.com</option>
			<option value="daum.net">daum.net</option>
			<option value="hotmail.com">hotmail.com</option>
			<option value="nate.com">nate.com</option>
			<option value="yahoo.co.kr">yahoo.co.kr</option>
			<option value="paran.com">paran.com</option>
			<option value="empas.com">empas.com</option>
			<option value="dreamwiz.com">dreamwiz.com</option>
			<option value="freechal.com">freechal.com</option>
			<option value="lycos.co.kr">lycos.co.kr</option>
			<option value="korea.com">korea.com</option>
			<option value="gmail.com">gmail.com</option>
			<option value="hanmir.com">hanmir.com</option>
		</select>


		</td>
	</tr>
	<?}?>

	<? if($data[form_telno_use] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;전화번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		
		<? $form_telno = explode("-", $_mb[mb_tel1]);?>
		<input type=text name='free_form_telno1' value='<?=$form_telno[0]?>' size=3 maxlength=3 <?=$required['form_telno_use']?> hname='전화번호(지역번호)'  class="onsc_font4" style=" margin-left:2%;">
		<span class="gmbs">-</span>
		<input type=text name='free_form_telno2' class="onsc_font4" value='<?=$form_telno[1]?>' size=3 maxlength=4 <?=$required['form_telno_use']?> hname='전화번호(국번)'>
		<span class="gmbs">-</span>
		<input type=text name='free_form_telno3' class="onsc_font4" value='<?=$form_telno[2]?>' size=3 maxlength=4 <?=$required['form_telno_use']?> hname='전화번호'> 			
		</td>
	</tr>
	<?}?>

	<? if($data[form_hpno_use] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;핸드폰번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		
		<? $form_hpno = explode("-", $_mb[mb_tel2]);?>
		<input type=text name='free_form_hpno1' value='<?=$form_hpno[0]?>' size=3 maxlength=3 <?=$required['form_hpno_use']?> hname='핸드폰(식별번호)'  class="onsc_font4" style=" margin-left:2%;">
		<span class="gmbs">-</span>
		<input type=text name='free_form_hpno2' value='<?=$form_hpno[1]?>' size=3 maxlength=4 <?=$required['form_hpno_use']?> hname='핸드폰(국번)'  class="onsc_font4">
		<span class="gmbs">-</span>
		<input type=text name='free_form_hpno3' value='<?=$form_hpno[2]?>' size=3 maxlength=4 <?=$required['form_hpno_use']?> hname='핸드폰(번호)'  class="onsc_font4"> 	
				
		</td>
	</tr>
	<?}?>


	<? if($data[form_addr_use] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;우편번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input type=text name='free_form_zip1' id="free_form_zip1" class="onsc_font3" value='<?=$_mb['mb_post']?>'  size=3 maxlength=5 readonly >

		<input type="button" value="주소검색" style="color:#fff; background-color:#000; border:0; font-size:12px; width:80px; height:27px; float:left; margin-left:2%;" onclick="javascript:openDaumPostcode();">

		</td>
	</tr>

	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;주소</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		<input type=text name='free_form_address1' id="free_form_address1" value='<?=$_mb['mb_address1']?>' size=30 maxlength=100 class="onsc_font6" readonly>


		</td>
	</tr>

	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;상세주소</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		<input type=text name='free_form_address2' id="free_form_address2" value='<?=$_mb['mb_address2']?>' size=18 maxlength=100 class="onsc_font6" <?=$required['form_addr_use']?> hname='주소(상세주소)' >

		

		</td>
	</tr>
	<?}?>






	<? if($form_text1[1] > 1){ ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;<?=$form_text1[0]?></td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		
		<input type=text name=free_form_text1 value='' size=51 maxlength=70 <? if($form_text1[1] == "3") echo "required"; ?> hname='<?=$form_text1[0]?>'  class="onsc_font6">

		</td>
	</tr>
	<?}?>


	<? if($form_textarea1[1] > 1){ ?>
	<tr>
		<td width="25%" height="80" class="onsc_font1">&nbsp;&nbsp;<?=$form_textarea1[0]?></td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<textarea name=free_form_textarea1  class="onsc_font7" <? if($form_textarea1[1] == "3") echo "required"; ?> hname='<?=$form_textarea1[0]?>'></textarea>
		
		</td>
	</tr>
	<?}?>



</table>