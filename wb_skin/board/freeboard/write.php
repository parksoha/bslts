<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 글작성

변수설명
$mode : 글작성모드(write,modify,replay)
$bd_num : 글수정,답변글 일 경우 글번호
$old_pass : 글수정시 원래 암호
$wcfg['use_notice'] : 공지사항
$wcfg['use_secret'] : 비밀글
$wcfg['use_reply_mail'] : 응답글
$wcfg['input_name'] : 이름입력여부
$wcfg['input_pass'] : 암호입력여부
$wcfg['input_email'] : 이메일입력여부
$wcfg['use_home'] : 홈페이지
$wcfg['use_category'] : 카테고리
$wcfg['use_html'] : html사용
$wcfg['use_link'] : 링크사용
$wcfg['use_upload'] : 업로드
$vcfg['spam_chk'] : 스팸체크여부
$spam_chk_img : 스팸이미지
$spam_chk_code : 스팸체크코드(현재는고정)
===================================================== */
?>

<?
//include_once('../editor/func_editor.php');
$content = "$bd_content";
$upload_image = ''; // 이미지 업로드 사용 (1은 사용안함)
$upload_media = ''; // 미디어 업로드 사용 (1은 사용안함)
?>
<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>

<div id="board_write_style" class="board_write_style_pc" style="float:left; width:100%;">
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="act" value="ok">
	<input type="hidden" name="bd_num" value="<?=$bd_num?>">
	<input type="hidden" name="old_pass" value="<?=$old_pass?>">
	<input type="hidden" name="bd_html" value="1">

	<h1><? if($mode=='write') echo "새글 등록"; elseif($mode=='modify') echo "글 수정"; else echo "답변글 등록";?></h1>
	<ul class="input_list">
		<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
		<li>
			<span class="title">글종류</span>
			<? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> 공지사항&nbsp;&nbsp;<? } ?>
			<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> 비밀글&nbsp;&nbsp;<? } ?>
			<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> 답변메일수신&nbsp;&nbsp;<? } ?>
		</li>
		<? } ?>
		<? if($wcfg['input_name']) { ?>
		<li>
			<span class="title">작성자</span>
			<input name="bd_name" type="text" value="<?=$bd_name?>" />
		</li>
		<? } ?>
		<? if($wcfg['input_pass']) { ?>
		<li>
			<span class="title">암호</span>
			<input name="bd_pass" type="password" value="" />
		</li>
		<? } ?>
		<? if($wcfg['input_email']) { ?>
		<li>
			<span class="title">이메일</span>

			<?if($mode =='reply'){?>
			<input name="bd_email" type="text" value="<?=$_site_info['admin_email']?>" />
			<?}else{?>
			<input name="bd_email" type="text" value="<?=$bd_email?>" />
			<?}?>
		</li>
		<? } ?>
		<? if($wcfg['use_home']) { ?>
		<li>
			<span class="title">홈페이지</span>
			<input name="bd_home" type="text" value="<?=$bd_home?>" />
		</li>
		<? } ?>
		<? if($wcfg['use_category']) { ?>
		<li>
			<span class="title">분류</span>
			<select name="cat_num">
				<option value="">==선택==</option>
				<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
			</select>
		</li>
		<? } ?>
		<li>
			<span class="title">제목</span>
			<input name="bd_subject" type="text" class="long" value="<?=$bd_subject?>" >
		</li>
		<? if($wcfg['use_html']) { ?>
		<li>
			<span class="title">내용</span>
			<textarea name="bd_content" id="bd_content" style="width:100%;"><?=$bd_content?></textarea>
		</li>
		<? } ?>
		<?
		if($wcfg['use_link']) { 
			for($i=0;$i<$wcfg['link_count'];$i++) {
		?>
		<li>
			<span class="title">링크 <?=($i+1)?></span>
			이름 :<input name="bd_links[<?=$i?>][name]" type="text" class="underline" value="<?=$bd_links[$i]['name']?>" ><br>
			URL :<input name="bd_links[<?=$i?>][url]" type="text" class="underline" value="<?=$bd_links[$i]['url']?>" size="60" style="color:blue; text-decoration:underline;">
		</li>
		<?
			}
		}?>
		<?
		if($wcfg['use_upload']) {
			for($i=0;$i<$wcfg['upload_count'];$i++) {
		?>
		<li>
			<span class="title">첨부파일 <?=($i+1)?></span>
			<input type="file" name="bd_files[<?=$i?>]" class="input"  size="40" src="<?=$skin_url?>images/search.gif">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			삭제
			<? } ?>
		</li>
		<?
			}
		}?>
		<? if($wcfg['spam_chk']) { ?>
		<li>
			<span class="title">스팸방지</span>
			<?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
			<input name="spam_chk" type="text" class="input" size="10">
			<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>">
		<? } ?>
	</ul>

	<div class="btn_group">
	<?
		switch($mode) {
			case 'write' :
	?><input type="image" src="<?=$skin_url?>images/confirm.gif" onclick="submitContents(this.form);" style="cursor:pointer" align="absmiddle"><?
			break;
			case 'reply' :
	?><input type="image" src="<?=$skin_url?>images/confirm.gif" onclick="submitContents(this.form);" style="cursor:pointer" align="absmiddle"><?
			break;
			case 'modify' :
	?><input type="image" src="<?=$skin_url?>images/confirm.gif" onclick="submitContents(this.form);" style="cursor:pointer" align="absmiddle"><?
			break;
		}
	?>&nbsp;&nbsp;<img src="<?=$skin_url?>images/cancel.gif" onclick="history.back();" style="cursor:pointer" align="absmiddle" />
	</div>
