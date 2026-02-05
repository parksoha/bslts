<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

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


	$Idx_Ary = array();
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['free_form']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'회원아이디',2=>'회원성명',3=>'회원주소',4=>'전화번호', 5=>'휴대폰',6=>'이메일'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							
							case '1' : $rs_list->add_where("free_form_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("free_form_telno LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $rs_list->add_where("free_form_hpno LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '4' : $rs_list->add_where("free_form_email LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break;
			}
		}
	}

	switch ($ot) {
		case 6 : $rs_list->add_order("free_form_num DESC");		break;
		default : $rs_list->add_order("free_form_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m10';



if($upd=='1'){
	mysql_query("update wb_tb_free_form set b_str2='".$stat."' where free_form_num='".$idx."'");
	echo "<script>alert('상태를 변경하였습니다.'); location.href='free_form_list.php?&page=".$page."';</script>";
}


include("_header.php");
include("admin.header.php"); 
?>

<script>
function free_form_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}

// SMS 발송 페이지
function memberPersms(ReHand,Hand,Name,Err)
{
	cw=screen.availWidth;     //화면 넓이
	ch=screen.availHeight;    //화면 높이

	sw=460;    //띄울 창의 넓이
	sh=649;    //띄울 창의 높이

	ml=((cw-sw)/2)-220;        //가운데 띄우기위한 창의 x위치
	mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치
	if(Err)
	{
		alert("휴대전화 정보가 올바르지 않습니다.");
	}
	else
	{
		if(Name) {
			window.open("sms_write.php?rehand="+ReHand+"&hand="+Hand+"&username="+Name,"","scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
		} else {
			window.open("sms_write.php?rehand="+ReHand+"&hand="+Hand+"&username="+Name,"","scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
		}
	}
}

function smsErr()
{
	alert("SMS 수신을 허용하지 않았거나 휴대전화 정보가 올바르지 않습니다.");
}
function sms_post_all()
{
	var f = document.list_form;
	f.action = "member_sms.php";
	f.submit();
}

function goodsPersms(id)
	{
		cw=screen.availWidth;     //화면 넓이
		ch=screen.availHeight;    //화면 높이

		sw=628;    //띄울 창의 넓이
		sh=887;    //띄울 창의 높이

		ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치



		 window.open("", "mypop", "scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
		 document.list_form.action = "/wb_admin/member_sms2.php?id="+id;
		 document.list_form.target = "mypop";
		 document.list_form.submit();		
	}
function sangstat(idx,stat,page){
	if(confirm("상태를 변경하시겠습니까?")){
		location.href="free_form_list.php?upd=1&idx="+idx+"&stat="+stat+"&page="+page;
	}else{
		return false;
	}	
}




function goodsmail(id)
	{

		var chk_in = document.getElementById("Idx_Ary3").value;
		var chk_in2 = document.getElementById("Idx_Arysd").value;


		if(chk_in2 == '0'){
			alert("이메일이 존재하지 않습니다.");
		}else{
		
			if(id == '3'){
				if(chk_in == ''){
					alert("고객을 체크해주세요.");
					exit;

				}
			}

			cw=screen.availWidth;     //화면 넓이
			ch=screen.availHeight;    //화면 높이

			sw=820;    //띄울 창의 넓이
			sh=960;    //띄울 창의 높이

			ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
			mt=((ch-sh)-100)/2;         //가운데 띄우기위한 창의 y위치

			 window.open("", "mypop", "scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
			 document.list_form.action = "/wb_admin/member_mail2.php?id="+id+"&auto=2";
			 document.list_form.target = "mypop";
			 document.list_form.submit();	
		}
	}
</script>







<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">신청목록<br>
	<span style="float:left; color:red; font-size:13px; padding-bottom:0px; line-height:20px;">
	*  온라인 문의 접수건 문자로 받길 원하시면 환경설정에서 문자신청,결재를 하시면 바로 서비스 이용이 가능합니다. (신청자,관리자 수신됨 )</br>
	- 신청자 sms문구 : 정상적으로 온라인문의가 신청되었습니다. -<?=$_site_info['company_name']?>-</br>
	- 관리자 sms문구 : 빠른상담접수 -  홍길동 / 010-1234-5678
	<!-- </br>* 아래 단체sms 발송으로 이벤트, 공지가 가능합니다. --></span>
	</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
검색: <select name="ss[0]">
<? $ss_list = array(1=>'회사명',2=>'전화번호',3=>'휴대폰',4=>'이메일'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">




<input name="mode" type="hidden" value="">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
		<td width="30" >수정</td>
		<td width="30" >삭제</td>
		<td width="40" >번호</td>
		<td width="100" >구분</td>
		<td width="100" >상담종류</td>
		<!--td>폼아이디</td-->
		<td>이름</td>
		<!--td>아이디</td-->
		<td width="200">제목</td>
		<td>핸드폰번호</td>
		<td>전화번호</td>

		<td>SMS</td>
		<td>이메일</td>
		<td>상태</td>
		
		<td>신청날짜</td>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"20\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$Idx_Ary[] = $R[free_form_num];


		if($R[free_form_email] != ""){
		$Idx_Arysd[]= $R[free_form_email];
		}


		$no--;

		$hand = explode("-",$R[free_form_hpno]);
		if( ($hand[0]=="010" || $hand[0]=="011" ||$hand[0]=="016" ||$hand[0]=="017" ||$hand[0]=="018" ||$hand[0]=="019") && (strlen($hand[1])==3 || strlen($hand[1])==4) && strlen($hand[2]) ==4) $handErr = "";
		else $handErr = "ERROR";

		if(!$R[free_mb_id]) $R[free_mb_id] ="비회원";
?>
	<tr height="25">
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[free_form_num]?>" class=none></td>
		<td align="center"><a href="free_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[free_form_num]?>">수정</a></td>
		<td align="center"><a href="#" onClick="confirm_del('free_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[free_form_num]?>')">삭제</a></td>
		<td align="center"><?=$no?></td>
		<td align="center">
		<?if($R["b_sty"]=="1"){?>
		<span style="color:red;">빠른상담</span>
		<?}?>		
		</td>


		<td align="center">
		
		
		<span style="color:blue;">
		<?if($R[free_select]=='1'){?>
		피부상담
		<?}else if($R[free_select]=='2'){?>
		피부체험
		<?}else if($R[free_select]=='3'){?>
		비만상담
		<?}?>
		</span>
	
		</td>
		<!--td align="center">&nbsp;<?=$R[free_form_id]?></td-->
		<td align="center">&nbsp;<?=$R[free_form_name]?></td>
		<!--td align="center">&nbsp;<?=$R[free_mb_id]?></td-->
		<td align="center">&nbsp;
		<?=$R[free_form_text1]?>
		



		</td>
		<td align="center">&nbsp;<?=$R[free_form_hpno]?></td>
		<td align="center">&nbsp;<?=$R[free_form_telno]?></td>
		<? if(!empty($site_info[sms_id]) && !empty($site_info[sms_pass])) { ?>
		<td align="center"><a href="javascript:memberPersms('<?=$_site_info['sms_from']?>','<?=$R[free_form_hpno]?>','<?=$R[free_form_name]?>','<?=$handErr?>');"><img src="images/sms_btn.gif" border="0" style="padding:3px; border:0px solid #fc0202;"></a></td>
		<? } else { ?>
		<td align="center"><a href="javascript:smsErr();"><img src="images/sms_btn.gif" border="0" style="padding:3px; border:0px solid #fc0202;"></a></td>
		<? } ?>

		<td align="center">
		<?if($R[agree]=='y'){?>		
		&nbsp;<span style="color:blue;">동의</span>
		<?}else{?>
		&nbsp;<span style="color:red;">미동의</span>
		<?}?>
		</td>

		<td align="center">
		
		&nbsp;<span style="color:blue;">
		<select name="stat" onchange="sangstat('<?=$R[free_form_num]?>',this.value,'<?=$page?>');" style="width:100px; height:25px; margin:5px 0 5px 0;">
			<option value="1" <?if($R[b_str2]=='1'){echo "selected";} ?> >상담대기</option>
			<option value="2" <?if($R[b_str2]=='2'){echo "selected";} ?> >상담완료</option>
		</select>
		</span>
		
		</td>

		<td align="center">&nbsp;<?=$R[free_form_datetime]?></td>
		</tr>
<?
}
?>
		<input type="hidden" name="Idx_Ary" value="<?=implode(",",$Idx_Ary)?>">


		<input type="hidden" name="Idx_Ary3" id="Idx_Ary3" value="<?=implode(",",$Idx_Ary)?>">

		<input type="hidden" name="Idx_Arysd" id="Idx_Arysd" value="<?=count($Idx_Arysd)?>">
</table>
</form>


<div style="width:100%; float:left;">

<div style="width:100%; float:left;text-align:center; margin-top:20px;"><?=rg_navi_display($page_info,$_get_param[2]); ?></div>

<div style="width:100%; float:left; margin-top:10px;">
	<img src="../wb_admin/images/mag_btn5.png" onClick="location.href='free_form_edit.php?<?=$p_str?>&page=<?=$page?>&mode=join'" style="cursor:pointer; float:left; margin-right:10px;">
	<img src="../wb_admin/images/mag_btn1.png" onClick="javascript:goodsPersms(1);" style="cursor:pointer; float:right; border:2px solid red; border:2px solid red; padding:5px;">
	
	<img src="../wb_admin/images/mag_btn10.png" onClick="javascript:goodsmail(1);" style="cursor:pointer; float:right; margin-right:10px; border:2px solid red; padding:5px;">
</div>

</div>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
