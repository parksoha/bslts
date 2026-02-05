<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	// 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['form_set']);
	$rs->select();
	$row=$rs->fetch();

	$form_text1 = explode("|", $row[form_text1_use]);
	$form_textarea1 = explode("|", $row[form_textarea1_use]);

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['free_form']);
		$rs->add_where("free_form_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) {
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();

		// 연락처
		list($data[free_form_zip1],$data[free_form_zip2])=explode('-',$data['free_form_zip']);
		list($data[free_form_telno1],$data[free_form_telno2],$data[free_form_telno3])=explode('-',$data[free_form_telno]);
		list($data[free_form_hpno1],$data[free_form_hpno2],$data[free_form_hpno3])=explode('-',$data[free_form_hpno]);

		// 이메일
		$form_email = explode("@", $data[free_form_email]);
		$form_email1 = $form_email[0];
		$form_email2 = $form_email[1];
		
		// 회원ID | 비회원
		if(!$data[free_mb_id]) {
			$free_mb_id = "비회원";
		} else {
			$free_mb_id = $data[free_mb_id];
		}

	}
	
	if($mode=='delete') {	// 삭제
		$rs->delete();
		rg_href("free_form_list.php?$_get_param[3]");
	}
	
	// Update|Join
	if($_SERVER['REQUEST_METHOD']=='POST') {
		// 등록 시간 
		$datetime = time();
		$datetime = date("Y-m-d H:i:s", $datetime);
		if($mode == "join") $free_form_datetime = $datetime;


		if($free_form_email1 != "" && $free_form_email2 != ""){
		
			$free_form_email = $free_form_email1."@".$free_form_email2;
		}else{
			$free_form_email ="";

		}

		$free_form_zip=$free_form_zip1.'-'.$free_form_zip2;
		$free_form_telno=$free_form_telno1.'-'.$free_form_telno2.'-'.$free_form_telno3;
		$free_form_hpno=$free_form_hpno1.'-'.$free_form_hpno2.'-'.$free_form_hpno3;
		
		if($free_form_zip=='-') $free_form_zip='';
		if($free_form_telno=='--') $free_form_telno='';
		if($free_form_hpno=='--') $free_form_hpno='';
		
		$free_form_address=$free_form_zip.$free_form_address1.$free_form_address2;

		$rs->clear();
		$rs->set_table($_table['free_form']);
		$rs->add_field("free_form_id","$free_form_id");
		$rs->add_field("free_mb_id","$free_mb_id");
		$rs->add_field("free_form_name","$free_form_name");
		$rs->add_field("free_form_jumin","$free_form_jumin");
		$rs->add_field("free_form_sex","$free_form_sex");
		$rs->add_field("free_form_email","$free_form_email");
		$rs->add_field("free_form_telno","$free_form_telno");
		$rs->add_field("free_form_hpno","$free_form_hpno");
		$rs->add_field("free_form_zip","$free_form_zip");
		$rs->add_field("free_form_address1","$free_form_address1");
		$rs->add_field("free_form_address2","$free_form_address2");
		$rs->add_field("free_form_profile","$free_form_profile");
		$rs->add_field("free_form_select","$free_form_select");
		$rs->add_field("free_form_radio","$free_form_radio");
		$rs->add_field("free_form_checkbox","$free_form_checkbox");
		$rs->add_field("free_form_text1","$free_form_text1");
		$rs->add_field("free_form_text2","$free_form_text2");
		$rs->add_field("free_form_text3","$free_form_text3");
		$rs->add_field("free_form_text4","$free_form_text4");
		$rs->add_field("free_form_text5","$free_form_text5");
		$rs->add_field("free_form_textarea1","$free_form_textarea1");
		$rs->add_field("free_form_textarea2","$free_form_textarea2");
		$rs->add_field("free_form_textarea3","$free_form_textarea3");
		$rs->add_field("free_form_textarea4","$free_form_textarea4");
		$rs->add_field("free_form_textarea5","$free_form_textarea5");
		$rs->add_field("free_form_datetime","$free_form_datetime");

		if($mode=='join') {
			$rs->insert();
			$num=$rs->get_insert_id();	
		}

		if($mode=='modify') {
			$rs->add_where("free_form_num=$num");
			$rs->update();
		}


		rg_href("free_form_list.php?$_get_param[3]");
	}

	$MENU_L='m10';
	

include("_header.php");
include("admin.header.php"); 
?>



<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>






<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">정보 수정/삭제</td>
  </tr>
