<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	include_once("../wb_include/lib.php");
	$is_use=false;
	
	$form_info=rg_html_entity($form_info);
	$dong=rg_html_entity($dong);
	
	if($stype=='') $stype='load';
	$c_stype[$stype]='checked';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>우편번호검색</title>
<style>
body, table, tr, td, form {
	margin:0 0 0 0;
	font-size: 12px;
	color: #3D3D3D;
}

.input,select {
	border: #94BACC 1px solid;
	FONT-SIZE: 9pt;
}

.button {
	background-color:#CDDEE7;
	border:1px #999999 solid;
}
</style>
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">

<link href="<?=$_url['css']?>rg4.css" rel="stylesheet" type="text/css">
<script src="http://post.rgboard.com/api/sido.php"></script>
<script>
function form_chk() {
	if(document.getElementById('sido').selectedIndex==0) {
		alert('시도를 선택해주세요.');
		return false;
	}
	if(document.getElementById('gungu').selectedIndex==0) {
		alert('시군구를 선택해주세요.');
		return false;
	}
	document.getElementById('kw').value = document.getElementById('kw').value.trim().replace(/  /gi, ' ').replace(/  /gi, ' ').replace(/  /gi, ' ');
	if(document.getElementById('kw').value.length==0) {
		alert('검색어를 입력해주세요.');
		return false;
	}
	
	var stype_form=document.getElementsByName('stype');
	var stype='';
	for(var i=0;i<stype_form.length;i++) {
		if(stype_form[i].checked) stype = stype_form[i].value;
	}
	if(stype!='building') {
		var kw=document.getElementById('kw').value.split(' ');
		if(kw.length!=2) {
			if(stype=='load') {
				alert('\'도로명+건물번호\'로 검색시 검색어는\n\n"도로명 건물번호"(Ex 테헤란로 152)로 입력해주셔야 합니다.');
			}
			if(stype=='dong') {
				alert('\'동(읍/면/리)+지번\'로 검색시 검색어는\n\n"동(읍/면/리)명 지번"(Ex 잠실동 27)로 입력해주셔야 합니다.');
			}
			return false
		}
	}
	
}

function init() {
	chang_stype('<?=$stype?>');
	init_sido('<?=$sido?>');
	sido_chang('<?=$gungu?>');
}
</script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" onLoad="init()">
<div style="text-align:center;margin:10px 0 10px;">
		<a href="search_post.php?form_info=<?=$form_info?>" style="font-weight:bold; color:blue; font-size:14px;">지번주소로 찾기(기존방식)</a> / <a href="search_post_road.php?form_info=<?=$form_info?>" style="font-weight:bold; color:blue; font-size:14px;">도로명주소로 찾기</a>
</div>
		<form name="post_form" method="get" action="<?=$_SERVER['PHP_SELF']?>" onSubmit="return form_chk()" enctype='multipart/form-data'>
		<input type="hidden" name="form_info" value="<?=$form_info?>">
<div class="title">우편번호찾기(도로명주소로 찾기)</div>

		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6" style="border-bottom:#54A8BA 1px solid;">
			<tr>
				<td align="center" style="border-bottom:#ECECEC 1px solid;padding-bottom:6px">
					<input type="radio" name="stype" value="load" onclick="chang_stype(this.value)" <?=$c_stype['load']?>>도로명+건물번호
					<input type="radio" name="stype" value="dong" onclick="chang_stype(this.value)" <?=$c_stype['dong']?>>동(읍/면/리)+지번
					<input type="radio" name="stype" value="building" onclick="chang_stype(this.value)" <?=$c_stype['building']?>>건물명(아파트명)
				</td>
			</tr>
				<tr>
					<td align="center" bgcolor="#EEEEEE" style="padding-top:6px;">
					시도 :
					<select name="sido" id="sido"  hname="시도" onChange="sido_chang()" style="width:120px">
						<option value="">선택</option>
					</select>
					시군구 :
					<select name="gungu" id="gungu"  hname="시군구" style="width:120px">
					<option value="">선택</option>
					</select>
					<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
						<tr>
							<td width="90" align="right"><strong>검색어&nbsp;:</strong></td>
							<td align="center"><input type="text" class="input" name="kw" id="kw" style="width:100%"  value="<?=$kw?>"></td>
							<td width="90">
								<input type="submit" class="button" value=" 검색 "></td>
						</tr>
					</table>
					</td>
				</tr>
			<tr>
			  <td align="center">
