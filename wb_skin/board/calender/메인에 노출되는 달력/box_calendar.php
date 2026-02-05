<? 
	/****************************************************
	// 게시판 코드로 게시판이름과 게시판번호를 알아낸다.
	/****************************************************/
	$rs->clear();
	$rs->set_table($_table['bbs_cfg']);
	$rs->add_where("bbs_code='$bbs_code'");
	//$rs->add_order("bbs_db_num"); 

	$row_t = $rs->fetch();
	$bbs_name = $row_t[bbs_name];
	$bbs_num = $row_t[bbs_num];
	/****************************************************/

	$where_board_name=$bbs_name;  //연결할게시판이름


	// --------------------------------------------------------------------------- // 
	// START : 달력의 디자인 및 해당월, 시작요일 등을 구하는 변수값 선언             // 
	// --------------------------------------------------------------------------- // 

	//테이블 테두리 칼라 
	$bordercolordark="FFFFFF"; 
	$bordercolorlight="000000"; 
	//테이블 크기 
	$cal_width = "150"; 
	$cal_td_width ="20"; 
	$cal_td_height_top="5"; 
	$cal_td_height="8"; 
	//오늘날짜 색 
	$today_color="000000"; 
	$today_out_color="FEEF81"; 
	$today_over_color="white"; 
	//일요일 색 
	$sun_color="red"; 
	$sun_bgcolor="white"; 
	$sun_out_color="white"; 
	$sun_over_color="white"; 
	//토요일 색 
	$sat_color="3385D9"; 
	$sat_bgcolor="white"; 
	$sat_out_color="white"; 
	$sat_over_color="white"; 
	//나머지 날짜 색 
	$else_color="666666"; 
	$else_bgcolor="white"; 
	$else_out_color="white"; 
	$else_over_color="white"; 

	//한달의 총 날짜 계산 함수 
	function Month_Day($i_month,$i_year){ 
		$day=1; 
		while(checkdate($i_month,$day,$i_year)){ 
			$day++; 
		} 
		$day--; 
		return $day; 
	} 

	//오늘 날짜를 년월일별로 구하기 
	$today=date("Ymd"); 
	$today_year=date("Y"); 
	$today_month=date("m"); 
	$today_day=date("d"); 

	//month와 year의 변수값이 지정되어있지 않으면 오늘로 지정. 
	if(!$month)$month=(int)$today_month; 
	if(!$year)$year=$today_year; 


	//선택한 월의 총 일수를 구함. 
	$total_day=Month_Day($month,$year); 

	//선택한 월의 1일의 요일을 구함. 일요일은 0. 
	$first=date(w,mktime(0,0,0,$month,1,$year)); 


	//지난달과 다음달을 보는 루틴 
	$year_p=$year-1; 
	$year_n=$year+1; 
	if($month==1){ 
		$year_prev=$year_p; 
		$year_next=$year; 
		$month_prev=12; 
		$month_next=$month+1; 
	} 
	if($month==12){ 
		$year_prev=$year; 
		$year_next=$year_n; 
		$month_prev=$month-1; 
		$month_next=1; 
	} 
	if($month!=1 && $month!=12){ 
		$year_prev=$year; 
		$year_next=$year; 
		$month_prev=$month-1; 
		$month_next=$month+1; 
	} 
	// --------------------------------------------------------------------------- // 
	// END : 달력의 디자인 및 해당월, 시작요일 등을 구하는 변수값 선언             // 
	// --------------------------------------------------------------------------- // 
?> 
<!---------------------------------------> 
<!--- START : (년월일, 이전달/다음달) ---> 
<!---------------------------------------> 
<table cellspacing='0' cellpadding='0' width='<?=$cal_width?>' border='0' align='center'> 
<tr> 
<td width='20' align='center'> 
	<a href='<?=$PHP_SELF?>?bbs_code=<?=$bbs_code?>&month=<?=$month_prev?>&year=<?=$year_prev?>' title='<?=$year_prev?>-<?=$month_prev?>'>◀</a>
</td>
<td align='center'><font style='font-family:verdana;font-size:10pt;' title=''><?=$year?>년 <b><?=$month?>월</b></td>
<td width='20' align='center'>
	<a href='<?=$PHP_SELF?>?bbs_code=<?=$bbs_code?>&month=<?=$month_next?>&year=<?=$year_next?>' title='<?=$year_next?>-<?=$month_next?>'>▶</a> 
</td> 
</tr>
<tr><td height='4'></td></tr>
</table> 
<!-------------------------------------> 
<!--- END : (년월일, 이전달/다음달) ---> 
<!-------------------------------------> 

