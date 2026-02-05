<?

include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$add_ary = array("free_form_email"=>"");
$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['free_form']);






if($id=="1" && $re != "1"){
	if($Idx_Ary != 'all'){
		if(strlen($Idx_Ary)>1) $Idx_Ary = str_replace('","',"','",$Idx_Ary);
		$rs_list->add_where("free_form_num in (".$Idx_Ary.")");

	}
}else if($id=="1" && $re == "1"){
	if($Idx_Ary != 'all'){
		if($num_ord=="1"){
			if(strlen($Idx_Ary)>1) $Idx_Ary = str_replace('","',"','",$Idx_Ary);
			$rs_list->add_where("free_form_num in (".$Idx_Ary.") group by free_form_email");
			
			
		}else{
			if(strlen($Idx_Ary)>1) $Idx_Ary = str_replace('","',"','",$Idx_Ary);
			
			$rs_list->add_where("free_form_num in (".$Idx_Ary.")");
			
		}

	}
}else if($id=="2" && $re != "1"){
	if($Idx_Ary2 != 'all'){
		if(strlen($Idx_Ary2)>1) $Idx_Ary2 = str_replace('","',"','",$Idx_Ary2);
		$rs_list->add_where("free_form_num in (".$Idx_Ary2.")");
		
		
	}
	
}else if($id=="2" && $re == "1"){
	if($Idx_Ary2 != 'all'){
		if($num_ord=="1"){
			if(strlen($Idx_Ary2)>1) $Idx_Ary2 = str_replace('","',"','",$Idx_Ary2);

			$rs_list->add_where("free_form_num in (".$Idx_Ary2.") group by free_form_email");
			
			
			
		}else{
			if(strlen($Idx_Ary2)>1) $Idx_Ary2 = str_replace('","',"','",$Idx_Ary2);
			
			$rs_list->add_where("free_form_num in (".$Idx_Ary2.")");
		
		}		
	}
}else if($id=="3" && $re != "1"){
	if($Idx_Ary3 != 'all'){
		if(strlen($Idx_Ary3)>1) $Idx_Ary3 = str_replace('","',"','",$Idx_Ary3);
		$rs_list->add_where("free_form_num in (".$Idx_Ary3.")");
		
		
	}

	
}else if($id=="3" && $re == "1"){
	if($Idx_Ary3 != 'all'){
		if($num_ord=="1"){
			if(strlen($Idx_Ary3)>1) $Idx_Ary3 = str_replace('","',"','",$Idx_Ary3);			
			$rs_list->add_where("free_form_num in (".$Idx_Ary3.") group by free_form_email");
			
			
		}else{
			if(strlen($Idx_Ary3)>1) $Idx_Ary3 = str_replace('","',"','",$Idx_Ary3);			
			$rs_list->add_where("free_form_num in (".$Idx_Ary3.")");
			
		}
	
	}
}


$rs_list->add_order("free_form_num DESC");


while($R=$rs_list->fetch()) {	

	
	if($R[free_form_email] != ''){
		$add_ary[free_form_email][] = $R[free_form_email]."/".$R[free_form_name];
		
	}
	
}







if($_SERVER['REQUEST_METHOD']=='POST' && $mode=='send'){







		$charset = "utf-8";

		$content .= $conf;
	

		

	

		$mail_body= ($content);
		$date=date("D, d M Y H:i:s +0900");

		$subject2 = $subject;

		
		$FromName = "=?$charset?B?" . base64_encode($_site_info[site_name]) . "?=";//보내는 사람
		$FromEmail = $fmail;	//보내는 이메일(발송이메일주소)

		

		
				
		for($i=0;$i<count($add_ary[free_form_email]);$i++){

			


			
			$mail_compan = explode("/",$add_ary[free_form_email][$i]);

			

			$mail_body2 = str_replace("{회사명}",$mail_compan[1],$mail_body);
			$subject3 = str_replace("{회사명}",$mail_compan[1],$subject);

			

			$subject3 = "=?$charset?B?" . base64_encode($subject3) . "?=";	// 메일제목

			$mailheaders = "From:".$FromName."<".$FromEmail.">\r\n";
			$mailheaders .= "Return-Path:".$FromEmail."\r\n";
			$mailheaders .= "X-Mailer: PHP WebMail \r\n";		
			$mailheaders .= "Content-Type: text/html; charset=utf-8\n";
			$mailheaders .= "Content-Transfer-Encoding: BASE64\n\n";
			$mailheaders .= chunk_split(base64_encode($mail_body2)). "\n";

			
			mail($mail_compan[0], $subject3, "", $mailheaders);
			
		
		}

		
	
	
			
		
		#####    이메일 발송 END    #####




	

		$write_date = date("Y-m-d H:i:s",time());
		
		if($email_ok == "ok") {

			$email_hap = count($add_ary[free_form_email]);

			if(count($email_hap > 1)){
				$ids_i = $add_ary[free_form_email][0]."외 ".$email_hap."명";

			}else{
				$ids_i = $add_ary[free_form_email][0];
			}
			$conf2 =  preg_replace("!<style(.*?)<\/style>!is","",$conf);
			$conf3 = preg_replace("(\<(/?[^\>]+)\>)", "", $conf2);
			$conf4 = preg_replace('/ /', '', $conf3);
			$conf5 = preg_replace("/\s+/", "", $conf4);


			/*
			$rs = new recordset($dbcon);
			$rs->clear();
			$rs->set_table("wb_tb_maillog");

			$rs->add_field("log_send", $fmail);

			$rs->add_field("log_rece", $ids_i);
			$rs->add_field("log_tit", $subject2);
			$rs->add_field("log_con",   $conf5);
			$rs->add_field("log_con2", $conf);
			
			
			
			$rs->add_field("log_write", $write_date);
			$rs->insert();
			*/
		}
		
	
		##### 이메일 발송 로그저장 END #####

		rg_href("","발송 완료 되었습니다.","close");






}




