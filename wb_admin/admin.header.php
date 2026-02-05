<?
$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='site_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","site_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$site_info = unserialize($tmp);
?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #ffffff}
-->
</style>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">

	<tr>
	  <td height="25" colspan="2" align="right" bgcolor="388cbd" style="padding-right:10px"><table  cellspacing="0" cellpadding="0">
        <tr>
          <td><a href="/" target="_blank" class="menu">홈페이지</a> <span class="style2">│</span> <a href="<?=$_url['member']?>login.php?logout&admin=1" class="menu">로그아웃</a></td>
        </tr>
      </table></td>
  </tr>
	<tr>
		<td align="center" valign="top" bgcolor="388cbd" style="padding-top:5px; position:relative;"><img src="../wb_data/design/<?=$logo1[logo1]?>" width="150" height="60" style="position:absolute; top:-15px; left:0;"></td>
        <td height="55" align="left" valign="top" bgcolor="388cbd" style="padding-top:5px">
		
		<table  border="0" cellspacing="0" cellpadding="0">
          <tr>
			<td width="80" align="center"><a href="<?=$_path[admin]?>index.php" class="menu">대쉬보드</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center"><a href="<?=$_path[admin]?>site_setup.php" class="menu">환경설정</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="120" align="center"><a href="<?=$_path[admin]?>member_list.php" class="menu" style="font-weight:bold;">회원(거래처)관리</a></td>
            <td width="5"><span class="style2">│</span></td>

            <td width="80" align="center" ><a href="<?=$_path[admin]?>free_form_list.php" class="menu" style="font-weight:bold;">신청폼관리</a></td>
			<td width="5"><span class="style2">│</span></td>


			

           <!--td width="80" align="center" ><a href="javascript:memberPersms('<?=$_site_info['sms_from']?>','','','<?=$handErr?>');"  class="menu" title="SMS">문자보내기</a></td>

		   <td width="5"><span class="style2">│</span></td -->
            <!-- <td width="80" align="center" ><a href="<?=$_path[admin]?>group_list.php" class="menu">그룹관리</a></td>
            <td width="5"><span class="style2">│</span></td> -->
            <td width="120" align="center" ><a href="<?=$_path[admin]?>bbs_list.php" class="menu">게시판/페이지관리</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center" ><a href="<?=$_path[counter]?>" class="menu"><font color="#FFFF00" size="2"><b>pc 접속통계</b></font></a></td>
            <td width="5"><span class="style2">│</span></td>
			<td width="110" align="center" ><a href="<?=$_path[counter]?>index_m.php" class="menu"><font color="#FFFF00" size="2"><b>m 접속통계</font></a></a></td>
			<td width="5"><span class="style2">│</span></td>
            <td width="80" align="center" ><a href="<?=$_path[admin]?>newwinlist.php" class="menu">팝업창관리</a></td>


			<!--td width="80" align="center" ><a href="<?=$_path[admin]?>push_notice_list.php" class="menu">푸쉬공지</a></td>
            <td width="5"><span class="style2">│</span></td -->

			<?if($site_info['shop_chk'] != "0"){?>
			<td width="5"><span class="style2">│</span></td>
			<td width="80" align="center" ><a href="<?=$_path[admin]?>ksnet_list.php" class="menu">전자결제</a></td>

			<?}?>

			<td width="5"><span class="style2">│</span></td>
			<td width="80" align="center" ><a href="<?=$_path[admin]?>new_design1.php" class="menu">디자인관리</a></td>

			
			

			<?if($_SESSION['ss_mb_id']=="webbridge" || $_SESSION['ss_mb_id']=="webbridge1" || $_SESSION['ss_mb_id']=="webbridge2"){?>
			<td width="90" align="center" style="padding-left:50px;"><a href="<?=$_path[admin]?>etc_page1.php" style="color:#00ff24; font-weight:normal;font-size:12px;" class="menu">유용한프로그램</a></td>
			<td width="5"><span class="style2" style="color:#00ff24;">│</span></td>
			
            <td width="80" align="center"><a href="http://webbridge.co.kr/wb_board/list.php?&bbs_code=maintenance" style="color:#00ff24; font-weight:normal;font-size:12px;" class="menu" target="_blank">유지보수문의</a></td>
			<?}else{?>
			<td width="80" align="center" style="padding-left:50px;"><a href="http://webbridge.co.kr/wb_board/list.php?&bbs_code=maintenance" style="color:#00ff24; font-weight:normal;font-size:12px;" class="menu" target="_blank">유지보수문의</a></td>


			<?}?>


			<td width="5"><span class="style2" style="color:#00ff24;">│</span></td>

		   <td width="120" align="center"><a href="<?=$_path[admin]?>portal.php" class="menu" style="color:#00ff24; font-weight:normal;font-size:12px;">포털광고/추천상품 외</a></td>

		  </tr>
        </table></td>
  </tr>
	<tr>
	  <td width="180" align="center"><img src="<?=$_path[admin]?>images/too_bg2.gif"/></td>
	  <td align="left" background="<?=$_path[admin]?>images/top_bg.gif"><img src="<?=$_path[admin]?>images/too_bg_img.gif" /></td>
  </tr>
</table>

