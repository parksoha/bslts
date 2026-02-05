<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
-->
</style>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	
	<tr>
	  <td height="25" colspan="2" align="right" bgcolor="1c7fb9" style="padding-right:10px"><table  cellspacing="0" cellpadding="0">
        <tr>
          <td><a href="<?=$_path['page']?>" target="_blank" class="menu">홈페이지</a> <span class="style2">│</span> <a href="<?=$_url['member']?>login.php?logout" class="menu">로그아웃</a></td>
        </tr>        
      </table></td>
  </tr>
	<tr>
		<td align="center" valign="top" bgcolor="1c7fb9" style="padding-top:5px"><span class="style1">ADMIN PAGE</span></td>
        <td height="55" align="left" valign="top" bgcolor="1c7fb9" style="padding-top:5px"><table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="80" align="center"><a href="<?=$_path[admin]?>site_setup.php" class="menu">기본정보</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center"><a href="<?=$_path[admin]?>member_list.php" class="menu">회원관리</a></td>
            <td width="5"><span class="style2">│</span></td>
            <!-- <td width="80" align="center" ><a href="<?=$_path[admin]?>group_list.php" class="menu">그룹관리</a></td>
            <td width="5"><span class="style2">│</span></td> -->
            <td width="80" align="center" ><a href="<?=$_path[admin]?>bbs_list.php" class="menu">게시판관리</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center" ><a href="<?=$_path[counter]?>" class="menu">기타관리</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center" ><a href="<?=$_path[admin]?>newwinlist.php" class="menu">팝업창관리</a></td>
            <td width="5"><span class="style2">│</span></td>
            <td width="80" align="center" ><a href="<?=$_path[admin]?>free_form_list.php" class="menu">신청폼관리</a></td>
			<td width="5"><span class="style2">│</span></td>
            <!-- <td width="80" align="center" ><a href="<?=$_path[admin]?>inquiry.php" class="menu">문의하기</a></td>-->
		   <td width="80" align="center" style="padding-left:50px;"><a href="http://webbridge.co.kr/wb_board/list.php?&bbs_code=maintenance" style="color:#d7e9f4; font-weight:normal;font-size:12px;" class="menu" target="_blank">유지보수문의</a></td>	
			<td width="5"><span class="style2">│</span></td>
		   <td width="110" align="center"><a href="<?=$_path[admin]?>partner.php" class="menu" style="color:#d7e9f4; font-weight:normal;font-size:12px;">파트너쉽 제휴 제안</a></td>
		   <td width="5"><span class="style2">│</span></td>
		   <td width="80" align="center"><a href="<?=$_path[admin]?>portal.php" class="menu" style="color:#d7e9f4; font-weight:normal;font-size:12px;">포털 광고하기</a></td>
          </tr>
        </table></td>
          </tr>
        </table></td>
  </tr>
	<tr>
	  <td width="180" align="center"><img src="<?=$_path[admin]?>images/too_bg2.gif"/></td>
	  <td align="left" background="<?=$_path[admin]?>images/top_bg.gif">&nbsp;</td>
  </tr>
</table>

<table width="100%" height="600"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="180" valign="top" background="<?=$_path[admin]?>images/left_bg.gif">

<? 
	switch($MENU_L) {
		case 'm2' : 
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">회원관리</td>
	</tr>	
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>member_list.php">회원목록</a></td>
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
    <td height="30" align="center" bgcolor="b1b1b1" class="style2">그룹관리</td>
  </tr>  
  <tr>
    <td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>group_list.php">그룹목록</a></td>
  </tr>
  <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
  <tr>
    <td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>group_member_list.php">그룹회원목록</a></td>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">게시판관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>bbs_list.php">게시판관리</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">기타관리</td>
	</tr>	
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_url['counter']?>">접속통계</a></td>
	  </tr>
	 <tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_sms_log.php">SMS 로그</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>fax_log.php">FAX 로그</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	  <tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>create_zip_tables.php">우편번호 테이블생성</a></td>
		</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">방문자통계</td>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2"> 팝업창관리</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>newwinlist.php">팝업창관리</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
    <tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href='<?=$_path[admin]?>newwinform.php'>팝업창등록</a><a href="<?=$_path[admin]?>jin_list.php"></a></td>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">신청폼관리</td>
	</tr>	
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_form_list.php">신청리스트</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>free_form_set.php">신청폼설정</a></td>
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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">웹브릿지에 문의하기</td>
	</tr>	
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>inquiry.php">문의하기</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
</table>




<?
			break;			
		case 'm19' : 
?>
<table width="175"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="10"></td>
	</tr>

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
		<td height="30" align="center" bgcolor="b1b1b1" class="style2">기본정보</td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif"> <a href="<?=$_path[admin]?>site_setup.php">환경설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
	<tr>
		<td height="25"><img src="<?=$_path[admin]?>images/bu.gif" /> <a href="<?=$_path[admin]?>site_member_form.php">회원항목설정</a></td>
	</tr>
	<tr>
		<td><img src="<?=$_path[admin]?>images/left_line.gif" /></td>
	</tr>
<?php /*?>	<tr>
		<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10"> <a href="<?=$_path[admin]?>site_setup_deny.php">제한설정</a></td>
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