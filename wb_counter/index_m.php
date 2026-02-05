<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	include_once("../wb_include/lib.php");
	require_once($_path['admin'].'admin_chk.php');
	require_once($_path['counter'].'rg_counter.lib.php');
	
	// 접속가능 체크
	if(!$rg_counter_access_guest && (!$rg_counter_access_guest && !$_auth['admin'])) {
		rg_href($_url['member']."login.php?ret_url=".$_SERVER['PHP_SELF'],"관리자만 접속 가능합니다.");
	}
		
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	// 최대 최소 년도
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day_m');
	$rs->add_field('min(reg_date) as min_date');
	$rs->add_field('max(reg_date) as max_date');
	$rs->fetch('min_date,max_date');
	
	if(!$min_date) $min_date=$today;
	
	if(!$max_date) $max_date=$today;
	
	$min_year=date('Y',$min_date);
	$max_year=date('Y',$max_date);
	
	$min_year_month=date('m',$min_date);
	$max_year_month=date('m',$max_date);

	$type_list=array('main','hour','day','month','year','br','os','res','host','search','log');
	if(!in_array($type,$type_list)) $type='main';

	$MENU_L='m5';	

	include($_path['admin'].'_header.php');
	include($_path['admin'].'admin.header.php');



	if($_SERVER['REQUEST_METHOD']=='POST' && $clnss=='ok') {
		mysql_query("delete from wb_tb_counter_day_m");
		mysql_query("delete from wb_tb_counter_etc_m");
		mysql_query("delete from wb_tb_counter_host_m");
		mysql_query("delete from wb_tb_counter_log_m");
		mysql_query("delete from wb_tb_counter_search_m");
		rg_href("/wb_counter/index_m.php","초기화를 완료하였습니다.");
	}

?>

<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<style type="text/css">
<!--
.btn1 {
	border: 1px solid;
}


td.title {
  text-align: center;
  padding-top: 2pt;
  padding-bottom: 2pt;
  background-color = rgb(245,245,255);
}

th.sunday {
  text-align: center;
  background-color: rgb(255,220,224);
  border-style: none;
}

th.saturday {
  text-align: center;
  background-color: rgb(224,220,255);
  border-style: none;
}

th.weekday {
  text-align: center;
  background-color: rgb(221,221,221);
  border-style: none;
}

td.invalid {
  text-align: center;
}

td.valid {
  text-align: center;
  background-color: #c8F8F8;
}

td.today {
  text-align: center;
  background-color: rgb(248,255,240);
}

td.omonth {
  text-align: center;
  background-color: rgb(248,245,240);
}

tr.omonth {
  text-align: center;
  background-color: #f8f8c8;
}

p.title {
  font-weight:bold
}

p.sunday {
  color: #D00000;
}

p.saturday {
  color: #0000D0;
}

p.weekday {
  color: #000000;
}

p.today {
	font-weight:bold;
}

.smaller {
}

a.2			{ text-decoration:none; }
a.2:link		{color: #ff0000;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:active	{color: #ccffff;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:visited	{color: #ff0000;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:hover		{color: #3078a8;font-family: 굴림;font-size: 9pt;text-decoration: none}

-->
</style>
<script src="calendar.js"></script>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">접속통계</td>
  </tr>
</table>
<br>
<table width="734" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr align="center">
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=main">
      <?=(($type=='main')?'<b>':'')?>
      처음</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=hour">
      <?=(($type=='hour')?'<b>':'')?>
      시간대별</a></td>
<?php /*?>    <td width="70"><a href="?type=week">
      <?=(($type=='week')?'<b>':'')?>
      요일별</a></td><?php */?>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=day">
      <?=(($type=='day')?'<b>':'')?>
      일별</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=month">
      <?=(($type=='month')?'<b>':'')?>
      월별</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=year">
      <?=(($type=='year')?'<b>':'')?>
      년별</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=br">
      <?=(($type=='br')?'<b>':'')?>
      브라우저</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=os">
      <?=(($type=='os')?'<b>':'')?>
      운영체제</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=res">
      <?=(($type=='res')?'<b>':'')?>
      해상도</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=search">
      <?=(($type=='search')?'<b>':'')?>
      검색엔진</a></td>
    <td width="66" style="border-right:1px solid #ccc;"><a href="?type=host">
      <?=(($type=='host')?'<b>':'')?>
      호스트별</a></td>
    <td width="74"><a href="?type=log">
      <?=(($type=='log')?'<b>':'')?>
      접속로그</a></td>
  </tr>
</table>
<br>
<br>
<?if($type!="log" && $type!="main"){?>
<div style="text-align:left;width:700px">
<?}?>
<?
	//echo '_'.$type.'.inc_m.php';
	include('_'.$type.'.inc_m.php');
?>
<?if($type!="log" && $type!="main"){?>
<div>
<?}?>
<br>


<form action="?" method="post" enctype='multipart/form-data' name="cln_form" id="cln_form">
<input type="hidden" name="clnss" value="ok" />
<input type="button" value="모바일접속통계 초기화" class="button" style="cursor:pointer;" onclick="clns();">
</form>


<script>
function clns(){
	var form=document.cln_form;
	 if(confirm("모바일접속통계를 초기화 하시겠습니까?")){
	 form.submit();
	 }else{
		return false;
	 }
}
</script>


<div id="CalendarLayer" style="display:none; width:172px; height:180px">
<iframe name="CalendarFrame" src="<?=$_url['js']?>/lib.calendar.js.htm"
width="172" height="180" border="0" frameborder="0" scrolling="no"></iframe></div>
<? include($_path['admin'].'admin.footer.php'); ?>
<? include($_path['admin'].'_footer.php'); ?>
