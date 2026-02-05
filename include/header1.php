<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=yes"/>



<?=$_site_info['site_meta']?>
<link rel="canonical" href="http://<?=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?=$_site_info['site_name']?>">
<meta property="og:description" content="<?=$_site_info['site_naver']?>">
<meta name="description" content="<?=$_site_info['site_naver']?>">
<meta property="og:url" content="http://<?=$_SERVER["HTTP_HOST"]?>">


<title><?=$_site_info['site_name']?></title>
<!-- 익스플로러 9 이하 버전에서 HTML5와 CSS3가 호환되도록 삽입한 소스-->
<!-- ie6, ie7 bug fix -->
<!--[if IE 7]>
<script src="<?=$site_path?>js/IE7.js" type="text/javascript"></script>
<![endif]-->
<!--[if lt IE 7]>
<script src="<?=$site_path?>js/IE7.js" type="text/javascript"></script>
<![endif]-->
<link href="<?=$site_path?>boilerplate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=$site_path?>css/style1.css" />
<!-- 스크립트 오류 표시 안보이게 -->
<SCRIPT LANGUAGE="JavaScript">
function killErrors() { return true; } window.onerror = killErrors;
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</SCRIPT>

<!--[if lte IE 8]>
<script type="text/javascript">
    if (confirm("현재 사용하시고 계신 브라우저의 버전이 낮습니다. \n본사이트는 반응형 홈페이지기 때문에 최신 브라우저만 지원이 됩니다. \n\n\n익스플로러 최신버전으로 설치 하시겠습니까? \n\n\n 확인: (받으러 가기) 취소: (그냥 접속하기)")==true){location.href="https://www.microsoft.com/ko-kr/download/internet-explorer.aspx";}
</script>
<![endif]-->

<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="<?=$site_path?>dist/html5shiv.js"></script>
<![endif]-->
<script src="<?=$site_path?>respond.min.js"></script>
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>


<script src="<?=$site_path?>wb_js/common.js"></script>


<script type="text/javascript" src="<?=$site_path?>js/jssor.slider.mini.js"></script>
<script type="text/javascript" src="<?=$site_path?>js/jssor.js"></script>


<script type="text/javascript">
var onSub="menu<?=$menu_num;?>";
var bodyc = "<?=$bodyClass?>";
var menu_num = "<?=$menu_num?>";


function brd(vl){
	if(vl=="1"){
		document.getElementById("brd66").style.display = "block";
		document.getElementById("brd65").style.display = "none";
		document.getElementById("brdimg1").src = "images/new_ov.jpg";
		document.getElementById("brdimg2").src = "images/qna_dw.jpg";	
		document.getElementById("brdhref").href = "javascript:menu5sub2();";	
	}else if(vl=="2"){
		document.getElementById("brd66").style.display = "none";
		document.getElementById("brd65").style.display = "block";
		document.getElementById("brdimg1").src = "images/new_dw.jpg";
		document.getElementById("brdimg2").src = "images/qna_ov.jpg";
		document.getElementById("brdhref").href = "javascript:menu5sub1();";
		
	}
}
</script>
<script type="text/javascript" src="<?=$site_path?>include/menu3.js"></script>
<script src="<?=$site_path?>js/jquery.slides.min.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAMF3C9H90PKVLOaa9sZvZodBTQ-g4_HpE"></script>	
<script type="text/javascript" src="<?=$site_path?>smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>


<script type="text/javascript" src="<?=$site_path?>js/jquery.vticker-min.js"></script>
<script type="text/javascript" src="<?=$site_path?>js/jquery.mmenu.min.all.js"></script>
<link href="<?=$site_path?>js/jquery.mmenu.all.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$site_path?>js/jssor.slider.js"></script>


<link href="<?=$site_path?>css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="<?=$site_path?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?=$site_path?>css/board_common.css" rel="stylesheet" type="text/css">

<script src="<?=$site_path?>include/common1.js"></script>


</head>
<body>



<?include($site_path.'include/left_menu1.php');?>




