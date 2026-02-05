<?
include_once("../wb_include/lib.php");
include_once("../wb_include/func_comm.php");

$rs = new recordset($dbcon);
$rs->clear();
$rs->set_table($_table['new_win']);
$rs->add_where("nw_id = $nw_id");
$rs->select();
$nw=$rs->fetch();

$nw[nw_subject] = rg_get_text($nw[nw_subject]);
$nw[nw_content] = rg_conv_text($nw[nw_content], 1);

// 에디터 이용시 행간 <P></P> 변경
$nw[nw_content] = str_replace("/\n/","<br/>", (stripslashes($nw[nw_content]))); //글내용
$nw[nw_content] = str_replace("<P>","", $nw[nw_content]); //글내용
$nw[nw_content] = str_replace("</P>","<br>", $nw[nw_content]); //글내용
?>

<html>
<head>
<title><?=$_site_info['site_name']?>-<?=$nw[nw_subject]?></title>
</head>
<script type="text/javascript" src="../wb_js/common.js"></script>
<script language="JavaScript">
    function div_close_<? echo $nw[nw_id] ?>() 
    {
        if (check_notice_<? echo $nw[nw_id] ?>.checked == true) {
              set_cookie("ck_notice_<? echo $nw[nw_id] ?>", "1" , <? echo $nw[nw_disable_hours] ?>);
        }
        window.close();
    }
</script>
<body leftmargin="0" topmargin="0">
<div id="div_notice_<? echo $nw[nw_id] ?>">
<table width="<? echo $nw[nw_width] ?>" height="<? echo $nw[nw_height] ?>" cellpadding="0" cellspacing="0">
<tr>	
    <td valign=top ><?=$nw[nw_content]?></td>
</tr>
<tr>
    <td height=20 align=center style="font-size:11px; color:#333333;font-family:돋움;"><input type=checkbox id='check_notice_<?=$nw[nw_id]?>' name='check_notice_<?=$nw[nw_id]?>' value='1' onclick="div_close_<? echo $nw[nw_id] ?>();">&nbsp;<label for='check_notice_<?=$nw[nw_id]?>'><? echo $nw[nw_disable_hours] ?> 시간동안 이창을 다시 띄우지 않겠습니다.</label></td>
</tr>	
</table>
</div>
</body>
</html>