<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
	2007-12-10 $form_info,$dong 변수 XSS 취약점 수정
 ===================================================== */
	include_once("../wb_include/lib.php");
	$is_use=false;
	$form_info=rg_html_entity($form_info);
	$dong=rg_html_entity($dong);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SEARCH POST</title>
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
	<div class="searchPOST">
		<h1>SEARCH <span>POST</span></h1>
		<form name="login_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
			<input type="hidden" name="form_info" value="<?=$form_info?>">
			<div class="boxWrap">
			<? if($dbcon->list_tables($_table['zip'])) { ?>
				<p>찾고자 하는 지역의 '동이름'을 입력해주십시오.<br />
				예 : 서울시 강남구 삼성1동이라면 '삼성1'만 입력하시면 됩니다.</p>
				<div class="inputWrap">
					<strong>동이름</strong>
					<input type="text" class="input" name="dong" size="20" maxlength="12" minbyte="4"  hname="동이름" required  value="<?=$dong?>">
					동(읍/면)
					<input type="submit" value="검색">
				</div>
			<? } else { ?>
				<p>우편번호테이블이 없습니다.<br />관리자모드에서 우편번호 테이블을 생성하십시요.</p>
			<? } ?>
			<? if($dong!='') { 
				list($form_name,$post1,$post2,$addr1,$addr2)=explode('|',$form_info);
				if($addr2!='') $form_addr2="opener.$form_name.$addr2";
			?>
			<script>
				function submit_post(post,addr) {
					post=post.split('-');
					if(window.opener.document.getElementById('<?=$post1?>') != null) {
						window.opener.document.getElementById('<?=$post1?>').value = post[0]+"-"+post[1];
						//window.opener.document.getElementById('<?=$post2?>').value = post[1];
						window.opener.document.getElementById('<?=$addr1?>').value = addr;
					<? if($form_addr2!='') { ?>
						window.opener.document.getElementById('<?=$addr2?>').focus();
					<? } ?>
					}
					else {
						window.opener.document.<?=$form_name?>.<?=$post1?>.value = post[0]+"-"+post[1];
						//window.opener.document.<?=$form_name?>.<?=$post2?>.value = post[1];
						window.opener.document.<?=$form_name?>.<?=$addr1?>.value = addr;
					<? if($form_addr2!='') { ?>
						window.opener.document.<?=$form_name?>.<?=$addr2?>.focus();
					<? } ?>   
					}
					window.opener.document.getElementById('<?=$addr2?>').value='';
					self.close()
				}
			</script>
				<ul class="zip_result">
					<?
						$rs_list = new recordset($dbcon);
						$rs_list->clear();
						$rs_list->set_table($_table['zip']);
						$rs_list->add_order("seq");
						$rs_list->add_where("dong LIKE '%".$dbcon->escape_string($dong,DB_LIKE)."%' escape '".$dbcon->escape_ch."'");
						$rs_list->select();
						if($rs_list->num_rows()<1) {
							echo "<li class='noZip'>등록(검색) 된 자료가 없습니다.</li>";
						}
						$page_info=$rs_list->select_list($page,50,10);
						$no = $page_info['start_no'];
						while($R=$rs_list->fetch()) {
							$no--;
					?>
					<li>
						<a href="javascript:;" onClick="submit_post('<?=$R[zipcode]?>','<?=$R[sido]?> <?=$R[gugun]?> <?=$R[dong]?>');">
							<?=$R[zipcode]?> : <?=$R[sido]?> <?=$R[gugun]?> <?=$R[dong]?> <?=$R[bunji]?>
						</a>
					</li>
					<?
						}
					?>
				</ul>
				<div class="pager"><?=rg_navi_display($page_info,"dong=$dong&form_info=$form_info"); ?></div>
			<? } ?>
				<div class="btn_group">
					<a href="javascript:self.close();">닫기</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

