<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
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
?>
<br />
<table width="500" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed" class="site_list" >
	<tr> 
		<th width="80">구분</th>
		<th width="100" >Cnt</th>
		
	</tr>
	<tr> 
		<td> 오늘 총 히트수</td>
		<td ><?=number_format($today_data['hits'])?></td>
		
	</tr>
	<tr> 
		<td> 오늘 순수 방문자</td>
		<td ><?=number_format($today_data['unique_hits'])?></td>
		
	</tr>

	<tr> 
		<td> 어제 총 히트수</td>
		<td ><?=number_format($yesterday_data['hits'])?></td>
		
	</tr>

	<tr> 
		<td> 어제 순수 방문자</td>
		<td ><?=number_format($yesterday_data['unique_hits'])?></td>
		
	</tr>

	<tr> 
		<td> 전체 총 히트수</td>
		<td ><?=number_format($total_data['hits'])?></td>
		
	</tr>

	<tr> 
		<td> 전체 순수 방문자</td>
		<td ><?=number_format($total_data['unique_hits'])?></td>
		
	</tr>


</table>
