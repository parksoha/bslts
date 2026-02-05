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
<li class="pcs_lists" style="width:21.7%; height:250px; float:left; text-align:center; margin:10px 0.5% 10px 0.5%; padding:1%; border:1px solid #dfdfdf; border-radius:0px;" >
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
				$rg4_thum_width =240;
				$rg4_thum_height =170;
			}

		}//foreach end
	}//if end
	else {
		$rg4_thum_path = $skin_url."images/noimg.png";
		$rg4_thum_width =240;
		$rg4_thum_height =170;
		}
?>


	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" height="170" align="center" bgcolor="#f3f3f3" style="position:relative;">
			<? if($_bbs_auth['cart']) { ?>
			<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none" style="position:absolute; top:0; left:0;">
			<? } ?>
			<?
			$info = getimagesize($rg4_thum_path);
			
			if($info[0] < $info[1]){
				$wh_ok="height='100%'";
			}else{
				$wh_ok="width='100%'";
			}

			?>

			<img src="<?=$rg4_thum_path?>" border="0" onclick="location.href='<?=$view_url?>';" <?=$wh_ok?> style="cursor:pointer;">
			</td>
		</tr>
	</table>
	

	
		<span class="title" style="width:100%; height:auto; float:left; text-align:left; padding-top:10px;">
			
			<?=($bd_notice >0)?$i_no:""?>
			<a href="<?=$view_url?>">
			
			<span style="float:left; font-size:13px; padding:3px; background:#4173bd; color:#ffffff; display:inline-block;
			border-radius:5px;">&nbsp;<!--제조사 :--> <b><?=$bd_home?></b> &nbsp;</span>
			<span style="width:100%; float:left; font-size:19px; padding:5px 0 0px 0; color:#003471; font-weight:bold; ">
			&nbsp;<!--모델명 :--> <?=mb_strimwidth($bd_subject,0,23,"...","utf-8")?></span>
			
			<!--<span style="width:100%; float:left; font-size:13px; padding-bottom:3px;">&nbsp;가격 : <?=$bd_subject3?></span>-->
			
			</a>
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
			<span style="float:left; font-size:13px; padding:3px; background:#5bc0de; color:#ffffff; display:inline-block;
			border-radius:5px;">&nbsp;<!--제조사 :--> <b><?=$bd_home?></b> &nbsp;</span>
			<span style="width:100%; float:left; font-size:17px; padding:1px 0 0px 0; color:#337ab7; font-weight:bold; ">
			<!--모델명 :--> <?=$bd_subject?></span> 
			</li>
			<!--<li class="mo_lists_contf_titles2" style="color:#000; font-weight:bold;">제조사 : <?=$bd_subject2?></li>
			<li class="mo_lists_contf_titles2" style="color:#000; font-weight:bold;">가격 : <?=$bd_subject3?></li>-->
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