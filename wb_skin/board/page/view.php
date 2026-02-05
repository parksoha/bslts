<?

/****/
	$rs_photo = new recordset($dbcon); 
	$rs_photo->clear();
	$rs_photo->set_table($_table['member']);
	$rs_photo->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
	$rs_photo->select();
	if($rs_photo->num_rows()) { // 회원정보가 있을때
		$pdata=$rs_photo->fetch();
		
		$pdata['mb_files']=unserialize($pdata['mb_files']);
		
		if($pdata['mb_files']['photo1']['name']!='') { 
			$photo_data = rg_base64("mb_num=$data[mb_num]&key=photo1&mode=view"); 
			$img_view_url = $_url['member']."mb_data.php?mb_data=".$photo_data; 
			//unset($photo_data); 
			//echo ("<img src='$photo_view_url' width='100' align='right'>");
		} else {
			$img_view_url = $skin_url."images/no_face.gif"; 
		}
	}
/*****/



?>
<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>

<div id="board_view_style" style="width:100%; height:auto; float:left;">
	<? if ($_REQUEST[skin_path]) exit; ?>

	
	


	<div class="link_files">
		<? if(is_array($bd_links) && (count($bd_links) > 0)) { ?>
		<dl>
			<dt>링크</dt>
			<?
			foreach($bd_links as $k => $v) {
				if($v['url']=='') continue;
				if($v['name']=='') $v['name']=$v['url'];
			?>
			<dd><a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;(Click : <?=number_format($v['hits'])?>)</a></dd>
			<? } ?>
		</dl>
		<? } ?>
		<? if($vcfg['use_download']) { ?>
		<dl>
			<dt>첨부파일</dt>
			<?
			foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
			?>
			<dd><a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;(Down :<?=number_format($v['hits'])?>)</a></dd>
			<? } ?>
		</dl>
		<? } ?>
	</div>
	
	<? 
		$array_list = array(excel=>'엑셀문서',doc=>'MS WORD문서',ppt=>'파워포인트문서'); 
	?> 

	<!--<img src="<?=$skin_url?>images/btn_hwp_down.gif" border="0" onclick="location.href='<?=$_path['bbs']?>down_file.php?type=hwp&bbs_code=<?=$bbs_code?>&bd_num=<?=$bd_num?>'" style="cursor:pointer" alt="hwp파일로&nbsp;저장" align="absmiddle">
	<img src="<?=$skin_url?>images/btn_text_down.gif" border="0" onclick="location.href='<?=$_path['bbs']?>down_file.php?type=txt&bbs_code=<?=$bbs_code?>&bd_num=<?=$bd_num?>'" style="cursor:pointer" alt="txt파일로&nbsp;저장" align="absmiddle">
	<img src="<?=$skin_url?>images/btn_txt_copy.gif" border="0" onclick="selectall('content_txt')" style="cursor:pointer" alt="본문 클릭보드에 담기" align="absmiddle"> -->
	<!-- <img src="<?=$skin_url?>images/btn_font_plus.gif" border="0" onclick="javascript:changesize('+');" style="margin-left:8px;cursor:pointer" alt="폰트사이즈 키우기" align="absmiddle">
	<img src="<?=$skin_url?>images/btn_font_minus.gif" border="0" onclick="javascript:changesize('-');" style="cursor:pointer" alt="폰트사이즈 줄이기" align="absmiddle"> -->

	<div class="article">
		<?
				if($vcfg['view_image']) { 
		?>

			<img src="../img/noimage.gif" id="view_image_width" height="0" width="100%"><br />
			<script language="JavaScript" type="text/JavaScript">
				if(onload) var set_img_old_onload=onload;
				onload=set_img_width_init;
			</script>
			<?
				foreach($bd_files as $k => $v) {
					if(!file_type_chk($v['type'],'image')) continue;
			?>
			<div class="image_aside"><img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" id="view_image"></div>
		<?
				}
			}
		?>

		<p><?=$bd_content?></p>
	</div>

	<? if($bd_ext1) { ?>
	<div class="tags">
		<b style="width:40px;font-size:18px;">태그</b>
		<?
			$tags= explode(",",$bd_ext1);
			for($itag=0;sizeof($tags) > $itag; $itag++) {
				echo "<a href='../rg4_member/search_board.php?c=&skey={$tags[$itag]}' class='lightbluegreen'>".$tags[$itag]."</a>";
				if (sizeof($tags) > $itag+1) echo ", ";
			}
		?>
	</div>
	<? } ?>

	<? if($vcfg['view_signature']) { ?>
	<div style="clear:both;margin-bottom:10px;padding:8px;text-align:left;background:#F0F0F0;">
		<b style="width:40px;font-size:18px;">서명</b>
		<span class="purple"><?=$mb_signature?></span>
	</div>
	<? } ?>

	<?
		if($vcfg['view_comment']) // 코멘트 표시여부 
			if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
	?>

	<div class="prev_next"> 
	<? if($prev_data) { ?>
		<!--<div style="float:left;width:100%;text-align:left;">
		&lt; <a href="<?=$url_view_prev?><?=($list_type)?"&list_type=".$list_type:"";?>" class="prev_next"><?=$prev_data['bd_subject']?></a>
		<?//=$prev_data['bd_name']?>
		</div> -->
	<? } ?>
	<? if($next_data) { ?>
		<!--<div style="float:ri style=""ght;width:100%;text-align:right;">
		<a href="<?=$url_view_next?><?=($list_type)?"&list_type=".$list_type:"";?>" class="prev_next"><?=$next_data['bd_subject']?></a> &gt;
		</div> -->
		<?//=$next_data['bd_name']?>
	<? } ?>
	</div>

	<div style="clear:both; padding-top:10px; padding-bottom:20px;">
		<table width="100%" border="0">
			<tr>
		
				<td align="right">


				<? if($vcfg['btn_modify']) { ?>	
		<img src="<?=$skin_url?>images/modify.gif" onClick="location.href='<?=$url_modify?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
		<? } ?>
		<? if($vcfg['btn_del']) { ?>	
		<img src="<?=$skin_url?>images/delete.gif" onClick="location.href='<?=$url_delete?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
		<? } ?>
		<? if($vcfg['btn_reply']) { ?>	
		<img src="<?=$skin_url?>images/reply.gif" onClick="location.href='<?=$url_reply?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
		<? } ?>
		<? if($vcfg['vote_yes']) { ?>	
		<img src="<?=$skin_url?>images/vote_good.gif" onClick="location.href='<?=$url_vote_yes?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
		<? } ?>
		<? if($vcfg['vote_no']) { ?>	
		<img src="<?=$skin_url?>images/vote_bad.gif" onClick="location.href='<?=$url_vote_no?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
		<? } ?>



		
				</td>
			</tr>
		</table>
	</div>
</div>

<? if($vcfg['view_list']) {  include('list_main_process.php'); } ?>

<SCRIPT LANGUAGE="JavaScript">
	document.all.content_txt.style.fontSize=12;
	document.all.content_txt.style.lineHeight=2.0;
	function changesize(flag){
		obj = document.all.content_txt.style.fontSize;
		num = eval(obj.substring(0,obj.length-2)*1);
		if(!isNaN(num)){
			if(flag=='+'){
				document.all.content_txt.style.fontSize = eval(num + 1);
			}else{
				if(num > 10)
				document.all.content_txt.style.fontSize = eval(num - 1);
				else
				alert('이미 폰트의 최소 사이즈입니다.');
			}
		}
	}

	function print_pop(url) {
	window.open(url,'_print','width=780,height=800');
	}
</script>