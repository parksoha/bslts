<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");


	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		
		

		unset($tmp);
		foreach($ks_info['level'] as $k => $v)
			if($v!='')
				$tmp[$v]=$ks_info['name'][$k];
		ksort($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($tmp));
		$rs->add_where("ss_name='ks_info'");
		$rs->update();
		
		$rs->commit();
		
	


		unset($tmp);
		foreach($ks_price['level'] as $y => $u)
			if($u!='')
				$tmp[$u]=$ks_price['name'][$y];
		ksort($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($tmp));
		$rs->add_where("ss_name='ks_price'");
		$rs->update();
		
		$rs->commit();
		
		rg_href('?');

	}

	// 상품 정보
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='ks_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","ks_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$ks_info = unserialize($tmp);

	// 금액 정보
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='ks_price'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","ks_price");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$ks_price = unserialize($tmp);

	
	$MENU_L='m12';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
<input type=hidden name=mode value="update">
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7"> 전자결제항목설정<span style="color:red; float:right;">※ 원하시는 상품명과 금액을 입력후 이용 가능합니다.</span></td>
	
  </tr>
</table>
<br>
 <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">상품명설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb1">
	 <tr>
      <td align="center" bgcolor="#F0F0F4" width="120">노출순서&nbsp;</td>
      <td align="center" bgcolor="#F0F0F4">&nbsp;상품명</td>
    </tr>
<?
	$i=0;
	if(is_array($ks_info)) 
	foreach($ks_info as $k => $v) {
		$i++;
?>
    <tr>
       <td height="40" align="center"><input type="text" class="input" name=ks_info[level][] value="<?=$k?>" size="3" dir="rtl" style="text-align:center;">&nbsp;</td>
      <td height="40" align="left">&nbsp;<input type="text" class="input" name=ks_info[name][] value="<?=$v?>" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" style="border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">
    <tr>
      <td height="40" align="center"><input type="button" value=" 추 가 " class="button" onClick="level_insert(1)"></td>
      
    </tr>
  </table>
  </br>



  <br>
 <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">상품금액설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb2">
	 <tr>
      <td align="center" bgcolor="#F0F0F4" width="120">노출순서&nbsp;</td>
      <td align="center" bgcolor="#F0F0F4">&nbsp;상품명</td>
    </tr>
<?
	$z=0;
	if(is_array($ks_price)) 
	foreach($ks_price as $y => $u) {
		$z++;
?>
    <tr>
       <td height="40" align="center"><input type="text" class="input" name=ks_price[level][] value="<?=$y?>" size="3" dir="rtl2" style="text-align:center;">&nbsp;</td>
      <td height="40" align="left">&nbsp;<input type="text" class="input" name=ks_price[name][] value="<?=$u?>" size=50> <input type="button" value="삭제" class="button" onClick="level_delete2(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" style="border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">
    <tr>
      <td height="40" align="center"><input type="button" value=" 추 가 " class="button" onClick="level_insert(2)"></td>
      
    </tr>
  </table>
  </br>
<table width="100%" align="center">
    <tr>
      <td align=center><input type="submit" value=" 적 용 " class="button">
      </td>
    </tr>
  </table>


</form>







<script>
var row_count=<?=$i?>;


function level_delete(e)
{
	var obj = find_parent_tag(e,'td');
	if(obj.parentNode)
		var idx = obj.parentNode.rowIndex;
	else
		var idx = obj.parentElement.rowIndex;
	var tRow = tb1.deleteRow(idx);
}

var row_countz=<?=$z?>;
function level_delete2(e)
{
	var obj = find_parent_tag(e,'td');
	if(obj.parentNode)
		var idx = obj.parentNode.rowIndex;
	else
		var idx = obj.parentElement.rowIndex;
	var tRow = tb2.deleteRow(idx);
}

function level_insert(id) {
	if(id=='1'){
		if(row_count<100) {
			row_count++;
			if(document.getElementById){
				var Tbl = document.getElementById('tb1');
			} else {
				var Tbl = document.all['tb1'];
			}
			var tRow = Tbl.insertRow(-1);  	
			var tmp=tRow.insertCell(0);
			tmp.innerHTML ='<input type="text" class="input" name=ks_info[level][] value="" size="3" dir="rtl" style="text-align:center;">&nbsp;';
			tmp.align='center';
			tmp.height='40';
			tmp=tRow.insertCell(1);
			tmp.innerHTML ='&nbsp;<input type="text" class="input" name=ks_info[name][] value="" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)">';
			tmp.align='center';
			tmp.height='40';
		}
	}else if(id=='2'){
		if(row_countz<100) {
			row_countz++;
			if(document.getElementById){
				var Tbl = document.getElementById('tb2');
			} else {
				var Tbl = document.all['tb2'];
			}
			var tRow = Tbl.insertRow(-1);  	
			var tmp=tRow.insertCell(0);
			tmp.innerHTML ='<input type="text" class="input" name=ks_price[level][] value="" size="3" dir="rtl2" style="text-align:center;">&nbsp;';
			tmp.align='center';
			tmp.height='40';
			tmp=tRow.insertCell(1);
			tmp.innerHTML ='&nbsp;<input type="text" class="input" name=ks_price[name][] value="" size=50> <input type="button" value="삭제" class="button" onClick="level_delete2(event)">';
			tmp.align='center';
			tmp.height='40';
		}		
	}
}
</script>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
