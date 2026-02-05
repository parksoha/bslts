<? 
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$MENU_L='m11';
include("_header.php");
include("admin.header.php");
?>

<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? 
if($mail_mode == ""){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td>
						<table width="739" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><img src="images/inquiry_tlt.jpg"></td>
							</tr>
                            <tr>
                              <td style="padding-left:20px;"><img src="images/ask_img01.jpg"></td>
                            </tr>
							<tr>
								<td style="padding:40px;">
									<form name="fm_mail" method="post" action="./inquiry.php" enctype="multipart/form-data">
									<input type="hidden" name="mail_mode" value="send">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="cccccc">
													<tr>
													  <td height="50" colspan="2" bgcolor="#FFFFFF">
															<TABLE cellpadding="0" cellspacing="0" border="0" style="font-weight:bold;">
																<TR>
																	<TD width="30%" height="25" style="padding-left:30;"><input type="radio" name="gubun" value="1" checked>디자인수정</TD>
																	<TD width="25%"><input type="radio" name="gubun" value="2">프로그램수정</TD>
																	<TD width="25%"><input type="radio" name="gubun" value="3">기업메일</TD>
																	<TD width="20%"><input type="radio" name="gubun" value="4">광고신청</TD>
																</TR>
																<TR>
																	<TD height="25" style="padding-left:30;"><input type="radio" name="gubun" value="5">보안서버신청</TD>
																	<TD><input type="radio" name="gubun" value="6">일대일상담창(채팅)</TD>
																	<TD><input type="radio" name="gubun" value="7">모바일사이트(홍보/몰)</TD>
																	<TD></TD>
																</TR>
															</TABLE>
														</td>
													</tr>
													<tr>
														<td width="130" style="padding-left:20px; color:#FFFFFF; font-weight:bold;" width="23%" bgcolor="32a30b">사이트명</td>
														<td bgcolor="#FFFFFF"><input type="text" name="company" value="<?=$_site_info[site_name]?>" style="width:200px; height:18px;" readonly></td>
													</tr>
													<tr>
														<td style="padding-left:20px; color:#FFFFFF; font-weight:bold;" bgcolor="32a30b">담당자</td>
														<td bgcolor="#FFFFFF"><input type="text" name="person" id="company2" style="width:200px; height:18px;">
														<span style="color:32a30b">직책과 이름을 함께 써주세요. ex) 홍길동 사장</span></td>
													</tr>
													<tr>
														<td style="padding-left:20px; color:#FFFFFF; font-weight:bold;" bgcolor="32a30b">직통전화</td>
														<td bgcolor="#FFFFFF"><input type="text" name="phone" style="width:200px; height:18px;"></td>
													</tr>
													<tr>
														<td style="padding-left:20px; color:#FFFFFF; font-weight:bold;" bgcolor="32a30b">문의내용<br>
														  (구체적으로 서술)</td>
													  <td bgcolor="#FFFFFF"><textarea name="question" style="width:470px; height:200px;"></textarea></td>
													</tr>
													<tr>
													  <td style="padding-left:20px; color:#FFFFFF; font-weight:bold;" bgcolor="32a30b">찾아보기</td>
													  <td bgcolor="#FFFFFF"><input type="file" name="fileupload" style="width:470px; height:18px;"></td>
												  </tr>
												</table>
										  </td>
										</tr>
										<tr>
											<td height="100" align="center"><a href="javascript:fm_mail_chk();"><img src="images/btn_save_01.gif" border="0"></a>&nbsp; <a href="javascript:fm_mail_reset();"><img src="images/btn_cancel_01.gif" border="0"></a></td>
									  </tr>
									</table>
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script language='Javascript'>

function fm_mail_reset()
{
	var form=document.fm_mail;

	form.reset();
	form.person.focus();
}

function fm_mail_chk()
{
	var form=document.fm_mail;
	
	if(form.question.value=="")
	{
		alert("문의 내용을 입력해주세요.");
		form.question.focus();
		return;
	}

	else form.submit();
}
</script>

