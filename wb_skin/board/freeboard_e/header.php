<?
//로그인 후 이동될 페이지
$ret_url_login = "../wb_board/list.php?bbs_code=".$bbs_code ;

//로그아웃 후 이동될 페이지
$ret_url_logout = "../wb_board/list.php?bbs_code=".$bbs_code ;

if($_SESSION['ss_login_ok']!="") {
?>
  <div align="right"><A HREF="../wb_member/login.php?logout&ret_url=<?=$ret_url_logout?>">logout</A></div>
<?} else {?>
  <div align="right"><A HREF="../wb_member/login.php?ret_url=<?=$ret_url_login?>"><FONT COLOR="#FFFFFF">admin</FONT></A></div>
<?}?>