<div id='stype_ex_load' style="display:">
				 예 : 테헤란로 152 →  ‘서울시’‘강남구’ 선택 후 "테헤란로 152"
</div>
<div id='stype_ex_dong' style="display:none">
				  예 : 잠실동 27 → ‘서울시’’송파구’ 선택 후 "잠실동 27"
</div>
<div id='stype_ex_building' style="display:none">
				 예 :  ‘서울시’ ’강남구’ 선택 후 "강남파이낸스센터" (건물명)
</div>
				 </td>
			  </tr>
		</table>
<?
if($kw!='' && $sido!='') {
	list($form_name,$post1,$post2,$addr1,$addr2)=explode('|',$form_info);
?>
<script>
function submit_post(post,addr1,addr2) {
post=post.split('-');
//addr1 = addr1.trim().replace(/  /gi, ' ').replace(/  /gi, ' ');
//addr2 = addr2.trim().replace(/  /gi, ' ').replace(/  /gi, ' ');
<? if($form_name!='') { ?>
		window.opener.document.<?=$form_name?>.<?=$post1?>.value = post[0];
		window.opener.document.<?=$form_name?>.<?=$post2?>.value = post[1];
		window.opener.document.<?=$form_name?>.<?=$addr1?>.value = addr1;
	<? if($addr2!='') { ?>
		window.opener.document.<?=$form_name?>.<?=$addr2?>.value = addr2;
		window.opener.document.<?=$form_name?>.<?=$addr2?>.focus();
	<? } ?>   
<? } else { ?>
		window.opener.document.getElementById('<?=$post1?>').value = post[0];
		window.opener.document.getElementById('<?=$post2?>').value = post[1];
		window.opener.document.getElementById('<?=$addr1?>').value = addr1;
	<? if($addr2!='') { ?>
		window.opener.document.getElementById('<?=$addr2?>').value = addr2;
		window.opener.document.getElementById('<?=$addr2?>').focus();
	<? } ?>    			    
<? } ?>
self.close()
}
</script>
		<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
<?
	$url="http://post.rgboard.com/api/post.php?";
	foreach($_REQUEST as $k => $v) {
		$url.="&".urlencode($k)."=".urlencode($v);
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	$content = curl_exec($ch);
	curl_close($ch);

	$data=json_decode($content);
	
	if($data->cnt < 1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	} else {
		foreach($data->list as $R) {
?>
			<tr onClick="submit_post('<?=$R->post?>','<?=$R->sido?> <?=$R->gungu?> <?=$R->myeon?> <?=$R->road?> <?=$R->road_no?>','<?=$R->building?>(<?=$R->dong?> <?=$R->dong_no?>)');" style="cursor:pointer">
				<td width="50" height="24" style="padding-left:5px;border-bottom:#ECECEC 1px solid;"><?=$R->post?></td>
				<td height="24" style="padding:4px 1px 1px 0px;border-bottom:#ECECEC 1px solid;"><?=$R->sido?> <?=$R->gungu?> <?=$R->myeon?> <?=$R->road?> <?=$R->road_no?> <?=$R->building?><br>
				<font color="#999999"><?=$R->sido?> <?=$R->gungu?> <?=$R->myeon?> <?=$R->dong?> <?=$R->dong_no?></font>
				</a></td>
			</tr>
<?
		}
?>
		</table>	
<?
	} 
}
?>		
<br>
<?php /*?>		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
				<input type="button" class="button" value="  닫  기  " onClick="self.close()">
					</td>
			</tr>
		</table><?php */?>
		</form>
		</td>
	</tr>
</table>
</body>
</html>