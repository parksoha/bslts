<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['estimate']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'이름',2=>'휴대전화'
				case '0' : 
					if($kw!='' && $__v!='') {
						// 연락처
						if($__v == "2"){
							$kw_hp = str_replace("-", "", $kw);
							$ss_kw=$dbcon->escape_string($kw_hp,DB_LIKE);
						} else {
							$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						}
						switch ($__v) {
							case '1' : 
								$rs_list->add_where("name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); 
								break;
							case '2' : 
								$rs_list->add_where("REPLACE(hand, '-', '') LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); 
								break;
						}
						unset($ss_kw);
					}
					break;
			}
		}
	}

	switch ($ot) {
		case 3 : $rs_list->add_order("num DESC");	break;
		default : $rs_list->add_order("num DESC");	break;
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
    <td bgcolor="#F7F7F7"><B>견적신청 리스트</B></td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
검색: <select name="ss[0]">
<? $ss_list = array(1=>'이름',2=>'휴대전화'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" style="height:20px;"> <input type="submit" name="검색" value="검색" style="width:60px;height:20px;" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" style="width:60px;height:20px;" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list1_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input name="mode" type="hidden" value="">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
<col width="50" align="center" />
<col width="100" align="center" />
<col width="100" align="center" />
<col width="100" align="center" />
<col  />
<col width="80" align="center" />
<col width="80" align="center" />
<col width="60" align="center" />
<col width="50" align="center" />
	<tr align="center" bgcolor="#F0F0F4">
		<!-- <td><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td> -->
		<td><B>번호</B></td>
		<td><B>이름</B></td>
		<td><B>아이디</B></td>
		<td><B>휴대전화</B></td>
		<td><B>이메일</B></td>
		<td><B>상담형태</B></td>
		<td><B>신청일</B></td>
		<td><B>처리상황</B></td>
		<td><B>삭제</B></td>
	</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

	if($R[process] == "접수") {
		$process = "<font color='#3300FF'>접수</font>";
	} else {
		$process = "<font color='#FF3300'>완료</font>";
	}

?>
	<tr height="25">
		<!-- <td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[smart_num]?>" class=none></td> -->
		<td><?=$no?></td>
		<td><a href="estimate_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>"><?=$R[name]?></a></td>
		<td>&nbsp;<a href="estimate_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>"><?=$R[mbid]?></a>&nbsp;</td>
		<td>&nbsp;<a href="estimate_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>"><?=$R[hand]?></a>&nbsp;</td>
		<td>&nbsp;<?=$R[email]?></td>
		<td>&nbsp;<?=$R[consult]?>&nbsp;</td>
		<td><?=substr($R[write_date], 0, 10)?></td>
		<td><?=$process?></td>
		<td><a href="javascript:void(0);" onClick="confirm_del('estimate_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>')">삭제</a></td>
	</tr>
<? } ?>
</table>
</form>
<table width="100%">
	<tr><td height="30"></td></tr>
	<tr>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>