<?

	include_once("../wb_include/lib.php");
	
	require_once("admin_chk.php");

	

	
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">대쉬보드</td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%" align="left">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="49%" align="left">
				<tr>
					<td class="a_sub_title" width="80%">&nbsp;공지사항</td>
					<td class="a_sub_title" width="20%" style="text-align:right;"><a href="/wb_board/list.php?bbs_code=qna" target="_block" style="color:#fff;">+MORE</a>&nbsp;</td>
				</tr>

				<tr>
					<td width="80%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;제목</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3;">&nbsp;등록날짜</td>
				</tr>
				<?=rg_lastest('data2','default_ul2',5,100);?>
				
			</table>


			<table border="0" cellspacing="0" cellpadding="0" width="49%" align="right">
				<tr>
					<td class="a_sub_title" colspan="3" width="80%">&nbsp;신청목록</td>
					<td class="a_sub_title" width="20%" style="text-align:right;"><a href="/wb_admin/free_form_list.php" style="color:#fff;">+MORE</a>&nbsp;</td>
				</tr>

				<tr>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;이름</td>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;핸드폰번호</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;상담상태</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3;">&nbsp;등록날짜</td>
				</tr>


				<?
				$sql_free = "select * from wb_tb_free_form order by free_form_num desc limit 5";
				$result_free = mysql_query($sql_free);
				while($free = mysql_fetch_array($result_free)){

					if(str_replace("-","",substr(date("Y-m-d"),0,10))==str_replace("-","",substr($free[free_form_datetime],0,10))){
						$new_sang ="<img src='../images/news1.gif' style='vertical-align:middle;'>";
					}else{
						$new_sang ="";

					}
				?>

				<tr onclick="location.href='/wb_admin/free_form_edit.php?&page=1&mode=modify&num=<?=$free[free_form_num]?>';" style="cursor:pointer;">
					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<img src="../images/common/bullet.gif"> <?=$free[free_form_name]?> <?=$new_sang?></td>
					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=$free[free_form_hpno]?></td>
					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?if($free[b_str2]=='1'){echo "상담대기";}else if($free[b_str2]=='2'){echo "상담완료";}?></td>

					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=substr($free[free_form_datetime],0,10)?></td>
				</tr>						
				<?}?>
				
				
			</table>
		</td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
</table>





<table border="0" cellspacing="0" cellpadding="0" width="100%" align="left">
	<tr>
		<td>





			<table border="0" cellspacing="0" cellpadding="0" width="49%" align="left">
				<tr>
					<td class="a_sub_title" colspan="3" width="80%">&nbsp;회원(거래처)관리</td>
					<td class="a_sub_title" width="20%" style="text-align:right;"><a href="/wb_admin/member_list.php" style="color:#fff;">+MORE</a>&nbsp;</td>
				</tr>


				<tr>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;아이디</td>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;회사(이름)</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;핸드폰번호</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3;">&nbsp;등록날짜</td>
				</tr>



				<?
				$sql_memb = "select * from wb_tb_member where mb_num != '1' and mb_id != 'webbridge1' and mb_id != 'webbridge2' order by mb_num desc limit 5";
				$result_memb = mysql_query($sql_memb);
				while($memb = mysql_fetch_array($result_memb)){

					if(str_replace("-","",substr(date("Y-m-d"),0,10))==date("Ymd",$memb[join_date])){
						$new_sang ="<img src='../images/news1.gif' style='vertical-align:middle;'>";
					}else{
						$new_sang ="";

					}
				?>

				<tr onclick="location.href='/wb_admin/member_edit.php?&page=1&mode=modify&num=<?=$memb[mb_num]?>';" style="cursor:pointer;">
					
					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=$memb[mb_id]?></td>	
					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=$memb[mb_name]?></td>					

					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;"><?=$memb[mb_tel2]?></td>
					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;&nbsp;
					<?if($memb[join_date] != "0"){
						echo date("Y-m-d",$memb[join_date]);
					}?>
					</td>
				</tr>						
				<?
				}
				?>

				
				
			</table>





			<table border="0" cellspacing="0" cellpadding="0" width="49%" align="right">
				<tr>
					<td class="a_sub_title" colspan="3" width="80%">&nbsp;카드결제</td>
					<td class="a_sub_title" width="20%" style="text-align:right;"><a href="/wb_admin/ksnet_list.php" style="color:#fff;">+MORE</a>&nbsp;</td>
				</tr>

				<tr>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;이름(회사)</td>
					<td width="30%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;결제방법</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3; border-right:1px solid #6d99d3;">&nbsp;금액</td>
					<td width="20%" height="25" style="border-top:1px solid #000; border-bottom:1px solid #6d99d3;">&nbsp;승인시간</td>
				</tr>


				<?
				$sql_card = "select * from wb_tb_card order by idx desc limit 5";
				$result_card = mysql_query($sql_card);
				while($card = mysql_fetch_array($result_card)){

					if(str_replace("-","",substr(date("Y-m-d"),0,10))==date("Ymd",$card[c_date])){
						$new_sang ="<img src='../images/news1.gif' style='vertical-align:middle;'>";
					}else{
						$new_sang ="";

					}
				?>

				<tr onclick="location.href='/wb_admin/ksnet_edit.php?&page=1&mode=modify&num=<?=$card[idx]?>';" style="cursor:pointer;">
					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<img src="../images/common/bullet.gif"> <?=$card[sndOrdername]?> <?=$new_sang?></td>


					<td width="30%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;
					<?
						if (empty($card[result]) || 4 != strlen($card[result]))
						{
							echo("(???)");
						}else
						{
							switch (substr($card[result],0,1))
							{
								case '1' : echo("신용카드"); break;
								case 'I' : echo("신용카드"); break;
								case '2' : echo("실시간계좌이체"); break;
								case '6' : echo("가상계좌발급"); break; 
								case 'M' : echo("휴대폰결제"); break; 
								case 'G' : echo("상품권"); break; 
								default  : echo("(????)"); break; 
							}
						}
					?>
					
					(<? if(!empty($card[authyn]) && "O" == $card[authyn]) echo("승인성공"); else echo("승인거절"); ?>)
					</td>
					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=number_format($card[amt])?>원</td>

					<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;"><?echo date("Y-m-d",$card[c_date])?>&nbsp;&nbsp;</td>
				</tr>						
				<?
				}
				?>
				
			</table>


			
		</td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>




