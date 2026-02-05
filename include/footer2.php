<div class="footer2">
    <ul>
		<li class="footer_logo2"><img src="<?=$site_path?>wb_data/design/<?=$logo2[logo2]?>"></li>
		<li class="footer_add2">
		
		상호 : <?=$_site_info[company_name]?> | 대표이사 : <?=$_site_info[admin_name]?> | 사업자등록번호 : <?=$_site_info[admin_corp]?>  <br>
	본사 : <?=$_site_info['address']?> | 대표전화: <?=$_site_info['admin_tel']?> |
					팩스 : <?=$_site_info['admin_fax']?> </br>
	
<!--<?=$_site_info['admin_email']?>-->
<br>   ⓒ 2017 <?=$_site_info[company_name]?> reserved. &nbsp;<a href="http://wbg.kr" target="_blank"><i>By webbridge</i></a>
		
		</li>
    </ul>
</div>

<?include($site_path.'wb_counter/rg_counter.php'); //통계관리?>



