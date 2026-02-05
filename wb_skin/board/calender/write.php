<?

		if($mode=='modify') {//글 수정
			$title = rg_date($bd_ext5,'%Y년 %m월 %d일')." 일정 수정";
			$bd_ext5_value = $bd_ext5;
		} else if($mode=='reply') {//응답글
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->add_where("bd_num = '$bd_num'");
			$data=$rs->fetch();
			$title = rg_date($data['bd_ext5'],'%Y년 %m월 %d일')." 일정 답변글 등록";
			$bd_ext5_value = $data['bd_ext5'];
		} else {//글쓰기
			if($book!='') {//날짜를 클릭해서 글쓰기 $book 지정
			$title = rg_date($book,'%Y년 %m월 %d일')." 일정 등록";
			$bd_ext5_value = $book;
			} else {//글쓰기 버튼으로 글쓰기 $book 비지정
			$mode="new_nobook";
			$title = "새 일정 등록";
			}
		}
?>
<div style="height:5px;"></div>

<!--form name="my_form" method="post" enctype="multipart/form-data" action="/croco/wb_skin/board/calender/upload_csv.php">
	<input type="hidden" name="mode" value="upload"/>
	<table border="0" cellpadding="1" cellspacing="1" width="<?=$width?>">
		<TR> 
			<TD colspan="2">
			<div style="float:left;font-weight:bold;">일정 일괄 업로드(CSV)</div>
			
			</TD>
		</TR>
		<tr bgcolor="#cccccc" height="1">
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#f7f7f7">
			<td width="120" align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font> <strong>첨부파일</strong></td>
			<td><input type="file" name="userfile"></td>
		</tr>
	</table>
	<table width="100%" border="0">
		<tr>
			<td align="center">
				<input type="image" src="<?=$skin_url?>images/confirm.gif" align="absmiddle" > 
				
				<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">

			</td>
		</tr>
	</table>
</form -->

<br/>


<!-- onSubmit="return validate(this)"-->
<form name="write_form" id="write_form" method="post" action="?"  enctype="multipart/form-data">
<?=$_post_param[3]?>
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<?=($mode!='new_nobook')?"<input type='hidden' name='bd_ext5' value='$bd_ext5_value'>":""?>

<table border="0" cellpadding="1" cellspacing="1" width="<?=$width?>">
		<TR> 
			<TD colspan="2">
			<div style="float:left;font-weight:bold;"><?=$title?></div>
			<!--<div style="float:right;"><font color="red"><b>*</b></font> 표시가 있는 부분은 필수항목입니다.<B>&nbsp;</B></div>-->
			</TD>
		</TR>
	<tr bgcolor="#cccccc" height="1">
		<td colspan="2"></td>
	</tr>
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<!--<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><strong>글종류</strong></td>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>>공지사항&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>>비밀글&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="" value="1" <?=$chk_bd_reply_mail?>>답변메일수신&nbsp;&nbsp;<? } ?>
		</td>
	</tr>-->
