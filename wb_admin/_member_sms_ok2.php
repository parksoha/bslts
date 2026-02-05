<?
include_once("../wb_include/lib.php");
require_once("admin_chk.php");
include "new_sms.php";
include_once("../sms/sms.log.php");

$wb_server_time  = time();
$wb_time_ymd = date("Y-m-d", $wb_server_time);
$wb_time_his = date("H:i:s", $wb_server_time);
$wb_time_ymdhis = date("Y-m-d H:i:s", $wb_server_time);
$_path['sms'] = '../wb_data/';



$socket_host	= "211.172.232.124";
$port_setting	= 1;

$icode_id	= $_site_info[sms_id];
$icode_pw	= $_site_info[sms_pass];

// SMS 모듈 클래스 생성
$SMS = new SMS;
$SMS->SMS_con($socket_host,$icode_id,$icode_pw,$port_setting);

// 발송번호 목록을 가져옵니다.
$strTelList		= str_replace("-","",$_POST["strTelList"]);
$strCallBack	= str_replace("-","",$_POST["strCallBack"]);
$strCaller		= $_POST["strCaller"];
$strSubject		= iconv("UTF-8", "EUC-KR", $_POST["strSubject"]);
$strURL				= $_POST["strURL"];
$strData			= iconv("UTF-8", "EUC-KR", $_POST["strData"]);

$chkSendFlag	= $_POST["chkSendFlag"];
$R_YEAR				= $_POST["R_YEAR"];
$R_MONTH			= $_POST["R_MONTH"];
$R_DAY				= $_POST["R_DAY"];
$R_HOUR				= $_POST["R_HOUR"];
$R_MIN				= $_POST["R_MIN"];

$strDest	= explode("/",$strTelList);	// 발송번호 목록
$nCount		= count($strDest);		// 발송번호 수

// 예약설정을 합니다.
if ($chkSendFlag) {
	$strDate = $R_YEAR.$R_MONTH.$R_DAY.$R_HOUR.$R_MIN;
} else {
	$strDate = "";
}

// 발송하기위해 패킷을 정의합니다.
$result = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

// 패킷 정의의 결과에 따라 발송여부를 결정합니다.
if ($result) {
	

	// 패킷이 정상적이라면 발송에 시도합니다.
	$result = $SMS->Send();

	if ($result) {
		$log .= "-----------------------\n";
		$log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
		$log .= "SMS 서버에 접속했습니다.\n";
		//echo "서버에 접속했습니다.<br>";
		$success = $fail = 0;
		foreach($SMS->Result as $result) {
			list($phone,$code)=explode(":",$result);
			if (substr($code,0,5)=="Error") {

				$log .= $phone."로 발송하는데 에러가 발생했습니다.\n";

				//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
				switch (substr($code,6,2)) {
					case '02':	 // "02:형식오류"
						$log .= "형식이 잘못되어 전송이 실패하였습니다.\n";
						//echo "형식이 잘못되어 전송이 실패하였습니다.";
						break;
					case '23':	 // "23:인증실패,데이터오류,전송날짜오류,발신번호미등록"
						$log .= "데이터를 다시 확인해 주시기바랍니다.\n";
						//echo "데이터를 다시 확인해 주시기바랍니다.";
						break;
					case '97':	 // "97:잔여코인부족"
						$log .= "잔여코인이 부족합니다.\n";
						//echo "잔여코인이 부족합니다.";
						break;
					case '98':	 // "98:사용기간만료"
						$log .= "사용기간이 만료되었습니다.\n";
						//echo "사용기간이 만료되었습니다.";
						break;
					case '99':	 // "99:인증실패"
						$log .= "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.\n";
						//echo "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.";
						break;
					case '87':	 // "87:인증실패"
						$log .= "(정액제-계약확인)인증 받지 못하였습니다.\n";
						//echo "(정액제-계약확인)인증 받지 못하였습니다.";
						break;
					default:	 // "미 확인 오류"
						$log .= "알 수 없는 오류로 전송이 실패하었습니다.\n";
						//echo "알 수 없는 오류로 전송이 실패하었습니다.";
						break;
				}
				$fail++;
			} else {
				if($mode=='send'){
					$log .= $phone."로 전송했습니다.\n";
				}
				//echo $phone."로 전송했습니다. (msg seq : ".$code.")<br>";
				$success++;
			}
		}
		//echo $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";		
		
		$sf_cnt = $success-$fail;
		$sf_cnt = str_replace("-","",$sf_cnt);

		if($mode=='send'){
			$log .= "전송 성공";
		}else{
			$log .= "총".$success."건 전송 했으며, ".$fail."건 전송실패 하였습니다.\n";
			$log .= $sf_cnt."건 전송 성공";
		}
		
		


		write_log($_path['sms']."log/sms.".date("ym", $wb_server_time), $log);
		$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.

		echo "<script>alert('전송완료'); window.close();</script>";


	}
	else{ //echo "에러: SMS 서버와 통신이 불안정합니다.<br>";

		echo "<script>alert('에러: SMS 서버와 통신이 불안정합니다.'); window.close();</script>";
	}


	
}
?>
