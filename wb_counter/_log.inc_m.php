<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
 $url_length=80;
	function open_url($url){
		if(strpos($url,'%')>0) {
		  return urlencode($url);
		} else {
		  return $url;
		}
	}
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_log_m');
	if($kw!='') {
		$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
		switch($sel) {
			case '1' : $rs->add_where("referrer like '%$ss_kw%' escape '".$dbcon->escape_ch."' or ip like '%$ss_kw%' escape '".$dbcon->escape_ch."' or host like '%$ss_kw%' escape '".$dbcon->escape_ch."' or keyword like '%$ss_kw%' escape '".$dbcon->escape_ch."' or country like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;

			case '2' : $rs->add_where("referrer like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '3' : $rs->add_where("ip like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '4' : $rs->add_where("host like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '5' : $rs->add_where("keyword like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '6' : $rs->add_where("country like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
		}
		unset($ss_kw);
	}
	$rs->add_order("num DESC");
	$page_info=$rs->select_list($page,100,10);
?>



<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="80%" align="left">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form action="?" name="set_date">
			<input type="hidden" name="type" value="<?=$type?>">
			  <tr>
				<td>
					<select name="sel">
			<?
				$key_list=array(1=>'-전체-',2=>'접속경로',3=>'아이피',4=>'호스트',5=>'키워드',6=>'국가(영문으로)');
				foreach($key_list as $key => $val) {
					echo "<option value=\"$key\"";
					if($key==$sel) echo " selected ";
					echo ">$val</option>";
				}
			?>
					</select>
					<input type="text" name="kw" value="<?=$kw?>">
					<input type="submit">
					</td>
					<td align="right">
					Total : <?=number_format($row_count)?> (<?=number_format($page_info['page'])?>/<?=number_format($page_info['total_page'])?>)
					</td>
			  </tr>
			</form>
			</table>
			<script language="JavaScript" type="text/JavaScript">
			function ref_open(url)
			{
				open(url)
			}
			</script>



			<div style="text-align:center"><?=rg_navi_display($page_info,"type=$type&time_start=$time_start&time_end=$time_end&sel=$sel&kw=$kw"); ?></div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed" class="site_list">
			  <tr> 
				<th width="16%"> 일시 </th>
				<th width="10%"> 아이피</th>

				<th width="10%"> 국가</th>

				<th width="18%">키워드</th>
				<th width="10%">hits</th>
				<th width="20%"> 접속경로</th>
				<th width="16%">기타정보</th>
			  </tr>
			  <? 
			$mb_function = function_exists('mb_detect_order') && function_exists('iconv');
			if($mb_function) {
				$ary[] = "ASCII";
				$ary[] = "EUC-KR";
				$ary[] = "JIS";
				$ary[] = "EUC-JP";
				$ary[] = "UTF-8";
				mb_detect_order($ary);
			}	
				while($r=$rs->fetch()) {

					$insert_date = date("Ymd", strtotime(rg_date($r['reg_date'])));
					if(date("Ymd")==$insert_date){
						$today_color="style='color:blue;'";
					}else{
						$today_color="";
					}

			?>
			  <tr> 
				<td align="center" <?=$today_color?>>
				  <?=rg_date($r['reg_date'])?>    </td>
				<td align="center"><?=$r['ip']?>    </td>
				<td align="center"><?=$r['country']?>    </td>
				<td><?=$r['keyword']?><br /></td>
				<td align="center"><?=$r['hits']?></td>
				<td nowrap="nowrap" style="text-overflow:ellipsis;overflow:hidden"><a href="javascript:ref_open('<?=open_url($r['referrer'])?>')" title="<?=$r['referrer']?>">
			  <?
						$tmp=urldecode($r['referrer']);
						if($mb_function) $tmp=iconv(mb_detect_encoding($tmp),"UTF-8",$tmp);
						echo $tmp;
			//			echo rg_cut_string($tmp, $url_length, "..");
			//			echo mb_detect_encoding($tmp)."$tmp";
						?>
			</a><br /></td>
				<td align="center"><?=$r['browser']?>/<?=$r['os']?>/<?=$r['res']?></td>
			  </tr>
			  <? 
				}
			?>
			</table>
			<div style="text-align:center"><?=rg_navi_display($page_info,"type=$type&time_start=$time_start&time_end=$time_end&sel=$sel&kw=$kw"); ?></div>

		</td>

		<td width="20%" align="right" valign="top">

			<table width="90%" border="0" cellspacing="0" cellpadding="0" class="site_list">
				<tr> 
					<th width="70%"> 국가 </th>
					<th width="30%"> total</th>					
				</tr>

				<?
				$sql_cony = "select country,COUNT(*) as sums from wb_tb_counter_log_m where country !='' group by country";
				$result_cony = mysql_query($sql_cony);
			
				while($cony = mysql_fetch_array($result_cony)){
				?>

				<tr>
					<td>&nbsp;<?=$cony[country]?></td>
					<td align="center"><?=$cony[sums]?></td>
				</tr>

				<?}?>

				
			</table>
		
		
		</td>
	</tr>
</table>	