</table>
<br>
<form name="free_form_edit" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="num" value="<?=$num?>" />
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="free_form_id" value="<?=$data['free_form_id']?>" />
<input type="hidden" name="free_mb_id" value="<?=$data['free_mb_id']?>" />
<input type="hidden" name="free_form_name" value="<?=$data['free_form_name']?>" />
<input type="hidden" name="free_form_datetime" value="<?=$data['free_form_datetime']?>" />
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD width="150">상담구분</TD>	
		
		<TD>
		<?if($data[free_select]=='1'){?>
		피부상담
		<?}else if($data[free_select]=='2'){?>
		피부체험
		<?}else if($data[free_select]=='3'){?>
		비만상담
		<?}?>
		
		</TD>
	
	</TR>
	<TR>
		<TD width="150">회원아이디</TD>
		<? if($mode == "join") { ?>
		<TD><input type=text name="free_mb_id" value='' size=14 maxlength=13 class=input18n_ph></TD>
		<? } else { ?>
		<TD><?=$free_mb_id?></TD>
		<? } ?>
	</TR>
	<TR>
		<TD width="150">신청인이름</TD>
		<? if($mode == "join") { ?>
		<TD><input type=text name="free_form_name" value='' size=14 maxlength=13 class=input18n_ph></TD>
		<? } else { ?>
		<TD><?=$data[free_form_name]?></TD>
		<? } ?>
	</TR>
	<TR>
		<TD>E-mail</TD>
		<TD>
			<input type=text name='free_form_email1' value='<?=$form_email1?>' size=15 maxlength=20 class=input18n_ph hname='이메일 ID'> @
			<input type=text name='free_form_email2' value='<?=$form_email2?>' size=15 maxlength=50 class=input18n_ph hname='이메일 도메인'>  
			<select name="xxx_mail_server" class="input18n_ph" onChange="javascript:this.form.free_form_email2.value=this.value;">
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
		</TD>
	</TR>
	<TR>
		<TD>전화번호</TD>
		<TD>
			<input type=text name='free_form_telno1' value='<?=$data[free_form_telno1]?>' size=3 maxlength=3 class=input18n_ph hname='전화번호(지역번호)'> -
			<input type=text name='free_form_telno2' value='<?=$data[free_form_telno2]?>' size=3 maxlength=4 class=input18n_ph hname='전화번호(국번)'> - 
			<input type=text name='free_form_telno3' value='<?=$data[free_form_telno3]?>' size=3 maxlength=4 class=input18n_ph hname='전화번호'> 
		</TD>
	</TR>
	<TR>
		<TD>핸드폰번호</TD>
		<TD>
			<input type=text name='free_form_hpno1' value='<?=$data[free_form_hpno1]?>' size=3 maxlength=3 class=input18n_ph hname='핸드폰(식별번호)'> -
			<input type=text name='free_form_hpno2' value='<?=$data[free_form_hpno2]?>' size=3 maxlength=4 class=input18n_ph hname='핸드폰(국번)'> - 
			<input type=text name='free_form_hpno3' value='<?=$data[free_form_hpno3]?>' size=3 maxlength=4 class=input18n_ph hname='핸드폰(번호)'> 
		</TD>
	</TR>
	<TR>
		<TD>우편번호</TD>
		<TD>
			<input type=text name='free_form_zip1' id="free_form_zip1" value='<?=$data[free_form_zip1]?>'  size=10 maxlength=5 class=input18n_ph >
			<img src="../images/btn_post.gif" border="0" align="absmiddle" style="cursor:hand;" onclick="openDaumPostcode();" />
		</TD>
	<TR>
		<TD>주소</TD>
		<TD>
			<input type=text name='free_form_address1' id="free_form_address1" value='<?=$data['free_form_address1']?>' size=30 maxlength=100 class=input18n_ph >&nbsp;
			<input type=text name='free_form_address2' id="free_form_address2" value='<?=$data['free_form_address2']?>' size=30 maxlength=100 class=input18n_ph hname='주소(상세주소)'>
		</TD>
	</TR>
	<TR>
		<TD><?=$form_text1[0]?>&nbsp;</TD>
		<TD><input type=text name=free_form_text1 value='<?=$data['free_form_text1']?>' size=51 maxlength=100 class=input18n_ph></TD>
	</TR>
	<TR>
		<TD><?=$form_textarea1[0]?>&nbsp;</TD>
		<TD><textarea name=free_form_textarea1 rows=5 style='width:95%;'><?=$data['free_form_textarea1']?></textarea>
		</TD>
	</TR>
	<? if($mode == "modify"){ ?>
	<TR>
		<TD>신청일</TD>
		<TD><?=$data['free_form_datetime']?></TD>
	</TR>
	<? } ?>
</TABLE><BR>
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="수   정" class="button">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>




<script>






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
			

			document.getElementById('free_form_zip1').value = data.zonecode;			
			document.getElementById('free_form_address1').value =  data.jibunAddress;
			document.getElementById('free_form_address2').focus();
		  

		},           
	}).open();       
}
</script>