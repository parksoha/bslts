<?
/*
$site_path='./';
$site_url='./';


include_once($site_path."wb_include/lib.php");
*/



$logo = "<img src='http://".$_SERVER["HTTP_HOST"]."/wb_data/design/".$logo1[logo1]."'>";

$go_links = "http://".$_SERVER["HTTP_HOST"]."/email_ok.php?mbnum=".$mb_num."&mbcode=".$mb_code;

$body="
<html>
<head>
<title>회원가입 축하메일</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<style>
BODY { FONT-SIZE: 9pt; LINE-HEIGHT: 160%; FONT-FAMILY: '돋움'}
TD { FONT-SIZE: 9pt; LINE-HEIGHT: 140%; FONT-FAMILY: '돋움'}
A:link {    text-decoration:none;     color:#000000;} 
A:visited {    text-decoration:none;     color:#000000;}
A:hover {    text-decoration:underline;     Color:#6377DC;}
A:active {    text-decoration:underline;    Color:#6377DC;}
BODY {scrollbar-face-color: #ffffff; scrollbar-shadow-color: #000000; scrollbar-highlight-color: #ffffff; scrollbar-3dlight-color: #000000; scrollbar-darkshadow-color: #ffffff; scrollbar-track-color: #eeeeee; scrollbar-arrow-color: #000000}
.tbg {  background-image: url(http://$_SERVER[HTTP_HOST]/images/good_mail_bg.gif); background-repeat: no-repeat; background-position: left top}
</style>
</head>
<body bgcolor='#FFFFFF' text='#000000'>
<table border='0' cellspacing='0' cellpadding='0'  align='center'>
<tr>
<td width='700' style='border:1px solid #e6e6e6;'>
<TABLE cellSpacing='0' cellPadding='0' width='700' align='center' border='0'>
	<TR>
		<TD style='padding:5 5 5 35' height='85'>$logo</TD>
	</TR>
</table>
<TABLE cellSpacing='0' cellPadding='0' width='700' align='center' border='0'>
	<tr>
		<td>
			<img src='http://$_SERVER[HTTP_HOST]/images/good_mail_join_tit2.gif'>
		
		</td>
	</tr>
</table>

<table width='700' border='0' cellspacing='0' cellpadding='0' align='center'>
	<tr>
		<td style='padding:20 35 30 35;'>
		".$mb_name."님</br>
		회원가입을 진심으로 축하드립니다.</br>
		아래버튼을 클릭하여 이메일 인증을 완료하셔야 최종 회원가입이 완료됩니다.</br>
		감사합니다.
		</td>
	</tr>
	<tr>
		<td width='700' align='center'>
			
			<div style='width:200px; margin:0 auto;'><a href='$go_links' style='width:200px; height:40px; line-height:40px; float:left; font-size:16px; font-weight:bold; color:#fff; background-color:#0a37ca; cursor:pointer; border:0; text-decoration:none;'>이메일인증</a></div>
		
		</td>
	</tr>
</table>
</br></br>
<table width='700' border='0' cellpadding='0' cellspacing='0' align='center'>
	<tr>
		<td style='padding:20 0 20 20; text-align:left; font-size:12px; border-top:1px solid #e6e6e6; color:#666666;' height='90'>


		상호 : ".$_site_info[company_name]." | 대표이사 : ".$_site_info[admin_name]." | 사업자등록번호 : ".$_site_info[admin_corp]."<br>
		본사 : ".$_site_info['address']." | 대표전화: ".$_site_info['admin_tel']." | 팩스 : ".$_site_info['admin_fax']."</br>
		Copyright 2017 ".$_site_info[company_name].". All rights reserved.		
		</td>
	</tr>
</table>
</td>
</tr>
</table>
</body>
</html>";
if ($_PRINT) echo "$body";
else
{


	$mime_type="text/html";
	$mail_body=($body);
	$date=date("D, d M Y H:i:s +0900");
	$subject="회원가입을 축하드립니다.";
	$MANAGEMENT_MAIL_ADDRESS=$_site_info[admin_email];
	$MANAGEMENT_NAME = $_site_info[site_name];

	$FromEmail = $MANAGEMENT_MAIL_ADDRESS;	//보내는 이메일
	$FromName = $MANAGEMENT_NAME;	//보내는 사람
		$mailheaders ="From:".$FromName."<".$FromEmail.">\r\n";
		$mailheaders .="Return-Path:".$FromEmail."\r\n";
		$mailheaders .="X-Mailer: PHP WebMail \r\n";
		//$mailheaders .= "Content-Type: text/html; charset=euc-kr";
	if($ht == "T") {
		$mail_body = str_replace(">","&gt;","$mail_body");
		$mail_body = str_replace("<","&lt;","$mail_body");
		$mail_body = str_replace("\"","&quot;","$mail_body");
	}else{
		$mail_body = str_replace("\\","","$mail_body");
	}
	$mailheaders .= "Content-Type: text/html;charset=EUC-kr\n";
	$bodytext  = $mail_body;

	mail($mb_email, $subject, $bodytext, $mailheaders);

}
?>
