<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

$MENU_L='m2';
include("_header.php");
include("admin.header.php");

// 현재 년월
if(!$sms_log_y) $sms_log_y = date('Y');
if(!$sms_log_m) $sms_log_m = date('m');
?>

<TABLE border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD bgcolor="#F7F7F7"><B><?=$sms_log_y?>년 <?=sprintf("%02d",$sms_log_m)?>월 SMS 로그</B></TD>
	</TR>
</TABLE>
<BR>

<TABLE>
	<FORM name="sms_log_view" METHOD=POST enctype="multipart/form-data">
	<TR>
		<TD>
			<select name="sms_log_y" onChange="sms_log_view.submit()">
			<? for ($i=date('Y'); $i<date('Y')+1; $i++) { ?>
			<option value="<?=$i?>" <? if($i == $sms_log_y) echo "selected"; ?>> <?=$i?> </option>
			<? } ?>
			</select> 년
			<select name="sms_log_m" onChange="sms_log_view.submit()">
			<? for ($i=1; $i<=12; $i++) { ?>
			<option value="<?=sprintf("%02d",$i)?>" <? if($i == $sms_log_m) echo "selected"; ?>> <?=sprintf("%02d",$i)?> </option>
			<? } ?>
			</select> 월
		</TD>
	</TR>
	</FORM>
</TABLE>
<BR>

<TABLE  border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
<col width='35' />
<col width='130' />
<col />
<col />
	<TR height="25" bgcolor="#F0F0F4">
		<TD align='center'>번호</TD>
		<TD align='center'>발송시간</TD>
		<TD align='center'>발송번호 / 건수</TD>
		<TD align='center'>발송상태</TD>
	</TR>
<?
// 기본값
$sms_log_ym = substr($sms_log_y, 2, 2).$sms_log_m;

$sms_log_file = $_path['data']."log/sms.".$sms_log_ym;
if(file_exists($sms_log_file)) {
	$fop = fopen($sms_log_file,"r");
	$frd = @fread($fop,filesize($sms_log_file));
	$sms_log_temp = explode("-----------------------", $frd);
	fclose($fop);

	for($i=1; $i <= count($sms_log_temp)-1;$i++) {
		list($sms_send_date, $sms_etc) = explode(" : ", $sms_log_temp[$i]);
		list($sms_etc1, $sms_etc2, $sms_etc3, $sms_etc4, $sms_etc5) = explode(".", $sms_etc);
		echo "<TR height='25'><TD align='center'>".$i."</TD><TD align='center'>".$sms_send_date."</TD><TD>&nbsp;&nbsp;".$sms_etc2.".</TD><TD>&nbsp;&nbsp;".$sms_etc3.".</TD></TR>";
	}
} else {
		echo $sms_log_select."<TR><TD colspan='4' height='300' align='center' valign='middle'><B>SMS 발송내역이 없습니다.</B></TD></TR>";
	}
?>
</TABLE>

<?
include("admin.footer.php");
include("_footer.php");
?>