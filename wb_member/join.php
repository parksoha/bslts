<?

	include_once("../wb_include/lib.php");



	if($_SESSION['ss_login_ok']) {
		
		rg_href("/");
	}



	
	$mode="member_join";

	// 회원정보 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
	$member_form['mb_pass']='2'; // 가입시 암호는 필수입력항목

	$required=array();
	foreach($member_form as $k => $v) {
		if($v=='2')
			$required[$k] = 'required';
		else
			$required[$k] = '';
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_join_ok') {
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);


		$mb_post=$mb_post1;
		$mb_tel1=$mb_tel11.'-'.$mb_tel12.'-'.$mb_tel13;
		$mb_tel2=$mb_tel21.'-'.$mb_tel22.'-'.$mb_tel23;

		if($mb_post=='-') $mb_post='';
		if($mb_tel1=='--') $mb_tel1='';
		if($mb_tel2=='--') $mb_tel2='';

		$mb_address=$mb_post.$mb_address1.$mb_address2;
		$photo1=$_FILES['mb_files']['name']['photo1'];
		$icon1=$_FILES['mb_files']['name']['icon1'];

		if($_FILES['mb_files']['name']['photo1']) {
			if(!file_type_chk($_FILES['mb_files']['type']['photo1'],'image')) {
				rg_href('','사진은 이미지로 업로드해주세요.','back');
			}
		}

		if($_FILES['mb_files']['name']['icon1']) {
			if(!file_type_chk($_FILES['mb_files']['type']['icon1'],'image')) {
				rg_href('','아이콘은 이미지로 업로드해주세요.','back');
			}
			// 이미지 크기 체크
			$tmp = getimagesize($_FILES['mb_files']['tmp_name']['icon1']);
			if($tmp[0] > 16 || $tmp[1] > 16) {
				rg_href('',"아이콘 크기는 가로세로 16이하로 해주세요.",'','back');
			}
		}

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if(!$validate->strlen_chk($mb_pass,4,12) || $mb_pass!=$mb_pass1)
			rg_href('','암호를 확인해주세요.','back');

		// 필수입력체크
		foreach($member_form as $k => $v) {
			if($v=='2') {
				if($validate->is_empty($$k))
						rg_href('',$_const['member_forms'][$k].'을(를) 입력해주세요.','back');
			}
		}

		if(!$validate->is_empty($mb_name) && !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');

		if(!$validate->is_empty($mb_nick) && !$validate->nickname($mb_nick))
			rg_href('','닉네임을 확인해주세요.','back');


		

		

		$mb_pass = get_password_str($mb_pass);

		$mb_is_mailing	= ($validate->number_only($mb_is_mailing))?$mb_is_mailing:'0';
		$mb_is_sms		= ($validate->number_only($mb_is_sms))?$mb_is_sms:'0';
		$mb_is_opening	= ($validate->number_only($mb_is_opening))?$mb_is_opening:'0';

		$mb_state=$_site_info['join_state'];
		$mb_level=$_site_info['join_level'];
		$mb_point=$_site_info['join_point'];

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='$mb_id'");
		$rs->select();
		if($rs->num_rows()!=0) // 사용하고 있는 아이디
			rg_href('','이미 사용중인 아이디 입니다.','back');

	
		if(is_array($mb_ext1)) $mb_ext1=serialize($mb_ext1);
		if(is_array($mb_ext2)) $mb_ext2=serialize($mb_ext2);
		if(is_array($mb_ext3)) $mb_ext3=serialize($mb_ext3);
		if(is_array($mb_ext4)) $mb_ext4=serialize($mb_ext4);
		if(is_array($mb_ext5)) $mb_ext5=serialize($mb_ext5);
		if(is_array($mb_open_field)) $mb_open_field=serialize($of);



		if($mb_businnum1 != "" && $mb_businnum2 != "" && $mb_businnum3 != ""){
			$mb_businnum = $mb_businnum1."-".$mb_businnum2."-".$mb_businnum3;
		}else{
			$mb_businnum ="";
		}

		//보안코드생성
		srand(time());
		$time = substr(time(),5,5);
		for($i=0;$i<3;$i++)
		{
			$asc=rand()%26+65;
			$c.=chr($asc);
		}
		$iparr = explode(".",$REMOTE_ADDR);
		$mb_code=$c.$time.$iparr[3];




		$rs->clear();
		$rs->set_table($_table['member']);

		$rs->add_field("mb_code","$mb_code");


		$rs->add_field("mb_licen","$mb_licen");

		$rs->add_field("mb_busin","$mb_busin");
		$rs->add_field("mb_businnum","$mb_businnum");

		
		
		$rs->add_field("mb_id","$mb_id");
		$rs->add_field("mb_pass","$mb_pass");
		$rs->add_field("mb_name","$mb_name");
		$rs->add_field("mb_nick","$mb_nick");
		$rs->add_field("mb_level","$mb_level");
		$rs->add_field("mb_state","$mb_state");

		$rs->add_field("mb_sex","$mb_sex");
		$rs->add_field("mb_post","$mb_post");
		$rs->add_field("mb_address1","$mb_address1");
		$rs->add_field("mb_address2","$mb_address2");
		$rs->add_field("mb_email","$mb_email");
		$rs->add_field("mb_tel1","$mb_tel1");
		$rs->add_field("mb_tel2","$mb_tel2");
		$rs->add_field("mb_is_mailing","$mb_is_mailing");
		$rs->add_field("mb_is_sms","$mb_is_sms");
		$rs->add_field("mb_is_opening","$mb_is_opening");
		$rs->add_field("mb_open_field","$mb_open_field");
		$rs->add_field("mb_signature","$mb_signature");
		$rs->add_field("mb_introduce","$mb_introduce");
		$rs->add_field("mb_admin_memo","$mb_admin_memo");
		$rs->add_field("mb_ext1","$mb_ext1");
		$rs->add_field("mb_ext2","$mb_ext2");
		$rs->add_field("mb_ext3","$mb_ext3");
		$rs->add_field("mb_ext4","$mb_ext4");
		$rs->add_field("mb_ext5","$mb_ext5");
		$rs->add_field("mb_point","0");
		$rs->add_field("login_count","0");
		$rs->add_field("login_date","0");
		$rs->add_field("login_ip","");
		$rs->add_field("join_date",time());
		$rs->add_field("join_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_field("modify_date","0");
		$rs->add_field("modify_ip","");
		$rs->insert();
		$mb_num=$rs->get_insert_id();

		// 파일 업로드
		$mb_files=upload_file($_path['member_data'],"mb_files",$mb_num);
		$mb_files=serialize($mb_files);

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_files","$mb_files");
		$rs->add_where("mb_num=$mb_num");
		$rs->update();

		set_point($mb_num,$_po_type_code['etc'],
							$_site_info['join_point'],'회원가입','회원가입포인트','');

		if($_site_info['join_login']=='1') {
			$login_date=time();
			$rs->clear();
			$rs->set_table($_table['member']);
			$rs->add_field("login_count",'1');
			$rs->add_field("login_date",$login_date);
			$rs->add_field("login_ip",$_SERVER['REMOTE_ADDR']);
			$rs->add_where("mb_num=$mb_num");
			$rs->update();

			$ss_mb_id = $mb_id;
			$ss_mb_num = $mb_num;
			$ss_login_ok = 'ok';
			$ss_hash = md5($login_date.$mb_id.$mb_num);

			$_SESSION['ss_mb_id']=$ss_mb_id;
			$_SESSION['ss_mb_num']=$ss_mb_num;
			$_SESSION['ss_login_ok']=$ss_login_ok;
			$_SESSION['ss_hash']=$ss_hash;
		}

		// 가입완료 파일이 없다면 바로 다음으로 넘기고
//				if (!file_exists($skin_site_path."mb_join_ok.php"))




		//이메일 인증 사용시
		if($member_form["email_cnfrm"] == "1"){


			include "../join_email.php";
			
		}



		$rs->commit();
		
		rg_href("/join_success.php?mbnum=".$mb_num."&mbcode=".$mb_code);
	}

?>
<? include_once($_path['member'].'_header.php'); ?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>


<div id="member">
	<form action="?" method="post" enctype='multipart/form-data' name="member_form" id="member_form" onsubmit="return validate(this)">
		<input type="hidden" name="form_mode" value="member_join_ok" />
		<input type="hidden" name="ret_url" value="../index.php" />
		
		
			<div class="member_form">
			<? include('member_form.php') ?>
			</div>


			<div class="member_agree">
				<h3>이용약관</h3>
				<?include('use_info.php');?>
				<label><input type="checkbox" name="use_agree" />위의 '이용약관'에 동의합니다.</label>
				<h3>개인정보취급방침</h3>
				<?include('use_privacy.php');?>
				<label><input type="checkbox" name="privacy_agree" />위의 '개인정보 취급방침'에 동의합니다.</label>
			
			</div>


			<div style="width:100%; height:auto; float:left; text-align:center;"><input type="button" onclick="mir_go();" value="회원가입" style="width:100px; height:30px; background-color:#000; color:#fff; font-size:12px;"></div>
	
	</form>
</div>


<? if($member_form['cnfrm'] == 1) { ?>

<form name="form1" action="/hs_cnfrm_popup2.php" method="post">
	<input type="hidden" name="in_tp_bit" value="0">

</form>


<form name="kcbResultForm" method="post" >
	<input type="hidden" name="idcf_mbr_com_cd" 		value="" 	/>
	<input type="hidden" name="hs_cert_svc_tx_seqno" 	value=""	/>
	<input type="hidden" name="hs_cert_rqst_caus_cd" 	value="" 	/>
	<input type="hidden" name="result_cd" 				value="" 	/>
	<input type="hidden" name="result_msg" 				value="" 	/>
	<input type="hidden" name="cert_dt_tm" 				value="" 	/>
	<input type="hidden" name="di" 						value="" 	/>
	<input type="hidden" name="ci" 						value="" 	/>
	<input type="hidden" name="name" 					value="" 	/>
	<input type="hidden" name="birthday" 				value="" 	/>
	<input type="hidden" name="gender" 					value="" 	/>
	<input type="hidden" name="nation" 					value="" 	/>
	<input type="hidden" name="tel_com_cd" 				value="" 	/>
	<input type="hidden" name="tel_no" 					value="" 	/>
	<input type="hidden" name="return_msg" 				value="" 	/>
</form>  
<?}?>




<? include_once($_path['member'].'_footer.php'); ?>

<script>



function bisnnom(tval){
	if(tval == '1'){
		$("#bisg").attr("style","display:none;");
		$("#bisg2").attr("style","display:none;");
		
	}else if(tval == '2'){
		$("#bisg").attr("style","display:table-row;");
		$("#bisg2").attr("style","display:table-row;");


	}

}

function onumbs(names){

	var fomrs = document.member_form;
	var textin = $("#"+names).val();

	if(/[^0123456789]/g.test(textin))
	{
		alert("숫자만 입력해주세요.");
		$("#"+names).val("");
		
	}
}




function jsSubmit(){	
	var form1 = document.form1;
	

	

	cw=screen.availWidth;     //화면 넓이
	ch=screen.availHeight;    //화면 높이

	sw=430;    //띄울 창의 넓이
	sh=590;    //띄울 창의 높이

	ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
	mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치




	window.open("", "auth_popup", "scrollbars=yes,left="+ml+",top="+mt+",width="+sw+",height="+sh);
	

	var form1 = document.form1;
	form1.target = "auth_popup";
	form1.submit();
}

function mir_go(){


	var fomr = document.member_form;


	<? if($member_form['licen'] == 1) { ?>

		if(fomr.mb_licen.value=="2"){
			if(fomr.mb_busin.value == ""){
				alert("상호명을 입력해주세요.");
				fomr.mb_busin.focus();
				return false;
			}


			if(fomr.mb_businnum1.value == ""){
				alert("사업자번호를 입력해주세요.");
				fomr.mb_businnum1.focus();
				return false;
			}


			if(fomr.mb_businnum2.value == ""){
				alert("사업자번호를 입력해주세요.");
				fomr.mb_businnum2.focus();
				return false;
			}


			if(fomr.mb_businnum3.value == ""){
				alert("사업자번호를 입력해주세요.");
				fomr.mb_businnum3.focus();
				return false;
			}


		}

	<?}?>


	<? if($member_form['cnfrm'] == 1) { ?>

	if(fomr.mb_own.value == ""){
		alert("본인인증을 해주세요.");
		
		return false;
	}
	<?}?>




	<? if($mode=="member_join") { ?>
	if(fomr.mb_id.value == ""){
		alert("아이디를 입력해주세요.");
		fomr.mb_id.focus();
		return false;
	}

	if(fomr.mb_id_chk.value == ""){
		alert("아이디 중복검색을 해주세요.");
		fomr.mb_id.focus();
		return false;
	}
	<?}?>


	


	if(fomr.mb_pass.value == ""){
		alert("비밀번호를 입력해주세요.");
		fomr.mb_pass.focus();
		return false;
	}


	if(fomr.mb_pass1.value == ""){
		alert("비밀번호확인을 입력해주세요.");
		fomr.mb_pass1.focus();
		return false;
	}


	if(fomr.mb_pass.value != fomr.mb_pass1.value){
		alert("비밀번호가 동일 하지 않습니다.");
		fomr.mb_pass.focus();
		return false;
	}


	<?if($member_form[mb_name] == 2){?>

	if(fomr.mb_name.value == ""){
		alert("이름을 입력해주세요.");
		fomr.mb_name.focus();
		return false;
	}
	<?}?>



	<?if($member_form[mb_nick] == 2){?>
	if(fomr.mb_nick.value == ""){
		alert("닉네임을 입력해주세요.");
		fomr.mb_nick.focus();
		return false;
	}
	<?}?>

	<?if($member_form[mb_email] == 2){?>
	if(fomr.mb_email.value == ""){
		alert("이메일을 입력해주세요.");
		fomr.mb_email.focus();
		return false;
	}

	<?}?>



	<?if($member_form[mb_tel1] == 2){?>
	if(fomr.mb_tel11.value == ""){
		alert("전화번호를 입력해주세요.");
		fomr.mb_tel11.focus();
		return false;
	}

	if(fomr.mb_tel12.value == ""){
		alert("전화번호를 입력해주세요.");
		fomr.mb_tel12.focus();
		return false;
	}

	if(fomr.mb_tel13.value == ""){
		alert("전화번호를 입력해주세요.");
		fomr.mb_tel13.focus();
		return false;
	}

	<?}?>


	<?if($member_form[mb_tel2] == 2){?>


	if(fomr.mb_tel21.value == ""){
		alert("핸드폰번호를 입력해주세요.");
		fomr.mb_tel21.focus();
		return false;
	}

	if(fomr.mb_tel22.value == ""){
		alert("핸드폰번호를 입력해주세요.");
		fomr.mb_tel22.focus();
		return false;
	}

	if(fomr.mb_tel23.value == ""){
		alert("핸드폰번호를 입력해주세요.");
		fomr.mb_tel23.focus();
		return false;
	}


	<?}?>


	<?if($member_form[mb_address] == 2){?>

	if(fomr.mb_post1.value == ""){
		alert("주소를 검색해주세요.");
		fomr.mb_post1.focus();
		return false;
	}


	if(fomr.mb_address1.value == ""){
		alert("주소를 입력해주세요.");
		fomr.mb_address1.focus();
		return false;
	}


	if(fomr.mb_address2.value == ""){
		alert("상세주소를 입력해주세요.");
		fomr.mb_address2.focus();
		return false;
	}
	<?}?>


	<?if($member_form[mb_signature] == 2){?>

	if(fomr.mb_signature.value == ""){
		alert("서명을 입력해주세요.");
		fomr.mb_signature.focus();
		return false;
	}

	<?}?>


	<?if($member_form[mb_introduce] == 2){?>
	if(fomr.mb_introduce.value == ""){
		alert("자기소개를 입력해주세요.");
		fomr.mb_introduce.focus();
		return false;
	}
	<?}?>


	<?if($member_form[icon1] == 2){?>
	if(document.getElementById('icon1').value == ""){
		alert("회원아이콘을 삽입해주세요.");
		document.getElementById('icon1').focus();
		return false;
	}
	<?}?>



	<?if($member_form[photo1] == 2){?>

	if(document.getElementById('photo1').value == ""){
		alert("사진을 삽입해주세요.");
		document.getElementById('photo1').focus();
		return false;
	}
	<?}?>



	




	



	if(!$(':input:checkbox[name=use_agree]:checked').val()){
		alert('이용약관에 동의해주세요.');
		return false;
	}else if(!$(':input:checkbox[name=privacy_agree]:checked').val()){
		alert('개인정보 취급방침에 동의해주세요.');		
		return false;
	}


	fomr.submit();
}



function idchkno(){
	document.member_form.mb_id_chk.value="";
}












function openDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {               

			var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
			var extraRoadAddr = ''; // 도로명 조합형 주소 변수

			// 법정동명이 있을 경우 추가한다. (법정리는 제외)
			// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
			if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
				extraRoadAddr += data.bname;
			}
			// 건물명이 있고, 공동주택일 경우 추가한다.
			if(data.buildingName !== '' && data.apartment === 'Y'){
			   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
			}
			// 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
			if(extraRoadAddr !== ''){
				extraRoadAddr = ' (' + extraRoadAddr + ')';
			}
			// 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
			if(fullRoadAddr !== ''){
				fullRoadAddr += extraRoadAddr;
			}
			

			document.getElementById('mb_post1').value = data.zonecode;			
			document.getElementById('mb_address1').value =  data.jibunAddress;
			document.getElementById('mb_address2').focus();
		  

		},           
	}).open();       
}
</script>