<div id="wrap">
	<div class="wrap_pc2">
		<div class="wrap_pc">
			
			
			<div class="top">
				<div class="mo_logo">
					<ul>
						<li class="mo_top_home"><a href="#menu"><img src="<?=$site_path?>images/mo_menus.jpg"></a></li>    
						<li class="mo_top_logos"><a href="javascript:home();"><img src="<?=$site_path?>wb_data/design/<?=$logo1[logo1]?>"></a></li>
						
					</ul>
				</div>
				<div class="logo"><a href="javascript:home();"><img src="<?=$site_path?>wb_data/design/<?=$logo1[logo1]?>" alt="<?=$_site_info['site_name']?>" ></a></div>        


				<div class="top_hsc">
					<ul>					
						
						<?if($ss_mb_id){?>
						<li style="width:25%;"><a href="javascript:home();">HOME</a></li>		
						<li style="width:25%;"><a href="javascript:mem_modify();" class="member">Mypage</a></li>
						<li style="width:25%;" class="sitemap_btn"><a href="javascript:mem_logout();">Logout</a></li>
						<li style="width:25%;"><a href="javascript:menu1sub2();">Contact Us</a></li>
						<?}else if($_site_info['login_control']=="on"){?>
						<li style="width:33.33333333333%;"><a href="javascript:home();">HOME</a></li>		
						<li style="width:33.33333333333%;" class="sitemap_btn"><a href="/wb_member/login.php">Login</a></li>
						<li style="width:33.33333333333%;"><a href="javascript:menu1sub2();">Contact Us</a></li>
						<?}?>
						
					</ul>
				</div>



				<div id="Gnb">
				<?
					echo '<ul class="menu">';




					$widt = floor (790 / count($menu_info)); // 메뉴 넓이 나누기 메뉴개수


					for($i=0;$i<count($menu_info);$i++){




						if($i==($menu_num-1)) $selected="selected"; else $selected='';
						echo '<li class="menu'.($i+1).'" style="width:'.$widt.'px">';
							$menu_names2 = explode("/",$menu_names[$i]);
							echo '<a href="javascript:menu'.($i+1).'();" class="'.$selected.' topmenus">'.$menu_names2[0].'</a>';

							

							$ii = $i+1;


							if(count($menu_info[$i])!=0){
								$sub=$menu_info[$i];								

								if(count($sub) == '1'){
									$widt2 = (100 * count($sub))+0;
									$widt3 = ($widt-$widt2)/2;

									if($i == "0"){
										$widt4 ="left:30px;";
									}else if($ii == count($menu_info)){
										$widt4 ="right:30px;";
										
									}else{
										$widt4 = "left:".$widt3."px";
									}
									
								}else{
									$widt2 = (100 * count($sub))+0;
									$widt3 = ($widt2-$widt)/2;

									if($i == "0"){
										$widt4 ="left:0;";
									}else if($ii == count($menu_info)){
										$widt4 ="right:0;";
										
									}else{
										$widt4 = "left:"."-".$widt3."px";
									}
									
								}

								


								
								
								
								echo '<ul class="sub subs'.$ii.'" style="width:'.$widt2.'px; '.$widt4.'">';
								

								
								for($k=0;$k<count($sub);$k++){
									echo '<li><a href="javascript:menu'.($i+1).'sub'.($k+1).'()">'.$sub[$k].'</a></li>';
								}
								echo '</ul>';
							}
						echo '</li>';
					}
					echo '</ul>';
				?>
				</div>






	   
						
				<div id="Gnb2">
				<?
					echo '<ul class="menu">';




					$widt = floor (100 / count($menu_info)); // 메뉴 넓이 나누기 메뉴개수


					for($h=0;$h<count($menu_info);$h++){




						if($h==($menu_num-1)) $selected="selected"; else $selected='';
						echo '<li class="menu'.($h+1).'" style="width:'.$widt.'%">';
						$menu_names2 = explode("/",$menu_names[$h]);
							echo '<a href="#return false;" class="'.$selected.' topmenus">'.$menu_names2[0].'</a>';

							
							if(count($menu_info[$h])!=0){
								$sub=$menu_info[$h];								

								
								$hh = $h+1;
								echo '<ul class="sub subs'.$hh.'">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" height="30">
										<tr>
								';
								

								
								for($b=0;$b<count($sub);$b++){
									echo '<td align="center" style="font-size:14px;" height="30"><a href="javascript:menu'.($h+1).'sub'.($b+1).'()" style="color:#fff; font-size:13px;">'.$sub[$b].'</a></td>';
								}
								echo '
									</tr>
								</table>
								</ul>';
							}
						echo '</li>';
					}
					echo '</ul>';
				?>
				</div>				
					
			</div>
		</div>        
	</div>

