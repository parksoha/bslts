<?
if(!$_mb){
	rg_href('',"로그된 회원만 접근 가능합니다..",'back');
}


//echo $_mb['mb_level'];
//echo $_const['employees_level'];
//오늘 날짜
$thisyear  = date('Y');  
$thismonth = date('n');  
$today     = date('j');  

//$year, $month 값이 없으면 현재 날짜
if (!$year) $year = $thisyear;
if (!$month) $month = $thismonth;

$datelike=date('Y-m-',mktime(0,0,0,$month,1,$year));
$start_where=mktime(0,0,0,$month,1,$year);
$end_where=mktime(0,0,0,$month,31,$year);

$rs_list->clear();
$rs_list->set_table($_table['bbs_body']);
$rs_list->add_where("bbs_db_num = '$bbs_db_num'");
$rs_list->add_where("bd_ext5>='$start_where'");
$rs_list->add_where("bd_ext5<='$end_where'");
if($ss['cat']) $rs_list->add_where("cat_num = {$ss['cat']}");
$rs_list->add_order("bd_num ASC"); 

for($s=0; $data[$s]=$rs_list->fetch(); $s++);

function skipoffset($sno,$eno) {
  for ($i=$sno; $i <= $eno; $i++) {
   ?><td></td><?
  }
}

//날짜의 범위 체크
if ($year > 9999 || $year < 0) rg_href('',"연도는 0~9999년만 가능합니다.",'back'); 
if ($month > 12 || $month < 0) rg_href('',"달은 1~12만 가능합니다.",'back'); 

$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));

//전월, 차월 이동링크
$pmonth = $month;
$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $year ;
$nextyear = $year ;
$prevyeary = $year - 1;
$nextyeary = $year + 1;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year -1;
} 
elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year +1;
}




