<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");

// 영문/한글 분리(두개의 값을 각각 저장)
$nw_ke_name = explode(":", $nw_ke_name);
$nw_open_menu = trim($nw_ke_name[0]);
$nw_open_name = trim($nw_ke_name[1]);

if(!$nw_open_menu) $nw_open_menu = "main";        // 기본실행위치
if(!$nw_open_name) $nw_open_name = "메인화면";  // 기본실행위치
if(!$nw_type) $nw_type = "window";                        // 기본형태

$rs->clear();
$rs->set_table($_table['new_win']);
$rs->add_field("nw_begin_time","$nw_begin_time");
$rs->add_field("nw_end_time","$nw_end_time");
$rs->add_field("nw_disable_hours","$nw_disable_hours");
$rs->add_field("nw_open_menu","$nw_open_menu");
$rs->add_field("nw_open_name","$nw_open_name");
$rs->add_field("nw_type","$nw_type");
$rs->add_field("nw_left","$nw_left");
$rs->add_field("nw_top","$nw_top");
$rs->add_field("nw_height","$nw_height");
$rs->add_field("nw_width","$nw_width");
$rs->add_field("nw_subject","$nw_subject");
$rs->add_field("nw_content","$nw_content");
$rs->add_field("nw_content_html","$nw_content_html");

if($w=='u') {
	
	$rs->add_where("nw_id=$nw_id");
	$rs->update();
	//rg_href("./newwinform.php?w=u&nw_id=$nw_id");
	rg_href("./newwinlist.php?$_get_param[3]");
}
if($w=='d') {
	$rs->add_where("nw_id=$nw_id");
	$rs->delete();
	rg_href("./newwinlist.php?$_get_param[3]");
}
if($w == "") {
	$rs->insert();
	$nw_id=$rs->get_insert_id();
	//rg_href("./newwinlist.php?w=u&nw_id=$nw_id");
	rg_href("./newwinlist.php?$_get_param[3]");
}
?>
