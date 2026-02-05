<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	if($mode=="modify"){
		$query = mysql_query("select * from push_notice where idx=$idx");
		$data = mysql_fetch_assoc($query);
	}

	$MENU_L='m17';

?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table width="100%" border="1" cellpadding="6" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td bgcolor="#F7F7F7" style="padding-left:15;">
		<? if($data['num']) {
				echo "<B>[".$data['s_company']." : ".$data['s_code']."] 정보 수정<B>"; 
			} else {
				echo "<B>푸쉬 공지 등록<B>"; 
			}
		?>
		</td>
	</tr>
</table><br>

<table width="850" cellpadding="0" cellspacing="0" border="0">
<form name="shop" method="post" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
	<tr>
		<!-- 기본정보 -->
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><font color="#3300CC"><b>[기본정보]</b></font></td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolordark="white" bordercolorlight="#E1E1E1">
				<col width="125" style="padding-left:5px;" />
				<tr>
					<td height="30">- 공지제목 <font color="#FF0000">v</font></td>
					<td>
						<input type="text" name="p_subject" value="<?=$data[p_subject]?>" style="width:98%;height:18px;font-size:12px;" />
					</td>
				</tr>
				<tr>
					<td>- 발송상태 <font color="#FF0000">v</font></td>
					<td>
						<SELECT NAME="p_state">
							<OPTION VALUE="S" <?=$data[p_state]=="S" ? "selected" : ""; ?>>발송대기
							<OPTION VALUE="E" <?=$data[p_state]=="E" ? "selected" : ""; ?>>발송완료
						</SELECT>
					</td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolordark="white" bordercolorlight="#E1E1E1">
				<col width="125" style="padding-left:5px;" />
				<tr>
					<td>- 공지내용</td>
					<td colspan="3"><textarea name="p_contents" style="width:92%; height:100px;"><?=$data[p_contents]?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50" align="center" valign="middle">
		<input type="button" name="sub_btn" value="<? if($idx) { echo "수 정 하 기"; } else { echo "등 록 하 기"; } ?>" style="width:80px;height:18px;" class="button" onfocus=this.blur();>&nbsp;&nbsp;
		<input type="button" id="send_btn" value="푸쉬 발송" style="width:80px;height:18px;" class="button" onfocus=this.blur();>&nbsp;&nbsp;
		<input type="button" value="목 록 보 기" onClick="location.href='push_notice_list.php';" style="width:80px;height:18px;" class="button" onfocus=this.blur();>
		<? if($mode == "modify" && $data['idx']) { ?>
		&nbsp;&nbsp;<input type="button" value="삭 제 하 기" id="del_btn" style="width:80px;height:18px;" class="button" onfocus=this.blur();>
		<? } ?>
		</td>
	</tr>
</form>
</table>
<div style="wdith:100%;" id="ret_html"></div>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
<script>
	$(function(){
		$("input[name='sub_btn']").click(function(){
			var $mode = $("input[name='mode']").val();
			var $key = true;
			var $p_subject = $("input[name='p_subject']").val();
			var $p_state = $("input[name='p_state']").val();
			var $idx = $("input[name='idx']").val();
			var $p_contents = $("textarea[name='p_contents']").val();
			if($p_subject==""){
				alert("공지 제목을 입력하세요.");
				$key = false;
			}
			if($p_contents==""){
				alert("공지 내용을 입력하세요.");
				$key = false;
			}
			if($key){
				$.post(
					"push_notice_send.php",
					{mode:$mode,p_subject:$p_subject,p_contents:$p_contents,p_state:$p_state,idx:$idx},
				function(result){
					if(result=="1"){
						alert("수정 하였습니다.");
						location.reload();
					}else{
						alert("오류발생 다시 시도해주세요");
						location.reload();
					}
				});
			}
		});

		$("#del_btn").click(function(){
			var $idx = $("input[name='idx']").val();
			if(confirm("정말 삭제 하시겠습니까?")){
				$.post(
					"push_notice_send.php",
					{mode:"delete",idx:$idx},
				function(result){
					if(result=="1"){
						alert("정상적으로 삭제 하였습니다.");
						location.href="./push_notice_list.php";
					}else{
						alert("오류발생 다시 시도해주세요");
						location.reload();
					}
				});
			}
		});

		$("#send_btn").click(function(){
			var $idx = $("input[name='idx']").val();
			//location.href="./push_notice_send.php?mode=send_push_test&idx="+$idx+"";
			$.post("push_notice_send.php",{mode:"send_push_test",idx:$idx},function(result){
				//alert(result);
				//location.href="./push_notice_list.php";
				$("#ret_html").html(result);
			});
		});

	});
</script>
