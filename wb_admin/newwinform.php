<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['new_win']);
$rs_list->add_where("nw_begin_time<= '".date("Y-m-d")."'");
$rs_list->add_where("nw_end_time >= '".date("Y-m-d")."'");
$rs_list->add_order("nw_id asc");
$rs_list->select();


	
	if($w == "u") {
		$rs->clear();
		$rs->set_table($_table['new_win']);
		$rs->add_where("nw_id=$nw_id");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$nw=$rs->fetch();
	} else {
		$nw[nw_disable_hours] = 24;
		if($rs_list->num_rows() == 0){
			$nw[nw_left]   = 300;
		}else if($rs_list->num_rows() == 1){
			$nw[nw_left]   = 700;
		}else if($rs_list->num_rows() == 2){
			$nw[nw_left]   = 1100;
		}
		$nw[nw_top]    = 200;
		$nw[nw_width]  = 350;
		$nw[nw_height] = 400;
		$nw[nw_content_html] = 2;



		
	}

$server_time = time();
$MENU_L='m9';
$nw_content_html = "1";


include("_header.php");





include("admin.header.php"); 
?>
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="../wb_js/jquery-ui.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>


<style>
.ui-widget-header{background:none; background-color:#8275ff;}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{background:none; background-color:red; color:#fff;}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{background:none; background-color:blue; color:#fff;}
</style>


<script>


$(function() { 
	//nw_begin_time	nw_end_time
	
	
	









$( "#nw_begin_time, #nw_end_time" ).datepicker({ 
		inline: true, 
		dateFormat: "yy-mm-dd 00:00:00",    /* 날짜 포맷 */ 
		prevText: 'prev', 
		nextText: 'next', 
		showButtonPanel: true,    /* 버튼 패널 사용 */ 
		changeMonth: true,        /* 월 선택박스 사용 */ 
		changeYear: true,        /* 년 선택박스 사용 */ 
		showOtherMonths: true,    /* 이전/다음 달 일수 보이기 */ 
		selectOtherMonths: true,    /* 이전/다음 달 일 선택하기 */ 

		showOn: "button",
		buttonImage: "../images/calendar.gif", 
        buttonImageOnly: true ,
		buttonText: "Select date",
		
		minDate: '-30y', 
		closeText: '닫기', 
		currentText: '오늘', 
		showMonthAfterYear: true,        /* 년과 달의 위치 바꾸기 */ 
		/* 한글화 */ 
		monthNames : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'], 
		monthNamesShort : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'], 
		dayNames : ['일', '월', '화', '수', '목', '금', '토'],
		dayNamesShort : ['일', '월', '화', '수', '목', '금', '토'],
		dayNamesMin : ['일', '월', '화', '수', '목', '금', '토'],
		showAnim: 'slideDown', 
		/* 날짜 유효성 체크 */ 
		onClose: function( selectedDate ) { 
			$('#fromDate').datepicker("option","minDate", selectedDate); 
		} 
	}); 


	


	
	




});

</script>

<form name=frmnewwin method=post action="./newwinformupdate.php" onSubmit="return validate(this)" style="margin:0px;">
<input type=hidden name=w     value='<? echo $w ?>'>
<input type=hidden name=nw_id value='<? echo $nw_id ?>'>
<input type="hidden" name="bd_html" value="1">
<table cellpadding=0 cellspacing=0 width=800 border=0>
<colgroup width=15%>
<colgroup width=35% bgcolor=#ffffff>
<colgroup width=15%>
<colgroup width=35% bgcolor=#ffffff>
<tr><td colspan=4 height=2 bgcolor=#0E87F9></td></tr>
<tr><td colspan=4 height=10></td></tr>

<tr>
    <td>시작 일시</td>
    <td>
        <input type=text class=ed name="nw_begin_time" id="nw_begin_time" size=21 maxlength=19 value='<? echo $nw[nw_begin_time] ?>' required hname="시작 일시" readonly>

        
	</td>
    <td>종료 일시</td>
    <td>
        <input type=text class=ed name="nw_end_time" id="nw_end_time" size=21 maxlength=19 value='<? echo $nw[nw_end_time] ?>' required hname="종료 일시" readonly>
		
       
	</td>
</tr>



<tr>
    <td>창위치 왼쪽</td>
    <td><input type=text class=ed name=nw_left size=5 value='<? echo $nw[nw_left] ?>' required hname="창위치 왼쪽"></td>
    <td>창위치 위</td>
    <td><input type=text class=ed name=nw_top  size=5 value='<? echo $nw[nw_top] ?>' required hname="창위치 위"></td>
</tr>
<tr>
    <td>창크기 가로</td>
    <td><input type=text class=ed name=nw_width  size=5 value='<? echo $nw[nw_width] ?>' required hname="창크기 가로(픽셀)"></td>
    <td>창크기 세로</td>
    <td><input type=text class=ed name=nw_height size=5 value='<? echo $nw[nw_height] ?>' required hname="창크기 세로(픽셀)"></td>
</tr>
<tr>
    <td>창 제목</td>
    <td colspan=3><input type=text class=ed name=nw_subject size=100% value='<? echo stripslashes($nw[nw_subject]) ?>' required hname="창 제목"></td>
</tr>
<input type=hidden name=nw_content_html value=1>
<tr>
    <td>내용</td>
    <td colspan=3 style='padding-top:5px; padding-bottom:5px;width:100%;'>
		<textarea name="nw_content" id="nw_content" style="width:100%;"><?=$nw[nw_content]?></textarea>
	</td>
</tr>
<tr><td colspan=4 height=1 bgcolor=CCCCCC></td></tr>
</table>

<TABLE width="100%" cellpadding=0 cellspacing=0 border=0>
	<TR>
		<TD width="40%" height="60" align="right" valign="middle"><input type="submit" value=" 확 인 " class="button" onClick="submitContents();" onfocus=this.blur();></TD>
		<TD width="20"></TD>
		<TD align="left"  valign="middle"><input type="button" value=" 취 소 " class="button" onClick="document.location.href='./newwinlist.php';" onfocus=this.blur();></TD>
	</TR>
</TABLE>
</form>
<? 
include("admin.footer.php"); 
include("_footer.php"); 
?>


<script>
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "nw_content",
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
		//oEditors.getById["nw_content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	//var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["nw_content"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["nw_content"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {

	oEditors.getById["nw_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("nw_content").value를 이용해서 처리하면 됩니다.
	
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
	oEditors.getById["nw_content"].setDefaultFont(sDefaultFont, nFontSize);
}

</script>