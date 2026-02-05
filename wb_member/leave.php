<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 :
2007-07-27 주민등록번호 체크 기능 제외
 ===================================================== */
	include_once("../wb_include/lib.php");
	
	if(!$_mb)
		rg_href($_url['member'].'login.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='leave_ok') {
		$mb_id=strtolower($mb_id);
		$mb_jumin = $mb_jumin1.$mb_jumin2;

		if($_mb['mb_id']!=$mb_id)
			rg_href('','자신의 아이디를 입력하세요.','back');

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');	

//		if(!$validate->jumin($mb_jumin,'jumin'))
//			rg_href('','주민등록 번호를 정확히 입력해주세요.','back');

//		$mb_jumin = get_password_str($mb_jumin);
		$mb_pass = get_password_str($mb_pass);
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
//		$rs->add_where("mb_jumin='".$dbcon->escape_string($mb_jumin)."'");
		$rs->add_where("mb_pass='".$dbcon->escape_string($mb_pass)."'");
		$rs->select();
		if($rs->num_rows()==0) // 입력정보가 올바르지 않다
			rg_href('','입력하신 정보를 확인 하세요.','back');

		if($_site_info['leave_state']==1) {
			$data=$rs->fetch();
			// 파일삭제하고
			$data['mb_files']=unserialize($data['mb_files']);
			upload_file_delete($_path['member_data'],$data['mb_files']); // 파일삭제
			// 회원정보 삭제
			$rs->delete();
			// 포인트 지우고
			$rs->clear();
			$rs->set_table($_table['point']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
			// 쪽지 지우고			
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
		} else {
			$rs->add_field("mb_state","3");
			$rs->update();
		}
		
		$ss_mb_id = '';
		$ss_mb_num = '';
		$ss_login_ok = '';
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		
//				if (!file_exists($skin_site_path."mb_join_ok.php")) 
		if($ret_url=='') $ret_url='../main/index.php';
		$rs->commit();
		rg_href($ret_url,'탈퇴되었습니다.');
	}

	$c_mb_is_mailing[$data['mb_is_mailing']]='checked';
	$c_mb_is_opening[$data['mb_is_opening']]='checked';
?>
<? include_once($_path['member'].'_header.php'); ?>




<div class="login_new3">

	<form action="?" method="post" enctype='multipart/form-data' name="leave_form" id="leave_form" onsubmit="return validate(this)">
		<input type="hidden" name="form_mode" value="leave_ok" />
		<input type="hidden" name="ret_url" value="../index.php" />

	<div class="login_new2">	
		<ul class="login_btn" style="margin:0 18px 0 0;">
			<li style="width:100%; height:34px; float:left; line-height:34px; font-size:14px; text-align:left;">&nbsp;&nbsp;아이디</li>
			<li style="width:100%; height:34px; float:left; line-height:34px; font-size:14px; margin-top:2px; text-align:left;">&nbsp;&nbsp;비밀번호</li>
			<li style="width:100%; height:34px; float:left; line-height:34px; font-size:14px; margin-top:2px; text-align:left;">&nbsp;&nbsp;이름</li>
		</ul>



		<ul class="login_fom" style="height:auto;">
			<li><input type="text" class="fom_syl" name="mb_id" maxlength="12" hname="아이디" value="" required="required" option="userid" tabindex="1" style="background-color:#fff;"></li>
			<li style="margin-top:2px;"><input type="password" name="mb_pass" class="fom_syl" required="required" hname="암호" tabindex="2" style="background-color:#fff;"></li>
			<li style="margin-top:2px;"><input type="text" class="fom_syl" name="mb_name" maxlength="12" hname="이름" required="required" tabindex="2" style="background-color:#fff;"></li>
		</ul>
		


		<ul style="width:100%; float:left;">
			<li style="width:100%; float:left; padding:5px 0 5px 0;">
				<input type="submit" class="login_btn_new" value="탈퇴" style="width:100%; height:32px;">
				
			</li>
		</ul>

		<ul style="width:100%; float:left;">
			<li style="width:100%; float:left; padding:5px 0 5px 0; font-size:14px; font-weight:bold;">
			
				<? 
					if($_site_info['leave_state']==1) { 
						echo "※ 탈퇴하시면 회원정보가 즉시 삭제됩니다."; 
					}else {
						echo "※ 탈퇴하시면 관리자 확인후 처리됩니다.";
					}
				?>
			</li>
		</ul>
		
	</div>

	</form>
</div>
<? include_once($_path['member'].'_footer.php'); ?>