<table width="100%" height="600"  border="0" cellpadding="0" cellspacing="0" style="background:url('<?=$_path[admin]?>images/left_bg.gif') left top repeat-y;">
	<tr>
		<td width="180" valign="top" background="<?=$_path[admin]?>images/left_bg.jpg" style="background-repeat:no-repeat;">

<?
	switch($MENU_L) {
		case 'm2' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2" class="white_link">회원관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>member_list.php" class="white_link">회원목록</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>

	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="javascript:memberPersms('<?=$_site_info['sms_from']?>','','','<?=$handErr?>');" class="white_link">문자보내기</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_sms_log2.php" class="white_link">SMS 문자 로그</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>
<?
			break;
		case 'm3' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="266f9a" class="style2">그룹관리</td>
  </tr>
  <tr>
    <td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>group_list.php" class="white_link">그룹목록</a></td>
  </tr>
  <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
  <tr>
    <td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>group_member_list.php" class="white_link">그룹회원목록</a></td>
  </tr>
  <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>
<?
			break;
		case 'm4' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">게시판/페이지관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>bbs_list.php" class="white_link">게시판/페이지관리</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>
<?
			break;
		case 'm5' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">기타관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_url['counter']?>" class="white_link">pc 접속통계</a></td>
	  </tr>
	 <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_url['counter']?>index_m.php" class="white_link">m 접속통계</a></td>
	  </tr>
	 <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<!--tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>fax_log.php" class="white_link">FAX 로그</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr-->
	  <!--tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>create_zip_tables.php" class="white_link">우편번호 테이블생성</a></td>
		</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr-->
	<!--<tr>
		<td><table width="95%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="5" height="1"></td>
				<td height="1" bgcolor="#C1C1C1"></td>
				<td width="5" height="1"></td>
			</tr>
			<tr>
				<td height="1" colspan="3"></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"><a href="uninstall.php">Database 제거 (*주의)</a></td>
	</tr> -->
	<tr>
		<td height="25">&nbsp;</td>
	</tr>
</table>
<?
			break;
		case 'm8' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">방문자통계</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>vister.php?type=hour">시간대별</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>vister.php?type=day">일별</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>vister.php?type=week">요일별</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>vister.php?type=month">월별</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>vister.php?type=year">년도별</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>
<?
			break;
		case 'm9' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2"> 팝업창관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>newwinlist.php" class="white_link">팝업창관리</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
    <tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> 
		
		
		
		<?if($rs_list->num_rows() == 3){?>
		<a href='javascript:alert("팝업창은 3개까지 등록 가능합니다.");' class="white_link">
		<?}else{?>
		<a href='<?=$_path[admin]?>newwinform.php' class="white_link">
		<?}?>
		팝업창등록</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>

<?
			break;
		case 'm10' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">신청폼관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_form_list.php" class="white_link">신청리스트</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_form_set.php" class="white_link">신청폼설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<!--tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>push_notice_list.php" class="white_link">푸쉬공지</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr-->
</table>




<?
			break;
		case 'm10_1' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">온라인예약</td>
	</tr>
	
</table>



<?
			break;
		case 'm17' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">신청폼관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>push_notice_list.php" class="white_link">공지리스트</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>push_notice.php" class="white_link">공지등록</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<!--tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>push_notice_list.php" class="white_link">푸쉬공지</a></td>
	</tr -->
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>
<?
			break;
		case 'm12' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>

	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">전자결제관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>ksnet_list.php" class="white_link">전자결제리스트</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>ksnet_form.php" class="white_link">전자결제항목설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>

<?
			break;
		case 'm20' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>

	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">포털 광고하기</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>portal.php" class="white_link">상호무료등재</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>portal2.php" class="white_link">네이버 키워드광고(유료)</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>

	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">추천상품</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>reco1.php" class="white_link">웹메일상품</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>reco2.php" class="white_link">대량문자 발송시스템</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<!--tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>reco3.php" class="white_link"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>reco4.php" class="white_link"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr-->


	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">파트너쉽 제휴 제안</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>partner.php" class="white_link">파트너쉽 제휴 제안</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>


<?
			break;
		case 'm11' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">웹브릿지에 문의하기</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>inquiry.php" class="white_link">문의하기</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>




<?
			break;
		case 'm21' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">디자인관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>new_design1.php" class="white_link">로고관리</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>


	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>new_design2.php" class="white_link">메인롤링관리</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>






<?
			break;
		case 'm22' :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>

	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">기타프로그램</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>etc_page1.php" class="white_link">온라인예약</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>


	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>etc_page2.php" class="white_link">전자결제</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	
	
</table>







<?
			break;
		default :
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="266f9a" class="style2">기본정보</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif"> <a href="<?=$_path[admin]?>site_setup.php" class="white_link">환경설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>site_member_form.php" class="white_link">회원항목설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>



<?php /*?>	<tr>
		<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10"> <a href="<?=$_path[admin]?>site_setup_deny.php" class="white_link">제한설정</a></td>
	</tr>
	<tr>
		<td><table width="95%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="5" height="1"></td>
				<td height="1" bgcolor="#C1C1C1"></td>
				<td width="5" height="1"></td>
			</tr>
			<tr>
				<td height="1" colspan="3"></td>
			</tr>
		</table></td>
	</tr><?php */?>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?
			break;
	}
?>
		</td>
		<td valign="top" class="m1" style="padding:10px 10px 10px 10px ">