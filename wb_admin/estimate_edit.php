<?

	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['estimate']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();
	}
	
	if($mode=='delete') {	// 삭제
		$rs->delete();
		rg_href("estimate_list.php?$_get_param[3]");
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $mode == "modify") {

		// 데이터베이스 입력
		$rs->clear();
		$rs->add_field("process","$process"); // 진행상황
		$rs->add_field("modify_date","$wb[time_ymdhis]"); // 수정날짜

		// 업데이트
		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		}

		$msgment .= "수정";
		rg_href("estimate_edit.php?$p_str&page=$page&mode=modify&num=$num", $msgment."이 완료됐습니다.","");
	}

	$MENU_L='m10';

include("_header.php");
include("admin.header.php"); 
?>

<TABLE border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<TR>
		<TD bgcolor="#F7F7F7"><B>[<?=$data['name']?>]</B>님 신청내용</TD>
	</TR>
</TABLE><BR>


<TABLE width="750" cellspacing="0" cellpadding="0" border="0">
<FORM name="estimate_modify" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data" onSubmit="formCheck(); return false">
<INPUT TYPE="hidden" name="mode" value="<?=$mode?>">
<INPUT TYPE="hidden" name="num" value="<?=$num?>">
	<TR>
		<TD align="center" valign="top">
			<TABLE width="750" cellspacing="0" cellpadding="2" bordercolordark="white" bordercolorlight="#E1E1E1" border="1">
				<TR>
					<TD>
						<TABLE width="750" border="1" cellspacing="0" cellpadding="0" bordercolordark="white" bordercolorlight="#E1E1E1">
							<col width="90" style="padding-left:5;" />
							<col width="270" style="padding-left:5;" />
							<col width="90" style="padding-left:5;" />
							<col style="padding-left:5;" />
							<TR>
								<TD height="30"><B>이름</B></TD>
								<TD>&nbsp;<?=$data['name']?></TD>
								<TD><B>아이디</B></TD>
								<TD>&nbsp;<?=$data['mbid']?></TD>
							</TR>
							<TR>
								<TD height="30"><B>자택전화번호</B></TD>
								<TD>&nbsp;<?=$data['tel']?></TD>
								<TD><B>휴대전화번호</B></TD>
								<TD>&nbsp;<?=$data['hand']?></TD>
							</TR>
							<TR>
								<TD height="30"><B>이메일</B></TD>
								<TD>&nbsp;<?=$data['email']?></TD>
								<TD><B>건축물종류</B></TD>
								<TD>&nbsp;<?=$data['kind']?></TD>
							</TR>
							<TR>
								<TD height="30"><B>상담형태</B></TD>
								<TD>&nbsp;<?=$data['consult']?></TD>
								<TD><B>예상금액</B></TD>
								<TD>&nbsp;<?=$data['amount']?></TD>
							</TR>
							<TR>
								<TD height="30"><B>넓이</B></TD>
								<TD>&nbsp;<?=$data['area']?></TD>
								<TD><B>도배공사</B></TD>
								<TD>&nbsp;<?=$data['papering']?></TD>
							</TR>
							<? if($data['etc']) { ?>
							<TR>
								<TD><B>기타 추가사항</B></TD>
								<TD colspan="3" style="padding-top:5;padding-bottom:5;padding-left:10;"><?=rg_get_text($data['etc'], 1)?></TD>
							</TR>
							<? } ?>
							<TR>
								<TD height="30"><B>신청일시</B></TD>
								<TD>&nbsp;<?=$data['write_date']?></TD>
								<TD><B>처리상황</B></TD>
								<TD>&nbsp;<select name='process' style="width:80;" onChange="javascript: formCheck();">
								<option value='접수' <?if($data['process']=="접수"):?> selected <?endif?> style="background-color:#CCE4FC;">접수
								<option value='완료' <?if($data['process']=="완료"):?> selected <?endif?> style="background-color:#F9DEDA;">완료
								</select></TD>
							</TR>
						</TABLE>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height="80" align="center" valign="middle"><input type="button" value="목록보기" onClick="location.href='estimate_list.php?<?=$_get_param[3]?>';" style="width:60px;height:21px;" class="button">&nbsp;&nbsp;&nbsp;
		<input type="button" value="삭제하기" onClick="confirm_del('estimate_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$data['num']?>')" style="width:60px;height:21px;" class="button"></TD>
	</TR>
	</FORM>
</TABLE>

<SCRIPT LANGUAGE="JavaScript">
<!--
function formCheck()
{
	var form=document.estimate_modify;

	if(confirm('처리상황을 수정 하시겠습니까?')){ 
		form.submit();
	}else{
		form.process.value = "<?=$data['process']?>";
		return false;
		}
}
//-->
</SCRIPT>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>