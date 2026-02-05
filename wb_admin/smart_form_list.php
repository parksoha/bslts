<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['smart_form']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'이름',2=>'연락처'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("smart_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("smart_hpno LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break;
			}
		}
	}

	switch ($ot) {
		case 3 : $rs_list->add_order("smart_num DESC");	break;
		default : $rs_list->add_order("smart_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m10';

include("_header.php");
include("admin.header.php"); 
?>

<script>
function smart_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한건이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">대출상담목록</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
검색: <select name="ss[0]">
<? $ss_list = array(1=>'이름',2=>'연락처'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
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
<col width="20" />
<col width="30" />
<col width="30" />
<col width="40" />
<col width="60" />
<col width="90" />
<col width="120" />
<col width="60" />
<col />
	<tr align="center" bgcolor="#F0F0F4">
		<td><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
		<td>수정</td>
		<td>삭제</td>
		<td>번호</td>
		<td>이름</td>
		<td>연락처</td>
		<td>신청날짜</td>
		<td>진행상황</td>
		<td>관리자 메모</td>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

	if($R[smart_process] == "2") {
		$smart_process = "<font color='blue'>상담완료</font>";
	} else {
		$smart_process = "<font color='red'>접수</font>";
	}
?>
	<tr height="25">
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[smart_num]?>" class=none></td>
		<td align="center"><a href="smart_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[smart_num]?>">수정</a></td>
		<td align="center"><a href="#" onClick="confirm_del('smart_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[smart_num]?>')">삭제</a></td>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[smart_name]?></td>
		<td align="center"><?=$R[smart_hpno]?></td>
		<td align="center"><?=$R[smart_datetime]?></td>
		<td align="center"><?=$smart_process?></td>
		<td align="center">&nbsp;<?=rg_cut_string($R[smart_memo], 80, "...")?>&nbsp;</td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr><td height="10"></td></tr>
	<tr>
		<td width="130">
			<input type="button" value="상담신청" class="button" onClick="location.href='smart_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=join'">
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>