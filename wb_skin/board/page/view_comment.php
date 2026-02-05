<div class="comments">
<?
	include("clist_pre_process.php");
	while($data_comment=$rs_comment->fetch()) {
		include("clist_data_process.php");
?>
	<dl>
		<dt>
			<? if($mb_id) { ?>
				<span onclick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')"><?=$bc_name?></span>
			<? } else { ?>
				<span><?=$bc_name?></span>
			<? } ?>
			<span class="date"><?=$bc_write_date?></span>
		</dt>
		<dd><?=$bc_content?> <? if($comment_delete_chk) { ?><img src="<?=$skin_url?>images/c_del.gif" onClick="location.href='<?=$comment_delete_url?>'" style="cursor:pointer" align="absmiddle" alt=" 코멘트 삭제 "><?}?></dd>
	</dl>
<? } ?>
</div>

<? if($_bbs_auth['comment']) { // 코멘트 쓰기여부 ?>


<div class="write_comment">
<form name="comment_form" action="?" method="post" onSubmit="return validate(this)" style="margin:0;">
	<?=$_post_param[3]?>
	<input type="hidden" name="mode" value="comment_write">
	<input type="hidden" name="bd_num" value="<?=$bd_num?>">
	<? if($vcfg['input_name'] || $vcfg['spam_chk']) { ?>
	<ul class="writer_info">
		
		<? if($vcfg['input_name']) {?>
		<li>작성자  <input type="text" name="bc_name" value="" class="input" /></li>
		<li>
		암호  <input type="password" name="bc_pass" class="input" />
		</li>
		<?}?>
		<? if($vcfg['spam_chk']) { ?>
		<li>
		스팸방지  
		<input name="spam_chk" type="text" class="input" size="10">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"> <?=$spam_chk_img?>
		</li>
		<?}?>
	</ul>
	<? } ?>
	<div class="textWrap">
		<textarea name="bc_content" rows="3" class="input_o"></textarea>
		<div class="btn"><input type="image" src="<?=$skin_url?>images/comment_ok.gif" value="코멘트등록" style="width:70px;height:50px;font:bold 16px doutum;background:#667D99;color:#FFFFFF;" /></div>
	</div>
</form>
</div>

<? } ?>

