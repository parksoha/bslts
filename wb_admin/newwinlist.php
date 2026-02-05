<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");
$MENU_L='m9';
include("_header.php"); 



$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['new_win']);
$rs_list->add_where("nw_begin_time<= '".date("Y-m-d")."'");
$rs_list->add_where("nw_end_time >= '".date("Y-m-d")."'");
$rs_list->add_order("nw_id asc");
$rs_list->select();





include("admin.header.php");


$rs = new recordset($dbcon);
$rs->clear();
$rs->set_table($_table['new_win']);
$rs->add_order("nw_id DESC");
$page_info=$rs->select_list($page,20,10);



?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">팝업창 목록</br>
		<span style="color:red;">* 팝업은 3개까지 등록 가능합니다.</span>	
	
	</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td>번호</td>
		<td>수정</td>
		<td>삭제</td>
		<td>시작일시</td>
		<td>종료일시</td>
		<td>Left</td>
		<td>Top</td>
		<td>Height</td>
		<td>Width</td>
		<td>제목</td>
	</tr>
<?
	if($rs->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"10\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	$no = $page_info['start_no'];
	while($row=$rs->fetch()) {
		$no--;
?>

	<tr height="25">
		<td align="center"><?=$no?></td>
		<td align="center"><a href="./newwinform.php?w=u&nw_id=<?=$row[nw_id]?>">수정</a></td>
		<td align="center"><a href="#" onClick="javascript:confirm_del('./newwinformupdate.php?<?=$p_str?>&page=<?=$page?>&w=d&nw_id=<?=$row[nw_id]?>')">삭제</a></td>
		<td align="center"><?=substr($row[nw_begin_time],2,14)?>&nbsp;</td>
		<td align="center"><?=substr($row[nw_end_time],2,14)?>&nbsp;</td>
        <td align="center"><?=$row[nw_left]?>&nbsp;</td>
        <td align="center"><?=$row[nw_top]?>&nbsp;</td>
        <td align="center"><?=$row[nw_height]?>&nbsp;</td>
        <td align="center"><?=$row[nw_width]?>&nbsp;</td>
        <td align="center"><?=$row[nw_subject]?>&nbsp;</td>
	</tr>

<? } ?>
</table>
</form>

<table width="100%">
	<tr>
		<td width="150" height="35" valign="middle">
			<?if($rs_list->num_rows() == 3){?>
			<input type="button" value="팝업창등록" class="button" onClick="alert('팝업창은 3개까지 등록 가능합니다.');">
			<?}else{?>
			<input type="button" value="팝업창등록" class="button" onClick="location.href='./newwinform.php'">
			<?}?>
			
		</td>
		
	</tr>
</table>

<? 
include("admin.footer.php"); 
include("_footer.php"); 
?>
