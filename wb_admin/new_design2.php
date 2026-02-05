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

<script>
//정보 전송
function bannerwriteSendit(Obj)
{

	if(Obj.img2.value=="")
	{
		alert("이미지를 선택해 주십시오.");
	}
	else
	{
		
		Obj.submit();
	}


}
function bannerSendit(Obj,idxs,mod,texts)
{

	if(confirm(texts+"하겠습니까?")){
		Obj.idx.value=idxs;
		Obj.mode.value=mod;
		Obj.submit();

	}else{
		return false;
	}


}
</script>


<style>
div, ul, li{list-style:none; padding:0; margin:0;}
.new_desi{width:750px; float:left; padding-left:57px;}
.new_tit_de{width:750px; float:left; height:auto;}
.new_tit_de ul{width:100%; height:auto; float:left;}
.new_tit_de ul li{width:auto; float:left; height:30px;border:1px solid #000; font-size:12px;line-height:30px; padding:0 8px 0 8px; margin-right:10px; cursor:pointer;}
.btn_bk{color:#fff; background-color:#000;}

.desiz_fom{width:100%; height:auto; float:left; margin-top:20px;}
.desiz_fom ul.imag_tit{width:100%; height:auto; float:left;}
.desiz_fom ul.imag_tit li{width:100%; height:20px; float:left; line-height:20px; padding-bottom:5px; font-size:14px; font-weight:bold; color:#000;}

.desiz_fom ul.in_fom_info{width:748px; height:auto; float:left; border:1px solid #000;}
.desiz_fom ul.in_fom_info li.ima_in{width:100%; height:auto; float:left; text-align:center; padding:30px 0 30px 0;}
.desiz_fom ul.in_fom_info li.ima_in2{width:100%; height:auto; float:left; text-align:center; padding:10px 0 10px 0; border-top:1px solid #000;}

.fil_in{border:1px solid gray; font-size: 9pt; height: 19px; background-color:#fff;}
.fil_sav{width:60px; height:20px; border:1px solid #434343; color:#fff; background-color:#434343; font-size:12px;  line-height:19px; cursor:pointer;}



.mytable { border-collapse:collapse; }  
.mytable th, .mytable td { border:1px solid black; }
</style>





<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">메인롤링관리</td>
  </tr>
</table>
<br>









<div class="new_desi">
	
	<div style="width:100%; height:20px; float:left; font-size:14px; font-weight:bold; color:red; margin-top:15px; line-height:20px;">※주의! 이미지 사이즈가 모두 동일해야 합니다.</div>


	<form name="bannerwriteForm5" method="post" action="design_ok.php"  enctype="multipart/form-data" >
	<input type="hidden" name="act" value="design_b">
	<input type="hidden" name="part" value="11">

	<div class="desiz_fom">
		<ul class="imag_tit">
			<li>※PC메인 롤링 이미지 수정 → gif , jpg , png 사용가능 </li>
		</ul>

	</div>

	

	<table border="1" cellspacing="0" cellpadding="0" width="100%" class="mytable">
		<tr>
			<td width="15%" align="center">링크주소</td>
			<td width="35%" height="60">&nbsp;
				<input type="text" name="siteUrl"  size="20" style=" border:1px solid gray; height: 19px;"></br>
				&nbsp;<input type="radio" name="siteTarget" value="_parent" checked>현재창 <input type="radio" name="siteTarget" value="_blank">새창 
			</td>

			<td width="15%" align="center">이미지순서</td>
			<td width="35%" height="60">&nbsp;
				<input class="box" type="text" name="sunwi" size=10> 예) 1~10
			</td>
		</tr>

		<tr>
			<td width="15%" align="center">PC 이미지 등록</br>넓이:2000px</td>
			<td height="30">&nbsp;<input type="file" name="img" class="fil_in" style="height:25px;"></td>

			<td colspan="2" rowspan="2" align="center"><input type="button" value="저장" class="fil_sav" onclick="bannerwriteSendit(document.bannerwriteForm5);"></td>
		</tr>


		<tr>
			<td width="15%" align="center">M 이미지 등록</br>넓이:1024px</td>
			<td height="30">&nbsp;<input type="file" name="img2" class="fil_in" style="height:25px;"></td>			
		</tr>
	</table>
	</form>



	<?

	$ban_qry = "select *from wb_tb_design2 order by orders asc";
	$ban_result = mysql_query($ban_qry);
	$ban_cnt =0;
	while($ban_row = mysql_fetch_array($ban_result))
	{
		$ban_cnt ++;
	?>

	
	<form name="bannerForm44<?=$ban_cnt?>" method="post" action="design_ok.php"  enctype="multipart/form-data" >
		<input type="hidden" name="act" value="design_b">
		<input type="hidden" name="part" value="12">
		<input type="hidden" name="idx">
		<input type="hidden" name="mode">
	
	
	<div class="desiz_fom">
		
		<ul class="in_fom_info" style="border-bottom:0;">
			<li class="ima_in">
			<span style="width:97%; height:auto; float:left; font-size:14px; font-weight:bold; text-align:left; padding-left:3%;">※PC</span>
			<img src="../wb_data/design/<?=$ban_row[main_img]?>" width="700"></br>
			<span style="width:97%; height:auto; float:left; font-size:14px; font-weight:bold; text-align:left; padding-left:3%;">※M</span>
			<img src="../wb_data/design/<?=$ban_row[main_img2]?>" width="700">
			</li>
			
		</ul>
	</div>


	<table border="1" cellspacing="0" cellpadding="0" width="100%" class="mytable">
		<tr>
			<td width="15%" align="center">링크주소</td>
			<td width="35%" height="60">&nbsp;
				<input type="text" name="siteUrl" value="<?=$ban_row[main_url]?>"  size="20" style=" border:1px solid gray; height: 19px; background-color: <?=$site_color?>" <?=$site_disabled?>></br>&nbsp;
				<input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[main_target] == "_parent") echo "checked";?>>현재창 <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[main_target] == "_blank") echo "checked";?>>새창
			</td>

			<td width="15%" align="center">이미지순서</td>
			<td width="35%" height="60">&nbsp;
				<input class="box" type="text" name="sunwi" value="<?=$ban_row[orders]?>" size=10> 예) 1~10
			</td>
		</tr>

		<tr>
			<td width="15%" align="center">PC 이미지 등록</br>넓이:2000px</td>
			<td height="30">&nbsp;<input type="file" name="img" class="fil_in" style="height:25px;"></td>

			<td colspan="2" rowspan="2" align="center">
			<input type="button" value="수정" class="fil_sav" onclick="bannerSendit(document.bannerForm44<?=$ban_cnt?>,'<?=$ban_row[idx]?>','edit','수정');">&nbsp;&nbsp;
			<input type="button" value="삭제" class="fil_sav" onclick="bannerSendit(document.bannerForm44<?=$ban_cnt?>,'<?=$ban_row[idx]?>','del','삭제');">
			</td>
		</tr>



		<tr>
			<td width="15%" align="center">M 이미지 등록</br>넓이:1024px</td>
			<td height="30">&nbsp;<input type="file" name="img2" class="fil_in" style="height:25px;"></td>

			
		</tr>
	</table>


	</form>
	<?}?>



	
</div>




<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>