<div class="footer">
<style>
a:hover.limkk{color:#275baa; text-shadow: 1px 1px 1px #999;}
a.limkk {color:#000000; font-size:11px;}
</style>
    <ul>
    <li class="footer_logo"><img src="<?=$site_path?>wb_data/design/<?=$logo2[logo2]?>"></li>
    <li class="footer_add">
	상호 : <?=$_site_info[company_name]?> | 대표이사 : <?=$_site_info[admin_name]?> | 사업자등록번호 : <?=$_site_info[admin_corp]?> <br>
	본사 : <?=$_site_info['address']?> | 대표전화: <?=$_site_info['admin_tel']?> |
					팩스 : <?=$_site_info['admin_fax']?> </br>
	
<!--개인정보관리책임자: 윤종환  <?=$_site_info['admin_email']?>-->
<br>    Copyright  2017 <?=$_site_info[company_name]?>. All rights reserved. &nbsp;<i><a href="http://wbg.kr" target="_blank"  class="limkk">By webbridge</a></i></li>
    </ul>
    </div>
<?include($site_path.'wb_counter/rg_counter.php'); //통계관리?>

