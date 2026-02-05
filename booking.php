<?
$site_path='./';
	$site_url='./';


include_once($site_path."wb_include/lib.php");



if($_SERVER['REQUEST_METHOD']=='POST' && $free_form_mode=='free_form_ok') {

	$datetime = time();
	$datetime = date("Y-m-d H:i:s", $datetime);


	$free_form_telno = $f_telno1."-".$f_telno2."-".$f_telno3;

	$rs->clear();
	$rs->set_table("wb_tb_free_form2");	
	//$rs->add_field("free_mb_id","$_SESSION[ss_mb_num]");
	$rs->add_field("free_select","$free_select");
	$rs->add_field("free_form_name","$free_form_name");
	
	$rs->add_field("free_form_telno","$free_form_telno");
	$rs->add_field("free_form_radio","$free_form_radio");	
	$rs->add_field("free_form_textarea1","$free_form_textarea1");
	$rs->add_field("b_str2","1");
	$rs->add_field("free_form_datetime2","$free_form_datetime2");
	$rs->add_field("free_form_datetime","$datetime");
	$rs->insert();
	$mb_num=$rs->get_insert_id();


	include("free_form_sms.php");

	echo "<script>alert('신청이 완료되었습니다.'); opener.parent.location.reload(); self.close(); </script>";

}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=yes"/>
<meta charset="utf-8">
<title>온라인예약</title>
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>

<style>

html { font-family:dotum;  font-size:12px; overflow-y: scroll; }
body { width:100%; margin:0 0 0 0; font-size:12px; font-family:nanum; }
img { border:none; margin:0; padding:0; vertical-align:top; }
input{ vertical-align:top; border:0; margin:0; padding:0;}
ul {margin:0; padding:0; list-style:none; }
li {margin:0; padding:0; list-style:none; vertical-align:top;}
table { list-style:none; text-align:left;}

div, ul, li{margin:0; padding:0; list-style:none;}