<? } elseif($mail_mode == "send") { 

// 메일전송
$charset = "utf-8";
if($gubun =="1") $gubun = "디자인수정";
if($gubun =="2") $gubun = "프로그램수정";
if($gubun =="3") $gubun = "기업메일";
if($gubun =="4") $gubun = "광고신청";
if($gubun =="5") $gubun = "보안서버신청";
if($gubun =="6") $gubun = "일대일상담창(채팅)";
if($gubun =="7") $gubun = "모바일사이트(홍보/몰)";

$question = stripslashes($question);
$question = nl2br($question);

$datetime = time();
$datetime = date("Y-m-d H:i:s", $datetime); // 신청시간

$form_mail_content  = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=$charset'><title>웹브릿지에 문의하기</title>\n";
$form_mail_content .= "<link rel='stylesheet' href='http://$_SERVER[HTTP_HOST]/wb_css/style.css' type='text/css'></head>\n";
$form_mail_content .= "<body leftmargin='0' topmargin='0' bgcolor='#FFFFFF' text='#000000'>\n";
$form_mail_content .= "<TABLE width='600' border='1' cellpadding='3' cellspacing='1' valign='top' bordercolordark='white' bordercolorlight='#E1E1E1'>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 사이트 이름</TD><TD>$_site_info[site_name]</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 분류</TD><TD>$gubun</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 담당자</TD><TD>$person</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 직통전화</TD><TD>$phone</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 사이트URL</TD><TD>http://$_SERVER[HTTP_HOST]</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' bgcolor='#F0F0F4'> * 문의내용</TD><TD>$question</TD></TR>\n";
$form_mail_content .= "<TR><TD width='120' height='30' bgcolor='#F0F0F4'> * 신청시간</TD><TD>$datetime</TD></TR>\n";
$form_mail_content .= "</TR></TABLE>\n";
$form_mail_content .= "</body></html>\n";

if($fileupload){
	$filename = basename($fileupload_name); 
	$result = fopen($fileupload,"r"); 
	$file = fread($result,$fileupload_size); 
	fclose($result);
	$boundary = "--------" . uniqid("part"); 
}

$mail_body= ($form_mail_content);
$date=date("D, d M Y H:i:s +0900");  

$to = "help@webbridge.co.kr";
$subject = "=?$charset?B?" . base64_encode("[문의사항] ".$_site_info[site_name]) . "?="; // 메일제목
$FromName = "=?$charset?B?" . base64_encode($person) . "?="; //보내는 사람
$FromEmail = $_site_info['admin_email'];	//보내는 이메일

$mailheaders = "From:".$FromName."<".$FromEmail.">\r\n";
$mailheaders .= "Return-Path:".$FromEmail."\r\n";
$mailheaders .= "X-Mailer: PHP WebMail \r\n";
	
if($filename != "") {
	$mailheaders.= "Content-type: MULTIPART/MIXED; BOUNDARY=\"$boundary\"\n\n";
	$mailheaders .= "--$boundary\n";
}

$mailheaders .= "Content-Type: TEXT/HTML; $charset\n";
$mailheaders .= "Content-Transfer-Encoding: BASE64\n\n";
$mailheaders .= chunk_split(base64_encode($mail_body)) . "\n";

if($filename != "") {
	$mailheaders .= "\n--$boundary\n";
	$mailheaders .= "Content-Type: APPLICATION/OCTET-STREAM; name=\"$filename\"\n";
	$mailheaders .= "Content-Transfer-Encoding: BASE64\n";
	$mailheaders .= "Content-Disposition: inline; filename=\"$filename\"\n";
	$mailheaders .= "\n";
	$mailheaders .= chunk_split(base64_encode($file));
	$mailheaders .= "\n";
	$mailheaders .= "--$boundary--\n";
}

@mail($to, $subject, "", $mailheaders);

rg_href("./inquiry.php", "메일이 정상적으로 발송되었습니다.");
} ?>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>