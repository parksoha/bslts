<?

	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

	$MENU_L='m22';	

?>


<? include("_header.php"); ?>
<? include("admin.header.php"); ?>


<div style="width:100%; height:auto; float:left;">



<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">온라인예약
	</td>
  </tr>
</table>

<div style="width:100%; height:auto; float:left; margin-top:20px;">
	<div style="width:760px; height:auto; float:left; border:1px solid #000; padding:20px; line-height:20px;">
	* 온라인 문의 접수건 문자로 받길 원하시면 환경설정에서 문자신청,결제를 하시면 바로 서비스 이용이 가능합니다. (신청자,관리자 수신됨 )</br>
- 신청자 sms문구 : 정상적으로 온라인문의가 신청되었습니다. -웹브릿지-</br>
- 관리자 sms문구 : [홍길동]님께서 온라인문의를 신청하셨습니다. 
	
	</div>

</div>

<div style="width:100%; height:auto; float:left; font-size:16px; font-weight:bold; margin:40px 0 20px 0;">※PC화면구성</div>

<div style="width:800px; height:auto; float:left; text-align:center;"><img src="../wb_admin/images/etc_page1.jpg" width="750" style="border:1px solid #cecece;"></div>


<div style="width:100%; height:auto; float:left; font-size:16px; font-weight:bold; margin:50px 0 20px 0;">※관리자화면구성</div>
<div style="width:800px; height:auto; float:left; text-align:center; margin-bottom:40px;"><img src="../wb_admin/images/etc_page1_1.jpg" width="750" style="border:1px solid #cecece;"></div>


</div>



<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>