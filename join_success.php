<?
include("include/header.php");





$rs->clear();
$rs->set_table($_table['setup']);
$rs->add_field("ss_content");
$rs->add_where("ss_name='member_form'");
$rs->fetch('tmp');
$member_form = unserialize($tmp);




$sql_memr = "select * from ".$_table['member']." where mb_num='".$mbnum."'";
$result_memr = mysql_query($sql_memr);
$memr = mysql_fetch_array($result_memr);




?>




<div class="j_ses"> 
	<div class="j_ses2"> 
		<div class="j_ses3">
			<?if($member_form["email_cnfrm"] == "1"){?>
				<span style="width:100%; height:auto; float:left; font-size:16px; font-weight:bold; padding-bottom:20px;"><?=$memr[mb_name]?>님</span>
				<span style="width:100%; height:auto; float:left; line-height:20px; font-size:14px; padding-bottom:20px;"><?=$_site_info[company_name]?>에 회원가입을 축하드립니다.</br>
				<?=$memr[mb_email]?>로 인증메일을 발송하였습니다.</br>
				이메일 인증을 완료하셔야 최종 회원가입이 완료됩니다.
				</span>
				<span style="width:100%; height:auto; float:left; font-size:14px; padding-bottom:20px;">감사합니다.</span>

				<span style="width:100%; height:auto; float:left; text-align:center;"><input type="button" value="홈으로" onclick="location.href='/';" class="ses_home_go"></span>
			<?}else if($member_form["email_cnfrm"] == "2"){?>
				<span style="width:100%; height:auto; float:left; font-size:16px; font-weight:bold; padding-bottom:20px;">안녕하세요 <?=$memr[mb_name]?>님</span>
				<span style="width:100%; height:auto; float:left; line-height:20px; font-size:14px; padding-bottom:20px;"><?=$_site_info[company_name]?>에 회원가입을 축하드립니다.
				
				</span>
				<span style="width:100%; height:auto; float:left; font-size:14px; padding-bottom:20px;">감사합니다.</span>

				<span style="width:100%; height:auto; float:left; text-align:center;"><input type="button" value="홈으로" onclick="location.href='/';" class="ses_home_go"></span>

			<?}?>



		</div>
	</div>
</div>





<?
include($site_path."include/footer3.php");
?>
