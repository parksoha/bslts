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
	include_once($_path['inc']."lib_bbs.php");
	
	$mode='list';
	
	if($_write_cfg['spam_chk'] >= $_gmb_info['gm_level']) { // 스팸체크코드발생
//		$spam_chk_code=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_code='12345';
		if($_SESSION["schk_".$spam_chk_code]=='')
			$_SESSION["schk_".$spam_chk_code]=substr(md5(uniqid(rand(), true)),-5);
	}

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	if(!$_bbs_auth['list']) {
		$_msg_type='list_no_auth';
		include("msg.php");
		exit;
	}	
	include('list_main_process.php');
?>