//1일의 요일
$fors = date('w',mktime(0,0,0,$month,1,$year));
$fore = date('w',mktime(0,0,0,$month,$maxdate,$year));
?>
<style>
A.green:link, A.green:visited, A.green:active   { color:#69A80F; text-decoration:none;}
A.green:hover   { color:#69A80F; text-decoration:none;}
</style>


<?
if($_bbs_auth['cart']) { 
	?>	<!--<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>-->
<? } ?>		

			<div style="width:90%; float:left; text-align:center; margin-bottom:20px; padding-left:10%;">
				<!--<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$prevyeary?>&month=<?=$pmonth?>" title="<?=$prevyeary?>년 <?=$pmonth?>월 보기"><img src="../wb_skin/board/calender/images/cal_left.png"></a>-->
				<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$prevyear?>&month=<?=$prevmonth?>" title="<?=$prevyeary?>년 <?=$pmonth?>월 보기"><img src="../wb_skin/board/calender/images/cal_left.png"></a>
				<font style="font-size:18px; vertical-align:top; font-weight:bold; color:#666666; margin:0 20px 0 20px;"><?=$year?></font>
				<!--<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$nextyeary?>&month=<?=$pmonth?>" title="<?=$nextyeary?>년 <?=$pmonth?>월 보기"><img src="../wb_skin/board/calender/images/cal_right.png"></a>-->	 		
				<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$nextyear?>&month=<?=$nextmonth?>" title="<?=$nextyeary?>년 <?=$pmonth?>월 보기"><img src="../wb_skin/board/calender/images/cal_right.png"></a>
					
					<div style="width:auto; float:right;  right:10px; top:15px;">
						<form name="cal_month_form" action="?" method="get" enctype="multipart/form-data">
						<?=$_post_param[0]?>
						<input type="hidden" name="year" value="<?=$year?>">
						<? 
						for($m=1; $m<=12; $m++) {
						 $array_month[$m]=$m.'월';
						}
						?>
						<select name="month" onChange="cal_month_form.submit()">
						<?=rg_html_option($array_month,"$month")?>
						</select>
						</form>
					</div>
			</div>

			
			

			<!--<? if($_bbs_info['use_category']) { ?><td align="right">
				<form name="category_form" action="?" method="get" enctype="multipart/form-data">
				<?=$_post_param[0]?>
					<img src="<?=$skin_url?>images/category.gif" align="absmiddle">
				   <select name="ss[cat]" onChange="document.category_form.submit();">
					<option value="">=전체=</option>
					<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
					</select>
				</form>
			</td>
			<? } ?>-->	
			
			
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<TABLE cellspacing="0" cellpadding="0" border="0"  align="center" width="<?=$width?>">
	<tr>
	  <td valign="top">
				  <table cellpadding="0" cellspacing="1" border="0" bgcolor="#e4e4e4" width="100%">
				    <tr bgcolor="#fff" height="20" align="center" style="font-family:tahoma; font-size:11px;">
					  <td width="14%" style="color:#dc050a">SUN</td>
					  <td width="14%" style="color:#898989">MON</td>
					  <td width="14%" style="color:#898989">TUE</td>
					  <td width="14%" style="color:#898989">WED</td>
					  <td width="14%" style="color:#898989">THU</td>
					  <td width="14%" style="color:#898989">FRI</td>
					  <td width="14%" style="color:#488dba">SAT</td>
					</tr>
					<tr bgcolor="#ffffff">
<?
	skipoffset(1,$fors); 
	for($day=1; $day <= $maxdate; $day++) {
	$day_no=$day+0;
	$book=mktime(0, 0, 0, $month, $day, $year);
    $offset = date('w',$book);

	if($offset == 0)	 {
		$bgcolor=$suncor;
		$fontcolor=$sunfcor;
	} elseif($offset == 6) {
		$bgcolor=$satcor;
		$fontcolor=$satfcor;
	} else {
		$bgcolor=$daycor;
		$fontcolor=$dayfcor;
	}

//오늘일 경우 셀 디자인 표시
if($day==$today && $month==$thismonth && $year==$thisyear) $today_bg=" bgcolor='#FFFFDD'";
else $today_bg='';
?>
					<td valign="top" height="<?=$height?>"<?=$today_bg?>>
						<table cellpadding="2" cellspacing="0" border="0" width="100%" style="table-layout:fixed;">
						  <tr>
						    <td nowrap>
<?
	//공휴일, 기념일 처리
	$h_m = sprintf("%02d",$month);
	$h_d = sprintf("%02d",$day);
	$h_day=$h_m.$h_d;
	for($h=0;sizeof($holiday_arr)>$h;$h++){
		if($holiday_arr[$h] ==$h_day) {
			$bgcolor=$suncor; 
			$fontcolor=$sunfcor; 
			//echo "<font style='font-size:11px;' color={$fontcolor}>$holiname_arr[$h]</font>";
		} 
	}

		for($h=0;sizeof($memorialday_arr)>$h;$h++){
		if($memorialday_arr[$h] ==$h_day) {
			//echo "<font style='font-size:11px;' color={$satfcor}>$memorialname_arr[$h]</font>";
		} 
	}
	//음력처리
	$myarray = soltolun($year,$month,$day);
	$m_m = sprintf("%02d",$myarray[month]);
	$m_d = sprintf("%02d",$myarray[day]);
	$m_day=$m_m.$m_d;
	for($h=0;sizeof($moonday_arr)>$h;$h++){
		if($moonday_arr[$h] ==$m_day) {
			$bgcolor=$suncor; 
			$fontcolor=$sunfcor; 
			//echo "<font color={$fontcolor}>$moonname_arr[$h]</font>";
		} 
	}
	if ($myarray[day]==1 || $myarray[day]==5 || $myarray[day]==15 || $myarray[day]==20 || $myarray[day]==25)		
		//echo " <span style='font-size:8pt;color:#999'>($myarray[month].$myarray[day]$myarray[leap])</span>";
	
?>
</td>
							<td align="right" width="<?=$width2?>" bgcolor="<?=$bgcolor?>" style="color:<?=$fontcolor?>">
								<? if($_bbs_auth['write'] ) { ?>
								<a href="write.php?<?=$_get_param[3]?>&book=<?=$book?>">
								<?}?>
								<?=$day?><?=($_bbs_auth['write'])?'</a>':''?>&nbsp;
							</td>
						  </tr>

<?
	for($s=0;$s<sizeof($data);$s++)	{
		include($_skin_list_main);
	}
?>
						</table>
					</td>
<?
  if ($offset == 6 && $day!=$maxdate) {
    echo "</tr> \n";
    echo "<tr bgcolor='#FFFFFF'> \n";
    }
}

if ($offset != 6) {
  skipoffset($fore,5);
  echo "</tr> \n";
}
?>
</TABLE>
</td>
</tr>
</table>
</form>
<br />
	<table width="<?=$width?>" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
<? if($_bbs_auth['write']) { ?>
					<!--<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write.php?<?=$_get_param[3]?>'" style="cursor:pointer" align="absmiddle">-->
<? } ?>
<? if($_bbs_auth['admin']) { ?>
<script>
function board_manager(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한개이상 선택 하세요.');
		return;
	}
	window_open('', "board_manager", 'scrollbars=no,width=355,height=200');
	document.list_form.action = '<?=$_url['bbs']?>board_manager.php';
	document.list_form.target='board_manager';
	document.list_form.submit();
}
</script>
					<!--<img src="<?=$skin_url?>images/bbs_admin.gif" onclick="board_manager();" style="cursor:pointer" align="absmiddle">-->
<? } ?>
					</td>
				</tr>
			</table>
<!--<form name="my_form" method="post" enctype="multipart/form-data" action="/croco/wb_skin/board/calender/upload_csv.php">
	<input type="hidden" name="mode" value="upload"/>
	<table border="0" cellpadding="1" cellspacing="1" width="<?=$width?>">
		<TR> 
			<TD colspan="2">
			<div style="float:left;">엑셀 업로드(CSV)</div>
			
			
			
			</TD>
		</TR>
		<tr bgcolor="#cccccc" height="1">
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#f7f7f7">
			<td width="120" align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font> <strong>엑셀업로드</strong></td>
			<td><input type="file" name="userfile">*<span onclick="javascript:location.href='./filedownload.php'" style="cursor:pointer;"> 업로드예:[DOWNLOAD]</span></td>
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
</form>-->