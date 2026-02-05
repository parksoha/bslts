<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['smart_form']);
		$rs->add_where("smart_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 회원정보가 올바르지 않다면
			rg_href('','대출정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();

		// 고객이름
		$smart_name = $data['smart_name'];

		// 연락처
		list($data[hpno1],$data[hpno2],$data[hpno3])=explode('-',$data[smart_hpno]);
	}
	
	if($mode=='delete') {	// 삭제
		$rs->delete();
		rg_href("smart_form_list.php?$_get_param[3]");
	}
	
	// Update|Join
	if($_SERVER['REQUEST_METHOD']=='POST') {
		
		// 등록 시간 
		$datetime = time();
		$datetime = date("Y-m-d H:i:s", $datetime);
		if($mode == "join") $data[smart_datetime] = $datetime;
		
		// 연락처
		$smart_hpno = $smart_hpno1."-".$smart_hpno2."-".$smart_hpno3;

		// 처리상황
		if($mode == "join") $smart_process = "1";

		$rs->clear();
		$rs->set_table($_table['smart_form']);
		$rs->add_field("smart_name","$smart_name");
		$rs->add_field("smart_hpno","$smart_hpno");
		$rs->add_field("smart_process","$smart_process");
		$rs->add_field("smart_memo","$smart_memo");
		$rs->add_field("smart_1","$smart_1");
		$rs->add_field("smart_2","$smart_2");
		$rs->add_field("smart_3","$smart_3");
		$rs->add_field("smart_4","$smart_4");
		$rs->add_field("smart_datetime","$data[smart_datetime]");
		if($mode=='join') {
			$rs->insert();
			$num=$rs->get_insert_id();	
		}

		if($mode=='modify') {
			$rs->add_where("smart_num=$num");
			$rs->update();
		}


		rg_href("smart_form_list.php?$_get_param[3]");
	}

	$MENU_L='m10';
	

include("_header.php");
include("admin.header.php"); 
?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">상담정보 등록/수정</td>
  </tr>
</table>
<br>
<form name="smart_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<? if($mode == "join"){ ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>고객이름</strong></td>
		<td><input type=text name="smart_name" value='' size=14 maxlength=13 class=input18n_ph></td>
	</tr>	
	<? } else { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>고객이름</strong></td>
		<td> <?=$smart_name?></td>
	</tr>	
	<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>휴대전화</strong></td>
		<td><input type=text name=smart_hpno1 value='<?=$data['hpno1']?>' size=3 maxlength=3 class=input18n_ph>
			<input type=text name=smart_hpno2 value='<?=$data['hpno2']?>' size=3 maxlength=4 class=input18n_ph>
			<input type=text name=smart_hpno3 value='<?=$data['hpno3']?>' size=3 maxlength=4 class=input18n_ph>
		</td>
	</tr>
	<!-- 정보수정시에만 노출 -->
	<? if($mode == "modify"){ ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>등록시간</strong></td>
		<td> <?=$data['smart_datetime']?></td>
	</tr>	
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>처리결과</strong></td>
		<td> <select name='smart_process'>
				<option value='1' <?if($data['smart_process']=='1'):?> selected <?endif?>>접수
				<option value='2' <?if($data['smart_process']=='2'):?> selected <?endif?>>상담완료
				</select>
		</td>
	</tr>
	<? } ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>관리자 메모</strong></td>
		<td> <textarea cols="55" rows="3" name='smart_memo' class="textarea"><?=$data['smart_memo']?></textarea></td>
	</tr>
</table><BR>
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="등록/수정" class="button">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>