</table>















<?
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$yesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));

	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_where("reg_date=$today");
	$today_data=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_where("reg_date=$yesterday");
	$yesterday_data=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field("sum(hits) as hits");
	$rs->add_field("sum(unique_hits) as unique_hits");
	$total_data=$rs->fetch();	


	


	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day_m');
	$rs->add_where("reg_date=$today");
	$today_datas=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day_m');
	$rs->add_where("reg_date=$yesterday");
	$yesterday_datas=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day_m');
	$rs->add_field("sum(hits) as hits");
	$rs->add_field("sum(unique_hits) as unique_hits");
	$total_datas=$rs->fetch();



	
?>



<table border=0 width="100%" cellpadding=0 cellspacing=0 align="center">
	<tr> 
		<td width="50%" align="center" style="position:relative;">
			<div id="piechart" style="width: 500px; height: 500px;"></div>
			<span style="position:absolute; bottom:0px; width:100%; text-align:center; left:0;">오늘 PC 방문자 : <?=number_format($today_data['unique_hits'])?>명</span>
			
		</td>

		<td width="50%" align="center" style="position:relative;">
			<div id="piechart2" style="width: 500px; height: 500px;"></div>
			<span style="position:absolute; bottom:0px; width:100%; text-align:center; left:0;">오늘 모바일 방문자 : <?=number_format($today_datas['unique_hits'])?>명</span>
		</td>
	</tr>

	
</table>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
      function drawChart() {


        var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],

			<?
			$sql_pcser = "select keyword,SUM(unique_hits) as hit from wb_tb_counter_search where keyword !='' group by keyword order by hit desc limit 5";
			$result_pcser = mysql_query($sql_pcser);
			while($pcser = mysql_fetch_array($result_pcser)){

				
			?>
		
				['<?=$pcser[keyword]?>',  <?=$pcser[hit]?>],
			<?}?>

			
			
        ]);

        var options = {
			legend: 'none',
		
	
			title: 'PC 검색키워드'
			
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));


        chart.draw(data, options);

	
      }


 google.setOnLoadCallback(drawChart2);

 function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
			<?
			$sql_moser = "select keyword,SUM(unique_hits) as hit from wb_tb_counter_search_m where keyword !='' group by keyword order by hit desc limit 5";
			$result_moser = mysql_query($sql_moser);
			while($moser = mysql_fetch_array($result_moser)){

				
			?>
		
				['<?=$moser[keyword]?>',  <?=$moser[hit]?>],
			<?}?>
        ]);

        var options = {
          title: '모바일 검색키워드',
			    legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));


        chart.draw(data, options);

	
      }
</script>




<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
