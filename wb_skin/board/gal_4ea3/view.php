<!--// 스킨스타일CSS //-->
<link rel="stylesheet" href="<?=$skin_url?>skinstyle.css" type="text/css"/>
<div id="g_view_style" style="width:100%; height:auto; float:left;" class="board_view_style_pc">
	<? if ($_REQUEST[skin_path]) exit; ?>
	<!--<h1 style="height:auto; padding:10px 0 10px 0; text-align:left; background:none; border:0;">
		<?=($vcfg['use_category'] && $_category_name_array[$cat_num]!='')?"[".$_category_name_array[$cat_num]."]":""?> 
		&nbsp;&nbsp;모델명 : <?=$bd_subject?></br>
		&nbsp;&nbsp;제조사 : <?=$bd_subject2?></br>
		&nbsp;&nbsp;가격 : <?=$bd_subject3?>
	</h1>-->
<!--	<div class="article_info">
		
			<ul class="info_list" style="width:100%; float:left; height:auto; border-top:1px solid #ccc;">
			
		  <li style="float:right;"><?=$bd_view_count?> hit</li>

			<? if($bd_email){?>
			<li style="float:right;">
				이메일 :  <a href="mailto:<?=$bd_email;?>"><img src="<?=$skin_url;?>images/mail_icon.gif"> <?=$bd_email;?></a>
			</li>
			<?}?>

			<li style="float:right;">이름 : <span onClick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style='cursor:pointer;'><?=($mb_icon)?$mb_icon:$bd_name?></span>
			</li>

			<? if($bd_home) { ?><li>
				홈페이지 :  <a href="<?=$bd_home?>" target="_blank"><?=$bd_home?></a>
			</li><? }?>
			<li style="float:right;">등록일 : 
				<?=rg_date($data['bd_write_date'],$vcfg['date_format'])?>				
			</li>
		</ul>
		<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { /* 추천수.. 주석처리?>
		(<?=($vcfg['btn_vote_yes'])?"추천 : {$bd_vote_yes}":""?><?=($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no'])?" / ":""?><?=($vcfg['btn_vote_no'])?"반대 : {$bd_vote_no}":""?>)
		<?*/ } ?>
	</div>-->

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
				foreach($bd_files as $k => $v) {
					if(!file_type_chk($v['type'],'image')) continue;
			?>
			<!--<div class="image_aside"><img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" id="view_image"></div>-->
			 
			<div class="image_aside"><img src="<?=$v['view_url']?>"  id="view_image" style=" border:0px solid #f2f0f0; border-radius:5px; "></div>
		<?
				}
			}
		?>
       <p><span style="width:93%; padding:10px 2%; border:1px solid #f2f0f0; border-radius:5px; font-size:19px; display:inline-block; box-shadow:1px 1px 1px #999999; text-align:center;"><b><?=$bd_subject?></b></span></p>
		
		
		<p> <div style="clear:both; float:left; padding:5px 0 20px 2%; display:inline-block;"> <?=$bd_content?></div></p>

		 <p><span style="width:93%; padding:10px 2%; border:1px solid #3e8f3e; border-radius:5px; font-size:17px; display:inline-block; box-shadow:1px 2px 2px #f1f1f1; text-align:center; text-shadow:1px 2px 2px #999999; 
		 background:#49a049; color:#ffffff;"><b><a href="javascript:menu6sub2();" class="p_link">Q&A</a></b></span></p>
	</div>
	<? if($vcfg['view_signature']) { ?>
		<?=$mb_signature?>
	<? } ?>
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





















