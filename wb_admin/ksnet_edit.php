<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	

	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['card']);
		$rs->add_where("idx=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 회원정보가 올바르지 않다면
			rg_href('','결제정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();
	}

	if($mode=='delete') {	// 삭제
		// 결제정보 삭제
		$rs->delete();
		rg_href("ksnet_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

	}
	$MENU_L='m12';
	

	extract($data);

?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="800" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">결제정보 보기</td>
  </tr>
</table>
<br>

<table border="1" cellpadding="3" cellspacing="0" width="800" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>결제방법</strong></td>
		<td>
<?
		if (empty($result) || 4 != strlen($result))
		{
			echo("(???)");
		}else
		{
			switch (substr($result,0,1))
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
?>	</td>
		<td width="120" align="center" bgcolor="#F0F0F4">성공여부</td>
		<td><?echo($authyn)?>(<? if(!empty($authyn) && "O" == $authyn) echo("승인성공"); else echo("승인거절"); ?>) </td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>주문자 이름</strong></td>
		<td><?=$sndOrdername?></td>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>구매 금액</strong></td>
		<td><?=number_format($amt)?> 원</td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>주문자 Email</strong></td>
		<td><?=$sndEmail?></td>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>주문자 전화번호</strong></td>
		<td><?=$sndMobile?></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>거래번호</strong></td>
		<td><?=$trno?></td>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>승인/코드 번호</strong></td>
		<td>
			<?=$authno?> 
			<?
				if(substr($result,0,1)==6){
					echo $bank_code_ary[$authno];
				}
			?>
			(카드사 승인번호/은행 코드번호)</td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>승인/코드 번호</strong></td>
		<td colspan="3"><?=$isscd?>  ( 발급사코드/가상계좌번호/계좌이체번호)</td>
	</tr>
</table>
<table width="800" border="0" align="center">
	<tr>
		<td align="center">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>