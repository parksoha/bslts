<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

	

	$ret_url = get_ret_url("page");
	$ret_url.="page=";
	$thispage = $page ? $page : 1 ;
	$perpage = 20; //페이지에 보여줄 갯수
	$limit = $perpage*($thispage-1); //보여질 페이지
	$limit_con=" limit ".$limit.",".$perpage;
	$total_page = $total/$perpage > 1 ? $total/$perpage : 1;
	$query = mysql_query("select * from push_notice where 1 order by idx desc ".$limit_con);
	$total =@mysql_num_rows(mysql_query("select * from push_notice where 1 order by idx desc "));
	$MENU_L='m17';
	$pageHMTL = page($total, $perpage, $thispage,$ret_url);

?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="950" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td bgcolor="#F7F7F7">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><B>공지 리스트</B></td>
					<td align="right">Total : <?=$total?>	(<?=$thispage?>/<?=$total_page?>)</td>
				</tr>
			</table>
		</td>
	</tr>
</table></br>

<table border="1" cellpadding="0" cellspacing="0" width="950" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
<col width="5%" style="text-align:center;" />
<col width="" style="text-align:center;" />
<col width="" style="text-align:center;" />
<col width="" style="text-align:center;" />
<col width="10%" style="text-align:center;" />
	<tr align="center" bgcolor="#F0F0F4">
		<!-- <td><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td> -->
		<td><B>번호</B></td>
		<td><B>공지제목</B></td>
		<td><B>등록일자</B></td>
		<td><B>처리상태</B></td>
		<td><B>관리</B></td>
	</tr>
	<?
	$push_state = array("S"=>"<font color=red>발송대기</font>","E"=>"<font color=blue>발송완료</font>");
	$i=1;
	while($asc = @mysql_fetch_assoc($query)){
	extract($asc);
	?>
	<tr align="center">
		<td>&nbsp;<?=$i++?></td>
		<td>&nbsp;<?=$p_subject?></td>
		<td>&nbsp;<?=date("Y-m-d",$p_date)?></td>
		<td>&nbsp;<?=$push_state[$p_state]?></td>
		<td>
			<a href="./push_notice_edit.php?idx=<?=$idx?>&mode=modify">보기</a>
		</td>
	</tr>
		<?}?>
</table>
<table width="950" style="border:0px solid red">
	<tr>
		<td width="150">
			<input type="button" value="공지등록" class="button" onClick="location.href='push_notice.php';">
		</td>
	</tr>
	<tr>
		<td align="center">
			<?=$pageHMTL?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>