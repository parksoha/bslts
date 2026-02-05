<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$_bbs_info['bbs_name']?> - [<?=$mail_from_name?>] 님의 글이 등록되었습니다.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<table border="1" cellpadding="3" cellspacing="0" width="600" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed;font-size:9pt;">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>제목</strong></td>
		<td><a href="<?=$mail_view_url?>" target="_rgboard"><?=$mail_subject?></a></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성자</strong></td>
		<td><?=$mail_from_name?></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>내용</strong></td>
		<td><?=$mail_content?></td>
	</tr>
</table>
</body>
</html>
