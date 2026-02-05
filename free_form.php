<?include("include/header.php");


// 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['form_set']);
	$rs->select();
	$data=$rs->fetch();
	if($rs->num_rows() == 0) // 관리자 페이지 설정 확인
			rg_href('index.php','관리자 페이지에서 설정 후 이용하세요.','');

	if($data[form_user_use] > 2 && !$_mb) 
		rg_href($_path['member'].'login.php','로그인후 이용하실 수 있습니다.', '');

	$form_text1 = explode("|", $data[form_text1_use]);
	$form_textarea1 = explode("|", $data[form_textarea1_use]);

	$required=array();
	foreach($data as $k => $v) {
		if($v =='3')
			$required[$k] = 'required';
		else
			$required[$k] = '';
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && $free_form_mode=='free_form_ok') {
/*		if (!$_POST[agree])
			rg_href('./free_form.php','약관의 내용에 동의해야 신청을 하실 수 있습니다.', '');
		
		if(!$free_form_name)
			rg_href('','이름은 필수 입력사항 입니다.','back');

		if(!$validate->is_empty($free_form_name) && !$validate->han_only($free_form_name))
			rg_href('','이름을 확인해주세요.','back');
*/		
		$free_form_email = trim($free_form_email1)."@".trim($free_form_email2);
		$free_form_zip=$free_form_zip1;
		$free_form_telno=$free_form_telno1.'-'.$free_form_telno2.'-'.$free_form_telno3;
		$free_form_hpno=$free_form_hpno1.'-'.$free_form_hpno2.'-'.$free_form_hpno3;
		
		if($free_form_zip=='-') $free_form_zip='';
		if($free_form_telno=='--') $free_form_telno='';
		if($free_form_hpno=='--') $free_form_hpno='';
		
		$free_form_address="(".$free_form_zip.") ".$free_form_address1.$free_form_address2;
		
		$datetime = time();
		$datetime = date("Y-m-d H:i:s", $datetime); // 신청시간

		$rs->clear();
		$rs->set_table($_table['free_form']);
		$rs->add_field("free_form_id","$data[form_id]");
		$rs->add_field("free_mb_id","$_mb[mb_id]");
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
		$rs->add_field("b_str2","1");
		$rs->add_field("agree","$new_agree2");
		$rs->add_field("free_form_datetime","$datetime");
		$rs->insert();
		$mb_num=$rs->get_insert_id();

		// 메일
		$form_mail_content = "<TABLE width='600' cellpadding='3' cellspacing='1' width='600' bordercolordark='white' bordercolorlight='#E1E1E1' style='table-layout:fixed;font-size:9pt;'>\n";
		if($data[form_name_use] > 1) $form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>회사명</TD><TD>$free_form_name</TD></TR>\n";
		if($data[form_email_use] > 1) $form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>E-mail</TD><TD>$free_form_email</TD></TR>\n";
		if($data[form_telno_use] > 1) $form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>전화번호</TD><TD>$free_form_telno</TD></TR>\n";
		if($data[form_hpno_use] > 1)$form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>핸드폰번호</TD><TD>$free_form_hpno</TD></TR>\n";
		if($data[form_addr_use] > 1)$form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>주소</TD><TD>$free_form_address</TD></TR>\n";
		if($form_text1[1] > 1) $form_mail_content .= "<TR><TD width='120' bgcolor='#F0F0F4'>$form_text1[0]</TD><TD>$free_form_text1</TD></TR>\n";
		if($form_textarea1[1] > 1) $form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>$form_textarea1[0]</TD><TD>$free_form_textarea1</TD></TR>\n";
		$form_mail_content .= "<TR><TD width='120' height='20' bgcolor='#F0F0F4'>신청시간</TD><TD>$datetime</TD></TR>\n";
		$form_mail_content .= "</TR></TABLE>\n";
		
		$to = $_site_info['mail_from'];
		$subject = $free_form_name.'님께서 신청한 내용입니다.';
		$message = $form_mail_content;

		$Headers .= "From: ".$free_form_name."<".$free_form_email."> \r\n";
		$Headers .= "Content-Type: text/html; charset=utf-8 \r\n";
		
		
		// 이메일 발송

			//mail($to,$subject,$message,$Headers);

		// SMS 발송
		include("free_form_sms.php");

		if($ret_url=='') $ret_url='../index.php';
		rg_href($ret_url,'신청이 완료되었습니다.','');
	}
?>


     
 <style>
