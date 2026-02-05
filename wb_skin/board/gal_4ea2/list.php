<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>

<style>
#gall a img{ border: 3px solid #ffffff; }
#gall a:hover img{ border: 1px solid orange;	}
</style>
<div class="g_default">
	<div class="top_info top_info_pc">
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




	<div class="category top_info_mo">
	<form name="category_forms" action="?" method="get" enctype="multipart/form-data">
		<?=$_post_param[0]?>
		<? if($_bbs_info['use_category']) { ?>
		<select name="ss[cat]" onChange="document.category_forms.submit();">
		<option value="">카테고리</option>
		<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
		</select>
		<? } ?>
	</form>
	</div>








	<form name="list_form" method="post" enctype="multipart/form-data" action="?">
	<?=$_post_param[3]?>
	<input name="mode" type="hidden" value="">
	<div class="g_list" style="width:100%; height:auto; float:left;">
		<ul style="width:100%; height:auto; float:left;">
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
		<div class="pager pager_pc"><?=rg_navi_display2($page_info,$_get_param[2],$skin_url, $list_type); ?></div>

		<div class="pager_mo"><?=rg_navi_display_m($page_info,$_get_param[2],$skin_url, $list_type); ?></div>
	</div>
	</form>









<? if($_bbs_auth['admin']||$_bbs_auth['write']) { ?>
	<div class="btns btn_group_pc">
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




	
	<div class="btn_group btn_group_mo">
		<? if($_bbs_auth['admin']) { ?>
		<div class="left">
			
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
				<a href="javascript:board_manager();">관리</a>
			
		</div>
		<? } ?>
		<? if($_bbs_auth['write']) { ?>
		<div class="right">
			
				<a href="write.php?<?=$_get_param[3]?>" class="strong">글쓰기</a>
			
		</div>
		<? } ?>
		
	</div>
<?}?>

</div>

