<?

 	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['bbs_cfg']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("bbs_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' or bbs_db LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' or bbs_skin LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("bbs_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							//case '2' : $rs_list->add_where("bbs_code LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $rs_list->add_where("bbs_db LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '4' : $rs_list->add_where("bbs_skin LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;

							
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 
					if($__v == '2') { $rs_list->add_where("bbsnpage =  0 and pcmobile = 0"); }
					else if($__v == '3') { $rs_list->add_where("bbsnpage =  1 and pcmobile = 0"); }
					else if($__v == '4') { $rs_list->add_where("bbsnpage =  0 and pcmobile = 1"); }
					else if($__v == '5') { $rs_list->add_where("bbsnpage =  1 and pcmobile = 1"); }
					break;
					
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("bbs_num DESC");		break;
		default : $rs_list->add_order("bbs_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m4';	
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
function group_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">게시판/페이지목록</br>
	<font color="#0000FF"><B>아래 <font color="red">보기</font>버튼 클릭후 전체 게시판/페이지관리 (등재,수정) 가능합니다. 삭제시 모든 데이터 유실. 주의하세요.</B></font></br>
	
	</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
구분 : <select name="ss[1]" onChange="search_form.submit()">


<? $ss_list_ser = array(1=>'-전체-',2=>'게시판(PC)',3=>'페이지(PC)',4=>'게시판(모바일)',5=>'페이지(모바일)'); ?>
<?=rg_html_option($ss_list_ser,"$ss[1]")?>
</select>
							
검색: 
<select name="ss[0]">
<? $ss_list = array(1=>'-전체-',2=>'이름',3=>'디비명',4=>'스킨'); ?>
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
<?php /*?>		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td><?php */?>
		<td width="30" >수정</td>
		<?if($_SESSION['ss_mb_id']=="webbridge" || $_SESSION['ss_mb_id']=="webbridge1" || $_SESSION['ss_mb_id']=="webbridge2"){?>
		<td width="30" title="삭제시 모든 데이터 유실. 주의하세요.">삭제</td>
		<?}?>
		<td width="30" title="아래 보기버튼 클릭후 전체 게시판관리 (등재,수정) 가능합니다.">보기</td>
		<td width="55" bgcolor="#F0F0F4" >카테고리</td>
		<td width="40" >번호</td>
		<td width="130">구분</td>
		<td>이름</td>

		<td>스킨</td>

		<!--td>코드</td-->

		<td>디비명</td>
		<!--td>그룹</td-->
		
		<td>카테고리</td>
		<td>등록일</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_group=new recordset($dbcon);
	$rs_group->set_table($_table['group']);
	$rs_group->add_field('gr_name');
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
		if($R[gr_level_type]==1)
			$R[gr_level_info]=unserialize($R[gr_level_info]);
		else
			$R[gr_level_info]=$_level_info;
			
		$rs_group->add_where("gr_num=$R[gr_num]");
		$rs_group->fetch('gr_name');
		$rs_group->free_result();
		$rs_group->clear_where();
?>
	<tr height="25">
<?php /*?>		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>" class=none></td>
<?php */?>		<td align="center"><a href="bbs_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[bbs_num]?>">수정</a></td>
		<?if($_SESSION['ss_mb_id']=="webbridge" || $_SESSION['ss_mb_id']=="webbridge1" || $_SESSION['ss_mb_id']=="webbridge2"){?>
		<td align="center" title="삭제시 모든 데이터 유실. 주의하세요."><a href="#" onClick="confirm_del('bbs_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[bbs_num]?>')">삭제</a></td>
		<?}?>

		<?

		$sql_pagelink = "select * from wb_tb_bbs_body where bbs_db_num='".$R[bbs_db_num]."' order by bd_notice DESC, bd_num DESC limit 1";
		$result_pagelink = mysql_query($sql_pagelink);
		$pagelink = mysql_fetch_array($result_pagelink);

		$pagelink_row = mysql_num_rows($result_pagelink);


		
	

		if($R[bbsnpage]=="0"){
			$bbs_view_href=$_url['bbs']."list.php?bbs_code=".$R[bbs_code];
		}else if($R[bbsnpage]=="1"){


			if($pagelink_row == "0"){
				$bbs_view_href=$_url['bbs']."list.php?bbs_code=".$R[bbs_code];
			}else{
				$bbs_view_href="/wb_board/view.php?&bbs_code=".$R[bbs_code]."&bd_num=".$pagelink[bd_num];
			}
		}

	
		?>
		
		

		<td align="center" title="보기버튼 클릭후 전체 게시판관리 (글삭제,등재,수정) 가능합니다."><a href="<?=$bbs_view_href?>" target="_blank" style="color:red;">보기</a></td>
		<td align="center"><a href="javascript:void(0)" onClick="window_open('bbs_category.php?bbs_db_num=<?=$R[bbs_db_num]?>','category','scrollbars=yes,width=400,height=500')">카테고리</a></td>
		<td align="center"><?=$no?></td>

		<td align="center">
		<?if($R[bbsnpage] == '0'){?>
		게시판
		<?}else{?>
		<span style="color:blue;">페이지</span>
		<?}?>
		<?if($R[pcmobile] == '0'){?>
		<b>(PC)</b>
		<?}else{?>
		<b>(모바일)</b>
		<?}?>
		</td>

		<td align="center"><?=$R[bbs_name]?></td>
		<td align="center"><?=$R[bbs_skin]?></td>


		<!--td align="center"><?=$R[bbs_code]?>		  <br /></td-->
		<td align="center"><?=$R[bbs_db]?></td>
		<!--td align="center"><?=$gr_name?></td-->
		
		<td align="center">
		<?if($R[use_category]=="0"){?>
		사용안함
		<?}else if($R[use_category]=="1"){?>
		사용함
		<?}?>
		</td>
		<td align="center"><?=rg_date($R[reg_date],'%Y-%m-%d')?></td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		<td width="150">
			<input type="button" value="게시판등록" class="button" onClick="location.href='bbs_edit.php?<?=$p_str?>&page=<?=$page?>'">
<?php /*?>			<input type="button" value="그룹삭제" class="button" onClick="group_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>