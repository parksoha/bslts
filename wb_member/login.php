<?

	include_once("../wb_include/lib.php");
	

	if(isset($logout)) {
		$ss_mb_id='';
		$ss_mb_num='';
		$ss_login_ok='';
		$ss_hash='';
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		$_SESSION['ss_hash']=$ss_hash;
		unset($_SESSION['ss_mb_id']);
		unset($_SESSION['ss_mb_num']);
		unset($_SESSION['ss_login_ok']);
		unset($_SESSION['ss_hash']);
		if($ret_url=='') $ret_url='../index.php';

		if($admin == "1"){
			rg_href("/wb_admin");
		}else{
			rg_href($ret_url);
		}
	}

	if($_SESSION['ss_login_ok']) {
		if($ret_url=='') $ret_url='../index.php';
		rg_href($ret_url);
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_login_ok') {
		$mb_id=strtolower($mb_id);
		
		$ret_url_login='?ret_url=' . urlencode($ret_url);

		if($back_url_login) $ret_url_login= $back_url_login;

		if(!$validate->userid($mb_id))
			rg_href($ret_url_login,'아이디를 확인해주세요.');

		if(!$validate->strlen_chk($mb_pass,4,12))
			rg_href($ret_url_login,'암호를 확인해주세요.');

		$mb_pass = get_password_str($mb_pass);

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->select();
		if(!$rs->num_rows()) //
			rg_href($ret_url_login,'가입되지 않은 아이디 입니다1.');

		$data=$rs->fetch();
		if($data['mb_pass']!=$mb_pass) {
			rg_href($ret_url_login,'암호를 정확히 입력하세요.');
		}

		switch($data['mb_state']) {
			case 1 : // 승인된 아이디
				break;
			case '0' :
				rg_href($ret_url_login,'승인대기중입니다. 입력하신 이메일에서 인증해주세요.');
				break;
			case '2' :
				rg_href($ret_url_login,'미승인된 아이디 입니다.');
				break;
			case '3' :
				rg_href($ret_url_login,'탈퇴된 아이디입니다.\n재가입을 원할경우 관리자에게 메일주십시요.');
				break;
			default :
				rg_href($ret_url_login,'알수없는 오류 관리자에게 연락 바랍니다.');
				break;
		}
		$login_date=time();
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("login_count",$data['login_count']+1);
		$rs->add_field("login_date",$login_date);
		$rs->add_field("login_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_where("mb_num={$data['mb_num']}");
		$rs->update();

		// 지난 로그인 날자와 현재 로그인 날자가 다르다면 로그인 포인트 올린다.
		if(floor($data['login_date']/86400) < floor(time()/86400))
			set_point($data['mb_num'],$_po_type_code['etc'],
								$_site_info['login_point'],'로그인','로그인포인트','');

		$ss_mb_id = $data['mb_id'];
		$ss_mb_num = $data['mb_num'];
		$ss_login_ok = 'ok';
		// 로그인 체크방법 해쉬데이타 로그인시간,아이디,회원번호로 체크
		$ss_hash = md5($login_date.$data['mb_id'].$data['mb_num']);
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		$_SESSION['ss_hash']=$ss_hash;
		$rs->commit();
		if($ret_url=='') $ret_url='../index.php';
			rg_href($ret_url);
	}
?>
<? include ($_path['member'].'_header.php'); ?>



<div class="login_new3">

	<form action="?" method="post" enctype='multipart/form-data' name="login_form" id="login_form" onsubmit="return validate(this)">
		<input type="hidden" name="form_mode" value="member_login_ok" />
		<input type="hidden" name="ret_url" value="<?=$ret_url?>" />

	<div class="login_new2">	
		<ul class="login_fom">
			<li><input type="text" class="fom_syl" name="mb_id"></li>
			<li style="margin-top:2px;"><input type="password" name="mb_pass" class="fom_syl"></li>
		</ul>
		<ul class="login_btn">
			<li><input type="submit" value="Log In" onfocus="document.loginForm.pwd.focus();" class="login_btn_new"></li>
		</ul>
		<ul class="ser_joy">
			<li onclick='location.href="<?=$_path['member']?>find_id.php"'>아이디찾기</li>
			<li style="margin:0 5px 0 5px;" onclick='location.href="<?=$_path['member']?>find_pass.php"'>비밀번호찾기</li>
			<li onclick='location.href="<?=$_path['member']?>join.php"'>회원가입</li>
		</ul>		
	</div>

	</form>
</div>


<? include_once($_path['member'].'_footer.php'); ?>
