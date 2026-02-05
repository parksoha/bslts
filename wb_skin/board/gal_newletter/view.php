<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>

<?
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
?>
<div id="g_view_style" style="float:left; width:100%; margin-top:20px;">
	<? if ($_REQUEST[skin_path]) exit; ?>
	<h1>
		<?=($vcfg['use_category'] && $_category_name_array[$cat_num]!='')?"[".$_category_name_array[$cat_num]."]":""?> 
		<?=$bd_subject?>
	</h1>
	<div class="article_info">
		<? if($_bbs_info['auth_view'] == "0") { ?>
		<!-- SNS Share S-->
		<div class="sns_share">
		<?// include "../sns_send.php"; ?>
		</div><!-- SNS Share E -->
		<? } ?>
		<ul class="info_list">
			<li>최초등록
				<?=rg_date($data['bd_write_date'],$vcfg['date_format'])?>
				<? if($bd_modify_date>"0") echo "<span style='margin-left:10px;'> 최종수정 ".rg_date($data['bd_modify_date'],$vcfg['date_format'])."</span>"; ?>
			</li>
			<? if($bd_home) { ?><li>
				홈페이지 <a href="<?=$bd_home?>" target="_blank"><?=$bd_home?></a>
			</li><? }?>
			<li>이름 : <span onClick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style='cursor:pointer;'><?=($mb_icon)?$mb_icon:$bd_name?></span>
			</li>
			<li><?=$bd_view_count?> hit</li>
		</ul>
	</div>

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

	<div class="article">
		<?
				if($vcfg['view_image']) { 
		?>

		
			<script language="JavaScript" type="text/JavaScript">
				if(onload) var set_img_old_onload=onload;
				onload=set_img_width_init;
			</script>
			<?
				//$is_sum=0; //첫번째 파일을 섬네일로 등록하도록 되어있어 섬네일은 view페이지에서 안보이도록 한다. 모두 보이게 할경우 수정
				foreach($bd_files as $k => $v) {
					/*if($is_sum==0){
						$is_sum++;
						continue;
					}*/
					if(!file_type_chk($v['type'],'image')) continue;
			?>
			<!--div class="image_aside"><img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" id="view_image"></div-->
		<?
				}
			}
		?>

		<p><?=$bd_content?></p>
	</div>

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
				<td align="left">
				<? if($next_data) { ?>
					<img src="<?=$skin_url?>images/prev.gif" onClick="location.href='<?=$url_view_next?>'" style="cursor:pointer" align="absmiddle">
				<? } ?>
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
				<td align="right">
				<? if($vcfg['btn_list']) { ?>
						<img src="<?=$skin_url?>images/list.gif" onClick="location.href='<?=$url_list?><?=($list_type)?"&list_type=".$list_type:"";?>'" style="cursor:pointer" align="absmiddle">
				<? } ?>
				<? if($prev_data) { ?>
					<img src="<?=$skin_url?>images/next.gif" onClick="location.href='<?=$url_view_prev?>'" style="cursor:pointer" align="absmiddle">
				<? } ?>
				</td>
			</tr>
		</table>
	</div>
</div>

<? if($vcfg['view_list']) {  include('list_main_process.php'); } ?>

<SCRIPT LANGUAGE="JavaScript">
	document.all.content_txt.style.fontSize=14;
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
</script>