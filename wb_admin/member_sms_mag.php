<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");



if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		
	$rs->clear();
	$rs->set_table($_table['setup']);
	
	$rs->add_field("ss_content",serialize($msg_list));
	$rs->add_where("ss_name='msg_list'");
	$rs->update();
	
	$rs->commit();
	
	rg_href('?');

}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../include/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<title>SMS 문자 메시지</title>

<style>
body{margin:0; padding:0;}
div, ul, li, span, form{margin:0; padding:0; list-style:none;}
.msglist2{width:628px; height:auto; float:left; border:5px solid #388cbd; padding:0 10px 10px 10px;}
.msglist{width:628px; height:auto; float:left;}
.msglist ul{width:628px; float:left; height:auto;}
.msglist ul li{width:145px; height:auto; margin:0 5px 0 5px; float:left; border:1px solid #536fff;}
.msg_lig{width:100%; height:25px; float:left; line-height:25px; text-align:center; background-color:#e3e8ff;}
.msg_lig2{width:100%; height:100px; float:left; background-color:#f3f5ff; font-size:12px; overflow-x:hidden;}
.msg_lig4{width:100%; height:auto; float:left; margin-top:5px;}
.msg_titq{width:98%; height:30px; float:left; padding-left:2%; line-height:30px; color:#000; font-size:12px; font-weight:bold;}
</style>

</head>
<body>
<SCRIPT language=JavaScript>
function zip_copy1(msg, byt) {
opener.document.getElementById('sms_message').value = msg;
opener.document.getElementById('sdcoun').value = byt;

if(byt > 90){
	opener.document.getElementById('msgType').innerText = "LMS";
	opener.document.getElementById('maxLength').innerText = "1500";
	opener.document.getElementById('divLmsTitle').style.display ="";

	
}else{
	opener.document.getElementById('msgType').innerText = "SMS";
	opener.document.getElementById('maxLength').innerText = "90";
	opener.document.getElementById('divLmsTitle').style.display ="none";
}

top.close();
}



$(document).ready(function(){


for(h=0; h < 24; h++){

var str =document.getElementById('msgtext'+h).value;
var str_len = str.length;



var rbyte = 0;
var rlen = 0;
var one_char = "";
var str2 = "";

for(var i=0; i<str_len; i++){
	one_char = str.charAt(i);
	if(escape(one_char).length > 4){
		rbyte += 2;                                         //한글2Byte
	}else{
		rbyte++;                                            //영문 등 나머지 1Byte
	}

	
}


 document.getElementById('byteInfo'+h).innerText = rbyte+"byte";
 document.getElementById('bt'+h).value = rbyte;

}


$(".thi_bor").bind('mouseout', function(){
	$(".thi_bor").attr('style','border:1px solid #536fff;');	
});

$(".thi_bor").bind('mouseover', function(){
	$(".thi_bor").attr('style','border:1px solid #536fff;');	
	$(this).attr('style','border:1px solid red;');	
});



});


function fnChkByte(obj, num){
var str = obj.value;
var str_len = str.length;

var rbyte = 0;
var rlen = 0;
var one_char = "";
var str2 = "";

for(var i=0; i<str_len; i++){
	one_char = str.charAt(i);
	if(escape(one_char).length > 4){
		rbyte += 2;                                         //한글2Byte
	}else{
		rbyte++;                                            //영문 등 나머지 1Byte
	}	
}

    document.getElementById('byteInfo'+num).innerText = rbyte+"byte";
	document.getElementById('bt'+num).value = rbyte;

}

</SCRIPT>
<form name='form1' method='post' action="?" onSubmit="return validate(this)">
<input type=hidden name=mode value="update">
<div class="msglist2">

<div class="msg_titq">* 발송문구 예시 활용</div>
<div class="msg_titq">1. 신년, 추석인사</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo0"></span>
				<input type="hidden" id="bt0">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext0').value, document.getElementById('bt0').value);">
			</span>
<textarea class="msg_lig2" id="msgtext0" onKeyUp="javascript:fnChkByte(this,'0')">
새해 복많이 받으시고 건강 하시기 바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>	
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo1"></span>
				<input type="hidden" id="bt1">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext1').value, document.getElementById('bt1').value);">
			</span>
<textarea class="msg_lig2" id="msgtext1" onKeyUp="javascript:fnChkByte(this,'1')">
가족 친지들과 풍성한 한가위 맞이 하시길 기원합니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo2">0byte</span>	
				<input type="hidden" id="bt2">				
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext2').value, document.getElementById('bt2').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list1]" id="msgtext2" onKeyUp="javascript:fnChkByte(this,'2')"><?=$_msg_list['list1']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo3">0byte</span>
				<input type="hidden" id="bt3">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext3').value, document.getElementById('bt3').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list2]" id="msgtext3" onKeyUp="javascript:fnChkByte(this,'3')"><?=$_msg_list['list2']?></textarea>
			
		</li>
	</ul>
</div>



<div class="msg_titq" style="margin-top:10px;">2. 신상품안내,교육일정</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo4"></span>
				<input type="hidden" id="bt4">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext4').value, document.getElementById('bt4').value);">
			</span>
<textarea class="msg_lig2" id="msgtext4" onKeyUp="javascript:fnChkByte(this,'4')">
SOLIDWORKS Standard 신상품이 출시되었으니 홈페이지 오셔서 기능확인바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>	
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo5"></span>
				<input type="hidden" id="bt5">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext5').value, document.getElementById('bt5').value);">
			</span>
<textarea class="msg_lig2" id="msgtext5" onKeyUp="javascript:fnChkByte(this,'5')">
11차 CAD 상품교육이 1.22일 ㅇㅇ본사 세미나실에서 열리오니 꼭참석하시기 바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo6">0byte</span>
				<input type="hidden" id="bt6">				
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext6').value, document.getElementById('bt6').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list3]" id="msgtext6" onKeyUp="javascript:fnChkByte(this,'6')"><?=$_msg_list['list3']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo7">0byte</span>
				<input type="hidden" id="bt7">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext7').value, document.getElementById('bt7').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list4]" id="msgtext7" onKeyUp="javascript:fnChkByte(this,'7')"><?=$_msg_list['list4']?></textarea>
			
		</li>
	</ul>
</div>




<div class="msg_titq" style="margin-top:10px;">3. 거래처 공지(사업장이전,상호변경)</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo8"></span>
				<input type="hidden" id="bt8">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext8').value, document.getElementById('bt8').value);">
			</span>
<textarea class="msg_lig2" id="msgtext8" onKeyUp="javascript:fnChkByte(this,'8')">
ㅇㅇ본사가 12.21일부로 강남역에서 분당으로 이전하오니 방문시 참고 바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>	
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo9"></span>
				<input type="hidden" id="bt9">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext9').value, document.getElementById('bt9').value);">
			</span>
<textarea class="msg_lig2" id="msgtext9" onKeyUp="javascript:fnChkByte(this,'9')">
2016.12.31일 주주총회가 본사 대회의실에서 열리오니 주주님들 참석 바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo10">0byte</span>	
				<input type="hidden" id="bt10">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext10').value, document.getElementById('bt10').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list5]" id="msgtext10" onKeyUp="javascript:fnChkByte(this,'10')"><?=$_msg_list['list5']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo11">0byte</span>
				<input type="hidden" id="bt11">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext11').value, document.getElementById('bt11').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list6]" id="msgtext11" onKeyUp="javascript:fnChkByte(this,'11')"><?=$_msg_list['list6']?></textarea>
			
		</li>
	</ul>
</div>



<div class="msg_titq" style="margin-top:10px;">4. 부고공지</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo12"></span>
				<input type="hidden" id="bt12">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext12').value, document.getElementById('bt12').value);">
			</span>
<textarea class="msg_lig2" id="msgtext12" onKeyUp="javascript:fnChkByte(this,'12')">
ㅇㅇㅇ대표이사님 부친께서 12.24일 별세하셨습니다. 장례식장은 ㅇㅇ병원 15호 영안실이며 발인은 27일입니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>	
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo13"></span>
				<input type="hidden" id="bt13">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext13').value, document.getElementById('bt13').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list7]" id="msgtext13" onKeyUp="javascript:fnChkByte(this,'13')"><?=$_msg_list['list7']?></textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo14">0byte</span>
				<input type="hidden" id="bt14">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext14').value, document.getElementById('bt14').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list8]" id="msgtext14" onKeyUp="javascript:fnChkByte(this,'14')"><?=$_msg_list['list8']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo15">0byte</span>
				<input type="hidden" id="bt15">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext15').value, document.getElementById('bt15').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list9]" id="msgtext15" onKeyUp="javascript:fnChkByte(this,'15')"><?=$_msg_list['list9']?></textarea>
			
		</li>
	</ul>
</div>




<div class="msg_titq" style="margin-top:10px;">5. 박람회,동창회</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo16"></span>	
				<input type="hidden" id="bt16">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext16').value, document.getElementById('bt16').value);">
			</span>
<textarea class="msg_lig2" id="msgtext16" onKeyUp="javascript:fnChkByte(this,'16')">
건축자재 박람회가 12.13일 삼성동 koex 에서 개최되오니 많은 참석 바랍니다.
- <?=$_site_info['company_names']?>
</textarea>
		</li>	
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo17"></span>
				<input type="hidden" id="bt17">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext17').value, document.getElementById('bt17').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list10]" id="msgtext17" onKeyUp="javascript:fnChkByte(this,'17')"><?=$_msg_list['list10']?></textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo18">0byte</span>
				<input type="hidden" id="bt18">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext18').value, document.getElementById('bt18').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list11]" id="msgtext18" onKeyUp="javascript:fnChkByte(this,'18')"><?=$_msg_list['list11']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo19">0byte</span>
				<input type="hidden" id="bt19">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext19').value, document.getElementById('bt19').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list12]" id="msgtext19" onKeyUp="javascript:fnChkByte(this,'19')"><?=$_msg_list['list12']?></textarea>
			
		</li>
	</ul>
</div>



<div class="msg_titq" style="margin-top:10px;">5. 기타</div>
<div class="msglist">

	<ul>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo20"></span>
				<input type="hidden" id="bt20">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext20').value, document.getElementById('bt20').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list13]" id="msgtext20" onKeyUp="javascript:fnChkByte(this,'20')"><?=$_msg_list['list13']?></textarea>
		</li>
		
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo21"></span>
				<input type="hidden" id="bt21">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext21').value, document.getElementById('bt21').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list14]" id="msgtext21" onKeyUp="javascript:fnChkByte(this,'21')"><?=$_msg_list['list14']?></textarea>
		</li>

		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo22">0byte</span>
				<input type="hidden" id="bt22">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext22').value, document.getElementById('bt22').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list15]" id="msgtext22" onKeyUp="javascript:fnChkByte(this,'22')"><?=$_msg_list['list15']?></textarea>
			
		</li>
		<li class="thi_bor">
			<span style="width:100%; height:25px; float:left; position:relative;">
				<span class="msg_lig" id="byteInfo23">0byte</span>
				<input type="hidden" id="bt23">
				<input type="submit" value="저장" class="button" style="position:absolute; top:0; left:0;">
				<input type="button" value="적용" class="button" style="position:absolute; top:0; right:0; cursor:pointer;"  onclick="zip_copy1(document.getElementById('msgtext23').value, document.getElementById('bt23').value);">
			</span>
<textarea class="msg_lig2" name="msg_list[list16]" id="msgtext23" onKeyUp="javascript:fnChkByte(this,'23')"><?=$_msg_list['list16']?></textarea>
			
		</li>
	</ul>
</div>


</div>
</form>
</body>
</html>