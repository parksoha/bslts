<?include("include/header.php");?>


     
 <style>
.onlin_s{width:94%; height:auto; float:left; padding-bottom:10px;  margin:0 3% 0 3%; font-size:14px; font-weight:bold; color:#000;}
.onlin_s2{width:94%; height:auto; float:left; padding-bottom:10px;  margin:10px 3% 0 3%; font-size:12px; font-weight:bold; color:#000;}
.onlin_s3{width:94%; height:auto; float:left; font-size:12px; margin:10px 3% 0 3%; color:#000;}

.onlinesd_fom_table{ border-top:1px solid #0099cc;  margin:0 3% 0 3%;}
.onlinesd_fom_table td{ border-bottom:1px solid #ccc;}
.onlinesd_fom_table td.onsc_font1{background-color:#f4f4f4; font-weight:bold; color:#000; font-size:12px;}
.onlinesd_fom_table td.onsc_font2{border-bottom:1px solid #ccc;}
.onlinesd_fom_table th{background-color:#f6f9ff; border-bottom:1px solid #ccc;}

.onsc_font3{ border:1px solid #ccc; height:23px; width:50%; float:left; margin-left:2%; text-align:center;}
.onsc_font4{ border:1px solid #ccc; height:23px; width:24%; float:left; text-align:center;}
.gmbs{float:left; padding:5px 1% 0 1%; }

.onsc_font5{ border:1px solid #ccc; height:27px; width:25%; float:left; margin-left:2%;}

.onsc_font6{ border:1px solid #ccc; height:23px; width:70%; float:left; margin-left:2%; text-align:center;}
.onsc_font7{ border:1px solid #ccc; height:70px; width:90%; float:left; margin-left:2%; text-align:center;}

 </style>




<form name='KSPayWeb' action = "./card_ok.php" method='post'>
<?
	$tmp=explode(" ",microtime());
	$sndOrdernumber=date('Ymd_').substr($tmp[0],2);
?>


<div style="width:100%; height:auto; float:left; margin-top:20px;">
	
	<div class="onlin_s2">※ (필수) 개인정보 수집.이용동의</div>

	<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="94%">
		<tr>
			<th width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">목적</th>
			<th width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">항목</th>
			<th width="33.3333333333333333333%" height="25" align="center">보유기간</th>
		</tr>

		<tr>
			<td width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">상품결제</td>
			<td width="33.3333333333333333333%" height="25" align="center" style=" border-right:1px solid #ccc;">회사명,이메일,카드번호</td>
			<td width="33.3333333333333333333%" height="25" align="center">결제완료후 3개월까지,그후 파기</td>
		</tr>
	</table>

	<div class="onlin_s3">* 온라인문의를 위해 필요한 최소한의 개인정보이므로 동의를 해주셔야 이용이 가능합니다.</div>
	<div class="onlin_s3" style="margin-top:0; padding-bottom:20px; border-bottom:1px solid #9e9e9e; margin-bottom:20px;">
	
		<span style="float:left; padding-top:10px;">(필수) 개인정보 수집.이용동의 사항에 동의하십니까?</span>

		<span style="float:right; padding-top:10px;">
			<label class="chk_dongi" style="padding-right:10px;"><input type="radio" name="new_agree" value="1" hname='동의'>&nbsp;동의함</label>
			<label class="chk_dongi"><input type="radio" name="new_agree" value="2">&nbsp;동의하지 않음</label>

		</span>
	</div>

	










	<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="94%">
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;상품명</td>
			<td width="75%" class="onsc_font2">

			<span style="float:left; width:100%; margin:7px 0 7px 0;">
			<?for($t=1; $t <= count($_ks_info); $t++){?>
				<label style="float:left; margin-left:2%; padding-top:5px;"><input type="radio" name="sndGoodname" onclick="snd_view2('0')" value="<?=$_ks_info[$t]?>">&nbsp;<?=$_ks_info[$t]?></label>
			<?}?>
			</span>

			<span style="float:left; width:100%; margin-bottom:7px;">
				<label style="float:left; margin-left:2%; padding-top:5px;"><input type="radio" name="sndGoodname" value="직접입력" id="sndGoodname3" onclick="snd_view2('1')"style="border: 1px #5075BD solid; ">&nbsp;직접입력</label>
				<input type="text" class="onsc_font3" id="mount3" name="sndGoodname2" style="margin-left:2%;" disabled>
			</span>


			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;상품금액</td>
			<td width="75%" class="onsc_font2">

			<span style="float:left; width:100%; margin:7px 0 7px 0;">
			<?for($j=1; $j <= count($_ks_price); $j++){?>
				<label style="float:left; margin-left:2%; padding-top:5px;"><input type="radio" name="sndAmount" value="<?=$_ks_price[$j]?>"  onclick="snd_view('0')" >&nbsp;<?=number_format($_ks_price[$j])?></label>
			<?}?>
			</span>

			<span style="float:left; width:100%; margin-bottom:7px;">
				<label style="float:left; margin-left:2%; padding-top:5px;"><input type="radio" name="sndAmount" value="직접입력"  id="sndAmount2" onclick="snd_view('1')">&nbsp;직접입력</label>			
				<input type="text" class="onsc_font3" id="mount2" name="sndAmount_text" style="margin-left:2%;" onkeyup="cmaComma(this);" onchange="cmaComma(this);" disabled>
			</span>


			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;주문자명(회사)</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;

			<input maxlength=20 id="" name="sndOrdername" class="onsc_font3">
			
						
			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;핸드폰번호</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input maxlength='12' id="" name="sndMobile" class="onsc_font3"><span style="float:left; padding-left:2%;">숫자만입력해주세요.</span>		
					
			</td>
		</tr>


		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;주문자 Email</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input maxlength='50' id="" name="sndEmail" class="onsc_font3"><span style="float:left; padding-left:2%;">결제결과가 전송됩니다.</span>			
					
			</td>
		</tr>


		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;결제유형</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input type="radio" name="sndPaymethod" value="1000000000" checked>&nbsp;신용카드		
					
			</td>
		</tr>

	</table>
























	<div class="btn" style="width:100%; height:auto; float:left; text-align:center; margin-top:20px;"><img src="../images/btn_ok100.gif" onclick="goOpen();" style="cursor:pointer;"/></div>



</div>
        
       
        
  <input type=hidden name='sndStoreid'         value="<?=$_site_info['site_code']?>"><!-- 테스트용 아이디: 2999199999 (테스트이후 실제발급아이디로 변경)-->
	<input type=hidden name='sndOrdernumber'	   value="<?=$sndOrdernumber?>"><!-- 주문번호 -->
	

<!----------------------------------------------- <Part 2. 추가설정항목(메뉴얼참조)>  ----------------------------------------------->

	<!-- 0. 공통 환경설정 -->
	<input type=hidden	name=sndReply value="">
	<input type=hidden  name=sndGoodType value="1"> 	<!-- 상품유형: 실물(1),디지털(2) -->
	
	<!-- 1. 신용카드 관련설정 -->
	
	<!-- 신용카드 결제방법  -->
	<!-- 일반적인 업체의 경우 ISP,안심결제만 사용하면 되며 다른 결제방법 추가시에는 사전에 협의이후 적용바랍니다 -->
	<input type=hidden  name=sndShowcard value="I,M"> <!-- I(ISP), M(안심결제), N(일반승인:구인증방식), A(해외카드), W(해외안심)-->
	
	<!-- 신용카드(해외카드) 통화코드: 해외카드결제시 달러결제를 사용할경우 변경 -->
	<input type=hidden	name=sndCurrencytype value="WON"> <!-- 원화(WON), 달러(USD) -->
	
	<!-- 할부개월수 선택범위 -->
	<!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 결제창에서 고객이 스크롤하여 선택하게 됩니다 -->
	<!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
	<input type=hidden	name=sndInstallmenttype value="ALL(0:2:3:4:5:6:7:8:9:10:11:12)">
	
	<!-- 가맹점부담 무이자할부설정 -->
	<!-- 카드사 무이자행사만 이용하실경우  또는 무이자 할부를 적용하지 않는 업체는  "NONE"로 세팅  -->
	<!-- 예 : 전체카드사 및 전체 할부에대해서 무이자 적용할 때는 value="ALL" / 무이자 미적용할 때는 value="NONE" -->
	<!-- 예 : 전체카드사 3,4,5,6개월 무이자 적용할 때는 value="ALL(3:4:5:6)" -->
	<!-- 예 : 삼성카드(카드사코드:04) 2,3개월 무이자 적용할 때는 value="04(3:4:5:6)"-->
	<!-- <input type=hidden	name=sndInteresttype value="10(02:03),05(06)"> -->
	<input type=hidden	name=sndInteresttype value="NONE">

	<!-- 2. 온라인입금(가상계좌) 관련설정 -->
	<input type=hidden	name=sndEscrow value="1"> 			<!-- 에스크로사용여부 (0:사용안함, 1:사용) -->
	
	<!-- 3. 월드패스카드 관련설정 -->
	<input type=hidden	name=sndWptype value="1">  			<!--선/후불카드구분 (1:선불카드, 2:후불카드, 3:모든카드) -->
	<input type=hidden	name=sndAdulttype value="1">  		<!--성인확인여부 (0:성인확인불필요, 1:성인확인필요) -->
	
	<!-- 4. 계좌이체 현금영수증발급여부 설정 -->
    <input type=hidden  name=sndCashReceipt value="0">          <!--계좌이체시 현금영수증 발급여부 (0: 발급안함, 1:발급) -->

<!----------------------------------------------- <Part 3. 승인응답 결과데이터>  ----------------------------------------------->
<!-- 결과데이타: 승인이후 자동으로 채워집니다. (*변수명을 변경하지 마세요) -->

	<input type=hidden name=reWHCid 	value="">
	<input type=hidden name=reWHCtype 	value="">
	<input type=hidden name=reWHHash 	value="">
<!--------------------------------------------------------------------------------------------------------------------------->

<!--업체에서 추가하고자하는 임의의 파라미터를 입력하면 됩니다.-->
<!--이 파라메터들은 지정된결과 페이지(kspay_result.php)로 전송됩니다.-->
	<input type=hidden name=a        value="a1">
	<input type=hidden name=b        value="b1">
	<input type=hidden name=c        value="c1">
	<input type=hidden name=d        value="d1">
<!--------------------------------------------------------------------------------------------------------------------------->
		
</form>
        
        
        

<? include("include/footer3.php");?>

<script language="javascript">
<!--



	/*goOpen() - 함수설명 : 결제에 필요한 기본거래정보들을 세팅하고 kspay통합창을 띄웁니다.*/

	var fom = document.KSPayWeb;

	function goOpen() 
	{ 
	
		var	mesg =$(':input:radio[name=new_agree]:checked').val();
		
	
		if(mesg=="2" || !mesg){
			alert('개인정보의 수집,이용에 관한 사항에 동의하셔야 결제하실 수 있습니다.');
			fom.agree_comm.focus();			
		}else if(fom.sndGoodname.value=='') {
			alert('상품명을 선택해주세요.');
			
		}else if(fom.sndGoodname.value=='직접입력' && fom.sndGoodname2.value=='') {
			alert('상품명을 입력해주세요.');
			fom.sndGoodname2.focus() ;
			
		}
		
		
		
		else if(fom.sndAmount.value=='') {
			alert('상품금액을 선택해주세요.');
			
		}else if(fom.sndAmount.value=='직접입력' && fom.sndAmount_text.value=='') {
			alert('상품금액을 입력해주세요.');
			fom.sndAmount_text.focus() ;
			
		}
		
		
		
		
		else if(fom.sndOrdername.value=='') {
			alert('주문자명을 입력해주세요.');
			fom.sndOrdername.focus() ;
			
		}else if(fom.sndMobile.value=='') {
			alert('핸드폰번호를 입력해주세요.');
			fom.sndMobile.focus() ;
			
		}else if(/[^0123456789]/g.test(fom.sndMobile.value)){
			alert("핸드폰번호는 숫자만 입력해주세요.");
			fom.sndMobile.focus();
		}else{

			if(fom.sndAmount.value == "직접입력" && fom.sndAmount_text.value != "" ||  fom.sndAmount_text.value != ""){
				var sndAmount_text = document.KSPayWeb.sndAmount_text ;
				var conme= document.KSPayWeb.sndAmount_text.value;
				var conme2 = String(conme);
				var conme3 = conme2.replace(/[^\d]+/g, '');

				$("#sndAmount2").val(conme3);				
			
			}


			if(fom.sndGoodname.value == "직접입력" && fom.sndGoodname2.value != "" ||  fom.sndGoodname2.value != ""){
				var sndAmount_text = document.KSPayWeb.sndGoodname2 ;
				var conme= document.KSPayWeb.sndGoodname2.value;
				var conme2 = String(conme);
				

				$("#sndGoodname3").val(conme2);				
			
			}





			
			_pay(document.KSPayWeb);
		}

		
	}

	function _pay(_frm) 
	{

		var o_name = fom.sndOrdername.value;
		var o_mobile = fom.sndMobile.value;
		var o_email = fom.sndEmail.value;

		var filter = "win16|win32|win64|mac|macintel"; 


		if ( navigator.platform ) { 
			if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
				//mobile 
				_frm.sndReply.value           = getLocalUrl("card_ok2.php?sndOrdername="+o_name+"&sndMobile="+o_mobile+"&sndEmail="+o_email) ;
			} else { 
				//pc 
				_frm.sndReply.value           = getLocalUrl("card_ok.php?sndOrdername="+o_name+"&sndMobile="+o_mobile+"&sndEmail="+o_email) ;
			}
		}



		
 		
		

		var agent = navigator.userAgent;
		var midx		= agent.indexOf("MSIE");
		var out_size	= (midx != -1 && agent.charAt(midx+5) < '7');
    	
		var width_	= 500;
		var height_	= out_size ? 568 : 518;
		var left_	= screen.width;
		var top_	= screen.height;
    	
		left_ = left_/2 - (width_/2);
		top_ = top_/2 - (height_/2);


	
		if ( navigator.platform ) { 
			if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
				//mobile 
				_frm.target = '_self';
				_frm.action ='http://kspay.ksnet.to/store/mb2/KSPayPWeb_utf8.jsp';
			} else { 
				//pc 
				op = window.open('about:blank','AuthFrmUp',
					'height='+height_+',width='+width_+',status=yes,scrollbars=no,resizable=no,left='+left_+',top='+top_+'');

				if (op == null)
				{
					alert("팝업이 차단되어 결제를 진행할 수 없습니다.");
					return false;
				}
				
				_frm.target = 'AuthFrmUp';
				_frm.action ='https://kspay.ksnet.to/store/KSPayFlashV1.3/KSPayPWeb.jsp?sndCharSet=utf-8';
			}
		}


		
		
		
		_frm.submit();
		
    }

	function getLocalUrl(mypage) 
	{ 
		var myloc = location.href; 
		return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
	} 
	
	// goResult() - 함수설명 : 결제완료후 결과값을 지정된 결과페이지(kspay_wh_result.php)로 전송합니다.
	function goResult(){
		fom.target = "";


		var filter = "win16|win32|win64|mac|macintel"; 
		if ( navigator.platform ) { 
			if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
				//mobile 
				fom.action = "./card_ok2.php";
			} else { 
				//pc 
				fom.action = "./card_ok.php";
			}
		}



		
		fom.submit();
	}
	// eparamSet() - 함수설명 : 결제완료후 (kspay_wh_rcv.php로부터)결과값을 받아 지정된 결과페이지(kspay_wh_result.php)로 전송될 form에 세팅합니다.
	function eparamSet(rcid, rctype, rhash){
		fom.reWHCid.value 	= rcid;
		fom.reWHCtype.value   = rctype  ;
		fom.reWHHash.value 	= rhash  ;
	}

	

	function cmaComma(obj) {
		var firstNum = obj.value.substring(0,1); // 첫글자 확인 변수
		var strNum = /^[/,/,0,1,2,3,4,5,6,7,8,9,/]/; // 숫자와 , 만 가능
		var str = "" + obj.value.replace(/,/gi,''); // 콤마 제거  
		var regx = new RegExp(/(-?\d+)(\d{3})/);  
		var bExists = str.indexOf(".",0);  
		var strArr = str.split('.');  
	 
		
	 
		while(regx.test(strArr[0])){  
			strArr[0] = strArr[0].replace(regx,"$1,$2");  
		}  
		if (bExists > -1)  {
			obj.value = strArr[0] + "." + strArr[1];  
		} else  {
			obj.value = strArr[0]; 
		}
	}






function showObject(Obj,Boolen)
{
	if(Boolen)
	{
		//활성화
		Obj.disabled = false;
		Obj.style.background = "#ffffff";
		Obj.focus() ;
	}
	else
	{
		//비활성화
		Obj.disabled = true;
		Obj.style.background = "#dddddd";
		Obj.value = "" ;
	}
}



function snd_view2(idx)
{
	var form = eval("document.KSPayWeb") ;
	if(idx=='1') {
		showObject(form.sndGoodname2, true) ;
	} else {
		showObject(form.sndGoodname2, false) ;
	}
}



function snd_view(idx)
{
	var form = eval("document.KSPayWeb") ;
	if(idx=='1') {
		showObject(form.sndAmount_text, true) ;
	} else {
		showObject(form.sndAmount_text, false) ;
	}
}

//-->
</script>