.onlin_s{width:100%; height:auto; float:left; padding-bottom:10px;  margin:0 0 0 0; font-size:16px; font-weight:bold; color:#1c4b81;}
.onlin_s2{width:100%; height:auto; float:left; padding-bottom:10px;  margin:10px 0 0 0; font-size:12px; font-weight:bold; color:#000;}
.onlin_s3{width:100%; height:auto; float:left; font-size:12px; margin:10px 0 0 0; color:#000;}

.onlinesd_fom_table{ border-top:1px solid #5b88c9;  margin:0 0 0 0; }
.onlinesd_fom_table td{ border-bottom:1px solid #dcdcdc;}
.onlinesd_fom_table td.onsc_font1{background-color:#edf4f9; font-weight:bold; color:#1c4b81; font-size:1.2em; padding:6px 0 6px 10px;}
.onlinesd_fom_table td.onsc_font2{border-bottom:1px solid #ccc; }
.onlinesd_fom_table th{background-color:#edf4f9; border-bottom:1px solid #dcdcdc;}

.onsc_font3{ border:1px solid #ccc; height:30px; width:50%; float:left; margin-left:2%; text-align:center;}
.onsc_font4{ border:1px solid #ccc; height:30px; width:24%; float:left; text-align:center;}
.gmbs{float:left; padding:5px 1% 0 1%; }

.onsc_font5{ border:1px solid #ccc; height:27px; width:25%; float:left; margin-left:2%;}

.onsc_font6{ border:1px solid #ccc; height:23px; width:70%; float:left; margin-left:2%; text-align:center;}
.onsc_font7{ border:1px solid #ccc; height:70px; width:90%; float:left; margin-left:2%; text-align:center;}

 </style>


<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>


<form action="free_form.php" method="post" enctype='multipart/form-data' name="free_form" id="free_form">
	<input type="hidden" name="free_mb_id" value="<?=$mb_id?>" />
	<input type="hidden" name="free_form_mode" value="free_form_ok" />
	<input type="hidden" name="ret_url" value="../index.php" />



<div style="width:100%; height:auto; float:left; margin-top:20px;">
	<div class="onlin_s">※ 견적문의, 제품상담이 필요하시면 아래 온라인 문의 부탁드립니다.</div>




	<? include('free_form.skin.php') ?>

	


	<div class="onlin_s2" style="font-size:18px; color:#4173bd; font-weight:bold; margin-top:40px;">(필수) 개인정보 수집.이용동의</div>

	<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="100%">
		<tr>
			<th width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;font-size:13px; padding:6px 0;">목적</th>
			<th width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">항목</th>
			<th width="33.3333333333333333333%" height="25" align="center">보유기간</th>
		</tr>

		<tr>
			<td width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;font-size:13px; padding:6px 0;">온라인문의 및 본인여부확인</td>
			<td width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">회사명,이메일,휴대폰번호</td>
			<td width="33.3333333333333333333%" height="25" align="center">법령에 정한 기간</td>
		</tr>
	</table>

	<div class="onlin_s3" style="font-size:13px;">* 온라인문의를 위해 필요한 최소한의 개인정보이므로 동의를 해주셔야 이용이 가능합니다.</div>
	<div class="onlin_s3" style="margin-top:0;">
	
		<span style="float:left; padding-top:10px;font-size:13px;">(필수) 개인정보 수집.이용동의 사항에 동의하십니까?</span>

		<span style="float:right; padding-top:10px;">
			<label class="chk_dongi" style="padding-right:10px;"><input type="radio" name="new_agree" value="1" hname='동의'>&nbsp;동의함</label>
			<label class="chk_dongi"><input type="radio" name="new_agree" value="2">&nbsp;동의하지 않음</label>

		</span>
	</div>

	<div class="onlin_s2" style="margin-top:20px; font-size:18px; color:#4173bd; font-weight:bold;margin-top:40px;">개인정보수집 이용에 따른 동의</div>
	<textarea style="width:96%; height:280px; float:left; border:1px solid #b2b2b2; font-size:14px; margin:0 0 0 0; padding:20px 2%; line-height:30px;" readonly><?=$data[form_stipulation]?></textarea>

	<div class="onlin_s3" style="margin-top:0;">
	
		<span style="float:left; padding-top:10px; font-size:13px;">개인정보의 수집.이용에 관한 사항에 동의하십니까?</span>

		<span style="float:right; padding-top:10px;">
			<label class="chk_dongi" style="padding-right:10px;"><input type="radio" name="new_agree2" value="1" hname='동의'>&nbsp;동의함</label>
			<label class="chk_dongi"><input type="radio" name="new_agree2" value="2">&nbsp;동의하지 않음</label>
		</span>
	</div>

	<div class="btn" style="width:100%; height:auto; float:left; text-align:center; margin-top:20px; margin-bottom:50px;"><img src="../images/btn_ok.gif" onclick="free_form1();" style="cursor:pointer;"/></div>



</div>
        
       
        
        
  
        
        
        

<? include("include/footer3.php");?>


<script>
function free_form1()
{
	var form=document.free_form;
	var blank_pattern = /[\s]/g;
	var	mesg =$(':input:radio[name=new_agree]:checked').val();
	var	mesg2 =$(':input:radio[name=new_agree2]:checked').val();

	<?
	if($data[form_name_use] > "1"){
	if($data[form_name_use] == "3"){?>
	if(form.free_form_name.value=="")
	{
		alert("회사명을 입력해 주세요.");
		form.free_form_name.focus();
		return false;
	}
	<?}?>
	if( blank_pattern.test(form.free_form_name.value) == true)
	{
		alert("회사명에 공백을 포함할수 없습니다.");
		form.free_form_name.focus();
		form.free_form_name.select();
		return false;
	}   
	<?}?>
	<?if($data[form_email_use] > "1"){ 
	if($data[form_email_use] == "3"){?>
	if(form.free_form_email1.value=="")
	{
		alert("이메일을 입력하세요.");
		form.free_form_email1.focus();
		return false;
	}   
	if(form.free_form_email2.value=="")
	{
		alert("이메일을 입력하세요.");
		form.free_form_email2.focus();
		return false;
	} 
	<?}
	}?>


	<?if($data[form_telno_use] > "1"){ 
		if($data[form_telno_use] == "3"){?>
	if(form.free_form_telno1.value=="")
	{
		alert("전화번호를 입력하세요.");
		form.free_form_telno1.focus();
		return false;
	} 
	if(form.free_form_telno2.value=="")
	{
		alert("전화번호를 입력하세요.");
		form.free_form_telno2.focus();
		return false;
	}
	if(form.free_form_telno3.value=="")
	{
		alert("전화번호를 입력하세요.");
		form.free_form_telno3.focus();
		return false;
	}
	<?}}?>

	<? if($data[form_hpno_use] > "1"){ 
		if($data[form_hpno_use] == "3"){?>
	if(form.free_form_hpno1.value=="")
	{
		alert("핸드폰번호를 입력하세요.");
		form.free_form_hpno1.focus();
		return false;
	} 
	if(form.free_form_hpno2.value=="")
	{
		alert("핸드폰번호를 입력하세요.");
		form.free_form_hpno2.focus();
		return false;
	}
	if(form.free_form_hpno3.value=="")
	{
		alert("핸드폰번호를 입력하세요.");
		form.free_form_hpno3.focus();
		return false;
	}
	<?}}?>


	<? if($data[form_addr_use] > "1"){ 
		if($data[form_addr_use] == "3"){?>
	if(form.free_form_zip1.value=="")
	{
		alert("우편번호를 검색 하세요.");
		form.free_form_zip1.focus();
		return false;
	} 

	

	if(form.free_form_address1.value=="")
	{
		alert("주소를 입력하세요.");
		form.free_form_address1.focus();
		return false;
	} 

	if(form.free_form_address2.value=="")
	{
		alert("주소를 입력하세요.");
		form.free_form_address2.focus();
		return false;
	} 


	<?}}?>



	<? if($form_text1[1] > "1"){ 
		if($form_text1[1] == "3"){?>
	if(form.free_form_text1.value=="")
	{
		alert("제목을 입력하세요.");
		form.free_form_text1.focus();
		return false;
	}
	<?}}?>

	<? if($form_textarea1[1] > "1"){
		if($form_textarea1[1] == "3"){?>
	if(form.free_form_textarea1.value=="")
	{
		alert("내용을 입력하세요.");
		form.free_form_textarea1.focus();
		return false;
	}
	<?}}?>

	if(mesg=="2" || !mesg){
		alert('(필수) 개인정보 수집.이용동의에 동의하셔야 신청하실 수 있습니다.');
		form.agree_comm.focus();	
		return false;
	}
	if(mesg2=="2" || !mesg2){
		alert('개인정보수집 이용에 따른 동의에 동의하셔야 신청하실 수 있습니다.');
		form.new_agree2.focus();	
		return false;
	}
	form.submit();
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
			

			document.getElementById('free_form_zip1').value = data.zonecode;			
			document.getElementById('free_form_address1').value =  data.jibunAddress;
			document.getElementById('free_form_address2').focus();
		  

		},           
	}).open();       
}
</script>