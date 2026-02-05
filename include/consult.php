<SCRIPT> 

function runSendit()

{

	
	var form=document.runForm;
	if(form.b_name.value==""){
		alert("회사명을 입력해 주십시오.");
		form.b_name.focus();
	}else if(form.b_tel1.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		form.b_tel1.focus();
	}else if(form.b_tel2.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		form.b_tel2.focus();
	}else if(form.b_tel3.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		form.b_tel3.focus();
	}else if(!$(':input:checkbox[name=bb_agree]:checked').val()){
		alert('개인정보수집에 동의해주세요.');
	}else if(confirm('빠른상담 하시겠습니까?')){


		var dataString = $("#runForm").serialize();
		
		$.ajax({
			url:'../include/consult_ajax.php',
			dataType:'json',
			type:'POST',
			data: dataString,
			success: function(result){	
				if(result=="1"){
					alert("신청이 완료되었습니다.");
				}else if(result=="2"){
					alert("죄송합니다. 하루에 한번만 상담신청이 가능합니다.");
				}
				 
			}
		});
		
		

	}

}
function person()
{
	cw=screen.availWidth;     //화면 넓이
	ch=screen.availHeight;    //화면 높이

	sw=440;    //띄울 창의 넓이
	sh=490;    //띄울 창의 높이

	ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
	mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치

	
	test=window.open("/person_pop.php",'개인정보동의',"resizable=no,scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
		
}




function onumbs2(names){

	var fomrs = document.member_form;
	var textin = $("#"+names).val();

	if(/[^0123456789]/g.test(textin))
	{
		alert("숫자만 입력해주세요.");
		$("#"+names).val("");
		
	}
}


</SCRIPT> 


<div class="wrap5">
	
	<div class="r_sang3">
		<div class="consu_tit">빠른상담</div>
		<span class="con_name">회사명</span>

		<form method="post" name="runForm" id="runForm">
		<span class="run_name1"><input type="text" name="b_name" class="b_name_in"></span>

		<span class="con_name">핸드폰번호</span>
		<span class="run_name2"><input type="text" name="b_tel1" id="b_tel1" class="b_tel1_in1" maxlength="3" style="text-align:center;" onkeyup="onumbs2('b_tel1');"><span class="run_font_st1">-</span><input type="text" name="b_tel2" id="b_tel2" class="b_tel1_in1" maxlength="4" style="text-align:center;" onkeyup="onumbs2('b_tel2');"><span class="run_font_st1">-</span><input type="text" name="b_tel3"  id="b_tel3"class="b_tel1_in1" maxlength="4" style="text-align:center;" onkeyup="onumbs2('b_tel3');"></span>	
		
		<span class="run_name3"><a href="javascript:person();" style="text-decoration:underline;">개인정보수집동의</a> <input type="checkbox" name="bb_agree"></span>
		
		<span class="run_name3"><input type="button" value="전송" onclick="runSendit();" class="run_ok_btn"></span>
		</form>
	</div>

</div>