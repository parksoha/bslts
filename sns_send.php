<?


// 사이트 명, 글 제목
$sns_tit = $_site_info['site_name']." [".$bd_subject."]";
$sns_tit = rg_cut_string($sns_tit, 100);
$sns_tit_con = $sns_tit;

// 사이트 명
$sns_tit2 = $_site_info['site_name'];
$sns_tit2 = rg_cut_string($sns_tit2, 100);
$sns_tit_con2 = $sns_tit2;

// 글 제목
$sns_tit3 = $bd_subject;
$sns_tit3 = rg_cut_string($sns_tit3, 100);
$sns_tit_con3 = $sns_tit3;

// 트랙백 주소
$sns_url = "http://$_SERVER[HTTP_HOST]/sns_tb.php/$bbs_code/$bd_num";

// 트위터
$twitter_url= urlencode($sns_tit_con)."+++".urlencode($sns_url);

// 페이스북
$face_url= $sns_url;
$face_url = urlencode($sns_url);
$face_tit = urlencode($sns_tit_con3);

// 미투데이
$me2_url= $sns_url;
$me2_url = urlencode($me2_url);
$me2_tit = urlencode($sns_tit_con2);
$me2_url_text = $bd_subject;
$me2_url_text = str_replace("\"","˝","$me2_url_text"); // 사이트 명에 따옴표 들어 가면 출력 안되던 것 수정
$me2_url_text = $me2_url_text;
$me2_url_text = urlencode($me2_url_text);
$me2_tag = $bd_subject; // 태그 부분에 현재글 위치 표기
$me2_tag = $me2_tag;
$me2_tag = urlencode($me2_tag);

// 요즘
$yozm_url= $sns_url;
$yozm_url = urlencode($yozm_url);
$yozm_tit = urlencode($sns_tit_con);
?>
<TABLE width="100" border="0" cellpadding="0" cellspacing="0" align="center">
	<TR>
		<!-- <TD width="35" align="center"><a href="http://twitter.com/home/?status=<?=$twitter_url?>" target="_blank" onFocus='this.blur();'><img src="../images/twitter.gif" border="0" alt="트위터"></a></TD> -->
		<TD width="35" align="center"><a href="http://twitter.com/share?text=<?=$twitter_url?>" target="_blank" onFocus='this.blur();'><img src="../images/twitter.gif" border="0" alt="트위터"></a></TD>
		<TD width="35" align="left"><a href="http://www.facebook.com/sharer.php?u=<?=$face_url?>&t=<?=$face_tit?>" target="_blank" onFocus='this.blur();'><img src="../images/facebook.gif" border="0" alt="페이스북"></a></TD>
		<!--<TD width="35" align="center"><a href='http://me2day.net/posts/new?new_post[body]=<?=$me2_tit?>+++["<?=$me2_url_text?>":<?=$me2_url?>+]&new_post[tags]=<?=$me2_tag?>' target="_blank" onFocus='this.blur();'><img src="../images/m2day.gif" border="0" alt="미투데이"></a></TD>
		<TD width="35" align="center"><a href="http://yozm.daum.net/api/popup/prePost?sourceid=41&link=<?=$yozm_url?>&prefix=<?=$yozm_tit?>" target="_blank" onFocus='this.blur();'><img src="../images/yozm.gif" alt="다음요즘" border="0"></a></TD>
		<TD align="center"><a href="#" onclick="clipboard();alert('블로그에 글 작성시 붙여넣기(Ctrl + V) 하시면 됩니다')" onFocus='this.blur();'><img src="../images/blogscrap.gif" border="0" alt="스크랩"></a></TD>-->
	</TR>
</TABLE>

<!-- 클립보드 -->
<SCRIPT LANGUAGE="JavaScript">
<!--
function clipboard() {
	var txt=document.body.createTextRange();
	txt.moveToElementText(document.all.copyarea);
	txt.select();
	txt.execCommand("copy");
	document.selection.empty(); 
}
//-->
</SCRIPT>