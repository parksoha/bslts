<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>







<div id="board_style">
	<div class="category">
	<form name="category_form" action="?" method="get" enctype="multipart/form-data">
		<?=$_post_param[0]?>
		<? if($_bbs_info['use_category']) { ?>
		<span class="cat_txt">category</span>
		<select name="ss[cat]" onChange="document.category_form.submit();">
		<option value="">=전체=</option>
		<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
		</select>&nbsp;&nbsp;
		<? } ?>
	</form>
	</div>
	<div class="total_info">
		Total : <?=$page_info['total_rows']?> (<?=$page_info['page']?>/<?=$page_info['total_page']?>)
	</div>
	<? if($_mb[mb_id]) { ?>
	<div class="show_myarticle">
		<a href="list.php?bbs_code=<?=$bbs_code?>&ss%5Bsn%5D=1&kw=<?=$_mb[mb_id]?><?=($list_type)?"&list_type=".$list_type:"";?>" class="<?=($kw==$_mb[mb_id])?"bluetitle":"blue";?>">나의글보기</a>
	</div>
	<? } ?>

	<!--<a href="list.php?bbs_code=<?=$bbs_code?>&list_type=album" class="<?=($list_type=='album')?"bluetitle":"blue";?>"><img src="<?=$skin_url?>images/ico-list-album.gif" border="0" align="absmiddle"> 앨범형</a>
		 <span style="margin-left:8px;"></span>
		<a href="list.php?bbs_code=<?=$bbs_code?>&list_type=board" class="<?=(!$list_type || $list_type=='board')?"bluetitle":"blue";?>"><img src="<?=$skin_url?>images/ico-list-board.gif" border="0" align="absmiddle"> 게시판형</a>
		<span style="margin-left:8px;"></span> -->
	<div class="board_list">
	<form name="list_form" method="post" enctype="multipart/form-data" action="?">
		<?=$_post_param[3]?>
		<input type="hidden" name="list_type" value="<?=$list_type?>">
		<input name="mode" type="hidden" value="">
		
		<?
			if($_bbs_auth['cart']) { $admin_class="admin_list"; }
		?>
		<ul class="<?=$admin_class;?>">
			<? if (!$list_type || $list_type == "board") { ?>
			<li class="list_head">
				<?if($_bbs_auth['cart']) { ?><span class="admin"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></span><?}?>
				<span class="num">번호</span>
				<span class="title">제목</span>
				<span class="writer">작성자</span>
				<span class="date">등록일</span>
				<span class="hit">조회수</span>
			</li>
			<? } 
				if($rs_list->num_rows()<1) {
			?>
			<li class="noContent">등록(검색) 된 자료가 없습니다.</li>
			<?}?>
			<? //list
				$no = $page_info['start_no'];
				if(isset($bd_num)) $o_bd_num=$bd_num;

				while($data=$rs_list->fetch()) {
					$i_no=--$no;
					include("list_data_process.php");

					if($bd_delete > 0) include($_skin_list_delete); // 삭제글	
					else if($bd_secret > 0) include($_skin_list_secret); // 비밀글
					else if($bd_notice > 0) include($_skin_list_notice); // 공지사항		
					else if($o_bd_num==$bd_num) include($_skin_list_current); // 현재글
					else include($_skin_list_main);
				}
			?>
		</ul>
	</form>
	</div>

	<div class="pager numclik_pc">
		<?=rg_navi_display2($page_info,$_get_param[2],$skin_url, $list_type); ?>
	</div>





	<div style="padding-top:10px;" class="numclik_mo">
		<?=rg_navi_display_m($page_info,$_get_param[2],$skin_url, $list_type); ?>
	</div>





	<div class="search_box search_box_mo" style="border:0; width:300px; margin:0 auto; padding-top:10px; padding-right:0;">
		<form name="search_form" action="?" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
		<input name="list_type" type="hidden" value="<?=$list_type?>">
		<?=$_post_param[0]?>
			<div class="hide_box">
				<? if($ss['cat']) { ?>
				<label><input type="checkbox" name="ss[cat]" value="<?=$ss['cat']?>" checked>분류내검색</label>
				<? } ?>
				<label><input type="checkbox" name="ss[si]" value="1" checked>아이디</label>
				<label><input type="checkbox" name="ss[sn]" value="1" checked>작성자</label>
				<label><input type="checkbox" name="ss[st]" value="1" checked>제목</label>
				<label><input type="checkbox" name="ss[sc]" value="1" checked>내용</label>
			</div>
			<input name="kw" type="text" id="kw" class="btn" value="<?=$kw?>" hname="검색어"  style="border:1px solid #ccc; width:255px; border-radius:5px;"/>
			<input type="submit" value="검색" style="position:inherit;"/> 
			<!-- <img src="<?=$skin_url?>images/s_cancel.gif" onclick="location.href='?<?=$_get_param[0]?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle"> -->
		</form>
	</div>









	<?if($_bbs_auth['write']||$_bbs_auth['admin']){?>
	<div class="btn_group btn_group_mo" style="margin-top:15px;">
		<div class="left">
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
			<a href="javascript:board_manager()">관리</a>
		<? } ?>
		</div>
		<div class="right">
			<? if($_bbs_auth['write']) { ?>
			<a class="btn strong" href="write.php?<?=$_get_param[3]?><?=($list_type)?"&list_type=".$list_type:"";?>">글쓰기</a>
			<? } ?>
		</div>
	</div>



	<div class="btn_group btn_group_pc">
		
		<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write.php?<?=$_get_param[3]?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
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
		
	</div>
	<?}?>








	<div class="search_box search_box_pc">
		<form name="search_form" action="?" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
		<input name="list_type" type="hidden" value="<?=$list_type?>">
		<?=$_post_param[0]?>



			<div class="hide_box">
				<? if($ss['cat']) { ?>
				<label><input type="checkbox" name="ss[cat]" value="<?=$ss['cat']?>" checked>분류내검색</label>
				<? } ?>
				<label><input type="checkbox" name="ss[si]" value="1" <?=$checked_si?>>아이디</label>
				<label><input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>작성자</label>
				<label><input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목</label>
				<label><input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용</label>
			</div>


			<input name="kw" type="text" id="kw" value="<?=$kw?>" hname="검색어" style="border:0px;width:150px;height:19px;color:#666666; border:1px solid #CCCCCC" required>
			<input type="image" src="<?=$skin_url?>images/s_search.gif" align="absmiddle"> 
			
		</form>
	</div>
</div>



