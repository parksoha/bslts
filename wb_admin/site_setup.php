<?

	include_once("../wb_include/lib.php");
	include_once("../wb_sms/mw.sms.lib.php");
	require_once("admin_chk.php");

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		
		$rs->clear();
		$rs->set_table($_table['setup']);
		if($site_info[address] !=""){
			$hn_addr = urlencode(trim($site_info[address]));
			$Lat_Lng=get_LatLng_hn($hn_addr);
			if($Lat_Lng['lat'] && $Lat_Lng['lng']){
				$site_info[lat] = $Lat_Lng['lat'];
				$site_info[lng] = $Lat_Lng['lng'];
			}
		}
		$rs->add_field("ss_content",serialize($site_info));
		$rs->add_where("ss_name='site_info'");
		$rs->update();

		unset($tmp);
		foreach($level_info['level'] as $k => $v)
			if($v!='')
				$tmp[$v]=$level_info['name'][$k];
		ksort($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($tmp));
		$rs->add_where("ss_name='level_info'");
		$rs->update();
		
		$rs->commit();
		
		rg_href('?');

	}

	// 사이트 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='site_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","site_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$site_info = unserialize($tmp);
	
	// 레벨 정보
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='level_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","level_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$level_info = unserialize($tmp);


	


	// SMS 아이코드
	if ($site_info[sms_id] && $site_info[sms_pass]) 
	{
		

		$res = get_sock("http://www.icodekorea.com/res/userinfo.php?userid=$site_info[sms_id]&userpw=$site_info[sms_pass]");
		$res = explode(';', $res);
		$userinfo = array(
			'code'      => $res[0], // 결과코드
			'coin'      => $res[1], // 고객 잔액 (충전제만 해당)
			'gpay'      => $res[2], // 고객의 건수 별 차감액 표시 (충전제만 해당)
			'payment'   => $res[3]  // 요금제 표시, A:충전제, C:정액제
		);
	}


	
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">환경설정</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">사이트 환경설정(웹페이지에 노출)</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">사이트 이름</td>
      <td colspan="3"><input name="site_info[site_name]" type="text" class="input" value="<?=$site_info['site_name']?>"  maxlength="15" size="50"> 네이버에 웹페이지 제목으로 인식됩니다. (최대 15자 제한)</td>
    </tr>

	 <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">네이버 설명문구</td>
      <td colspan="3"><input name="site_info[site_naver]" type="text" class="input" value="<?=$site_info['site_naver']?>" size="100"  maxlength="45">(최대 45자 제한)</td>
    </tr>

	<tr>
      <td width="120" align="center" bgcolor="#F0F0F4">네이버 meta태그</td>
      <td colspan="3"><input name="site_info[site_meta]" type="text" class="input" value="<?=str_replace('"',"'",$site_info['site_meta'])?>" size="100">
	  네이버에서 발급받으신 meta태그를 입력하시면 소유확인이 됩니다.
	  </td>
    </tr>

	<tr>
		<td align="center" bgcolor="#F0F0F4">상호</td>
		<td><input type="text" class="input" name="site_info[company_name]" value="<?=$site_info['company_name']?>">
			상호를 입력하세요.</td>

		<td width="122" bgcolor="#F0F0F4" align="center">사업자등록번호</td>
		<td><input type="text" class="input" name="site_info[admin_corp]" value="<?=$site_info['admin_corp']?>"></td>
	</tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">대표자</td>
      <td colspan="3"><input name="site_info[admin_name]" type="text" class="input" value="<?=$site_info['admin_name']?>" size="50" required hname='운영자이름'></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">이메일</td>
      <td colspan="3"><input name="site_info[admin_email]" type="text" class="input" value="<?=$site_info['admin_email']?>" size="50" required hname="운영자이메일" option="email"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">연락처</td>
      <td width="200"><input type="text" class="input" name="site_info[admin_tel]" value="<?=$site_info['admin_tel']?>"></td>
	  <td width="122" bgcolor="#F0F0F4" align="center">팩스번호</td>
      <td><input type="text" class="input" name="site_info[admin_fax]" value="<?=$site_info['admin_fax']?>"></td>
    </tr>
    <!--tr>
      <td bgcolor="#F0F0F4" align="center">발송이메일주소</td>
      <td colspan="3"><input name="site_info[mail_from]" type="text" class="input" value="<?=$site_info['mail_from']?>" size="50" hname="발송이메일주소"></td>
    </tr-->
    <!--tr>
      <td bgcolor="#F0F0F4" align="center">회신이메일주소</td>
      <td><input name="site_info[mail_return]" type="text" class="input" value="<?=$site_info['mail_return']?>" size="50" option="email" hname="회신이메일주소"></td>
    </tr-->
    
		<tr>
			<td align="center" bgcolor="#F0F0F4">사업자 주소</td>
			<td colspan="3">
			<input type="text" class="input" name="site_info[address]" value="<?=$site_info['address']?>" size=70>&nbsp;
			<input type="text" class="input" name="site_info[lat]" value="<?=$site_info['lat']?>" size=20>&nbsp;
			<input type="text" class="input" name="site_info[lng]" value="<?=$site_info['lng']?>" size=20>주소를 입력하세요.</td>
		</tr>

  </table>


	<br>
	<!-- KSNET 전자결제 설정 S -->
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">KSNET 전자결제 설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" bgcolor="#F0F0F4" align="center">상점 아이디</td>
      <td width="300" style="border-right:0;"><input name="site_info[site_code]" type="text" class="input" value="<?=$site_info['site_code']?>" hname="상점 아이디">
       </td>
      <td style="border-left:0;"> <span style="float:left; color:red; padding:0 0 0 5px; position:relative;">* 상품 카드결제를 받기 원하시면 웹브릿지로 연락 바랍니다. 
	  </span>
	  
	   
	  </td>
		
		<style>
		#Pop_info_maintenance7{position:absolute; top:0; left:0;}
		</style>
		<script>
		$(document).ready(function(){
	
			$("#pop_info_btn").click(function(){
				$("#Pop_info_maintenance7").attr("style","display:block; top:-300px; left:-300px; ");	
			});
			$("#Pop_info_maintenance7").bind("mouseout",function(){
				$("#Pop_info_maintenance7").attr("style","display:none;");	
			});

		});
	</script>
    </tr>
	<tr>
      <td width="120" bgcolor="#F0F0F4" align="center">사용 여부설정</td>
		<td width="300" style="border-right:0;">
			<input type="radio" name="site_info[shop_chk]" value="1" checked> 사용함
			<input type="radio" name="site_info[shop_chk]" value="0" <?=$site_info['shop_chk'] == "0" ? "checked" : "";?>> 사용안함
		</td>

		<td style="border-left:0;">
			<span style="color:blue;">&nbsp;* 적용사이트 : <a href="http://webbridge.co.kr/html/htmlinfo/other/payment.php" target="_blank" style="color:blue;">http://webbridge.co.kr/html/htmlinfo/other/payment.php</a></span>
		</td>
    </tr>
  </table>
  <!-- KSNET 전자결제 설정 E -->

  <br>
  <!-- SMS 환경설정 S -->


   <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
  	
	<tr>
		<td colspan="2" height="2" bgcolor="red"></td>
	</tr>

	<tr>
		<td colspan="2" height="3"></td>
	</tr>
  </table>


  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">SMS 환경설정</td>


    </tr>
  </table>




  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
  	<tr>
		<td colspan="2" height="3"></td>
	</tr>
    <tr>
		
      <td><span style="float:left; color:red;">&nbsp;* 아래  서비스 신청 주소에서 회원가입후 충전하시면 이용가능합니다.</span></td>
    </tr>
  </table>




  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
      <td bgcolor="#F0F0F4" align="center">회사명</td>
      <td width="300" style="border-right:0;"><input name="site_info[company_names]" type="text" class="input" value="<?=$site_info['company_names']?>" hname="회사명" autocomplete="off"></td>
	  <td style="border-left:0;"><span style="color:red;">&nbsp;* 문자리스트 마지막부분에 회사명이 노출됩니다.</span></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">SMS 발신자 번호</td>
      <td width="300" style="border-right:0;"><input type="text" name="site_info[sms_from]" class="input" value="<?=$site_info['sms_from']?>" hname="SMS 발신자 번호" style="width:100px;"></td>
	  <td style="border-left:0;"><span style="color:red;">&nbsp;* sms 서비스는  발신자번호 인증을 꼭 하셔야합니다.</br>
	&nbsp;* 발신자번호 인증주소 <a href="http://www.icodekorea.com/?ctl=noti_number_reg_info" style="color:blue;">http://www.icodekorea.com/?ctl=noti_number_reg_info</a>
	  </span></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">SMS 수신자 번호</td>
       <td width="300" style="border-right:0;"><input type="text" name="site_info[sms_to]" class="input" value="<?=$site_info['sms_to']?>" hname="SMS 수신자 번호" style="width:100px;"> <input type="text" name="site_info[sms_to1]" class="input" value="<?=$site_info['sms_to1']?>" hname="SMS 수신자 번호" style="width:100px;"></td>
	   <td style="border-left:0;"><span style="color:red;">&nbsp;* 신청폼관리 관리자 수신번호(수신자번호 2개 등록가능)</span></td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4"><b style="color:blue;">SMS 서비스신청</b></td>
      <td colspan="2"><a href='http://icodekorea.com/res/join_company_fix_a.php?sellid=webbridge' target="_blank" style="font-weight:bold; color:blue;">http://icodekorea.com/res/join_company_fix_a.php?sellid=webbridge</a></td>
    </tr>
	<tr>
      <td bgcolor="#F0F0F4" align="center">아이코드 ID</td>
      <td colspan="2"><input name="site_info[sms_id]" type="text" class="input" value="<?=$site_info['sms_id']?>" hname="아이코드 회원아이디" autocomplete="off"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">아이코드 PASS</td>
      <td colspan="2"><input name="site_info[sms_pass]" type="password" class="input" value="<?=$site_info['sms_pass']?>" hname="아이코드 패스워드" autocomplete="off"></td>
    </tr>

	<!--tr>
	<td bgcolor="#F0F0F4" align="center">요금제</td>
	<td>
        <?
        if ($userinfo[payment] == 'A')
            echo ' 충전제';
        else if ($userinfo[payment] == 'C')
            echo ' 정액제';
        else
            echo ' 가입해주세요.';
        ?>
	</td>
	</tr-->
	
	<tr>
		<td bgcolor="#F0F0F4" align="center">충전 잔액</td>
		<td colspan="2">
			<?=number_format($userinfo[coin])?> 원
			<input type=button class=btn1 value='충전하기' onclick="window.open('http://icodekorea.com/company/credit_card_input.php?icode_id=<?=$site_info['sms_id']?>&icode_passwd=<?=$site_info['sms_pass']?>','icode_payment','width=800,height=800')">
		</td>
	</tr>
	<tr>
		<td bgcolor="#F0F0F4" align="center">건수별 금액</td>
		<td colspan="2">
			<?=number_format($userinfo[gpay])?> 원
		</td>
	</tr>
	
	
  </table>

  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
  	<tr>
		<td colspan="2" height="3"></td>
	</tr>
	<tr>
		<td colspan="2" height="2" bgcolor="red"></td>
	</tr>
  </table>
  <!-- SMS 환경설정 E -->
  <br>
  <!-- FAX 환경설정 S -->
  <!--table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">FAX 환경설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">FAX 서비스 신청</td>
      <td><a href='http://www.moashot.com' target=_blank>http://www.moashot.com</a></td>
    </tr>
	<tr>
      <td bgcolor="#F0F0F4" align="center">모아샷 ID</td>
      <td><input name="site_info[fax_id]" type="text" class="input" value="<?=$site_info['fax_id']?>" hname="아이코드 회원아이디"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">모아샷 PASS</td>
      <td><input name="site_info[fax_pass]" type="password" class="input" value="<?=$site_info['fax_pass']?>" hname="아이코드 패스워드"></td>
    </tr>
  </table >
  <br -->
  <!-- FAX 환경설정 E -->
  


