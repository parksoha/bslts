<?

	include_once("../wb_include/lib.php");
	include_once("../wb_sms/mw.sms.lib.php");
	require_once("admin_chk.php");

	$MENU_L='m12';	

	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['card']);

	switch ($ot) {
		case 10 : $rs_list->add_order("idx DESC");		break;
		default : $rs_list->add_order("idx DESC");		break;
	}

	$page_info=$rs_list->select_list($page,20,10);
?>


<? include("_header.php"); ?>
<? include("admin.header.php"); ?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">결제 목록<span style="color:red; float:right;">※ 거래처 미수금을 카드결제로 받을수 있도록 구성한 화면입니다.</span></td>

  </tr>
</table>
<br>
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td width="30" >보기</td>
		<td width="30" >삭제</td>
		<td width="40" >번호</td>
		<td width="100">결제방법</td>
		<td width="100">성공여부</td>
		<td width="200">주문자명(회사)</td>
		<td width="200">이메일</td>
		<td width="150">전화번호</td>
		<td width="150">금액</td>
		<td width="150">거래시간</td>
		</tr>
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
?>
	<tr height="25">
		<td align="center"><? if($R[mb_id] == "webbridge") { echo "&nbsp;"; } else { ?><a href="ksnet_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[idx]?>">보기</a><? } ?></td>
		<td align="center"><? if($R[mb_id] == "webbridge") { echo "&nbsp;"; } else { ?><a href="#" onClick="confirm_del('ksnet_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[idx]?>')">삭제</a><? } ?></td>
		<td align="center"><?=$no?></td>
		<td align="center">
<?
			if (empty($R[result]) || 4 != strlen($R[result]))
			{
				echo("(???)");
			}else
			{
				switch (substr($R[result],0,1))
				{
					case '1' : echo("신용카드"); break;
					case 'I' : echo("신용카드"); break;
					case '2' : echo("실시간계좌이체"); break;
					case '6' : echo("가상계좌발급"); break; 
					case 'M' : echo("휴대폰결제"); break; 
					case 'G' : echo("상품권"); break; 
					default  : echo("(????)"); break; 
				}
			}
?>
		</td>
		<td align="center"><?echo($R[authyn])?>(<? if(!empty($R[authyn]) && "O" == $R[authyn]) echo("승인성공"); else echo("승인거절"); ?>) </td>
		<td align="center"><?echo$R[sndOrdername]?></td>
		<td align="center"><?echo$R[sndEmail]?></td>
		<td align="center"><?echo$R[sndMobile]?></td>
		<td align="center"><?=number_format($R[amt])?>원</td>
		<td align="center"><?echo date("Y-m-d H:i:s",$R[c_date])?></td>
		</tr>
<?
}
?>
</table>
<table width="100%">
	<tr>
		<td> </td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>