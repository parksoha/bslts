
<nav id="menu" style="display:none;">
<script>
$(document).ready(function(){

	$("#menu").attr("style","display:block");
});
</script>

	<div class="gong_menu">
		<ul class="left_logo">
			<li style="width:100%; float:left; height:48px; border-bottom:1px solid #e8e8e8; text-align:center;"><img src="<?=$site_path?>wb_data/design/<?=$logo1[logo1]?>" height="100%"><a href="#return false;" id="my-button2" class="menu_clo"><i class="fa fa-times"></i></a></li>
		</ul>
		

		<div id='cssmenu' class="neleftmenu">
			<ul class="sldme">

				<?
					




				


					for($h=0;$h<count($menu_info);$h++){




						if($h==($menu_num-1)) $selected="selected"; else $selected='';
						echo '<li class="active has-sub">';
							$menu_names2 = explode("/",$menu_names[$h]);
							echo '<a href="#return false;" class="texslim" style="color:#000;"><span class="texslim2">+ '.$menu_names2[0].'</span></a>';

							
							if(count($menu_info[$h])!=0){
								$sub=$menu_info[$h];								

								
								
								echo '<ul class="dismen">';
								

								
								for($b=0;$b<count($sub);$b++){
									echo '<li><a href="javascript:menu'.($h+1).'sub'.($b+1).'()" class="texslim"><span class="texslim3"><i class="fa fa-caret-right"></i> '.$tw_okli3.$sub[$b].'</span></a></li>';
								}
								echo '</ul>';
							}
						echo '</li>';
					}
		
				?>


				
				<?if($ss_mb_id){?>
				<li class="active"><a href="javascript:mem_modify();" class="texslim" style="color:#000;"><span class="texslim2">+ 마이페이지</span></a></li>
				<li class="active"><a href="javascript:mem_logout();" class="texslim" style="color:#000;"><span class="texslim2">+ 로그아웃</span></a></li>

				<?}else if($_site_info['login_control']=="on"){?>
				<li class="active"><a href="/wb_member/login.php" class="texslim" style="color:#000;"><span class="texslim2">+ 로그인</span></a></li>
				<?}?>

				
				
				
			
			</ul>
		</div>

		
	</div>

</nav>