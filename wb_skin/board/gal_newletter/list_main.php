<?
	$tmp=unserialize($bd_ext1); if(is_array($tmp)) $bd_ext1=$tmp;
	$tmp=unserialize($bd_ext2); if(is_array($tmp)) $bd_ext2=$tmp;
	$tmp=unserialize($bd_ext3); if(is_array($tmp)) $bd_ext3=$tmp;
	$tmp=unserialize($bd_ext4); if(is_array($tmp)) $bd_ext4=$tmp;
	$tmp=unserialize($bd_ext5); if(is_array($tmp)) $bd_ext5=$tmp;
	unset($tmp);

	if($l_cols % $cols == 0) {
?>
<? if($l_cols != 0) { ?>

<? } ?>

<?
}
$l_cols++;
?>
<li>
	<div class="aside_img">
	<?
		$img_cnt = 0;                 // 카운트 초기화
		$thumb2_width = "145";    // 두번째 썸네일 가로 최대크기
		$thumb2_height = "82";    // 두번째 썸네일 세로 최대크기
		$bd_files=unserialize($bd_files);

		if(is_array($bd_files) && (count($bd_files) > 0)) {
			foreach($bd_files as $k => $v) {
				if(file_type_chk($v['type'],'image')) {

					if($img_cnt != 0 && $img_cnt < $thumb_cnt && $img_cnt % $cols_cnt == 0) echo "</TR>\n";
					$img_cnt = $img_cnt + 1;  // 카운터

					// 파일의 서버경로
					$rg4_img_path = $_path['bbs_data'].$bd_files[$k][sname];
					// 섬네일의 서버경로
					$rg4_thum2_path = $_path['bbs_data'].$bd_files[$k][sname].'$th2$';
					// 워터마크 서버경로
					$watermark_path = $skin_path."images/small_watermark";
					$watermark_path = $skin_path."images/small2_watermark";

					// 원본 이미지 정보
					$rg4_file_info = getimagesize($rg4_img_path);

					//썸네일 이미지 크기 가로세로 비율 조정
					if(($rg4_file_info[0] > $thumb2_width) || ($rg4_file_info[1] > $thumb2_height)) {
						// 썸네일 이미지 크기 가로세로 비율 조정
						$w_rate2 = $rg4_file_info[0] / $thumb2_width;
						$h_rate2 = $rg4_file_info[1] / $thumb2_height;

						if($w_rate2 > $h_rate2) {
							$rg4_thum2_width = $thumb2_width;
							$rg4_thum2_height = ceil($rg4_thum2_width/$rg4_file_info[0] * $rg4_file_info[1]);
						} else {
							$rg4_thum2_height = $thumb2_height;
							$rg4_thum2_width = ceil($rg4_thum2_height/$rg4_file_info[1] * $rg4_file_info[0]);
						}
					} else {
						$rg4_thumb2_width = $rg4_file_info[0];
						$rg4_thumb2_height = $rg4_file_info[1];
					}

					if($img_cnt == 1 && !file_exists($rg4_thum2_path)) {
						//워터마크 사용 @thumbnailImageCreate($rg4_img_path, $rg4_thum2_path, $rg4_thum2_width, $rg4_thum2_height, $watermark2_path);
						@thumbnailImageCreate($rg4_img_path, $rg4_thum2_path, $rg4_thum2_width, $rg4_thum2_height); // 두번째 썸네일
					}


					// 두번째 썸네일 출력
					if($img_cnt == 1) {
						if($bd_home) {
							echo "<a href='$bd_home' title='홈페이지 바로가기' target='_blank'><img src='$rg4_thum2_path' border='0'></a>";
						} else {
							echo "<img src='$rg4_thum2_path' border='0'>";
						}
					}
				}
			}
		} else { //섬네일없을경우
			if($bd_home) {
				echo "<a href='$bd_home' title='홈페이지 바로가기' target='_blank'><img src='".$skin_url."/images/noimg.png' border='0'></a>";
			} else {
				echo "<img src='".$skin_url."/images/noimg.png' border='0'>";
			}
		}
		?>
	</div>
	<dl>
		<dt><a href="#"><? if($_bbs_auth['cart']) { ?>
			<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none">
			<? } ?><?=($cat_name)?"[$cat_name]":""?>
			<?=($bd_notice >0)?$i_no:""?>
			<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?>
			<?=$i_reply?> <?=$i_secret?> <?=$i_new?>
		</a></dt>
		<dd><?=rg_cut_string(rg_get_text($bd_ext1, 1), 200, "...")?></dd>
		<dd class="info">조회 : <?=$bd_view_count?></dd>
	</dl>
</li>
	