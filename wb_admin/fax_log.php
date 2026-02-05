<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['fax']);

	if($mode=='delete') {	// 삭제
		$rs_list->add_where("num=$num");
		$rs_list->delete();
		rg_href("fax_log.php?$_get_param[3]");
	}

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'신청인',2=>'팩스번호'
				case '0' : 
					if($kw!='' && $__v!='') {
						// 휴대폰
						if($__v == "2"){
							$kw = str_replace("-", "", $kw);
							$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						} else {
							$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						}
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : 
								$rs_list->add_where("name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); 
								break;
							case '2' : 
								$rs_list->add_where("fax LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); 
								break;
						}
						unset($ss_kw);
					}
					break;
			}
		}
	}

	switch ($ot) {
		case 6 : $rs_list->add_order("num DESC");		break;
		default : $rs_list->add_order("num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';

include("_header.php");
include("admin.header.php"); 
?>

<script>
function free_form_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7"><B>FAX 발송 로그</B></td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
검색: <select name="ss[0]">
<? $ss_list = array(1=>'신청인',2=>'팩스번호'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="검색" value="검색" style="width:60px;height:21px;" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" style="width:60px;height:21px;" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input name="mode" type="hidden" value="">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<col width="50" />
	<col width="100" />
	<col width="100" />
	<col />
	<col width="120" />
	<col width="120" />
	<col width="100" />
	<col width="50" />
	<tr align="center" bgcolor="#F0F0F4">
		<td>번호</td>
		<td>신청인</td>
		<td>팩스번호</td>
		<td>발송제목</td>
		<td>팩스 전송 신청일시</td>
		<td>팩스 결과 회신일시</td>
		<td>전송결과</td>
		<td>삭제</td>
	</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"300\">
		<td align=\"center\" colspan=\"8\"><B>FAX 발송내역이 없습니다.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
	<tr height="25">
		<td align="center"><?=$no?></td>
		<td align="center">&nbsp;<?=$R[name]?>&nbsp;</td>
		<td align="center">&nbsp;<?=$R[fax]?>&nbsp;</td>
		<td align="center">&nbsp;<?=$R[tit]?>&nbsp;</td>
		<td align="center">&nbsp;<?=$R[write_date]?>&nbsp;</td>
		<td align="center">&nbsp;<?=$R[modify_date]?>&nbsp;</td>
		<td align="center">&nbsp;<? if($R[result_code] == 1) { echo "<font color='#0000FF'>".$R[result]."</font>"; } else { echo "<font color='#FF0000'>".$R[result]."</font>"; }?>&nbsp;</td>
		<td align="center"><a href="#" onClick="confirm_del('fax_log.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>')">삭제</a></td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		<td height="60" align="center" valign="middle">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>