.wraps{width:100%; height:auto; float:left;}
.top_titles{width:100%; height:auto; float:left; background-color:#e30307; color:#fff; font-size:14px; font-weight:bold; padding:10px 0 10px 0;}


.onlin_s{width:94%; height:auto; float:left; padding-bottom:10px;  margin:0 3% 0 3%; font-size:14px; font-weight:bold; color:#000;}
.onlin_s2{width:94%; height:auto; float:left; padding-bottom:10px;  margin:10px 3% 0 3%; font-size:12px; font-weight:bold; color:#000;}
.onlin_s3{width:94%; height:auto; float:left; font-size:12px; margin:10px 3% 0 3%; color:#000;}

.onlinesd_fom_table{ border-top:1px solid #0099cc;}
.onlinesd_fom_table td{ border-bottom:1px solid #ccc;}
.onlinesd_fom_table td.onsc_font1{background-color:#f4f4f4; font-weight:bold; color:#000; font-size:12px;}
.onlinesd_fom_table td.onsc_font2{border-bottom:1px solid #ccc;}
.onlinesd_fom_table th{background-color:#f6f9ff; border-bottom:1px solid #ccc;}

.onsc_font3{ border:1px solid #ccc; height:23px; width:50%; float:left; margin-left:2%; text-align:center;}
.onsc_font4{ border:1px solid #ccc; height:23px; width:24%; float:left; text-align:center;}
.gmbs{float:left; padding:0 1% 0 1%; height:25px; line-height:25px;}

.onsc_font5{ border:1px solid #ccc; height:27px; width:50%; float:left; margin-left:2%;}

.onsc_font6{ border:1px solid #ccc; height:23px; width:70%; float:left; margin-left:2%; text-align:center;}
.onsc_font7{ border:1px solid #ccc; height:70px; width:90%; float:left; margin-left:2%;}


</style>


<script type="text/javascript">


function runSenditd()

{

	
	var formd=document.runFormd;
	if(formd.free_form_radio.value==""){
		alert("예약현황을 선택해 주십시오.");
		formd.free_form_radio.focus();
	}else if(formd.free_form_name.value==""){
		alert("이름을 입력해 주십시오.");
		formd.free_form_name.focus();
	}else if(formd.f_telno1.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		formd.f_telno1.focus();
	}else if(formd.f_telno2.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		formd.f_telno2.focus();
	}else if(formd.f_telno3.value==""){
		alert("핸드폰번호를 입력해 주십시오.");
		formd.f_telno3.focus();
	}else if(confirm('온라인예약 하시겠습니까?')){


		formd.submit();
		
		

	}

}

</script>



</head>

<body>


<div class="wraps">
	<div class="top_titles">&nbsp;&nbsp;&nbsp;온라인 예약 (<?=$year?>년 <?=$month?>월 <?=$day?>일)</div>
	
	<form method="post" name="runFormd" id="runFormd">
	<input type="hidden" name="free_form_mode" value="free_form_ok">
	<input type="hidden" name="free_form_datetime2" value="<?=$year.$month.$day?>">
	<table border="0" cellpadding="0" cellspacing="0" class="onlinesd_fom_table" width="100%">
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;종류</td>
			<td width="75%" class="onsc_font2">

			<select name="free_select" class="onsc_font5">
				<option value="1">피부체험</option>
				<option value="2">피부상담</option>
				<option value="3">비만상담</option>
				
			</select>

			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;예약현황</td>
			<td width="75%" class="onsc_font2">
				<?
				$coida = $year.$month.$day;

				$sql_freds = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='1'";
				$result_freds = mysql_query($sql_freds);
				$row_freds = mysql_num_rows($result_freds);

				$sql_freds2 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='2'";
				$result_freds2 = mysql_query($sql_freds2);
				$row_freds2 = mysql_num_rows($result_freds2);


				$sql_freds3 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='3'";
				$result_freds3 = mysql_query($sql_freds3);
				$row_freds3 = mysql_num_rows($result_freds3);

				$sql_freds4 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='4'";
				$result_freds4 = mysql_query($sql_freds4);
				$row_freds4 = mysql_num_rows($result_freds4);


				$sql_freds5 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='5'";
				$result_freds5 = mysql_query($sql_freds5);
				$row_freds5 = mysql_num_rows($result_freds5);


				$sql_freds6 = "select * from wb_tb_free_form2 where free_form_datetime2='$coida' and free_form_radio ='6'";
				$result_freds6 = mysql_query($sql_freds6);
				$row_freds6 = mysql_num_rows($result_freds6);
				
				
			
				?>			
				<?if($ss == '1'){?>
					<?if($row_freds == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="1">&nbsp;10:00 예약신청이 가능합니다.</label>
					<?}?>
					<?if($row_freds2 == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="2">&nbsp;11:00 예약신청이 가능합니다.</label>
					<?}?>
					<?if($row_freds6 == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="6">&nbsp;12:00 예약신청이 가능합니다.</label>
					<?}?>
					
				<?}else{?>
					<?if($row_freds == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="1">&nbsp;10:00 예약신청이 가능합니다.</label>
					<?}?>
					<?if($row_freds2 == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="2">&nbsp;11:00 예약신청이 가능합니다.</label>
					<?}?>
					<?if($row_freds3 == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="3">&nbsp;14:00 예약신청이 가능합니다.</label>
					<?}?>
					<?if($row_freds4 == '0'){?>
					<label style="float:left; margin-left:2%; padding-top:10px; cursor:pointer;"><input type="radio" name="free_form_radio" value="4">&nbsp;15:00 예약신청이 가능합니다.</label>	
					<?}?>
					<?if($row_freds5 == '0'){?>
					<label style="float:left; margin-left:2%; padding:10px 0 10px 0; cursor:pointer;"><input type="radio" name="free_form_radio" value="5">&nbsp;16:00 예약신청이 가능합니다.</label>
					<?}?>
				<?}?>
				
	


			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;이름</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;

			<input maxlength="20" name="free_form_name" class="onsc_font3">
			
						
			</td>
		</tr>
		
		<tr>
			<td width="25%" height="35" class="onsc_font1">&nbsp;&nbsp;핸드폰</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<input maxlength='3' name="f_telno1" class="onsc_font4" style="margin-left:2%;">
			<span class="gmbs">-</span>
			<input maxlength='4' name="f_telno2" class="onsc_font4">
			<span class="gmbs">-</span>
			<input maxlength='4' name="f_telno3" class="onsc_font4">
					
			</td>
		</tr>


		

		<tr>
			<td width="25%" height="80" class="onsc_font1">&nbsp;&nbsp;기타메모</td>
			<td width="75%" class="onsc_font2">&nbsp;&nbsp;
			<textarea name="free_form_textarea1"  class="onsc_font7" maxlength='100'></textarea>
			
			</td>
		</tr>

	</table>

	<div style="width:100%; height:auto; float:left; text-align:center; margin-top:15px;">
	<input type="button" value="확인" style="width:100px; height:30px; background-color:#e30307; color:#fff; border:0; cursor:pointer;" onclick="runSenditd();">
	<input type="button" value="취소" style="width:100px; height:30px; background-color:#b8b8b8; color:#fff; border:0; cursor:pointer;" onclick="self.close();">
	</div>

	</form>

</div>






</body>
</html>
