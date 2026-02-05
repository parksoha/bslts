<script>
function openLayer(IdName, tpos, lpos){
	var pop = document.getElementById(IdName);
	//alert(pop.style.display)
	pop.style.display = "block";
	pop.style.top = tpos + "px";
	pop.style.left = lpos + "px";
}

function closeLayer(IdName){
	var expire = new Date();
	var cDay =1;
	var cName =IdName;
	var cValue =IdName;
	expire.setDate(expire.getDate() + cDay);
	cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
	if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
	document.cookie = cookies;

	var pop = document.getElementById(IdName);
	pop.style.display = "none";
}


function closeLayers(IdName){

	var pop = document.getElementById(IdName);
	pop.style.display = "none";
}

function getCookie(cName) {
	//alert(cName)
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
	start += cName.length;
	var end = cookieData.indexOf(';', start);
	if(end == -1)end = cookieData.length;
		cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

</script>

<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 
		$rs_list = new recordset($dbcon);
		$rs_list->clear();
		$rs_list->set_table($_table['new_win']);
		//$rs_list->add_where("'$wb[time_ymdhis]' between nw_begin_time and nw_end_time");
		$rs_list->add_where("nw_begin_time<= '".date("Y-m-d")."'");
		$rs_list->add_where("nw_end_time >= '".date("Y-m-d")."'");
		$rs_list->add_order("nw_id asc");
		$rs_list->select();

	$idx = 1;
while($row_nw=$rs_list->fetch()) {
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["ck_notice_{$row_nw[nw_id]}"]) 
        continue;

	$nw_width = $row_nw[nw_width] + 40;
	$nw_height = $row_nw[nw_height] + 85;

	$nw_width2 = $row_nw[nw_width] - 6;
	$nw_height2 = $row_nw[nw_height] - 6;
?>
    <!-- script language="JavaScript">
    var opt = "scrollbars=no, marginwidth=0, marginheight=0, resizable=0, width=<?=$row_nw[nw_width]+20?>,height=<?=($row_nw[nw_height]+20)?>,top=<?=$row_nw[nw_top]?>,left=<?=$row_nw[nw_left]?>";
    popup_window("<?=$_path[new_win]?>newwinpop.php?nw_id=<?=$row_nw[nw_id]?>", "WINDOW_<?=$row_nw[nw_id]?>", opt);
    </script -->

<style>
#layerPop<?=$idx?>{position:absolute;display:none; z-index:1000000000; width:<?=$nw_width?>px; height:<?=$nw_height?>px; background-color:#fff; border:1px solid #3fa5f5; float:left;}


</style>

<script>$(function(){ if(getCookie("layerPop<?=$idx?>") ==""){$('#poppop_<?=$idx?>').trigger('click');} })</script>
<a href="#" onclick="openLayer('layerPop<?=$idx?>',<?=$row_nw[nw_top]?>,<?=$row_nw[nw_left]?>)" id="poppop_<?=$idx?>" style="display:none;">Open</a>
<div id="layerPop<?=$idx?>" name="layerPop<?=$idx?>">
	<div style="width:100%; float:left; position:relative;">
		<img src="../images/popup/poptopd1.jpg" style="float:left;">
		<img src="../images/popup/poptopd2.jpg" style="float:right;">
		<div style="width:100%; text-align:center; float:left; position:absolute; padding-top:20px;">
			<img src="../images/popup/poptopd3.jpg">		
		</div>
	</div>

	<div style="width:<?=$row_nw[nw_width]?>px; height:<?=$row_nw[nw_height]?>px; float:left; padding:20px 20px 20px 20px;"><?=$row_nw["nw_content"]?></div>

	<div style=" position:absolute; bottom:0; right:0; width:100%; float:left; height:20px; border-top:1px solid #3fa5f5;">
	<a href="javascript:closeLayers('layerPop<?=$idx?>');"  style="padding:0 10px 0 10px; float:right; color:#000; font-size:11px; line-height:20px;">닫기</a>
	<a href="#" onclick="closeLayer('layerPop<?=$idx?>')" class="close" style="float:right; color:#000; font-size:11px; line-height:20px;">X 오늘 다시 보지 않기</a>
	
	</div>
</div>

<?
	$idx++;
} 
?>

