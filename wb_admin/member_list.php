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
	$rs_list->set_table($_table['member']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'회원아이디',2=>'회원성명',3=>'주민번호',4=>'회원주소',5=>'전화번호', 6=>'휴대폰',7=>'이메일'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("mb_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("mb_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							
							case '3' : $rs_list->add_where("(mb_address1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' OR mb_address2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."') "); break;
							case '4' : $rs_list->add_where("mb_tel1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '5' : $rs_list->add_where("mb_tel2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '6' : $rs_list->add_where("mb_email LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 회원상태
					if($__v != '') { $rs_list->add_where("$__v =  mb_state"); } break;
				case '2' : // 회원레벨
					if($__v !== '') { $rs_list->add_where("$__v =  mb_level"); } break;

				case '3' : // 회원레벨
					if($__v !== '') { $rs_list->add_where("$__v =  mb_licen"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("mb_num DESC");		break;
		default : $rs_list->add_order("mb_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m2';	

?>





<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<script>
function member_mail(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='check';
	list_form.action='member_mail.php';
	list_form.submit();
}
function member_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		
	}else{

		if(confirm("삭제하시겠습니까?")){
			list_form.mode.value='delete';
			list_form.action='member_edit.php?dels=1';
			list_form.submit();
		}else{
			return false;
		}
		

	}
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
		alert("회원의 휴대전화 정보가 올바르지 않습니다.");
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
	alert("SMS 수신을 허용하지 않았거나 혹은 휴대전화 정보가 올바르지 않습니다.\n\n회원 정보를 확인 하시기 바랍니다.");
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

		ml=((cw-sw)/2)-300;        //가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치



		 window.open("", "mypop", "scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
		 document.list_form.action = "/wb_admin/member_sms1.php?id="+id;
		 document.list_form.target = "mypop";
		 document.list_form.submit();		
	}


function exproc(){
	
	var fo= document.exs_form;

	if(fo.csv_file.value=="")
	{
		alert("CSV파일을 넣어주세요.");
		
	}else{

		if(confirm("업로드 하시겠습니까?")) 
		{ 
			fo.submit();
		}else{
			return false;
		}
	}
	

}




function goodsmail(id)
	{

		var chk_in = document.getElementById("Idx_Ary3").value;
		
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
		 document.list_form.action = "/wb_admin/member_mail1.php?id="+id+"&auto=2";
		 document.list_form.target = "mypop";
		 document.list_form.submit();		
	}




</script>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7" >
	<span style="float:left; color:red; font-size:13px; padding-bottom:0px; line-height:20px;">
	<span style="color:#000;">회원목록</span><br>
	* 아래 개별회원, 단체문자, 이벤트 문자 발송이 가능합니다.</br>
	* 환경설정에서 문자신청,결재를 하시면 바로 서비스 이용이 가능합니다.</span>

	<div style="float:right;">
	<form name="exs_form" method="post" action="ex_proc.php" enctype="multipart/form-data">
		※Excel 대량 업로드 <a href="../wb_data/excel_download.csv" style="color:red;">(업로드예:[DOWNLOAD])</a></br>
		※확장자: aaa.csv 로  업로드해야 합니다</br>
		<input type="file" name="csv_file" style="border:1px solid #000;"> &nbsp;<input type="button" value="확인" onclick="exproc();">
	</form>
	</div>
	</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
상태 : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_const['member_states'],"$ss[1]")?>
</select>

&nbsp;&nbsp;&nbsp;


레벨(거래처) : <select name="ss[2]" onChange="search_form.submit()" style="border:2px solid red;">
<option value="">=전체=</option>
<?=rg_html_option($_level_info,"$ss[2]")?>
</select>


&nbsp;&nbsp;&nbsp;



회원구분 : <select name="ss[3]" onChange="search_form.submit()" style="border:2px solid red;">
<option value="">=전체=</option>
<option value="1" <?if($ss[3] == "1"){echo "selected";}?>>개인회원</option>
<option value="2" <?if($ss[3] == "2"){echo "selected";}?>>사업자회원</option>
</select>


&nbsp;&nbsp;&nbsp;




검색: <select name="ss[0]" style="border:2px solid red;">
<? $ss_list = array(1=>'회원아이디',2=>'회원성명',3=>'회원주소',4=>'전화번호',
						5=>'휴대폰',6=>'이메일'); ?>
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



<!--전체회원에게 sms보내기-->
<?
$sql_sms1 = "select * from wb_tb_member where 1=1 and mb_is_sms='1'";
$result_sms1 = mysql_query($sql_sms1);

while($sms1 = mysql_fetch_array($result_sms1)){

	$Idx_Ary[] = $sms1[mb_num];
?>

<?}?>
<input type="hidden" name="Idx_Ary" value="<?=implode(",",$Idx_Ary)?>">
<!--전체회원에게 sms보내기 끝-->


<!--검색한회원에게 sms보내기-->
<?
if($__v=="1"){
	$serch="and mb_id LIKE '%$kw%'";
}else if($__v=="2"){
	$serch="and mb_name LIKE '%$kw%'";
}else if($__v=="3"){
	$serch="and mb_jumin LIKE '%$kw%'";
}else if($__v=="4"){
	$serch="and mb_address1 LIKE '%$kw%' or mb_address2 LIKE '%$kw%'";
}else if($__v=="5"){
	$serch="and mb_tel1 LIKE '%$kw%'";
}else if($__v=="6"){
	$serch="and mb_tel2 LIKE '%$kw%'";
}else if($__v=="7"){
	$serch="and mb_email LIKE '%$kw%'";
}else{
	$serch="";
}


if($ss[2] != ""){
	$levs = "and mb_level = '$ss[2]'";
}else{
	$levs="";
}	

if($ss[1] != ""){
	$stated = "and mb_state = '$ss[1]'";
}else{
	$stated = "";
}


$sql_sms2 = "select * from wb_tb_member where 1=1 and mb_is_sms='1' $serch $levs $stated";
$result_sms2 = mysql_query($sql_sms2);
$sms2_row = mysql_num_rows($result_sms2);

while($sms2 = mysql_fetch_array($result_sms2)){

	$Idx_Ary2[] = $sms2[mb_num];
	
?>

<?}?>

<input type="hidden" name="Idx_Ary2" value="<?=implode(",",$Idx_Ary2)?>">
<!--검색한회원에게 sms보내기 끝-->


<input type="hidden" name="Idx_Ary3" id="Idx_Ary3" value="<?=implode(",",$Idx_Ary2)?>">


<input name="mode" type="hidden" value="">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
		<td width="30" >수정</td>
		<td width="30" >삭제</td>
		<td width="40" >번호</td>
		<td>회원구분</td>
		<td>아이디</td>
		<td>이름</td>
		<td>휴대폰번호</td>
		<td>레벨</td>
		<td>SMS</td>
		<td>상태</td>
		
		<td>포인트</td>
		<td>가입일</td>
		
		
		<td>접속</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"20\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	if($kw != ''){
		$no = $page_info['start_no'];
	}else{
		$no = $page_info['start_no']-1;
	}
	while($R=$rs_list->fetch()) {
		$Idx_Ary[] = $R[mb_num];
		
		

		$hand = explode("-",$R[mb_tel2]);
		if( ($hand[0]=="010" || $hand[0]=="011" ||$hand[0]=="016" ||$hand[0]=="017" ||$hand[0]=="018" ||$hand[0]=="019") && (strlen($hand[1])==3 || strlen($hand[1])==4) && strlen($hand[2]) ==4) $handErr = "";
		else $handErr = "ERROR";

		if($R[mb_id] != 'webbridge' && $R[mb_id] != 'webbridge1' && $R[mb_id] != 'webbridge2'){
			$no--;
?>
	<tr height="25">
		<td align="center">
		<?if($R[mb_id] != 'admin'){ ?>
		<input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>"  class=none>
		<?}?>
		</td>
		<td align="center"><? if($R[mb_id] == "webbridge" && $R[mb_id] == "webbridge1" && $R[mb_id] == "webbridge2") { echo "&nbsp;"; } else { ?><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[mb_num]?>">수정</a><? } ?></td>
		<td align="center"><? if($R[mb_id] == "webbridge" && $R[mb_id] == "webbridge1" && $R[mb_id] == "webbridge2") { echo "&nbsp;"; } else { ?><a href="#" onClick="confirm_del('member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[mb_num]?>')">삭제</a><? } ?></td>
		<td align="center"><?=$no?></td>
		<td align="center">
		<?if($R[mb_licen]=="1"){?>
		개인회원
		<?}else if($R[mb_licen]=="2"){?>
		사업자회원
		<?}?>
		</td>
		<td align="center"><?=$R[mb_id]?>&nbsp;</td>
		<td align="center"><?=$R[mb_name]?></td>
		<td align="center"><?=$R[mb_tel2]?>&nbsp;</td>
		<td align="center"><?=$_level_info[$R[mb_level]]?></td>

		<? if($R[mb_is_sms]=='1' && !empty($site_info[sms_id]) && !empty($site_info[sms_pass])) { ?>
		<td align="center"><a href="javascript:memberPersms('<?=$_site_info['sms_from']?>','<?=$R[mb_tel2]?>','<?=$R[mb_name]?>','<?=$handErr?>');"><img src="images/sms_btn.gif" border="0" style="padding:3px; border:0px solid #fc0202;"></a></td>
		<? } else { ?>
		<td align="center"><a href="javascript:smsErr();"><img src="images/sms_btn.gif" border="0" style="padding:3px; border:0px solid #fc0202;"></a></td>
		<? } ?>

		<td align="center"><?=$_const['member_states'][$R[mb_state]]?></td>
		
		<td align="center"><?=$R[mb_point]?></td>
		<td align="center"><?=rg_date($R[join_date],'%Y-%m-%d')?></td>
		
		
		<td align="center"><?=$R[login_count]?></td>
		</tr>
<?
}
	}
?>
		
</table>
<div style="width:100%; float:left;">

	<div style="width:100%; float:left;text-align:center; margin-top:20px;"><?=rg_navi_display($page_info,$_get_param[2]); ?></div>


	<div style="width:50%; float:left; margin-top:30px;">
		<img src="../wb_admin/images/mag_btn3.png" onClick="member_del();" style="cursor:pointer; float:left; margin-right:10px;">
		<img src="../wb_admin/images/mag_btn4.png" onClick="location.href='member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=join'" style="cursor:pointer; float:left;">	
		
		<div style="width:100%; float:left; color:blue; padding-left:10px; line-height:25px;">* 이름, 핸드폰번호 입력만으로 고객관리가능 / 단체문자 발송가능합니다.</div>
	</div>


	<div style="width:50%; height:auto; float:left; margin-top:20px;">
	<!-- <input type="button" value="단체문자" class="button" onClick="javascript:goodsPersms('<?=implode(",",$Idx_Ary)?>');"> -->
	<span style="width:250px; float:right; padding:3px;">
	<img src="../wb_admin/images/mag_btn1.png" onClick="javascript:goodsPersms(1);" style="cursor:pointer; float:left; margin-right:10px; border:2px solid red; padding:5px;">


	<img src="../wb_admin/images/mag_btn10.png" onClick="javascript:goodsmail(1);" style="cursor:pointer; float:left; margin-right:10px; border:2px solid red; padding:5px;">


	



	<?if($sms2_row == "0"){?>
	
	</br><img src="../wb_admin/images/mag_btn2.png" onClick="alert('검색된 회원이 없습니다.');" style="cursor:pointer; float:left; margin-top:10px; border:2px solid red; border:2px solid red; padding:5px;">
	<?}else{?>
	</br><img src="../wb_admin/images/mag_btn2.png" onClick="javascript:goodsPersms(2);" style="cursor:pointer; float:left;  margin:10px 10px 0 0 ; border:2px solid red; padding:5px;">
	
	<?}?>


	<img src="../wb_admin/images/mag_btn200.png" onClick="javascript:goodsmail(2);" style="cursor:pointer; float:left; margin:10px 10px 0 0; border:2px solid red; padding:5px;">
	</span>
	</div>

</div>

			
		

		

</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>



