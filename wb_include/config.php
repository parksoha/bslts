<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['site_path'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	

	// 알지보드버전 2008-04-02 ver 4.1.0 (베타버전)
  define('RGBOARD_VERSION', '4.1.0');
  define('RG_DB_MYSQL', 'MYSQL');
  define('RG_DB_CUBRID', 'CUBRID');
  define('RG_DB_ORACLE', 'ORACLE');
	
	define('DB_LIKE', 1);
	
	$_table['prefix']				= 'wb_tb_';	// 테이블명 접두어
	$_table['member']			= $_table['prefix'].'member';	// 회원
	$_table['group']				= $_table['prefix'].'group';	//	그룹
	$_table['gmember']			= $_table['prefix'].'gmember';	//	그룹회원
	$_table['bbs_cfg']			= $_table['prefix'].'bbs_cfg';	//	게시판설정
	$_table['bbs_body']			= $_table['prefix'].'bbs_body';	//	게시판 본문
	$_table['bbs_comment']	= $_table['prefix'].'bbs_comment';	//	게시판 코멘트
	$_table['bbs_category']	= $_table['prefix'].'bbs_category';	//	게시판 카테고리
	$_table['setup']				= $_table['prefix'].'setup';	//	사이트설정
	$_table['point']				= $_table['prefix'].'point';	//	포인트내역
	$_table['note']				= $_table['prefix'].'note';	//	쪽지
	$_table['new_win']			= $_table['prefix'].'new_win';	//	팝업창내역
	$_table['form_set']			= $_table['prefix'].'form_set'; //	폼셋팅
	$_table['free_form']			= $_table['prefix'].'free_form';//	입력폼
	$_table['smart_form']		= $_table['prefix'].'smart_form'; //	폼셋팅
	$_table['zip']					= $_table['prefix'].'zip';	//	우편번호
	$_table['fax']					= $_table['prefix'].'fax';	//	팩스전송로그
	$_table['estimate']			= $_table['prefix'].'estimate';	//	견적의뢰
	$_table['card']					= $_table['prefix'].'card';	//	카드결제
	
	$_path['site']			= $site_path;	// 기본경로
	$_path['bbs']			= $_path['site'].'wb_board/';	// 게시판
	$_path['css']			= $_path['site'].'wb_css/';	// 스타일시트
	$_path['member']		= $_path['site'].'wb_member/';	// 회원
	$_path['js']			= $_path['site'].'wb_js/';	// 스크립트
	$_path['admin']		= $_path['site'].'wb_admin/';	// 관리자
	$_path['counter']		= $_path['site'].'wb_counter/';	// 카운터
	$_path['inc']			= $_path['site'].'wb_include/';	// 라이브러리등
	$_path['mail_form']	= $_path['site'].'wb_mail/';	// 이메일주소경로
	$_path['skin']			= $_path['site'].'wb_skin/';	// 스킨경로
	$_path['bbs_skin']	= $_path['skin'].'board/';	// 게시판 스킨
	$_path['login_skin']	= $_path['skin'].'login/';	// 로그인 스킨
	$_path['last_skin']	= $_path['skin'].'last/';	// 최근글 스킨
	$_path['page']		= $_path['site'].'main/';	// 웹페이지
	$_path['new_win']	= $_path['site'].'wb_new_win/';	// 팝업
	$_path['sms']			= $_path['site'].'wb_sms/';	// SMS
	$_path['calendar']	= $_path['site'].'calendar/';	// 달력

	$_path['data']				= $_path['site'].'wb_data/';	// 데이타파일
	$_path['member_data']	= $_path['data'].'member/';	// 회원 데이타파일
	$_path['bbs_data']		= $_path['data'].'board/';	// 게시판 첨부파일
	$_path['session']		= $_path['data'].'session/';	// 세션

	$_url['site']				= $site_url;	// 기본경로
	$_url['bbs']			= $_url['site'].'wb_board/';	// 게시판
	$_url['css']			= $_url['site'].'wb_css/';	// 스타일시트
	$_url['member']		= $_url['site'].'wb_member/';	// 회원
	$_url['js']				= $_url['site'].'wb_js/';	// 스크립트
	$_url['admin']			= $_url['site'].'wb_admin/';	// 관리자
	$_url['counter']		= $_url['site'].'wb_counter/';	// 카운터
	$_url['mail_form']	 	= $_url['site'].'wb_mail/';	// 이메일주소경로
	$_url['skin']			= $_url['site'].'wb_skin/';	// 스킨경로
	$_url['bbs_skin']		= $_url['skin'].'board/';	// 게시판 스킨
	$_url['login_skin']	= $_url['skin'].'login/';	// 로그인 스킨
	$_url['last_skin']		= $_url['skin'].'last/';	// 최근글 스킨
	$_url['mobile']		= $_url['site'].'m/';	// 모바일

	$_const['member_states']		= array(0=>'대기',1=>'승인',2=>'미승인',3=>'탈퇴'); // 회원상태
	$_const['group_states']		= array(0=>'대기',1=>'승인',2=>'미승인',3=>'폐쇄');	// 그룹상태
	$_const['group_level_type']	= array(0=>'회원레벨',1=>'그룹레벨');	// 그룹레벨 적용방식

	$_const['admin_level']			= 90;	// 최고 관리자 레벨
	$_const['group_admin_level']= 50;	// 그룹 관리자 레벨
	$_const['sex']							= array('M'=>'남자','F'=>'여자'); // 성별

	$_const['member_form_state'] = array(0=>'사용안함',1=>'선택',2=>'필수');
	$_const['member_forms'] = array(
		'mb_name' => '이름',
		'mb_nick' => '닉네임',
		'mb_email' => '이메일',
		
		'mb_tel1' => '전화번호',
		'mb_tel2' => '핸드폰번호',
		'mb_address' => '주소',
		'mb_signature' => '서명',
		'mb_introduce' => '자기소개',
		'photo1' => '사진',
		'icon1' => '회원아이콘'
	);
	
	// 사용디비
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	$_const['db_type']['CUBRID']	= array('code'=>'CUBRID','name'=>'Cubrid','hname'=>'큐브리드','default_port'=>'33000');
	$_const['db_type']['ORACLE']	= array('code'=>'ORACLE','name'=>'Oracle','hname'=>'오라클','default_port'=>'1521');

	// 포인트형태
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','shop'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'기타','1'=>'게시판','2'=>'쇼핑몰','10'=>'관리자');
	
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화

	if (function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Seoul");

	$wb['server_time']  = time();
	$wb['time_ymd']    = date("Y-m-d", $wb['server_time']);
	$wb['time_his']      = date("H:i:s", $wb['server_time']);
	$wb['time_ymdhis'] = date("Y-m-d H:i:s", $wb['server_time']);


$bank_code_ary = array(
	"04"=>"국민은행",
	"05"=>"외환은행",
	"11"=>"농협은행",
	"26"=>"신한은행",
	"20"=>"우리은행",
	"23"=>"제일은행",
	"04"=>"기업은행",
	"03"=>"우체국",
	"71"=>"시티은행",
	"27"=>"부산은행",
	"32"=>"전북은행",
	"37"=>"경남은행",
	"39"=>"대구은행",
	"31"=>"광주은행",
	"E0"=>"삼성증권",
	);

	?>