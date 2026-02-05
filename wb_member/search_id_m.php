<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	include_once("../wb_include/lib.php");
	$is_use=false;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SEARCH ID</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="apple-touch-fullscreen" content="YES" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<script src="<?=$_url['js']?>common.js"></script>
	<script src="<?=$_url['js']?>lib.validate.js"></script>
</head>
<body>
	<div class="searchID">
		<h1>SEARCH <span>ID</span></h1>
		<form name="login_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
			<input type="hidden" name="form_info" value="<?=$form_info?>">
			<div class="boxWrap">
				<p>
					<?
						if($mb_id!='') { 
							if(!$validate->userid($mb_id)) {
					?> 
					<span class="id"><?=$mb_id?></span>는 아이디로 사용할 수 없습니다.
					<? 
							} else {
								$rs->clear();
								$rs->set_table($_table['member']);
								$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
								$rs->select();
								if(!$rs->num_rows()) { 
									$is_use=true;
					?> 
					<span class="id"><?=$mb_id?></span>는 사용가능한 아이디 입니다.
					<? 
								} else {
					?> 
					<span class="id"><?=$mb_id?></span>는 이미사용중인 아이디 입니다.<br>다른 아이디를 입력하세요.
					<? 
								}
							}
						} else { 
					?> 
					사용할 아이디를 입력 해주세요.
					<?
						}
					?>
				</p>
				<div class="inputWrap">
					<strong>아이디</strong>
					<input type="text" class="input" name="mb_id" size="18" maxlength="12" hname="아이디" required option="userid"  value="<?=$mb_id?>">
					<input name="submit" type="submit" value="중복확인">
				</div>
				<div class="btn_group">
					<? if($is_use) { ?>
						<?
						list($form_name,$f_mb_id)=explode('|',$form_info);
						$form_mb_id="opener.$form_name.$f_mb_id";
						?>
						<a href="javascript:<?=$form_mb_id?>.value='<?=$mb_id?>';<?=$form_mb_id?>.focus();self.close();">사용하기</a>
					<? } ?>
						<a href="javascript:self.close();">닫기</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