<!----------------------------------------------------> 
<!--- START : 달력리스트 보여주기                  ---> 
<!----------------------------------------------------> 
<table cellspacing=0 cellpadding=0 bordercolorlight='<?=$bordercolorlight?>' bordercolordark='<?=$bordercolordark?>' width='<?=$cal_width?>' border=0 align='center'> 
<!-- START : 달력 요일 표시 --> 
<tr> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$sun_bgcolor?>' style='color:000000;font-size:12px;'>일</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$else_bgcolor?>' style='color:000000;font-size:12px;'>월</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$else_bgcolor?>' style='color:000000;font-size:12px;'>화</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$else_bgcolor?>' style='color:000000;font-size:12px;'>수</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$else_bgcolor?>' style='color:000000;font-size:12px;'>목</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$else_bgcolor?>' style='color:000000;font-size:12px;'>금</td> 
<td align=center height='<?=$cal_td_height_top?>' width='<?=$cal_td_width?>' bgcolor='<?=$sat_bgcolor?>' style='color:000000;font-size:12px;'>토</td> 
</tr> 
<!-- END : 달력 요일 표시 --> 
<tr> 


<? 
	//count는 <tr>태그를 넘기기위한 변수. 변수값이 7이되면 <tr>태그를 삽입한다. 
	$count=0; 

	//첫번째 주에서 빈칸을 1일전까지 빈칸을 삽입 
	for($i=0; $i<$first; $i++){ 
		echo "<td height='$cal_td_height' width='$cal_td_width'> </td>"; 
		$count++; 
	} 

	// --------------------------------------------- // 
	// START : 날짜를 테이블에 표시                  // 
	// --------------------------------------------- // 
	for($day=1;$day<=$total_day;$day++){ 
		$count++; 

		//오늘일 경우 셀 디자인 표시 
		if($day==$today_day && $month==$today_month && $year==$today_year){ 
			$m_out_color=$today_out_color; 
			$m_over_color=$today_over_color; 
			$day_color=$today_color; 
		} 
		//오늘 아닐경우 
		else { 
		//일요일 
		if ($count==1){ 
			$m_out_color=$sun_out_color; 
			$m_over_color=$sun_over_color; 
			$day_color=$sun_color; 
		} 
		//토요일 
		elseif ($count==7){ 
			$m_out_color=$sat_out_color; 
			$m_over_color=$sat_over_color; 
			$day_color=$sat_color; 
		} 
		//평일 
		else { 
			$m_out_color=$else_out_color; 
			$m_over_color=$else_over_color; 
			$day_color=$else_color; 
		} 
	} 

	// 일자구분
	$view_date_s=mktime(0,0,0,$month,$day,$year); 
	$view_date_e=mktime(0,0,0,$month,$day+1,$year); 
	//echo $view_date;
	echo "<td valign=top bgcolor='$m_out_color' height='$cal_td_height' width='$cal_td_width' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color' style='word-break:break-all;padding:0px;'>"; 

	// 날짜정보를 자동으로 넣어 쓰기 땜에.. 
	$rs->clear();
	$rs->add_field('count(*)');
	$rs->set_table($_table['bbs_body']);
	$rs->add_where("bbs_db_num=$bbs_num AND bd_write_date > '$view_date_s' AND bd_write_date < '$view_date_e'");
	$rs->fetch("data_tot");

	// 해당일자에 자료가 있을경우 * 표시 
	if($data_tot >0 ){ 
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_where("bbs_db_num=$bbs_num AND bd_write_date > '$view_date_s' AND bd_write_date < '$view_date_e'");
		$data=$rs->fetch();
		$doc_num2=$data[bd_num]; 

		// 본인의 경로에 맞게 수정 
		echo "<div align=center style='background:D6EFC6;'><A HREF='list.php?bbs_code=$bbs_code&bd_num=$doc_num2&month=$month&year=$year' title='$where_board_name  $data_tot 건' onfocus=blur()><strong><font  color='$day_color' size='2'>$day</font></strong></a></div>" ; 
		} else { echo "<div align=center><font  color='$day_color' size='2'>$day</font></div>"; }
		echo "</td>"; 

		//마지막주의 경우 
		if($count==7 && $day == $total_day ){ 
			echo"</tr>"; //토요일이 되면 줄바꾸기 위한 <tr>태그 삽입 
		} elseif($count==7){ 
			echo "</tr><tr>"; 
			$count=0; 
		} 
	} 
	// --------------------------------------------- // 
	// END : 날짜를 테이블에 표시                    // 
	// --------------------------------------------- // 
?> 
<? 
	// 선택한 월의 마지막날 이후의 빈 셀 삽입 
	for($day++; $total_day < $day && $count<7; ){ 
		echo "<td height='$cal_td_height' width='$cal_td_width' bgcolor='white'> </td>"; 
		$count++; 
	} 
	echo "</table>"; 
?> 