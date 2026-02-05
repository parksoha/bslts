<?

include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$MENU_L='m2';
include("_header.php");
include("admin.header.php");

	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table("wb_tb_msg");



$sql_msgli2s = "select distinct(SUBSTRING_INDEX(m_date,'-',2)) as aass from wb_tb_msg order by m_date desc limit 1";
$result_msgli2s = mysql_query($sql_msgli2s);				
$msgli2s = mysql_fetch_array($result_msgli2s);
$tos = explode("-",$msgli2s['aass']);



	
	if($ser == '1'){
		if($bunru == '0'){
			$rs_list->add_where("m_date LIKE '%".$sms_log_y."-".$sms_log_m."%'");
		}else{
			$rs_list->add_where("m_date LIKE '%".$sms_log_y."-".$sms_log_m."%' and m_bun='".$bunru."'");
		}
	}else{
		$rs_list->add_where("m_date LIKE '%".$msgli2s['aass']."%'");
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("idx DESC");		break;
		default : $rs_list->add_order("idx DESC");		break;
	}

	$page_info=$rs_list->select_list($page,20,10);	
	$no = $page_info['start_no'];
	$num =$no-1;


?>

<TABLE border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD bgcolor="#F7F7F7">
		<?if($ser == '1'){?>
		<B><?=$sms_log_y?>년<?=sprintf("%02d",$sms_log_m)?>월 SMS 로그</B>
		<?}else{?>
			<B><?=$tos[0]?>년<?=$tos[1]?>월 SMS 로그</B>
		<?}?>
		</TD>
	</TR>
</TABLE>
<BR>





				
<TABLE>
	<FORM name="sms_log_view" METHOD=POST enctype="multipart/form-data">
	
	<input type="hidden" value="1" name="ser">
	<TR>
		<TD>

			
			
			<select name="sms_log_y">		
				<?
				$sql_msgli2 = "select distinct(SUBSTRING_INDEX(m_date,'-',1)) as aass from wb_tb_msg order by m_date desc";
				$result_msgli2 = mysql_query($sql_msgli2);				
				$row_msgli2 = mysql_num_rows($result_msgli2);

				if($row_msgli2 > 0){
				while($msgli2 = mysql_fetch_array($result_msgli2)){						
				?>
				<option value="<?=$msgli2['aass']?>" <?if($ser=='1'){if($sms_log_y==$msgli2['aass']){echo "selected";}}else{if($msgli2['aass']==$tos[0]){echo "selected";}}?>><?=$msgli2['aass']?></option>			
				<?}}else{?>
				<option value="<?=date('Y')?>"><?=date('Y')?></option>
				<?}?>
			</select> 년

			<select name="sms_log_m">
				<? for ($i=1; $i<=12; $i++) { ?>
				<option value="<?=sprintf("%02d",$i)?>" <?if($ser=='1'){if($sms_log_m==sprintf("%02d",$i)){echo "selected";}}else{if(sprintf("%02d",$i)==$tos[1]){echo "selected";}}?>><?=sprintf("%02d",$i)?></option>
				<? } ?>
			</select> 월

			

			<select name="bunru">
				<option value="0" <?if($bunru=='0'){echo "selected";}?>>전체</option>
				<option value="1" <?if($bunru=='1'){echo "selected";}?>>단체문자</option>
				<option value="2" <?if($bunru=='2'){echo "selected";}?>>개인문자</option>
				<option value="3" <?if($bunru=='3'){echo "selected";}?>>신청문자</option>
			<select>
			<input type="submit" name="검색" value="검색" class="button">
		</TD>
		
	</TR>
	</FORM>

</TABLE>



<div style="width:100%; height:auto; float:left; color:red;">
* 전송실패는 발신번호 미등록,충전잔액부족,수신번호 오류시 노출</br>
수신자의 정확한 발송상태를 보시려면 <a href="http://www.icodekorea.com/" target="_blank" style="color:blue;">(http://www.icodekorea.com/)</a>에서 로그인하여 확인 가능합니다.
</div>
<div style="float:right;">Total : <?=$num?></div>
<BR>

<TABLE  border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
<col width='5%' />
<col width='5%' />
<col width='12%' />
<col width='9%' />
<col width='31%' />
<col width='5%' />
<col width='5%' />
<col width='5%' />
<col width='23%' />
	<TR height="25" bgcolor="#F0F0F4">
		<TD align='center'>번호</TD>
		<TD align='center'>분류</TD>
		<TD align='center'>발송시간</TD>
		<TD align='center'>발송번호</TD>
		<TD align='center'>제목</TD>
		<TD align='center'>총건수</TD>
		<TD align='center'>성공건수</TD>
		<TD align='center'>실패건수</TD>
		<TD align='center'>발송상태</TD>
	</TR>


<?

if($num > 0){
while($R=$rs_list->fetch()) {
	$no--;

?>


<TR height='25'>
	<TD align='center'><?=$no?></TD>
	<TD align='center'>
	<?if($R['m_bun']=='1'){?>
	단체문자
	<?}else if($R['m_bun']=='2'){?>
	개인문자
	<?}else if($R['m_bun']=='3'){?>
	신청문자
	<?}?>
	</TD>
	<TD align='center'><?=$R['m_date']?></TD>
	<TD align='center'><?=$R['m_num']?></TD>
	<TD>&nbsp;<?=mb_strimwidth($R['m_title'],0,55,'...','utf-8')?></TD>
	<TD align="center"><?=$R['m_mark']?>건</TD>
	<TD align="center"><?=$R['m_mark2']?>건</TD>
	<TD align="center"><?=$R['m_mark3']?>건</TD>
	<TD align="center"><?=$R['m_state']?></TD>
</TR>
<?}
}else{
?>
<TR height='25'>
	<TD align='center' colspan="9"><B>SMS 발송내역이 없습니다.</B></TD>
</TR>
<?}?>

</TABLE>
<table width="100%">
	<tr>
		<td> </td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<?
include("admin.footer.php");
include("_footer.php");
?>