$mail_chks = implode("/",$add_ary[free_form_email]);
$chk_count = count($add_ary[free_form_email]);




?>






<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../include/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

<title>메일보내기</title>
</head>

<style>
div, ul, li{margin:0; padding:0; list-style:none;}
</style>

<body>

<div style="width:721px; height:791px; float:left; background:url('images/phone4.png') center no-repeat; padding:80px 40px 79px 39px;">


<div style="width:100%; float:left; margin-top:20px;">


	



	<form method='post' name="mailform" action='member_mail2.php?id=<?=$id?>&re=1' enctype="multipart/form-data">
	<input type='hidden' name='mode' value='send'>

	
	<input type='hidden' name='email_ok' value='ok' checked>

	



	<input type="hidden" name="add_ary" value="<?=$mail_chks?>">


	<?if($id=="1"){?>
	<input type="hidden" value="<?=$Idx_Ary?>" name="Idx_Ary">
	<?}else if($id=="2"){?>
	<input type="hidden" value="<?=$Idx_Ary2?>" name="Idx_Ary2">
	<?}else if($id=="3"){?>
	<input type="hidden" value="<?=$Idx_Ary3?>" name="Idx_Ary3">
	<?}?>
	



		
		
	<table width='100%' cellpadding='0' cellspacing='0' border='0'>
		

		<tr>
			<td width="15%" style='font-size:14px; padding:5px 0 5px 0;'>&nbsp;&nbsp;발송이메일주소</td>
			<td width="85%" align="center" style=' padding:5px 0 5px 0;'> <input type='text' name='fmail' style='width:90%; height:22px;font-size:12px;' value="<?=$_site_info['admin_email']?>"></td>		
		</tr>

		<tr>
			<td width="15%" style='font-size:14px; padding:5px 0 5px 0;'>&nbsp;&nbsp;수신인</td>
			<td width="85%" align="left" style=' padding:5px 0 5px 0;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$chk_count?>명이 선택 되었습니다. 
			&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="font-size:12px;">중복이메일 체크</span><input type="checkbox" name="num_ord" value='1' <?if($num_ord=='1'){echo "checked"; }?>><input type="button" onclick="bbsSendit2();" value="확인">
			</td>		
		</tr>

		<tr>
			<td width="15%" style='font-size:14px; padding:5px 0 5px 0;'>&nbsp;&nbsp;제목</td>
			<td width="85%" align="center" style=' padding:5px 0 5px 0;'> <input type='text' name='subject' class='subject' style='width:90%; height:22px;font-size:12px;'></td>			
		</tr>
		<tr>
			
			<td colspan="2" width="100%" style=' padding:5px 0 5px 0;' align="center"> 
			<textarea name='conf' id='bd_content' style='width:100%; height:510px;'></textarea>

			</td>											
		</tr>
		<tr>
			<td width='100%' colspan="2" align='center' style="padding-top:10px;">
			<input type='button' value='  발 송 하 기  ' onclick="bbsSendit();" style="width:100px; height:30px;" >
			</td>
		</tr>
	</table>
	</form>









</div>
</div>

</body>
</html>

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

	var consd = document.getElementById("bd_content").value;
	var consd2 = consd.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/g,"");



	if(consd2 ==""){
		alert("내용을 입력해주세요.");
		exit;
	}else{
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("bd_content").value를 이용해서 처리하면 됩니다.
		
		try {
			var chk_form = chkForm(elClickedObj.form,'0');
			if(chk_form){
				elClickedObj.form.submit();
			}
		} catch(e) {}
	}
	
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["bd_content"].setDefaultFont(sDefaultFont, nFontSize);
}




function bbsSendit()
{
	var form=document.mailform;


	if(form.fmail.value==""){
		alert("발송이메일주소를 입력해주세요.");
		form.fmail.focus();

	}else if(form.subject.value==""){
		alert("제목을 입력해주세요.");
		form.subject.focus();

	}else{
		submitContents();
		form.submit();
	}
}

function bbsSendit2()
{
	var form=document.mailform;

	form.mode.value="";

	form.email_ok.value="";

	form.submit();
}




function autotext(ok){
	var form=document.mailform;

	form.mode.value="";

	form.email_ok.value="";
	
	form.action = 'member_mail2.php?id=<?=$id?>&re=1&auto='+ok;
	form.submit();
}
</script>
