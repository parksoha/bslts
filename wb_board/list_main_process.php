<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	if(!defined('RGBOARD_VERSION')) exit;
	if(isset($_REQUEST['skin_path'])) exit;
	
	if($_bbs_auth['list']) {
		include('list_where.php');
		include('list_pre_process.php');
		if($mode==='list') include("_header.php");
		if(file_exists($skin_path."list.php")) include($skin_path."list.php");



		if($mode==='list') include('_footer.php');
	}
?>