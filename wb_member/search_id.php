<?

	include_once("../wb_include/lib.php");
	$is_use=false;
?>
<!doctype html>
<html class="">
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=yes"/>
	<title>아이디중복검색</title>
	
	
	<script src="<?=$_url['js']?>common.js"></script>
	<script src="<?=$_url['js']?>lib.validate.js"></script>


	<style>

html{ margin:0px; padding:0px; overflow: hidden;  } 
body {font-family:'malgun gothic', Dotum, AppleGothic, Sans-serif; border-collapse:collapse; margin:0px; padding:0px; width:100%; -webkit-text-size-adjust:none; zoom:1;}
h1, h2, h3, h4, h5, h6 { margin:0px; padding:0px;}
img { border:none; margin:0px; padding:0px; vertical-align:top;}
ol, ul {margin:0px; padding:0px; list-style:none;}
div, li, dl, dt, dd, form, iframe, p, a, span{margin:0px; padding:0px; list-style:none; vertical-align:top;}
label {vertical-align: middle;}
table, th, td {margin:0px; padding:0px; border-collapse:collapse;}
input, textarea {margin:0px; padding:0px; font-family:'malgun gothic', Dotum, "", Gulim, Tahoma, Verdana, AppleGothic, sans-serif;}
	

	
	.searchids{width:100%; height:auto; float:left;}
	.searchids_title{width:100%; height:auto; float:left; text-align:center; border-bottom:2px solid #000; font-size:20px; font-weight:bold; padding:10px 0 10px 0; margin-bottom:15px;}

	.wapser{width:100%; height:auto; float:left; text-align:center; font-size:14px; margin-bottom:15px;}

	.onsc_font3{ border:1px solid #ccc; height:23px; width:50%; float:left; margin-left:2%; text-align:center;}
	.ok_btn_sty3{width:100px; height:30px;  background-color:#343434; border:0; color:#fff; font-weight:bold; cursor:pointer;}
	</style>
</head>
<body>



	<div style="searchids">
		<div class="searchids_title">아이디 중복확인</div>

		<form name="login_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
			<input type="hidden" name="form_info" value="<?=$form_info?>">

		<div class="wapser">
			<?
				if($mb_id!='') { 
					if(!$validate->userid($mb_id)) {
			?> 
			<span style="font-weight:bold;"><?=$mb_id?></span>는 아이디로 사용할 수 없습니다.

			<script>
				opener.member_form.mb_id_chk.value = "";
			</script>
			<? 
					} else {
						$rs->clear();
						$rs->set_table($_table['member']);
						$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
						$rs->select();
						if(!$rs->num_rows()) { 
							$is_use=true;
			?> 
			<span style="font-weight:bold;"><?=$mb_id?></span>는 사용가능한 아이디 입니다.

			<script>
				opener.member_form.mb_id_chk.value = "1";
			</script>
			<? 
						} else {
			?> 
			<span style="font-weight:bold;"><?=$mb_id?></span>는 이미사용중인 아이디 입니다. 다른 아이디를 입력하세요.

			<script>
				opener.member_form.mb_id_chk.value = "";
			</script>
			<? 
						}
					}
				} else { 
			?> 
			사용할 아이디를 입력 해주세요.
			<?
				}
			?>		
		</div>

		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="30%" style="font-size:14px;" align="center">아이디</td>
				<td width="70%">
					<input type="text" class="onsc_font3" name="mb_id" size="18" maxlength="12" hname="아이디" required option="userid"  value="<?=$mb_id?>">
				


					<input type="submit" value="중복확인" style="color:#fff; background-color:#000; border:0; font-size:12px; width:80px; height:27px; float:left; margin-left:2%;">
			
				</td>
			</tr>
		</table>


		<div style="width:100%; height:auto; float:left; margin-top:15px; text-align:center;">

		<? if($is_use) { ?>
			<?
			list($form_name,$f_mb_id)=explode('|',$form_info);
			$form_mb_id="opener.$form_name.$f_mb_id";

			$form_mb_id2="opener.$form_name.mb_id_chk";
			?>
			<input type="button" value="사용하기" class="next ok_btn_sty3" onclick="javascript:<?=$form_mb_id?>.value='<?=$mb_id?>'; <?=$form_mb_id2?>.value='1'; <?=$form_mb_id?>.focus();self.close();">
		<? } ?>
	
		<input type="button" value="닫 기" class="next ok_btn_sty3" onclick="javascript:self.close();">
		</div>

		</form>

	</div>










	
</body>
</html>

