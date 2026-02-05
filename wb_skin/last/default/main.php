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
<tr>
  <td width="1" height="20" style="padding-left:1px;"></td>
  <td style="padding:1px 0 1px 7px; line-height:100%;" width="190"><a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <img src="/images/new.gif">  </td><td align='right'>[<?=$bd_write_date?>]</td>
</tr>

