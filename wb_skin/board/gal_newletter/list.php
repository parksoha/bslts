<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>

<div class="g_default" style="float:left; width:100%; margin-top:20px;">
	<div class="top_info">
		<? if($_bbs_info['use_category']) { ?>
		<form name="category_form" action="?" method="get" enctype="multipart/form-data">
			<?=$_post_param[0]?>
			<div class="category">
				Category :
				<select name="ss[cat]" onChange="document.category_form.submit();">
					<option value="">-- 전체 --</option>
					<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
				</select>
			</div>
		</form>
		<? } ?>
		<div class="total">
			Total :
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)
		</div>
	</div>
	<form name="list_form" method="post" enctype="multipart/form-data" action="?">
	<?=$_post_param[3]?>
	<input name="mode" type="hidden" value="">
	<div class="g_list">
		<ul>
		<?
		if($rs_list->num_rows()<1) {?>
			<li class="noContent">등록(검색) 된 자료가 없습니다.</li>
		<?}
			$no = $page_info['start_no'];
			$l_cols = 0;

			while($data=$rs_list->fetch()) {
				$i_no=--$no;
				include("list_data_process.php");
				
				if($bd_delete > 0) include($_skin_list_delete); // 삭제글	
				else if($bd_secret > 0) include($_skin_list_secret); // 비밀글
				else if($bd_notice > 0) include($_skin_list_notice); // 공지사항		
				else include($_skin_list_main);
			}
		?>
		</ul>
		<?
			if($_bbs_auth['cart']) { 
		?>
		
			<label><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none">전체선택</label>
		
		<? } ?>
		<div class="pager"><?=rg_navi_display2($page_info,$_get_param[2],$skin_url, $list_type); ?></div>
	</div>
	</form>
	<div class="btns">
			<? if($_bbs_auth['write']) { ?>
				<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write.php?<?=$_get_param[3]?>'" style="cursor:pointer" align="absmiddle">
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
				<img src="<?=$skin_url?>images/bbs_admin.gif" onclick="board_manager();" style="cursor:pointer" align="absmiddle" />
			<? } ?>
	</div>
</div>



<!-- <TABLE width="100%" cellspacing="0" border="0" cellpadding="0">
	<form name="search_form" action="<?=$url_all_list?>" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
	<?=$_post_param[0]?>
	<TR> 
		<TD>
			<? if($ss['cat']) { ?>
			<input type="checkbox" name="ss[cat]" value="<?=$ss['cat']?>" checked>분류내검색&nbsp;&nbsp;
			<? } ?>
		</TD>
		<TD align="right"> --><!-- <input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>작성자  -->
			<!-- <input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목 
			<input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" hname="검색어" style="border:0px;width:120px;height:19px;color:#666666; border:1px solid #CCCCCC" required>
			<input type="image" src="<?=$skin_url?>images/s_search.gif" align="absmiddle"> 
			<img src="<?=$skin_url?>images/s_cancel.gif" onclick="location.href='?<?=$_get_param[0]?>'" style="cursor:pointer" align="absmiddle">
		</TD>
	</TR>
	</form>
</TABLE> -->