</form>
</div>














<div id="board_write_style" class="board_write_style_mo">
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="act" value="ok">
	<input type="hidden" name="bd_num" value="<?=$bd_num?>">
	<input type="hidden" name="old_pass" value="<?=$old_pass?>">
	<input type="hidden" name="bd_html" value="0">
	<div class="write_top">
		<h1><? if($mode=='write') echo "새글 등록"; elseif($mode=='modify') echo "글 수정"; else echo "답변글 등록";?></h1>
		<div class="btn_group">
			<div class="left">
				<a href="javascript:history.back();">취소</a>
			</div>
			<div class="right">
				<input type="submit" class="btn" value="<?
				switch($mode) {
					case 'write' : echo "저장"; break;
					case 'reply' : echo "답변"; break;
					case 'modify' : echo "수정"; break;
				}
				?>" />
			</div>
		</div>
	</div>
	
	<ul class="input_list">
		<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
		<li>
			<span class="title">글종류</span>
			<? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> 공지사항&nbsp;&nbsp;<? } ?>
			<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> 비밀글&nbsp;&nbsp;<? } ?>
			<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> 답변메일수신&nbsp;&nbsp;<? } ?>
		</li>
		<? } ?>
		<? if($wcfg['input_name']) { ?>
		<li>
			<span class="title">작성자</span>
			<input name="bd_name" type="text" value="<?=$bd_name?>" placeholder="작성자" />
		</li>
		<? } ?>
		<? if($wcfg['input_pass']) { ?>
		<li>
			<span class="title">암호</span>
			<input name="bd_pass" type="password" value="" placeholder="암호" />
		</li>
		<? } ?>
		<? if($wcfg['input_email']) { ?>
		<li>
			<span class="title">이메일</span>
			<input name="bd_email" type="text" value="<?=$bd_email?>" placeholder="이메일" />
		</li>
		<? } ?>
		<? if($wcfg['use_home']) { ?>
		<li>
			<span class="title">홈페이지</span>
			<input name="bd_home" type="text" value="<?=$bd_home?>" placeholder="홈페이지" />
		</li>
		<? } ?>
		<? if($wcfg['use_category']) { ?>
		<li>
			<span class="title">분류</span>
			<select name="cat_num">
				<option value="">==선택==</option>
				<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
			</select>
		</li>
		<? } ?>
		<li>
			<span class="title">제목</span>
			<input name="bd_subject" type="text" class="long" value="<?=$bd_subject?>" placeholder="제목" />
		</li>
		<li class="inc_textarea"><textarea name="bd_content" placeholder='내용' hname="내용"><?=$bd_content?></textarea></li>
		<? /*if($wcfg['use_html']) { ?>
		<li>
			<span class="title">내용</span>
			<?=myEditor(1,$editor_Url,$formName,$contentForm,$textWidth,$textHeight);?>
		</li>
		<? }*/ ?>
		<?
		if($wcfg['use_link']) { 
			for($i=0;$i<$wcfg['link_count'];$i++) {
		?>
		<li>
			<span class="title">링크 <?=($i+1)?></span>
			이름 :<input name="bd_links[<?=$i?>][name]" type="text" class="underline" value="<?=$bd_links[$i]['name']?>" ><br>
			URL :<input name="bd_links[<?=$i?>][url]" type="text" class="underline" value="<?=$bd_links[$i]['url']?>" size="60" style="color:blue; text-decoration:underline;">
		</li>
		<?
			}
		}?>
		<?
		if($wcfg['use_upload']) {
			for($i=0;$i<$wcfg['upload_count'];$i++) {
		?>
		<li>
			<span class="title">첨부파일 <?=($i+1)?></span>
			<input type="file" name="bd_files[<?=$i?>]" class="input"  size="40" src="<?=$skin_url?>images/search.gif">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			삭제
			<? } ?>
		</li>
		<?
			}
		}?>
		<? if($wcfg['spam_chk']) { ?>
		<li>
			<span class="title">스팸방지</span>
			<?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
			<input name="spam_chk" type="text" class="input" size="10">
			<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>">
		<? } ?>
	</ul>

	<div class="btn_group">
		<div class="left">
			<a href="javascript:history.back();">취소</a>
		</div>
		<div class="right">
			<input type="submit" class="btn" value="<?
			switch($mode) {
				case 'write' : echo "저장"; break;
				case 'reply' : echo "답변"; break;
				case 'modify' : echo "수정"; break;
			}
			?>" />
		</div>
	</div>
</form>
</div>





















<script>
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "bd_content",
	sSkinURI: "../../smarteditor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["bd_content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	//var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["bd_content"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["bd_content"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {

	oEditors.getById["bd_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("bd_content").value를 이용해서 처리하면 됩니다.
	
	try {
		var chk_form = chkForm(elClickedObj.form,'0');
		if(chk_form){
			elClickedObj.form.submit();
		}
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["bd_content"].setDefaultFont(sDefaultFont, nFontSize);
}

</script>