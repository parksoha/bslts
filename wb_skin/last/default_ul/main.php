<?php /*?><?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		reset($bd_files);
		$v=current($bd_files);
		if($v['name']=='') continue;
		list($is_image)=explode('/',$v['type']);
		if($is_image!='image') continue;
?>

<?
	}
?><?php */?>




<li class="gongsd_fon3 ellipsis" onclick="location.href='<?=$view_url?>';" style="cursor:pointer;"><span class="gongsd_fon1">- <?=$bd_subject?><?=$i_comment_count?> <?=$i_new;?></span><span class="gongsd_fon2"><?=$bd_write_date?></span></li>


