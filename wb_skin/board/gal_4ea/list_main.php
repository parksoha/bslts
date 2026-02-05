<?

	$tmp=unserialize($bd_ext1); if(is_array($tmp)) $bd_ext1=$tmp;
	$tmp=unserialize($bd_ext2); if(is_array($tmp)) $bd_ext2=$tmp;
	$tmp=unserialize($bd_ext3); if(is_array($tmp)) $bd_ext3=$tmp;
	$tmp=unserialize($bd_ext4); if(is_array($tmp)) $bd_ext4=$tmp;
	$tmp=unserialize($bd_ext5); if(is_array($tmp)) $bd_ext5=$tmp;
	unset($tmp);

	if($l_cols % $cols == 0&&$l_cols!=0) { 
?>

<?
}
$l_cols++;
$col_wd=100/$cols;
?>
<li class="pcs_lists" style="width:21.5%; height:auto; float:left; text-align:center; margin:10px 1% 10px 2%; padding:0;" >
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
				if($rg4_file_info[0] > $rg4_file_info[1]) { 
					$rg4_thum_width = $thum_width; 
					$rg4_thum_height = ceil($rg4_thum_width/$rg4_file_info[0] * $rg4_file_info[1]); 
				} else { 
					$rg4_thum_height = $thum_height; 
					$rg4_thum_width = ceil($rg4_thum_height/$rg4_file_info[1] * $rg4_file_info[0]); 
				} 

				// 썸네일이 없다면 생성한다. 
				if(!file_exists($rg4_thum_path)) { 
					@thumbnailImageCreate($rg4_img_path, $rg4_thum_path, $rg4_thum_width, $rg4_thum_height); 
				} 
				break;
			}//if end
			else 	{
				$rg4_thum_path = $skin_url."images/noimg.gif";
				$rg4_thum_width =140;
				$rg4_thum_height =100;
			}

		}//foreach end
	}//if end
	else {
		$rg4_thum_path = $skin_url."images/noimg.png";
		$rg4_thum_width =88;
		$rg4_thum_height =88;
		}
?>
	<a href="<?=$view_url?>" style="width:100%; float:left; text-align:center; border:1px solid #ccc; " onMouseOver="this.style.border='1px solid blue'" onMouseOut="this.style.border='1px solid #ccc'">
		<img src="<?=$rg4_thum_path?>" border="0" width="100%" height='120' style="vertical-align:top;">
	</a>

	
		<span class="title" style="width:100%; height:auto; float:left; text-align:center; padding-top:5px;">
			<? if($_bbs_auth['cart']) { ?>
			<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none">
			<? } ?>
			<?=($bd_notice >0)?$i_no:""?>
			<?=$i_reply?> <?=$i_secret?> <?=($cat_name)?"[$cat_name]":""?><a href="<?=$view_url?>"><?=mb_strimwidth($bd_subject,0,20,"...","utf-8")?> <?=$i_comment_count?> <?=$i_new?></a>
		</span>
	
	
	
</li>







<li class="btn mos_lists">
	<div class="aside_img" style="position:lerative;">
		<img src="<?=$rg4_thum_path?>" border="0">

		<? if($_bbs_auth['cart']) { ?>
		<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none" style="position:absolute; top:10px; left:10px; z-index:5;">
		<? } ?>
	</div>

	<div class="mo_lists_contf" onclick="location.href='<?=$view_url?>';">
		<ul>
			<li class="mo_lists_contf_titles">
			
			<?=($cat_name)?"[$cat_name]":""?>
			<?=($bd_notice >0)?$i_no:""?>
			<?=$bd_subject?> <?=$i_comment_count?>
			<?=$i_reply?> <?=$i_secret?> <?=$i_new?>
			</li>
			<li class="mo_lists_contf_titles2"><?=rg_cut_string(rg_get_text($bd_content, 1), 150, "...")?></li>
			<li class="mo_lists_contf_titles3"><?=$bd_write_date?> | 조회 : <?=$bd_view_count?></li>
		</ul>
	</div>







	<!--dl><a href="<?=$view_url?>">
		<dt><? if($_bbs_auth['cart']) { ?>
			<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none">
			<? } ?><?=($cat_name)?"[$cat_name]":""?>
			<?=($bd_notice >0)?$i_no:""?>
			<?=$bd_subject?> <?=$i_comment_count?>
			<?=$i_reply?> <?=$i_secret?> <?=$i_new?>
		</dt>
		<dd><?=rg_cut_string(rg_get_text($bd_ext1, 1), 150, "...")?></dd>
		<dd class="info">
			<span class="writer"><?=$bd_name?></span>
			<span><?=$bd_write_date?></span>
			<span>조회 : <?=$bd_view_count?></span>
		</dd>
	</a></dl-->
</li>