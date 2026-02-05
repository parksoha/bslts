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
	switch($mode) {
		case 'email' : 
			rg_href('mailto:'.base64_decode($data),'','close');
		break;
		case 'homepage' : 
			rg_href(base64_decode($data));
		break;
	}
?>