<?
	/////////////// 리스트형으로 볼때 사용
	if (!$list_type || $list_type == "board") {
?>
	<li class="pcs_lists" style="height:40px; line-height:40px;">
		<? if($_bbs_auth['cart']) { ?>
		<span class="admin"><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none></span>
		<? } ?>
		<span class="num" style="height:40px; line-height:40px;"><?=$i_no?></span>
		<span class="title" style="height:40px; line-height:40px;"><a href="<?=$view_url?><?=($list_type)?"&list_type=".$list_type:"";?>" class="list_title" style="height:40px; line-height:40px;">
			<? if($_bbs_info['use_category']) {
					if($cat_name) echo "[".$cat_name."]";
				}
			?>
			<?=$i_reply?> <?=$i_secret?>
			<?=$bd_subject?>
			<?=$i_comment_count?> <?=$i_new?>
			<? if($bd_ext1) { ?><img src="<?=$skin_url?>images/ico-tag.gif" align="absmiddle"> <? } ?>
			<?
				//첨부파일유형별 아이콘
				$bd_files=unserialize($bd_files);
				//echo $bd_files;
				if(is_array($bd_files) && (count($bd_files) > 0)) {

					foreach($bd_files as $kk => $vv) {
						//echo $vv['type']."=";
						if(file_type_chk($vv['type'],'image')) {
							$file_type = $skin_url."images/files_icon/gif.gif";
						} else if(file_type_chk($vv['type'],'x-zip-compressed')) {
							$file_type = $skin_url."images/files_icon/rar.gif";
						} else if(file_type_chk($vv['type'],'plain')) {
							$file_type = $skin_url."images/files_icon/txt.gif";
						} else if(file_type_chk($vv['type'],'html')) {
							$file_type = $skin_url."images/files_icon/html.gif";

						} else if(file_type_chk($vv['type'],'octet-stream')) {
							$file_type = $skin_url."images/files_icon/file.gif";

						
						} //if end

					if($file_type) echo "<img src='$file_type' border='0' align='absmiddle' style='margin-left:4px;'>";
					} //foreach end
				} //if end
			?>
		</a></span>
		<span class="writer" style="height:40px; line-height:40px;">
			<? //if($mb_icon) { ?>
			<!--?//=$mb_icon?-->
			<? //} else { ?>
			<span onclick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style="cursor:pointer"><?=$bd_name?></span>
			<? //} ?>
		</span>
		<span class="date" style="height:40px; line-height:40px;"><?=$bd_write_date?></span>
		<span class="hit" style="height:40px; line-height:40px;"><?=$bd_view_count?></span>
	</li>





















	<li class="mos_lists"><a href="<?=$view_url?><?=($list_type)?"&list_type=".$list_type:"";?>" class="list_title">
		<? if($_bbs_auth['cart']) { ?>
		<span class="admin"><input type='checkbox' name="chk_nums[]" value="<?=$bd_num?>" class=none></span>
		<? } ?>
		<span class="title" style="font-size:14px;">
			<? if($_bbs_info['use_category']) {
					if($cat_name) echo "[".$cat_name."]";
				}
			?>
			<?=$i_reply?>
			<?=$bd_subject?>
			<?=$i_comment_count?> <?=$i_new?>

			<?if($i_secret != ""){?>
				<img src='<?=$skin_url?>images/secret.gif'>
			<?}?>


			<? if($bd_ext1) { ?><img src="<?=$skin_url?>images/ico-tag.gif" align="absmiddle"> <? } ?>
			<?
				//첨부파일유형별 아이콘
				$bd_files=unserialize($bd_files);
				//echo $bd_files;
				if(is_array($bd_files) && (count($bd_files) > 0)) {

					foreach($bd_files as $kk => $vv) {
						//echo $vv['type']."=";
						if(file_type_chk($vv['type'],'image')) {
							$file_type = $skin_url."images/files_icon/gif.gif";
						} else if(file_type_chk($vv['type'],'x-zip-compressed')) {
							$file_type = $skin_url."images/files_icon/rar.gif";
						} else if(file_type_chk($vv['type'],'plain')) {
							$file_type = $skin_url."images/files_icon/txt.gif";
						} else if(file_type_chk($vv['type'],'html')) {
							$file_type = $skin_url."images/files_icon/html.gif";

						} else if(file_type_chk($vv['type'],'octet-stream')) {
							$file_type = $skin_url."images/files_icon/file.gif";

						
						} //if end

					if($file_type) echo "<img src='$file_type' border='0' align='absmiddle' style='margin-left:4px;'>";
					} //foreach end
				} //if end
			?>
		</span>
		<span class="date"><?=$bd_write_date?></span>
	</a></li>
























	<? ++$i; ?>

<?
	} else if ($list_type=="album") {  /////////////// 앨범형때로 볼때 사용
?>


	<?
		if($l_cols % $cols == 0) {
	?>
	<tr><td align="middle" colspan='<?=$colspan?>' height="30"></td></tr>
	<tr>
	<?
		}
		$l_cols++;
	?>
	<td valign="top" style="padding:2px;">
<style>
.list_img_box { margin:5px; padding:8px; width:<?=$thum_width?>; height:; border:1px solid #CCCCCC; background:#FAFAFA; text-align:; }
*html .list_img_box { margin:5px; padding:8px; width:<?=$thum_width+20?>; height:; border:1px solid #CCCCCC; background:#FAFAFA; text-align:; }
a.list_img_box:link, a.list_img_box:visited   { text-decoration:none; color:#000000; font-size:14px; }
a.list_img_box:hover   { text-decoration:none; color:#800000;}
</style>
		<div class="list_img_box">
		<?
			$bd_files=unserialize($bd_files); 
			if(is_array($bd_files) && (count($bd_files) > 0)) {
				foreach($bd_files as $k => $v) { 
					if(file_type_chk($v['type'],'image')) {
						// 파일의 서버경로 
						$rg4_img_path = $_path['bbs_data'].$bd_files[$k][sname];
						// 섬네일의 서버경로 
						$rg4_thum_path = $_path['bbs_data'].$bd_files[$k][sname].'$th$'; 

						//썸네일 이미지 크기 가로세로 비율 조정 
						$rg4_file_info = getimagesize($rg4_img_path); 
							//이미지는 폭을 기준으로 썸네일작성 가로세로비율을 맞추려면 아래 주석을 해재
							$rg4_thum_width = $thum_width; 
							$rg4_thum_height = ceil($rg4_thum_width/$rg4_file_info[0] * $rg4_file_info[1]); 

						// 썸네일이 없다면 생성한다. 
						if(!file_exists($rg4_thum_path)) { 
							@thumbnailImageCreate($rg4_img_path, $rg4_thum_path, $rg4_thum_width, $rg4_thum_height); 
						} 
						break;
					}//if end
					else 	{
						$rg4_thum_path = $skin_url."images/noimage12090.jpg";
						$rg4_thum_width =120;
						$rg4_thum_height =100;
					}

				}//foreach end
			} else { //if end
				$rg4_thum_path = $skin_url."images/noimage12090.jpg";
				$rg4_thum_width =120;
				$rg4_thum_height =100;
			}
		?>
			<div style="width:<?=$thum_width?>;height:<?=$thum_height?>;text-align:center;overflow:hidden;">
			<a href="<?=$view_url?><?=($list_type)?"&list_type=".$list_type:"";?>"><img src="<?=$rg4_thum_path?>" border="0" align="absmiddle" title="<?=$bd_subject?>"></a>
			</div>

			<div style="clear:both;float:left;margin-top:4px;">
			<? if($_bbs_auth['cart']) { ?>
			<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none">
			<? } ?>
			<?=($bd_notice >0)?$i_no:""?>
			<?=$i_reply?> <?=$i_secret?> <?=($cat_name)?"[$cat_name]<br>":""?><a href="<?=$view_url?><?=($list_type)?"&list_type=".$list_type:"";?>"><?=rg_cut_string($bd_subject,20,"");?></a> <?=$i_comment_count?> <?=$i_new?>
			</div>
		</div>

	</td>

<? } ?>