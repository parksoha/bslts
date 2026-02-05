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

	include("_header.php");
	if(file_exists($skin_path."msg.php")) include($skin_path."msg.php");
	include('_footer.php');
?>