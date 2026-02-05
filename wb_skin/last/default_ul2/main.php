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


<tr onclick="window.open('<?=$view_url?>');" style="cursor:pointer;">
	<td width="80%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<img src="../images/common/bullet.gif"> <?=$bd_subject?> <?=$i_comment_count?> <?=$i_new2;?></td>
	<td width="20%" height="30" style="border-bottom:1px solid #c4c4c4;">&nbsp;<?=$bd_write_date?></td>
</tr>



