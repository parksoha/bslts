<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 
		
		$rs_list = new recordset($dbcon);
		$rs_list->clear();
		$rs_list->set_table($_table['new_win']);
		$rs_list->add_where("'$wb[time_ymdhis]' between nw_begin_time and nw_end_time");
		$rs_list->add_order("nw_id asc");
		$rs_list->select();
while($row_nw=$rs_list->fetch()) {
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["ck_notice_{$row_nw[nw_id]}"]) 
        continue;

	$rs = new recordset($dbcon);
	$rs->clear();
	$rs->set_table($_table['new_win']);
	$rs->add_where("nw_id = $row_nw[nw_id]");
	$rs->select();
	$nw=$rs->fetch();

	$nw[nw_subject] = rg_get_text($nw[nw_subject]);
	$nw[nw_content] = rg_conv_text($nw[nw_content], 1);

	// 에디터 이용시 행간 <P></P> 변경
	$nw[nw_content] = str_replace("/\n/","<br/>", (stripslashes($nw[nw_content]))); //글내용
	$nw[nw_content] = str_replace("<P>","", $nw[nw_content]); //글내용
	$nw[nw_content] = str_replace("</P>","<br>", $nw[nw_content]); //글내용
?>
    <script type="text/javascript">
	function div_close_<? echo $row_nw[nw_id] ?>() 
    {
        if (check_notice_<? echo $row_nw[nw_id] ?>.checked == true) {
              set_cookie("ck_notice_<? echo $nw[nw_id] ?>", "1" , <? echo $nw[nw_disable_hours] ?>);
        }
		MainPopclose();
    }
	function MainPopclose(){
		$('.MainPopUp').hide();
	}
    </script>
	<div class="MainPopUp" >
		<a href="javascript:MainPopclose();" class="close_btn">닫기</a>
		<div id="div_notice_<? echo $nw[nw_id] ?>">
		<?=$nw[nw_content]?>
		</div>
		<label for='check_notice_<?=$nw[nw_id]?>'><input type=checkbox id='check_notice_<?=$nw[nw_id]?>' name='check_notice_<?=$nw[nw_id]?>' value='1' onclick="div_close_<? echo $nw[nw_id] ?>();">&nbsp;<? echo $nw[nw_disable_hours] ?> 시간동안 이창을 다시 띄우지 않겠습니다.</label>
	</div>
	<style type="text/css">
		body{position:relative;}
		div.MainPopUp{position:absolute; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.7);}
		div.MainPopUp a.close_btn{position:absolute; right:0; top:0; display:block; width:30px; height:30px; background:#000 url('<?=$_path[new_win]?>ico_close.png') center center no-repeat; border-radius:5px; margin:2px; text-indent:-1000px; overflow:hidden; }
		div.MainPopUp>div{text-align:center; clear:both; background:#fff; margin-bottom:5px; padding:10px;}
		div.MainPopUp>div p{padding:0.3em 10px; }
		div.MainPopUp img{max-width:100%;}
		div.MainPopUp label{display:block; margin:0 2px; padding:0.4em 10px; border-radius:5px; background:#f4f4f4; color:#666; font-size:1em;}
		div.MainPopUp input[type=checkbox]{-webkit-appearance:none; appearance:none; -o-appearance:none; -moz-appearance:none; border-radius:4px; width:20px; height:20px; vertical-align:middle; background:#fff; border:1px solid #ccc; margin:-0.2em 2px; float:left; }
		div.MainPopUp input[type=checkbox]:checked{background:#fff url('<?=$_path[new_win]?>checkbox.png') center center no-repeat; background-size:15px;}
	</style>
<?
	} ?>
