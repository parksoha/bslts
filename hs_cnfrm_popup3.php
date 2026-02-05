<?php
	header('Content-Type: text/html; charset=utf-8');


	$site_path='./';
	$site_url='./';
	include_once($site_path."wb_include/lib.php");


	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);



	/**************************************************************************
		파일명 : hs_cnfrm_popup3.php
		
		본인확인서비스 결과 화면(return url)
	**************************************************************************/
	
	/* 공통 리턴 항목 */
	$rqstSiteNm				=	$_POST["rqst_site_nm"];			// 접속도메인	
	$hsCertRqstCausCd		=	$_POST["hs_cert_rqst_caus_cd"];	// 인증요청사유코드 2byte  (00:회원가입, 01:성인인증, 02:회원정보수정, 03:비밀번호찾기, 04:상품구매, 99:기타)

	/**************************************************************************
	 * 모듈 호출	; 본인확인서비스 결과 데이터를 복호화한다.
	 **************************************************************************/

	// 인증결과 암호화 데이터
	$encInfo = $_POST["encInfo"];
	//KCB서버 공개키
	$WEBPUBKEY = trim($_POST["WEBPUBKEY"]);
	//KCB서버 서명값
	$WEBSIGNATURE = trim($_POST["WEBSIGNATURE"]);

	/**************************************************************************
	 * 파라미터에 대한 유효성여부를 검증한다.
	 **************************************************************************/
	if(preg_match('~[^0-9a-zA-Z+/=]~', $encInfo, $match)) {echo "입력 값 확인이 필요합니다"; exit;}
	if(preg_match('~[^0-9a-zA-Z+/=]~', $WEBPUBKEY, $match)) {echo "입력 값 확인이 필요합니다"; exit;}
	if(preg_match('~[^0-9a-zA-Z+/=]~', $WEBSIGNATURE, $match)) {echo "입력 값 확인이 필요합니다"; exit;}

	// ########################################################################
	// # KCB로부터 부여받은 회원사코드 설정 (12자리)
	// ########################################################################
	$memId = $member_form['cnfrm2'];							// 회원사코드

	// ########################################################################
	// # 운영전환시 변경 필요
	// ########################################################################
	//$endPointUrl = "http://tsafe.ok-name.co.kr:29080/KcbWebService/OkNameService";//EndPointURL, 테스트 서버
	$endPointUrl = "http://safe.ok-name.co.kr/KcbWebService/OkNameService";// 운영 서버
		  
	//okname 실행 정보
	// ########################################################################
	// # 모듈 경로 지정 및 권한 부여 (hs_cnfrm_popup2.php에서 설정된 값과 동일하게 설정)
	// ########################################################################
	$exe = $DOCUMENT_ROOT."/okname";

	// ########################################################################
	// # 암호화키 파일 설정 (절대경로) - 파일은 주어진 파일명으로 자동 생성되며 생성되지 않으면 S211오류가 발생됨
	// # 파일은 매월초에 갱신되며 만일 파일이 갱신되지 않으면 복화화데이터가 깨지는 현상이 발생됨.
	// ########################################################################
	$keyPath = $DOCUMENT_ROOT."/okname.key";

	// ########################################################################
	// # 로그 경로 지정 및 권한 부여 (hs_cnfrm_popup2.asp에서 설정된 값과 동일하게 설정)
	// ########################################################################
	$logPath = $DOCUMENT_ROOT."/log";

	// ########################################################################
	// # 옵션값에 'L'을 추가하는 경우에만 로그(logPath변수에 설정된)가 생성됨.
	// # 시스템(환경변수 LANG설정)이 UTF-8인 경우 'U'옵션 추가 ex)$option='SLU'
	// ########################################################################
	$options = "SLU";	// S:인증결과복호화
		
	// 명령어
	$cmd = "$exe $keyPath $memId $endPointUrl $WEBPUBKEY $WEBSIGNATURE $encInfo $logPath $options";
//	echo "$cmd<br>";
	
	// 실행
	exec($cmd, $out, $ret);

    
	$retcode = "";

	if($ret == 0) {
		// 결과라인에서 값을 추출
		foreach($out as $a => $b) {
			if($a < 17) {
				$field[$a] = $b;
			}
		}
		$retcode = $field[0];




		if(strlen($field[12])==11){
			//3-4-4
			//mb_tel13
			$m_tel1 = substr($field[12],0,3);
			$m_tel2 = substr($field[12],3,4);
			$m_tel3 = substr($field[12],7,4);

			
		}else{
			//3-3-4
			$m_tel1 = substr($field[12],0,3);
			$m_tel2 = substr($field[12],3,3);
			$m_tel3 = substr($field[12],6,4);

		}
		
	}
	else {
		echo ("<script>self.close();</script>");
	}
    
//*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>KCB 본인확인서비스 샘플</title>
<script language="javascript" type="text/javascript" >
	function fncOpenerSubmit() {

		
		opener.member_form.mb_own.value="1";

		<?if($member_form[mb_name] == 2){?>
		opener.member_form.mb_name.value="<?=$field[7]?>";
		<?}?>
		<?if($member_form[mb_tel2] == 2){?>
		opener.member_form.mb_tel21.value="<?=$m_tel1?>";
		opener.member_form.mb_tel22.value="<?=$m_tel2?>";
		opener.member_form.mb_tel23.value="<?=$m_tel3?>";
		<?}?>



		
		self.close();
	}	



	function fncOpenerSubmit2() {


		opener.member_form.mb_own.value="";

		self.close();
	}	
</script>
</head>
<body>
	
</body>
<?php
	if($ret == 0) {
		//인증결과 복호화 성공
		// 인증결과를 확인하여 페이지분기등의 처리를 수행해야한다.
	 	if ($retcode == "B000") {
			echo ("<script>alert('본인인증성공'); fncOpenerSubmit();</script>");
		}
		else {
			echo ("<script>alert('본인인증실패'); fncOpenerSubmit2();</script>");
		}
	} else {
		//인증결과 복호화 실패
		echo ("<script>alert('인증결과복호화 실패'); fncOpenerSubmit2(); </script>");
	}
?>
</html>
