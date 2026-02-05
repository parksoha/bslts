<?
include_once("../wb_include/lib.php");

// 전송결과 회신이 아닌경우 관리자 체크
if($data == "")
	require_once("admin_chk.php");

// 전송결과 회신 이전
if($index_code) {

	list($tit,$name,$chkE,$chkS, $page) =  explode("[GB]", $title); // 전송제목, 신청인, 이메일발송여부, SMS발송여부, 원글페이지번호
	$index_code = $index_code;  // 식별번호
	list($org_num,$ux_time) = explode("_", $index_code); // 원글번호, 유닉스시간(초)
	$faxdata = $faxdata;             // 팩스번호

	$rs->clear();
	$rs->set_table($_table['fax']);
	$rs->add_field("faxid","$index_code");                  // 식별번호
	$rs->add_field("name","$name");                          // 신청인
	$rs->add_field("fax","$faxdata");                          // FAX 발송번호
	$rs->add_field("tit","$tit");                                    // 제목
	$rs->add_field("result","전송 신청");                   // 전송결과
	$rs->add_field("write_date","$wb[time_ymdhis]");     // 신청 시간
	$rs->insert();
	$num=$rs->get_insert_id();
	
	if($chkE) $msgment = "이메일 발송, ";
	if($chkS) $msgment .= "SMS 발송, ";
	$msgment .= "FAX 발송, 수정";
	rg_href("estimate_edit08.php?page=$page&mode=modify&num=$org_num", $msgment."이 완료됐습니다.","");
}

// 전송결과 회신
if($data != "") {

	list($faxid,$result_code) = explode(",", $data);  // 식별번호, FAX 결과 코드
	list($org_num,$ux_time) = explode("_", $faxid); // 원글번호, 마이크로 타임
	$send_start = $send_start ;   // 전송시작시간
	$send_end = $send_end;      // 전송완료시간
	
	if($result_code == 1) $result = "전송 성공";
	if($result_code == 2) $result = "전송중 실패";
	if($result_code == 3) $result = "응답 없음";
	if($result_code == 4) $result = "통화중";
	if($result_code == 5) $result = "번호오류";
	if($result_code == 6) $result = "기타오류";
	if($result_code == 20) $result = "사용불가 아이디";
	if($result_code == 21) $result = "패스워드 오류";
	if($result_code == 22) $result = "존재하지 않는 아이디";

	// 신청인 정보 확인
	if($result_code == 1) {
		$rs->clear();
		$rs->set_table($_table['estimate']);
		$rs->add_where("num=$org_num");
		$rs->select();

		if($rs->num_rows()==1) {	

			$data=$rs->fetch();
			$cntF = $data['cntF'] + 1;  // FAX 발송회수
		
			// FAX 발송회수 업데이트
			$rs->clear();
			$rs->set_table($_table['estimate']);
			$rs->add_field("cntF","$cntF");
			$rs->add_field("modify_date","$wb[time_ymdhis]"); // 수정날짜
			$rs->add_where("num=$data[num]");
			$rs->update();
		}
	}

	// 팩스 정보 확인
	$rs->clear();
	$rs->set_table($_table['fax']);
	$rs->add_where("faxid='$faxid'");
	$rs->select();
		
	if($rs->num_rows()==1) {

		$data=$rs->fetch();

		// 팩스 발송 결과 업데이트
		$rs->clear();
		$rs->set_table($_table['fax']);
		$rs->add_field("result","$result");                        // 전송 결과
		$rs->add_field("result_code","$result_code");       // 결과 코드
		$rs->add_field("send_start","$send_start");          // 발송 시작 시간
		$rs->add_field("send_end","$send_end");            // 발송 완료 시간
		$rs->add_field("modify_date","$wb[time_ymdhis]"); // 수정날짜
		$rs->add_where("num=$data[num]");
		$rs->update();
	}

}
?>