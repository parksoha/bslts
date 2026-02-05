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
	
	$rs_comment = new recordset($dbcon);
	$rs_comment->clear();
	$rs_comment->set_table($_table['bbs_comment']);
	$rs_comment->add_where("bd_num=$bd_num");
	$rs_comment->add_where("bc_depth < 1");
	$rs_comment->add_order("bc_num DESC");

?>