<?include($site_path."include/vi_sub.php");?>
		




	<?if($_site_info['b_consult']=="1"){?>
	<div class="wrap_pcsd2">
	<div class="wrap_pcsd3">
	<?include($site_path."include/consult.php");?>
	<?}else{?>
	<div class="wrap_pcsd4">
	<div class="wrap_pcsd5">	
	<?}?>



	<div class="con">
		<?if($bodyClass=="Sub"){?>
		<div class="sub_menu">
			<ul class="sub_menu_title">
				<li>
				<?$cur_menu2 = explode("/",$cur_menu);?>

				<span class="left_menu_font_sty1"><?=$cur_menu2[0]?></span>
				<span class="left_menu_font_sty2"><?=$cur_menu2[1]?></span>
				</li>
			</ul>
			<ul class="sub_menu2">

			<?if($menu_num&&!$is_member){?>

			<?
			$sub=$menu_info[$menu_num-1];
			for($i=0; $i<count($sub);$i++){
				if($sub_num==($i+1)) $selected="class='selected'"; else $selected="";
				echo "<li><a href='javascript:menu".$menu_num."sub".($i+1)."()' ".$selected.">".$sub[$i]."</a></li>";
			}
			?>

			<?}else if($is_member){?>


			<?
			if($menu_num=="log") $sub=$member_log; else $sub=$member_mem;
			for($i=0; $i<count($sub);$i++){
				if($sub_num==$i) $selected="class='selected'"; else $selected="";
				$i_sub=explode(":",$sub[$i]);
				echo "<li ".$selected."><a href='javascript:".$menu_num."_".$i_sub[1]."()' ".$selected.">".$i_sub[0]."</a></li>";
			}
			?>



			<?}?>

			</ul>

			<ul class="sub_menu3">
				<li><img src="<?=$site_path?>images/call_bansd4.png"></li>
			</ul>


			<ul class="sub_menu3" style="margin-top:20px;">
				<li>
					<span style="width:233px; height:auto; padding:7px 0 7px 0; float:left; background-color:#f44336; text-align:center; font-size:14px; color:#fff;">화장품도 이젠 맞춤형 시대!</span>


					<span style="width:217px; height:auto; padding:7px; float:left; border-left:1px solid #c6c3c3; border-right:1px solid #c6c3c3; border-bottom:1px solid #c6c3c3; font-size:14px; color:#000; line-height:20px;">
					세계최고의 과학자들이 100,000여 시간을 들여 완성한 오직 당신 만을 위해 탄생한 맞춤형 SkinCare! 2000여 가지의 성분 중 당신의 피부에 꼭 맞는 성분만을 선별해 주는 인공지능에 의해 당신의 피부에 최적화된 스킨케어 제품을 만날 수 있습니다.! 지금 만나 보세요!
					
					</span>
				</li>
			</ul>
		</div>

		<div class="con2">
			<div class="con2_title">
				<ul>
					<li class="con2_title_2"><?=$cur_sub;?></li>
					<li class="con2_nav">HOME > <a href="javascript:menu<?=$menu_num;?>();"><?=$cur_menu2[0]?></a> > <span class="con2_nav_color"><a href="javascript:menu<?=$menu_num;?>sub<?=$sub_num;?>();"><?=$cur_sub?></a></span></li>
				</ul>
			</div>
		<?}?>