<?
	//전체테이블 크기
	$bbs_width = '100%';

	// 섬네일 함수 
	include_once($skin_url.'lib_image_convert.php'); 
	
	$cols = 1;   // 한줄에 보여질 이미지 개수(리스트)

	// 페이지당 목록 개수를 보정한다. 
	if(($list_cfg[list_count] % $cols) > 0) {
		$list_cfg[list_count] += $cols - ($list_cfg[list_count] % $cols);
	}
	
	$colspan = $cols;


	// 글목록
	$_skin['i_reply']='<img src='.$skin_url.'images/re.gif>';// 응답글 아이콘
	$_skin['reply_depth']=8; // 응답글 깊이
	$_skin['i_comment_count']='<span class="comment_num" >$bd_comment_count</span>';// 코멘트수
	$_skin['i_new']='<img src='.$skin_url.'images/new.gif>'; // new 아이콘
	$_skin['i_secret']='<img src='.$skin_url.'images/secret.gif>'; // 비밀글 아이콘
	$_skin['i_delete1']='<font color=red>- 삭제된글입니다. -</font>'; // 삭제글
	$_skin['i_delete2']='<font color=red>[삭제]$bd_subject</font>'; // 삭제글(관리자)
	$_skin['i_notice']='<img src='.$skin_url.'images/noti.gif>'; // 공지사항
?>