<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">빠른상담설정</td>
    </tr>
  </table> 
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td bgcolor="#F0F0F4" width="120" align="center">빠른상담</td>
		<td width="300" style="border-right:0;">
			<input type="radio" name="site_info[b_consult]" value="1" <?=$site_info['b_consult'] == "1" ? "checked" : "";?>> 노출 <input type="radio" name="site_info[b_consult]" value="0" <?=$site_info['b_consult'] == "0" ? "checked" : "";?>> 미노출
		</td>
		<td style="border-left:0;"><span style="color:red;">&nbsp;* 노출시에 전체 웹페이지 우측에 노출됩니다.</span></td>
	</tr>
  </table>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
  	<tr>
		<td colspan="2" height="3"></td>
	</tr>
	
  </table>
  </br>


  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">포인트설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">신규가입시</td>
      <td><input type="text" class="input" name="site_info[join_point]" value="<?=$site_info['join_point']?>" size=10 option="number" hname="가입포인트" dir="rtl"> 
      숫자로만 입력 </td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">로그인시</td>
      <td><input type="text" class="input" name="site_info[login_point]" value="<?=$site_info['login_point']?>" size=10 option="number" hname="로그인포인트" dir="rtl"> 
      숫자로만 입력 </td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">회원 환경설정</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">회원 기본 상태 </td>
      <td><?=rg_html_radio("site_info[join_state]",$_const['member_states'],$site_info['join_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>			
			</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">회원 기본 레벨</td>
      <td><select name="site_info[join_level]">
<?=rg_html_option($level_info,$site_info['join_level'],NULL,NULL,NULL)?>
</select></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">탈퇴상태</td>
      <td><?=rg_html_radio("site_info[leave_state]",array(1=>"회원정보 즉시삭제","탈퇴 상태로 변경"),$site_info['leave_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>
			</td>
    </tr>
<?php /*?>    <tr>
      <td align="center" bgcolor="#F0F0F4">회원가입약관</td>
      <td><textarea class="input" name="member_agreement" rows="10" style="width:98%;"><?=$member_agreement?></textarea></td>
    </tr><?php */?>
    <tr>
      <td align="center" bgcolor="#F0F0F4">기타설정</td>
      <td><input type="checkbox" name="site_info[join_login]" value="1" <?=(($site_info['join_login']=='1')?'checked':'')?>>가입후 자동로그인</td>
    </tr>
	<tr>
      <td align="center" bgcolor="#F0F0F4">로그인설정</td>
      <td><INPUT TYPE="radio" NAME="site_info[login_control]" value="on" checked>사용 <INPUT TYPE="radio" NAME="site_info[login_control]" value="off" <?if($site_info['login_control']=="off")echo"checked";?>>사용안함</td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">레벨 이름설정(거래처 폴더구분)</td>
	  <td class="a_sub_title">※ 거래처 폴더 생성후 거래처관리에서 회원구분이 가능합니다.</td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb1">
    <tr>
      <td align="right" bgcolor="#F0F0F4" width="120">레벨(거래처)&nbsp;</td>
      <td bgcolor="#F0F0F4">&nbsp;레벨이름 (0 : 비회원, <?=$_const['admin_level']?> : 관리자)</td>
    </tr>
<?
	$i=0;
	if(is_array($level_info)) 
	foreach($level_info as $k => $v) {
		$i++;
?>
    <tr>
      <td align="right"><input type="text" class="input" name=level_info[level][] value="<?=$k?>" size="3" dir="rtl">&nbsp;</td>
      <td>&nbsp;<input type="text" class="input" name=level_info[name][] value="<?=$v?>" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td align="center"><input type="button" value=" 추 가 " class="button" onClick="level_insert()"></td>
     
    </tr>
  </table>
<script>
var row_count=<?=$i?>;

function level_delete(e)
{
	var obj = find_parent_tag(e,'td');
	if(obj.parentNode)
		var idx = obj.parentNode.rowIndex;
	else
		var idx = obj.parentElement.rowIndex;
	var tRow = tb1.deleteRow(idx);
}

function level_insert() {
	if(row_count<100) {
		row_count++;
		if(document.getElementById){
			var Tbl = document.getElementById('tb1');
		} else {
			var Tbl = document.all['tb1'];
		}
		var tRow = Tbl.insertRow(-1);  	
		var tmp=tRow.insertCell(0);
		tmp.innerHTML ='<input type="text" class="input" name=level_info[level][] value="" size="3" dir="rtl">&nbsp;';
		tmp.align='right';
		tmp=tRow.insertCell(1);
		tmp.innerHTML ='&nbsp;<input type="text" class="input" name=level_info[name][] value="" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)">';
	}
}
</script>
  <br>






<?if($_SESSION['ss_mb_id']=="webbridge" || $_SESSION['ss_mb_id']=="webbridge1" || $_SESSION['ss_mb_id']=="webbridge2"){?>

	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="a_sub_title">스킨선택</td>	 
		</tr>
	</table>

	<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tb1">

		<tr>
			<td width="25%" align="center"><label for="site_types1" style="cursor:pointer;"><img src="images/picsd1.jpg" width="100%" height="330"></label></td>
			<td width="25%" align="center"><label for="site_types2" style="cursor:pointer;"><img src="images/picsd2.jpg" width="100%" height="330"></label></td>
			<td width="25%" align="center"><label for="site_types3" style="cursor:pointer;"><img src="images/picsd3.jpg" width="100%" height="330"></label></td>		
			<td width="25%" align="center"><label for="site_types4" style="cursor:pointer;"><img src="images/picsd2.jpg" width="100%" height="330"></label></td>	
		</tr>


		<tr>
			<td width="25%" align="center">A타입<input type="radio" name="site_info[site_types]" value="1" id="site_types1" <?if($site_info[site_types] == '1'){echo "checked";}?>></td>
			<td width="25%" align="center">B타입<input type="radio" name="site_info[site_types]" value="2" id="site_types2" <?if($site_info[site_types] == '2'){echo "checked";}?>></td>
			<td width="25%" align="center">C타입<input type="radio" name="site_info[site_types]" value="3" id="site_types3" <?if($site_info[site_types] == '3'){echo "checked";}?>></td>	<td width="25%" align="center">D타입<input type="radio" name="site_info[site_types]" value="4" id="site_types4" <?if($site_info[site_types] == '4'){echo "checked";}?>></td>
		</tr>
	</table>
   <br>
<?}else{?>
<input type="hidden" name="site_info[site_types]" value="<?=$site_info[site_types]?>">
<?}?>




  <table width="100%" align="center">
    <tr>
      <td align=center><input type="submit" value=" 적 용 " class="button">
      </td>
    </tr>
  </table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