<? } ?>
<? if($wcfg['input_name']) { ?>
	<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font> <strong>팀</strong></td>
		<td><input name="bd_name" id="bd_name" type="text" class="input" style="width:90%;"value="<?if($mode=='modify')echo $bd_name?>" >
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font> <strong>암호</strong></td>
		<td><input name="bd_pass" type="password" value="" class="input" style="width:90%;"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<!--<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><strong>이메일</strong></td>
		<td><input name="bd_email" type="text" class="input" style="width:90%;" value="<?=$bd_email?>" size="40">
		</td>
	</tr>-->
<? } ?>
<? if($wcfg['use_home']) { ?>
	<!--<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>홈페이지</strong></td>
	  <td><input name="bd_home" type="text" class="input" style="width:90%;" value="<?=$bd_home?>" size="60"></td>
  </tr>-->
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>분류</strong></td>
	  <td><select name="cat_num">
<option value="">==선택==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
<? if($mode=='new_nobook') {?>
		<script src="<?=$skin_url?>calendar.js"></script>
		<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font> <strong>일정</strong></td>
		<td>
		 <input name="lay_date" type="text" id="lay_date" value="<?=$lay_date?>" size="11" maxlength="10" class="input" hname="일정" required readonly>
          <a style='CURSOR:pointer'  onClick="changeCal2(document.write_form.lay_date.value);ret_name = document.write_form.lay_date;showXY(document.all.lay_date);"><img src='<?=$skin_url?>images/cal.gif' align="absmiddle" border="0"></a>
		 <script language="javascript">createLayer('cal_day');</script>
		</td>
	</tr>
<?}?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"  style="width:100px;"><font color=red><b>*</b></font> <strong>매장명</strong></td>
		<td><input name="bd_subject" id="bd_subject" type="text" class="input" style="width:90%;" value="<?=$bd_subject?>" size="60"></td>
	</tr>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1" style="width:100px;"><font color=red><b>*</b></font> <strong>업체</strong></td>
		<td><input name="bd_bus" id="bd_bus" type="text" class="input" style="width:90%;" value="<?=$bd_bus?>" size="60"></td>
	</tr>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1" style="width:100px;">
		<font color=red><b>*</b></font> <strong>내용</strong><br>
		</td>
		<td>
		<? if($wcfg['use_html']) { 
?>
<!--<strong>웹에디터</strong>
<input type="radio" name="usefckeditor" onClick="location.href='<?=$_SERVER[PHP_SELF] 
?>?bbs_code=<?=$bbs_code?>&book=<?=$book?><?=($mode == 'modify')?"&bd_num={$bd_num}&mode=modify":""?>'" <?=(!$fckeditor)?"checked":""?>>사용안함&nbsp;&nbsp;
<input type="radio" name="usefckeditor" onClick="location.href='<?=$_SERVER[PHP_SELF] 
?>?fckeditor=use&bbs_code=<?=$bbs_code?>&book=<?=$book?><?=($mode == 'modify')?"&bd_num={$bd_num}&mode=modify":""?>'" <?=($fckeditor=='use')?"checked":""?>>사용&nbsp;&nbsp;&nbsp;&nbsp;-->
<?
		if($fckeditor=='use') {?>

		<input type="hidden" name="bd_html" value="1">
		<?
		include("../fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('bd_content');
		$oFCKeditor->BasePath = $_url['site'].'fckeditor/';
		$oFCKeditor->Value = rg_html_entity($bd_content,1);
		$oFCKeditor->Width = '90%';
		$oFCKeditor->Height = '300';
		$oFCKeditor->ToolbarSet = 'rgboard';
		//$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/user_config.js' ;
		$oFCKeditor->Create();
		?>
		<?
		} else {?>
		<!--<strong>HTML 사용</strong>
		<input type="radio" name="bd_html" value="0" <?=$chk_bd_html[0]?>>사용안함&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="1" <?=$chk_bd_html[1]?>>HTML사용&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="2" <?=$chk_bd_html[2]?>>HTML+&lt;BR&gt;-->
		<textarea name="bd_content" id="bd_content" cols="60" rows="10" style="width:90%;"><?=$bd_content?></textarea>
		<? } } else { ?>
		<textarea name="bd_content" id="bd_content" cols="60" rows="10" style="width:90%;"><?=$bd_content?></textarea>
		<? } ?>
		</td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>링크 #<?=($i+1)?></strong></td>
	  <td>
	<table border="0" cellpadding="0" cellspacing="0" width="90%">
	  <tr>
	    <td width="40" align="center">이름</td><td><input name="bd_links[<?=$i?>][name]" type="text" class="input" style="width:100%;" value="<?=$bd_links[$i]['name']?>" size="60"></td>
	   </tr>
	   <tr>
	     <td align="center">URL</td><td><input name="bd_links[<?=$i?>][url]" type="text" class="input" style="width:100%;" value="<?=$bd_links[$i]['url']?>" size="60"></td>
	  </tr>
	</table>
	</td>
  </tr>
<?
		}
	}
?>
<?
	if($wcfg['use_upload']) {
		for($i=0;$i<$wcfg['upload_count'];$i++) {
?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>첨부파일 #<?=($i+1)?></strong></td>
		<td>
			<input type="file" name="bd_files[<?=$i?>]" class="input" style="width:90%;" size="60">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			삭제
			<? } ?>
		</td>
	</tr>
<?
		}
	}
?>
<? if($wcfg['spam_chk']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font><strong>스팸방지</strong></td>
		<td><?=$spam_chk_img?> 왼쪽 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="15">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
<? } ?>
	<tr bgcolor="#cccccc" height="1">
		<td colspan="2"></td>
	</tr>
</table>

<table width="100%" border="0">
	<tr>
		<td align="center">
			<img src="<?=$skin_url?>images/confirm.gif" align="absmiddle" value="확인" style="cursor:pointer" class="chk">  
			
			<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">

		</td>
	</tr>
</table>
</form>



<script>
$(function(){
	$(".chk").click(function(){
		//write_form	bd_name	bd_subject	bd_content bd_bus
		if($("#bd_name").val()==""){
			alert("팀명을 입력해 주시기 바랍니다.");
			$("#bd_name").focus();
			return;
		}
		if($("#bd_subject").val()==""){
			alert("매장명을 입력해 주시기 바랍니다.");
			$("#bd_subject").focus();
			return;
		}
		if($("#bd_bus").val()==""){
			alert("업체를 입력해 주시기 바랍니다.");
			$("#bd_bus").focus();
			return;
		}
		/*
		if($("#bd_content").val()==""){
			alert("내용을 입력해 주시기 바랍니다.");
			$("#bd_content").focus();
			return;
		}
		*/
		$("#write_form").submit();
	});
});
</script>


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