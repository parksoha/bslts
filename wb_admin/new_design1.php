<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	// 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['form_set']);
	$rs->select();
	$row=$rs->fetch();

	$MENU_L='m21';
	

include("_header.php");
include("admin.header.php"); 




?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">로고관리</td>
  </tr>
</table>
<br>

<form name="logoForm" method="post" action="design_ok.php?act=design_a&part=1"  enctype="multipart/form-data" >
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD width="150">상단로고</TD>
	
		<TD><input type="file" name="img">
			<?if($logo1[logo1] != ""){?>
			<img src="../wb_data/design/<?=$logo1[logo1]?>" width="144">
			<?}?>
		</TD>	
	</TR>	

	<tr>
		<td colspan="2" align="center"><input type="submit" value="저장" class="button" style="width:80px; height:25px; cursor:pointer;"></td>
	</tr>
	
</TABLE>
</form>

</br>

<form name="logoForm" method="post" action="design_ok.php?act=design_a&part=2"  enctype="multipart/form-data" >

<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD width="150">하단로고</TD>
	
		<TD><input type="file" name="img">
			<?if($logo2[logo2] != ""){?>
			<img src="../wb_data/design/<?=$logo2[logo2]?>" width="144">
			<?}?>
		</TD>	
	</TR>	

	<tr>
		<td colspan="2" align="center"><input type="submit" value="저장" class="button" style="width:80px; height:25px; cursor:pointer;"></td>
	</tr>
	
</TABLE>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>