<div id="g_view_style" style="width:100%; height:auto; float:left;" class="board_view_style_mo">
	<? if ($_REQUEST[skin_path]) exit; ?>
	<div class="view_top">
		<!--<h1 style="line-height:25px; padding-bottom:10px;">
			<?=($vcfg['use_category'] && $_category_name_array[$cat_num]!='')?"[".$_category_name_array[$cat_num]."]":""?>
			모델명 : <?=$bd_subject?></br>
			제조사 :  <?=$bd_subject2?></br>
			가격 :  <?=$bd_subject3?>
		</h1>-->

		<ul class="article_info">
			<li>
				<!--<? if($bd_modify_date>"0") echo rg_date($data['bd_modify_date'],$vcfg['date_format']); //수정했을경우
					else echo rg_date($data['bd_write_date'],$vcfg['date_format']); //등록일
				?>
				<p><span style="width:96%; padding:10px 2%; border:1px solid #f2f0f0; border-radius:5px; font-size:19px; display:inline-block; box-shadow:1px 1px 1px #999999; text-align:center;">-->
				<p style="width:100%;  display:inline-block; color:#000; font-size:18px;"><b><?=$bd_subject?></b></p>
			</li>
			<!--<li>조회 <?=$bd_view_count?></li>
			<li class="write"><?=($mb_icon)?$mb_icon:$bd_name?></li>
			<? if($bd_home) { ?><li>
				홈페이지 <a href="<?=$bd_home?>" target="_blank"><?=$bd_home?></a>
			</li><? }?>-->
		</ul>
		<?if($bd_comment_count){?><span class="comment_num"><?=$bd_comment_count?></span><?}?>
	</div>

	<? if($vcfg['use_download']) { ?>
	<div class="down_files">
		<dl>
			<dt>첨부파일</dt>
			<?
			foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
			?>
			<dd><a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;(Down :<?=number_format($v['hits'])?>)</a></dd>
			<? } ?>
		</dl>
	</div>
	<? } ?>
	
	<? if(is_array($bd_links) && (count($bd_links) > 0)) { ?>
	<div class="link_files">
	<dl>
		<dt>링크</dt>
		<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
		?>
		<dd><a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?><!-- (Click : <?=number_format($v['hits'])?>) --></a></dd>
		<? } ?>
	</dl>
	</div>
	<? } ?>

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
			<!--<div class="image_aside"><img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" id="view_image"></div>-->
			
			<div class="image_aside"><img src="<?=$v['view_url']?>"  id="view_image"></div>
			
		<?
				}
			}
		?>

		<p><?=$bd_content?></p>

		 <p><span style="width:93%; padding:10px 2% 20px 2%; border:1px solid #3e8f3e; border-radius:5px; font-size:17px; display:inline-block; box-shadow:1px 2px 2px #f1f1f1; text-align:center; text-shadow:1px 2px 2px #999999; 
		 background:#49a049; color:#ffffff;"><b><a href="/free_form.php" class="p_link">제품문의</a></b></span></p>
		<? if($_bbs_info['auth_view'] == "0") { ?>
		<!-- SNS Share S-->
		<div class="sns_share">
		<? include "../sns_send.php"; ?>
		</div><!-- SNS Share E -->
		<? } ?>
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
	
	<div class="btn_group">
		<div class="left">
			<? if($vcfg['btn_modify']) { ?>
			<a href="<?=$url_modify?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">수정</a>
			<? } ?>
			<? if($vcfg['btn_del']) { ?>
			<a href="<?=$url_delete?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">삭제</a>
			<? } ?>
			<? if($vcfg['btn_reply']) { ?>	
			<a href="<?=$url_reply?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">답변</a>
			<? } ?>
			<? if($vcfg['vote_yes']) { ?>
			<a href="<?=$url_vote_yes?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">찬성</a>
			<? } ?>
			<? if($vcfg['vote_no']) { ?>
			<a href="<?=$url_vote_no?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">반대</a>
			<? } ?>
		</div>
		<div class="right">
			<? if($vcfg['btn_list']) { ?>
				<a href="<?=$url_list?><?=($list_type)?"&list_type=".$list_type:"";?>" class="btn">목록</a>
			<? } ?>
		</div>
	</div>
</div>








<? if($vcfg['view_list']) {  include('list_main_process.php'); } ?>


<!-- <img src="<?=$skin_url?>images/view_plus.gif" width="27" height="19" alt='확대보기' border="0" onclick="javascript:changesize('+')" style="cursor:pointer;">
		<img src="<?=$skin_url?>images/view_minor.gif" width="27" height="19" alt='축소보기' border="0" onclick="javascript:changesize('-')"  style="cursor:pointer;"> -->
<!--
<SCRIPT LANGUAGE="JavaScript">
	document.all.ct.style.fontSize=11;
	document.all.ct.style.lineHeight=1.6;
	function changesize(flag){
		obj = document.all.ct.style.fontSize;
		num = eval(obj.substring(0,obj.length-2)*1);
		if(!isNaN(num)){
			if(flag=='+'){
				document.all.ct.style.fontSize = eval(num + 1);
			}else{
				if(num > 1)
				document.all.ct.style.fontSize = eval(num - 1);
				else
				alert('이미 폰트의 최소 사이즈입니다.');
			}
		}
	}
</script>
-->