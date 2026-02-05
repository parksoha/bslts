<? include ("./include/header.php") ?>




<script>
function openpops(year,month,day,ss){
	cw=screen.availWidth;     //화면 넓이
	ch=screen.availHeight;    //화면 높이

	sw=460;    //띄울 창의 넓이
	sh=450;    //띄울 창의 높이

	ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
	mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치


	window.open("booking.php?year="+year+"&month="+month+"&day="+day+"&ss="+ss,"","scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);
}
</script>



<div class="calen_texts">
	

	<span style="width:100%; height:auto; float:left; text-align:left; color:#000; font-size:14px; font-weight:bold; padding:5px 0 5px 0;">단 한번의 체험으로 전혀 새로운 나를 만나다!</br>20년의 노하우 지금 만나세요...!</span>

	<span style="width:100%; height:auto; float:left; text-align:left; color:#000; font-size:18px; font-weight:bold; padding:10px 0 10px 0;">피부문제 - 디아이유에서 확실한 답을 찾으세요 !</span>


	<span style="width:100%; height:auto; float:left; text-align:left; color:#000; font-size:14px; font-weight:bold; padding:5px 0 5px 0;">
	평 일 : 10:00~20:00, 토요일 : 10:00~16:00</br>휴 무 : 매주 일요일</br>※온라인 등록시 무료입니다.
	</span>

</div>


<div style="width:100%; height:auto; float:left; margin-top:20px;">



<?
	//오늘 날짜
	$thisyear  = date('Y');  
	$thismonth = date('n');  
	$today = date('j');  

	//$year, $month 값이 없으면 현재 날짜
	if (!$year) $year = $thisyear;
	if (!$month) $month = $thismonth;

	$datelike=date('Y-m-',mktime(0,0,0,$month,1,$year));
	$start_where=mktime(0,0,0,$month,1,$year);
	$end_where=mktime(0,0,0,$month,31,$year);

	function skipoffset($sno,$eno) {
	  for ($i=$sno; $i <= $eno; $i++) {
	   ?>

<td bgcolor="#E7E7E7"></td>
<?
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
   

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="ffffff">

  <tr>
    <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><TABLE width="100%" cellpadding="0" border="0">
              <TR>
                <TD align="center" valign="top"><TABLE width="100%" cellspacing="0" cellpadding="5" bordercolordark="white" bordercolorlight="#E1E1E1" border="1">
                    <tr>
                      <td height="30" align="center">
					 
					  
					  <a href="calendar.php?year=<?=$prevyeary?>&month=<?=$pmonth?>" title="<?=$prevyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">◀◀</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="calendar.php?&year=<?=$prevyear?>&month=<?=$prevmonth?>" title="<?=$prevyear?>년 <?=$prevmonth?>월 보기" style="font-size:11px;" class="green">◀</a> <span style="font-size:18px;font-weight:bold;">&nbsp;&nbsp;&nbsp;
                        <?=$year?>
                        년&nbsp;
                        <?=$month?>
                        월</span>&nbsp;&nbsp;&nbsp; <a href="calendar.php?year=<?=$nextyear?>&month=<?=$nextmonth?>" title="<?=$nextyear?>년 <?=$nextmonth?>월 보기" style="font-size:11px;" class="green">▶</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="calendar.php?year=<?=$nextyeary?>&month=<?=$pmonth?>" title="<?=$nextyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">▶▶</a> </td>
                    </tr>
                  </TABLE></TD>
              </TR>
              <TR>
                <TD align="center" valign="top"><TABLE width="100%" cellspacing="0" cellpadding="0" border="0" align="center" width="310" bordercolorlight="#E1E1E1" border="1">
              <tr>
                <td valign="top"><table cellpadding="0" cellspacing="1" border="1" width="100%">
                    <tr height="30" align="center" style="font-size:15px;font-weight:bold;font-family:tahoma;">
                      <td style="color:#FF0000">SUN</td>
                      <td>MON</td>
                      <td>TUE</td>
                      <td>WED</td>
                      <td>THU</td>
                      <td>FRI</td>
                      <td style="color:#0000FF">SAT</td>
                    </tr>
                    <tr>
                      <?
									skipoffset(1,$fors); 
									for($day=1; $day <= $maxdate; $day++) {
									$day_no=$day+0;
									$book=mktime(0, 0, 0, $month, $day, $year);
									$offset = date('w',$book);
									// 내일
									$tomorrow_time = mktime(0, 0, 0, date(m), date(d)+1, date(Y));
									$tomorrow_date = date("Y년 m월 d일", $tomorrow_time);
									
									// 일요일, 토요일, 평일 글자색상
									if($offset == 0) {
										$day_display = "<font color='#FF0000'><B>".$day."</B></font>";
										$day_displays2="3";
									} elseif($offset == 6) {
										$day_display = "<font color='#0000FF'><B>".$day."</B></font>";
										$day_displays2="1";
									} else {
										$day_display = "<font color='#000000'><B>".$day."</B></font>";
										$day_displays2="2";
									}
								?>
                      <td valign="top" height="40" style="cursor:hand;"><table cellpadding="2" cellspacing="0" border="0" width="100%" height="100%" style="table-layout:fixed;">
                          <tr>

							
							

<?if(date("Ymd") == $year.sprintf("%02d",$month).sprintf("%02d",$day)){
	
	$nemosd = "background-color:#ffde00;";	
}else{

	$nemosd = "";	
}
?>


<?if(mktime() > mktime(0,0,0,$month,$day+1,$year)){?>

		<td align="center" bgcolor="#ffffff" style="font-size:15px; color:gray;">
		<B><?=$day?></B></br>
		<span style='font-size:12px; color:red;'>예약불가</span>
<?}else{?>

<?if(mktime() > mktime(0,0,0,$month,$day+1,$year)){?>
<?}?>





		<?


		$sql_freds = "select * from wb_tb_free_form2 where free_form_datetime > CURRENT_DATE() and free_mb_id='$_SESSION[ss_mb_num]'";
		$result_freds = mysql_query($sql_freds);
		$row_freds = mysql_num_rows($result_freds);
		$freds = mysql_fetch_array($result_freds);

		$coida = $year.sprintf("%02d",$month).sprintf("%02d",$day);


		if($day_displays2 == '1'){
			$sql_freds2 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='1' or free_form_datetime2='$coida' and free_form_radio ='2' or free_form_datetime2='$coida' and free_form_radio ='6'";
			$result_freds2 = mysql_query($sql_freds2);
			$row_freds2 = mysql_num_rows($result_freds2);

			$row_freds2s = 3 - $row_freds2;
			if($row_freds2 == '3'){
				$yacd="<span style='font-size:12px; color:red;'>예약불가</span>";	
			}else{
				$yacd="<span style='font-size:12px; color:blue;'>예약가능(".$row_freds2s.")</span>";	
			}
		}else if($day_displays2 == '3'){
			$yacd="";
		}else{

			$sql_freds2 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='1' or free_form_datetime2='$coida' and free_form_radio ='2' or free_form_datetime2='$coida' and free_form_radio ='3' or free_form_datetime2='$coida' and free_form_radio ='4' or free_form_datetime2='$coida' and free_form_radio ='5'";
			$result_freds2 = mysql_query($sql_freds2);
			$row_freds2 = mysql_num_rows($result_freds2);

			$row_freds2s = 5 - $row_freds2;

			if($row_freds2 == '5'){
				$yacd="<span style='font-size:12px; color:red;'>예약불가</span>";	
			}else{
				$yacd="<span style='font-size:12px; color:blue;'>예약가능(".$row_freds2s.")</span>";	
			}
		}

		?>




		<?if($day_displays2 == '1'){?>
			
			
			<?if($row_freds2 == '3'){?>
			<td align="center" onclick="alert('예약이 꽉 찼습니다.');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer; <?=$nemosd?>">

			<!--//?}else if($row_freds != '0'){?>
			<td align="center" onclick="alert('죄송합니다. 하루에 하나만 예약 가능합니다.');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer;"-->

			<?}else{?>
			<td align="center" onclick="openpops('<?=$year?>','<?=sprintf("%02d",$month)?>','<?=sprintf("%02d",$day)?>','<?=$day_displays2?>');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer; <?=$nemosd?>">
			<?}?>

		<?}else if($day_displays2 == '3'){?>
			<td align="center" bgcolor="#ffffff" style="font-size:15px; <?=$nemosd?>">
		<?}else{?>

			
			
			
			<?if($row_freds2 == '5'){?>
			<td align="center" onclick="alert('예약이 꽉 찼습니다.');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer; <?=$nemosd?>">

			<!--//?}else if($row_freds != '0'){?>
			<td align="center" onclick="alert('죄송합니다. 하루에 하나만 예약 가능합니다.');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer;"-->

			<?}else{?>
			<td align="center" onclick="openpops('<?=$year?>','<?=sprintf("%02d",$month)?>','<?=sprintf("%02d",$day)?>','<?=$day_displays2?>');" bgcolor="#ffffff" style="font-size:15px; cursor:pointer; <?=$nemosd?>">
			<?}?>


		<?}?>




		<?=$day_display?></br>
		<?=$yacd?>



<?}?>

							</td>
                          </tr>
                        </table></td>
                      <?
									if ($offset == 6 && $day!=$maxdate) {
									echo "</tr> \n";
									echo "<tr> \n";
									}
								}
							if ($offset != 6) {
								skipoffset($fore,5);
								echo "</tr> \n";
							}
							?>
                  </TABLE></td>
              </tr>
            </table></TD>
      </TABLE></td>
  </tr>
</table>
</td>
</tr>
 
  
</table>



</div>
<? include ("./include/footer3.php") ?>