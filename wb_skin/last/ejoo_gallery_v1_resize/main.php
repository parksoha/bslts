<?php /*?><?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		reset($bd_files);
		$v=current($bd_files);
		if($v['name']=='') continue;
		list($is_image)=explode('/',$v['type']);
		if($is_image!='image') continue;
?>
<img src="<?=$v['view_url']?>"><br><br>
<?
	}
?><?php */?>
<?
	if( $col_count % $cols_count == 0) echo "<tr>";
	$col_count++;
?>


<li onclick="location.href='<?=$view_url?>';" style="cursor:pointer;">
<?
if(is_array($bd_files) && (count($bd_files) > 0)) {
$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
?>
<img src="<?=$img_view_url?>" width="100%" height="177">
<?}else{?>
<img src="../images/no_imgsa.jpg" width="100%" height="177">
<?}?>

<span class="bodlast_titlesd"><?=$bd_subject?> <?=$i_comment_count?> <?=$i_new?></span>
<span class="bodlast_titlesd2"><?=rg_cut_string(rg_get_text($bd_ext1, 1), 100, "...")?></span>

</li>

