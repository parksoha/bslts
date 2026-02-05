<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

if($_SERVER['REQUEST_METHOD']=='POST' && $mode=='modify') { 

$charset = "utf-8";

$datetime = time();
$datetime = date("Y-m-d H:i:s", $datetime); // 신청시간

$form_fax_content  = "*Shtml*E*Shead*E*Smeta http-equiv=||Content-Type|| content=||text/html; charset=$charset||*E*Stitle*E전세버스 임대차 견적서*S/title*E\n";
$form_fax_content .= "*Slink rel=||stylesheet|| href=||http://$_SERVER[HTTP_HOST]/wb_css/style.css|| type=||text/css||*E*S/head*E\n";
$form_fax_content .= "*Sbody leftmargin=||0|| topmargin=||0|| bgcolor=||#FFFFFF|| text=||#000000||*E\n";

$form_fax_content .= "*STABLE width=||100%|| height=||100%||*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center|| valign=||middle||*E\n";

$form_fax_content .= "*STABLE width=||500|| cellpadding=||0|| cellspacing=||0|| border=||1|| bordercolordark=||white|| bordercolorlight=||#555555||*E\n";
$form_fax_content .= "*Scol width=||30|| /*E*Scol width=||90|| /*E*Scol width=||145|| /*E*Scol width=||90|| /*E*Scol /*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD colspan=||5|| height=||30|| align=||center|| style=||font-size:15px;||*E*SB*E전세버스 임대차 견적서*S/B*E*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD colspan=||5|| height=||45|| align=||center||*E".$wb[time_y]." ".$wb[time_m]." ".$wb[time_d]." ".$wb[time_w]."*SBR*E*SU*E*SB*E".$data[name]."*S/B*E 귀하*S/U*E 아래와 같이 견적합니다.*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";

$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD rowspan=||5|| height=||25|| align=||center||*E공*SBR*E*SBR*E급*SBR*E*SBR*E자*S/TD*E";
$form_fax_content .= "*STD align=||center||*E등록번호*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center|| style=||letter-spacing:1;||*E124-86-82831*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E상호*S/TD*E";
$form_fax_content .= "*STD align=||center||*E(주)푸른관광*S/TD*E";
$form_fax_content .= "*STD align=||center||*E대표자*S/TD*E";
$form_fax_content .= "*STD align=||center||*E김월선*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E주소*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E경기도 화성시 송산면 칠곡리 353-1*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E업태*S/TD*E";
$form_fax_content .= "*STD align=||center||*E서비스*S/TD*E";
$form_fax_content .= "*STD align=||center||*E종목*S/TD*E";
$form_fax_content .= "*STD align=||center||*E전세버스*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E전화번호*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*ETEL) 1600-5653&nbsp; /&nbsp; FAX) 02-352-5657*S/TD*E";
$form_fax_content .= "*S/TR*E\n";

$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD rowspan=||7|| height=||25|| align=||center||*E견*SBR*E*SBR*E적*SBR*E*SBR*E사*SBR*E*SBR*E항*S/TD*E";
$form_fax_content .= "*STD align=||center||*E차량*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[carO]." ".$data[carP]." ".$data[carS];
$form_fax_content .= "*S/TR*E\n";

if($data[purpose] == 3) {
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center||*E출발지*SBR*E운행일시*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrD]."*SBR*E".$data[dateD]." ~ ".$data[dateA]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E경유지*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrV]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center||*E도착지*SBR*E운행시간*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrA]."*SBR*E".$data[timeD]." ~ ".$data[timeA]."&nbsp;".$data[dayS]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
} else {
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center||*E출발지*SBR*E출발일시*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrD]."*SBR*E".$data[dateD]." ".$data[timeD]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center||*E경유지*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrV]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center||*E도착지*SBR*E상행일시*S/TD*E";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;".$data[addrA]."*SBR*E".$data[dateA]." ".$data[timeA]."*S/TD*E";
$form_fax_content .= "*S/TR*E\n";
}
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center|| style=||color: #0000FF;||*E견적금액*S/TD*E\n";
$form_fax_content .= "*STD colspan=||3|| align=||center||*E&nbsp;*SB*E".number_format($priceS)."*S/B*E 원&nbsp;*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD height=||25|| align=||center|| style=||color: #0000FF;||*E부대비용*S/TD*E\n";
$form_fax_content .= "*STD colspan=||3|| style=||padding-left:5;padding-right:5;word-break:break-all;||*E".rg_get_text($priceE)."&nbsp;*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*STR*E\n";
$form_fax_content .= "*STD align=||center|| style=||color: #0000FF;||*E견적내용*S/TD*E\n";
$form_fax_content .= "*STD colspan=||3|| style=||padding-left:5;padding-right:5;word-break:break-all;||*E".rg_get_text($report,1)."&nbsp;*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*S/TABLE*E\n";

$form_fax_content .= "*S/TD*E\n";
$form_fax_content .= "*S/TR*E\n";
$form_fax_content .= "*S/TABLE*E\n";
$form_fax_content .= "*S/body*E*S/html*E\n";

// FAX 전송 값 셋팅 S
$user_id = $_site_info['fax_id'];                                                  // 팩스 사용자 아이디
$user_pwd = $_site_info['fax_pass'];                                           // 팩스 사용자 패스워드
$faxdata = str_replace('-', '', trim($data['fax']));                           // 팩스 번호
$faxcontent = $form_fax_content;                                                // 팩스 내용
$ntype = 3;                                                                              // 팩스 전송결과
// 전송제목(제목, 신청인, 메일발송여부, SMS발송여부, 검색어, 페이지)
$title = $data['name']."님 [전세버스 임대차 견적서 - 푸른관광(주)][GB]".$data['name']."[GB]".$chkE."[GB]".$chkS."[GB]".$page;
$sfrom = "푸른관광(주)";                                                             // 팩스 문서 최상단 표시
$index_code = $data['num']."_".time();                                          // 전송결과를 넘겨받기 위한 고유 값
$return_url = "http://".$_SERVER[HTTP_HOST]."/wb_admin/fax_result.php"; // 전송결과값을 받을 URL 
// FAX 전송 값 셋팅 E
?>

<FORM METHOD=POST name=form_fax ACTION="http://www.moashot.com/e2f_delivery/check.asp">
<INPUT TYPE="hidden" name="user_id" value="<?=$user_id?>">
<INPUT TYPE="hidden" name="user_pwd" value="<?=$user_pwd?>">
<INPUT TYPE="hidden" name="faxdata" value="<?=$faxdata?>">
<INPUT TYPE="hidden" name="faxcontent" value="<?=$faxcontent?>">
<INPUT TYPE="hidden" name="ntype" value="<?=$ntype?>">
<INPUT TYPE="hidden" name="title" value="<?=$title?>">
<INPUT TYPE="hidden" name="sfrom" value="<?=$sfrom?>">
<INPUT TYPE="hidden" name="index_code" value="<?=$index_code?>">
<INPUT TYPE="hidden" name="return_url" value="<?=$return_url?>">
</FORM>

<SCRIPT LANGUAGE='JavaScript'>
<!--
	var form=document.form_fax;

	form_fax.submit();
//-->
</SCRIPT>
<? 
}
?>