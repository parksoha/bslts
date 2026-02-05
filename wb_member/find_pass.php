<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 :
  작성일 :
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 :
 ===================================================== */
/*
[암호 찾기]
1. 아이디,이름,주민번호를 입력
2. 회원이메일의 이메일 @ 앞부분중 뒷자리 3자리를 * 로 변경한뒤 보여준다
3. 확인후 발송 버튼을 누른다.
*/
	include_once("../wb_include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$mb_id=strtolower($mb_id);
		$mb_email = strtolower($mb_email);

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if($validate->is_empty($mb_name))
			rg_href('','이름을 확인해주세요.','back');

		if($validate->is_empty($mb_email) || !$validate->email($mb_email))
			rg_href('','이메일을 확인해주세요.','back');

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
		$rs->add_where("mb_email='".$dbcon->escape_string($mb_email)."'");
		$rs->select();
		if($rs->num_rows()==0) // 가입되지 않았다.
			rg_href('','가입되어 있지 않습니다.','back');

		$find_pass_data=$rs->fetch();

		switch($find_pass_data['mb_state']) {
			case 1 : // 승인된 아이디
				break;
			case '0' : 
				rg_href('','승인대기중입니다.','back');		
				break;
			case '2' : 
				rg_href('','미승인된 아이디 입니다.','back');		
				break;
			case '3' : 
				rg_href('','탈퇴된 아이디입니다.\n재가입을 원할경우 관리자에게 메일주십시요.','back');	
				break;
			default :
				rg_href('','알수없는 오류 관리자에게 연락 바랍니다.','back');	
				break;
		}
		if($form_mode=='find_pass_email_ok') {
			extract($find_pass_data);
			$mb_pass=rg_get_uniqid(6);

			$rs->add_field("mb_pass",get_password_str("$mb_pass"));
			$rs->update();
			
			$mail_to = "$mb_email";
			$mail_subject = "[{$mb_name}]님께서 문의하신 내용의 답변입니다.";
			$mail_from = $_site_info['mail_from'];
			$mail_return=$_site_info['mail_return'];
	
			ob_start();
			include($_path['mail_form'].'member_find_pass.php');
			$mail_message=ob_get_contents();
			ob_end_clean();
			$mail_message=str_replace('../','http://'.$_SERVER['HTTP_HOST'].'/',$mail_message);
			
			$rs->commit();
			if($ret_url=='') $ret_url='../main/index.php';
			if(rg_mail($mail_to,$mail_subject,$mail_message,$mail_from,$mail_return)) {
				rg_href($ret_url,'이메일 전송에 성공 했습니다.\n이메일을 확인 하신후 로그인 하세요.');
			} else {
				rg_href($ret_url,'이메일 전송에 실패 했습니다.\n관리자에게 문의 하십시요.');
			}
		}
	}
?>
<? include_once($_path['member'].'_header.php'); ?>
		<?
			if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='find_pass_ok') {
				list($email_id,$email_domain)=explode('@',$find_pass_data['mb_email']);

				$email_id[strlen($email_id)-1]='*';
				$email_id[strlen($email_id)-2]='*';
				$email_id[strlen($email_id)-3]='*';
		?>








<div class="login_new5">

	<form action="?" method="post" enctype='multipart/form-data' name="search_id_form" id="search_id_form" onsubmit="return validate(this)">
			<input type="hidden" name="form_mode" value="find_pass_email_ok" />
			<input type="hidden" name="ret_url" value="<?=$ret_url?>" />
			<input type="hidden" name="mb_id" value="<?=$mb_id?>" />
			<input type="hidden" name="mb_name" value="<?=$mb_name?>" />
			<input type="hidden" name="mb_email" value="<?=$mb_email?>" />

	<div class="login_new4">
		<span style="width:100%; height:auto; float:left; font-size:14px; text-align:center;">
		입력하신 정보와 일치하는 회원의 이메일 주소입니다.
		</span>

		<span style="width:100%; height:auto; float:left; font-size:14px; text-align:center; margin:15px 0 15px 0; font-weight:bold;">
		<?=$email_id?>@<?=$email_domain?>
		</span>		


		<span style="width:100%; height:auto; float:left; font-size:14px; text-align:center;">
		개인정보 도용에 따른 피해방지를 위해 끝3자리는 '*'로 표시합니다. <br />
		암호는 암호화 되어 있어 확인이 불가능합니다. <br />
		아래 &quot;이메일로받기&quot;버튼을 클릭 하시면 임시 암호를 이메일로 전송해 드립니다. <br />
		암호가 변경되어 전송되기 때문에 이메일을 확인후 변경된 암호로 로그인 하셔야 합니다.
		</span>		

		<span style="width:100%; height:auto; float:left; text-align:center; margin:15px 0 10px 0;"><input type="submit" value="이메일로받기" class="next ok_btn_sty3"></span>



		<ul class="ser_joy2">
			
			<li style="margin:0 5px 0 0;" onclick='location.href="<?=$_path['member']?>find_id.php"'>아이디찾기</li>
			<li style="margin:0 0 0 5px;" onclick='location.href="<?=$_path['member']?>join.php"'>회원가입</li>
		</ul>		
		
	</div>

	</form>
</div>
















		<? } else { ?>










<div class="login_new3">

		<form action="?" method="post" enctype='multipart/form-data' name="search_id_form" id="search_id_form" onsubmit="return validate(this)">
			<input type="hidden" name="form_mode" value="find_pass_ok" />
			<input type="hidden" name="ret_url" value="../index.php" />

		<div class="login_new2">	
			<ul class="login_fom" style="height:auto;">
				<li><span style="width:60px; float:left; height:34px; line-height:34px; text-align:center; font-weight:bold; font-size:12px;">아이디</span>
				<input type="text" id="mb_id" class="fom_syl2" name="mb_id" hname="아이디" value="" required option="userid" tabindex="1"  style="ime-mode:active; "/>
				
				</li>


				<li style="margin-top:2px;"><span style="width:60px; float:left; height:34px; line-height:34px; text-align:center; font-weight:bold; font-size:12px;">이름</span>

				<input type="text" id="mb_name" class="fom_syl2" name="mb_name" hname="이름" required tabindex="2" style="ime-mode:active;"/>		
				
				</li>



				<li style="margin-top:2px;"><span style="width:60px; float:left; height:34px; line-height:34px; text-align:center; font-weight:bold; font-size:12px;">이메일</span>

				<input type="text" id="mb_name" class="fom_syl2" name="mb_email" hname="이메일" required tabindex="2" style="ime-mode:active;"/>		
				
				</li>
			</ul>
			<ul class="login_btn">
				<li><input type="submit" value="비밀번호찾기" class="login_btn_new" style="height:106px"></li>
			</ul>
			<ul class="ser_joy2">
				
				<li style="float:left;" onclick='location.href="<?=$_path['member']?>find_pass.php"'>비밀번호찾기</li>
				<li style="float:right;" onclick='location.href="<?=$_path['member']?>join.php"'>회원가입</li>
			</ul>		
		</div>

		</form>
	</div>




<script language='Javascript'>
	if(typeof(document.search_id_form.mb_id) != "undefined")
		document.search_id_form.mb_id.focus();
</script>
<? } ?>
<? include_once($_path['member'].'_footer.php'); ?>
