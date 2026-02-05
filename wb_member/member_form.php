<script src="./jquery.placeholder.js"></script>




 <style>


.onlinesd_fom_table{ border-top:1px solid #0099cc;  margin:20px 3% 20px 3%;}
.onlinesd_fom_table td{ border-bottom:1px solid #ccc;}
.onlinesd_fom_table td.onsc_font1{background-color:#f4f4f4; font-weight:bold; color:#000; font-size:12px;}
.onlinesd_fom_table td.onsc_font2{border-bottom:1px solid #ccc;}
.onlinesd_fom_table th{background-color:#f6f9ff; border-bottom:1px solid #ccc;}

.onsc_font3{ border:1px solid #ccc; height:23px; width:50%; float:left; margin-left:2%; text-align:center;}
.onsc_font3:invalid{ background-color:#fff;}

.onsc_font4{ border:1px solid #ccc; height:23px; width:20%; float:left; text-align:center;}
.onsc_font4:invalid{ background-color:#fff;}
.gmbs{float:left; padding:5px 1% 0 1%; }






.onsc_font5{ border:1px solid #ccc; height:27px; width:25%; float:left; margin-left:2%;}
.onsc_font5:invalid{ background-color:#fff;}

.onsc_font6{ border:1px solid #ccc; height:23px; width:70%; float:left; margin-left:2%; text-align:center;}
.onsc_font6:invalid{ background-color:#fff;}
.onsc_font7{ border:1px solid #ccc; height:70px; width:90%; float:left; margin-left:2%; text-align:center;}
.onsc_font7:invalid{ background-color:#fff;}

 </style>






<div style="margin:0 3% 0 3%; width:94%; height:auto; float:left; text-align:right; "><span style="float:right; line-height:30px;">필수 입력</span><span style="color:red; font-weight:bold; font-size:20px; float:right; vertical-align:top;  padding-top:6px;">*</span></div>



<? if($member_form['licen'] == 1 || $member_form['cnfrm'] == 1) { ?>
<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="94%">

	<? if($member_form['licen'] == 1) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		회원구분</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<? if($mode == "member_join") { 
			$chkeds = "checked";
			
		}?>


		<label><input name="mb_licen" type="radio" value="1" onclick="bisnnom(this.value);" <?if($data['mb_licen'] == "1"){echo "checked";}?> <?=$chkeds?>> 개인회원</label>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<label><input name="mb_licen" type="radio" value="2" onclick="bisnnom(this.value);" <?if($data['mb_licen'] == "2"){echo "checked";}?>> 사업자회원</label>

		
		</td>
	</tr>



	<?
	if($mode != "member_join") {	
		if($data['mb_licen'] == "2"){
			$vi_dis = "display:table-row;";
		}else{
			$vi_dis = "display:none;";
		}
	}else{
		$vi_dis = "display:none;";
	}?>
	<tr id="bisg" style="<?=$vi_dis?>">
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		상호명</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		
		<input type="text" class="onsc_font3" name="mb_busin"  maxlength="20" value="<?=$data['mb_busin']?>">	

	
		</td>
	</tr>

	<?
		$businnum_row = explode("-",$data['mb_businnum']);
	?>

	<tr id="bisg2" style="<?=$vi_dis?>">
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		사업자번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		
			<input type="text" class="onsc_font4" name="mb_businnum1" id="mb_businnum1" style=" margin-left:2%;" maxlength="3" value="<?=$businnum_row[0]?>" onkeyup="onumbs('mb_businnum1');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_businnum2" id="mb_businnum2" maxlength="2" value="<?=$businnum_row[1]?>" onkeyup="onumbs('mb_businnum2');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_businnum3" id="mb_businnum3" maxlength="5" value="<?=$businnum_row[2]?>" onkeyup="onumbs('mb_businnum3');">

	
		</td>
	</tr>






	<?}?>



	<? if($member_form['cnfrm'] == 1) { ?>

	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		본인인증</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		<input type="button" value="휴대폰인증" style="color:#fff; background-color:#000; border:0; font-size:12px; width:80px; height:27px; float:left; margin-left:2%;"  onClick="jsSubmit();">

		<input type="hidden" name="mb_own">

		
		</td>
	</tr>
	<?}?>

	</table>
<?}?>


	






<div style="width:94%; height:auto; float:left; font-size:14px; padding:0 3% 10px 3%;">※ 기본정보</div>

<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="94%">
	
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		아이디</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<? if($mode=="member_join") { ?>
		
		<input type="text" class="onsc_font3" name="mb_id"  maxlength="20" onkeyup="idchkno();">

		<input type="hidden" name="mb_id_chk" id="mb_id_chk">


		<input type="button" value="중복검색" style="color:#fff; background-color:#000; border:0; font-size:12px; width:80px; height:27px; float:left; margin-left:2%;" onclick="javascript:search_mb_id('<?=$_url['member']?>','member_form|mb_id',document.member_form.mb_id.value);">

		<?} else {?>
			<?=$data['mb_id']?>
		<? } // end if member_join ?>
		</td>
	</tr>



	<tr>
		<td width="25%" height="50" class="onsc_font1">&nbsp;&nbsp;


		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		
		비밀번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input name="mb_pass" type="password" class="onsc_font3" maxbyte="12" minbyte="4">
		<span class="j_notice" style="width:98%; float:left;padding-left:2%;">*(영문,숫자 7자리 이상)</span>
		</td>
	</tr>



	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		비밀번호확인</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input type="password" class="onsc_font3" name="mb_pass1"/>		
		</td>
	</tr>


	<? if($member_form['mb_name']!=0) { ?>
	<tr>
		<td width="25%" height="50" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_name] == 2){?>
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;

		<?}?>

		이름</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		



		<? if($mode=="member_join") { ?>
			<input type="text" class="onsc_font3" name="mb_name" maxlength="20" minbyte="2" />
			<label><input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> /> 공개</label></br>
			<span class="j_notice" style="width:98%; float:left;padding-left:2%;">
				공백없이 한글로만 입력해주세요.
			</span>
		<? } else { ?>
			<?=$data['mb_name']?>
			<label><input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> /> 공개</label>
		<? } // end if member_join ?>

		
		</td>
	</tr>
	<? } // end if mb_name ?>


	<? if($member_form['mb_nick']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		<?if($member_form[mb_nick] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;

		<?}?>
		
		닉네임</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input name="mb_nick" type="text" class="onsc_font3" id="mb_nick" value="<?=$data['mb_nick']?>" size="20" maxlength="20" minbyte="2">

		</td>
	</tr>
	<? } // end if mb_nick ?>


	<? if($member_form['mb_email']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_email] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		이메일</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input type="text" class="onsc_font3" name="mb_email" maxlength="100" value="<?=$data['mb_email']?>">
			<label><input type="checkbox" name="of[mb_email]" value="1" <?=$c_of['mb_email']?> /> 공개</label>
		</td>
	</tr>
	<? } // end if mb_email ?>




	<? if($member_form['mb_tel1']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_tel1] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		
		전화번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input type="text" class="onsc_font4" name="mb_tel11" id="mb_tel11" style=" margin-left:2%;" maxlength="4" value="<?=$data['mb_tel11']?>" onkeyup="onumbs('mb_tel11');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_tel12" id="mb_tel12" maxlength="4" value="<?=$data['mb_tel12']?>" onkeyup="onumbs('mb_tel12');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_tel13" id="mb_tel13" maxlength="4" value="<?=$data['mb_tel13']?>" onkeyup="onumbs('mb_tel13');">

			<label><input type="checkbox" name="of[mb_tel1]" value="1" <?=$c_of['mb_tel1']?> /> 공개</label>

		</td>
	</tr>
	<? } // end if mb_email ?>


	<? if($member_form['mb_tel2']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		<?if($member_form[mb_tel2] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		핸드폰번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input type="text" class="onsc_font4" name="mb_tel21" id="mb_tel21" style=" margin-left:2%;" maxlength="4" value="<?=$data['mb_tel21']?>" onkeyup="onumbs('mb_tel21');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_tel22" id="mb_tel22" maxlength="4" value="<?=$data['mb_tel22']?>" onkeyup="onumbs('mb_tel22');">
			<span class="gmbs">-</span>
			<input type="text" class="onsc_font4" name="mb_tel23" id="mb_tel23" maxlength="4" value="<?=$data['mb_tel23']?>" onkeyup="onumbs('mb_tel23');">
			<label><input type="checkbox" name="of[mb_tel2]" value="1" <?=$c_of['mb_tel2']?> /> 공개</label>




			

		</td>
	</tr>
	<? } // end if mb_tel2 ?>





	<? if($member_form['mb_address']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_address] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		우편번호</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input type="text" class="onsc_font5" name="mb_post1" id="mb_post1" style="text-align:center;" size="6" maxlength="6" value="<?=$data['mb_post']?>" onkeyup="onumbs('mb_post1');">			

			<input type="button" value="주소검색" style="color:#fff; background-color:#000; border:0; font-size:12px; width:80px; height:27px; float:left; margin-left:2%;" onclick="javascript:openDaumPostcode();">
			<label><input type="checkbox" name="of[mb_post]" value="1" <?=$c_of['mb_post']?> /> 공개</label>
		</td>
	</tr>


	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_address] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		주소</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input name="mb_address1" type="text" class="onsc_font6" id="mb_address1" value="<?=$data['mb_address1']?>" size="50">
		</td>
	</tr>


	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_address] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>

		상세주소</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;
		<input name="mb_address2" type="text" class="onsc_font6" id="mb_address2" value="<?=$data['mb_address2']?>" size="35">

		</td>
	</tr>
	<? } // end if mb_address ?>




	<? if($member_form['mb_signature']!=0) { ?>
	<tr>
		<td width="25%" height="100" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[mb_signature] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>

		서명</td>
		<td width="75%" class="onsc_font2">

			<textarea name="mb_signature" cols="60" rows="3" class="onsc_font7"><?=$data['mb_signature']?></textarea>		
			
			<span class="j_notice" style="width:98%; padding-left:2%; float:left;">
				본인이 작성한 글 하단에 표시됩니다.
			</span>
		
		
		</td>
	</tr>
	<? } // end if mb_signature ?>


	<? if($member_form['mb_introduce']!=0) { ?>
	<tr>
		<td width="25%" height="100" class="onsc_font1">&nbsp;&nbsp;
		<?if($member_form[mb_introduce] == 2){?>
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		
		자기소개</td>
		<td width="75%" class="onsc_font2">
			<textarea name="mb_introduce" cols="60" rows="3" class="onsc_font7"><?=$data['mb_introduce']?></textarea>		
			
			<span class="j_notice" style="width:98%; padding-left:2%; float:left;">
				정보공개한 경우 다른 사람이 볼수 있습니다.
			</span>		
		</td>
	</tr>
	<? } // end if mb_introduce ?>
	


	<? if($member_form['icon1']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[icon1] == 2){?>
		<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>
		회원아이콘</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;


		<input type="file" name="mb_files[icon1]" id="icon1" class="onsc_font3 " size="30" hname="회원아이콘">

		<? if($data['mb_files']['icon1']['name']!='') { ?>
			<?=$data['mb_files']['icon1']['name']?>
			<label><input type="checkbox" name="mb_files_del[icon1]" value="1" />삭제</label>
		<? } ?>

		
		</td>
	</tr>
	<? } // end if icon1 ?>



	<? if($member_form['photo1']!=0) { ?>
	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		<?if($member_form[photo1] == 2){?>
			<span style="color:red; font-weight:bold; font-size:20px; vertical-align:middle;">*</span>&nbsp;
		<?}?>

		사진</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		<input type="file" name="mb_files[photo1]" id="photo1" class="onsc_font3" size="30" hname="사진" <?=$required['photo1']?> />
			<label><input type="checkbox" name="of[photo1]" value="1" <?=$c_of[photo1]?> /> 공개</label>
			<? if($data['mb_files']['photo1']['name']!='') { ?>
				<?=$data['mb_files']['photo1']['name']?>
				<label><input type="checkbox" name="mb_files_del[photo1]" value="1" /> 삭제</label>
			<? } ?>

		
		</td>
	</tr>
	<? } // end if photo1 ?>


	<tr>
		<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;
		
		수신여부</td>
		<td width="75%" class="onsc_font2">&nbsp;&nbsp;

		<label><input name="mb_is_mailing" type="checkbox" id="mb_is_mailing" value="1" <?=$c_mb_is_mailing[1]?> checked/> 메일수신</label>
		<label><input name="mb_is_sms" type="checkbox" id="mb_is_sms" value="1" <?=$c_mb_is_sms[1]?> checked/> SMS수신</label>

		
		</td>
	</tr>


</table>
