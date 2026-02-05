<?


if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

$icode_id = $_site_info['sms_id'];
$icode_pw = $_site_info['sms_pass'];
$wb_server_time  = time();
$wb_time_ymd = date("Y-m-d", $wb_server_time);
$wb_time_his = date("H:i:s", $wb_server_time);
$wb_time_ymdhis = date("Y-m-d H:i:s", $wb_server_time);


function mw_sms_send($hps, $callback, $msg)
{
    global $_path, $icode_id, $icode_pw, $wb_server_time, $wb_time_ymdhis;
    include_once($_path['sms']."sms.log.php");
    $strDest = array();

    if (is_array($hps)) {
        for ($i=0; $i<count($hps); $i++) {
            $hp = mw_get_hp($hps[$i], 0);
            if (trim($hp)) {
                $strDest[] = $hp;
            }
        }
    } else
        $strDest[] = mw_get_hp($hps, 0);

    $strCallBack = $callback;
    $strData = $msg;

    $socket_host = "211.172.232.124";
    $port_setting = 1;

    // SMS 모듈 클래스 생성
    $SMS = new mwBasicSMS;
    $SMS->SMS_con($socket_host,$icode_id,$icode_pw,$port_setting);

    // 발송번호 목록을 가져옵니다.
    //$strDest = explode(";",$strTelList); // 발송번호 목록
    $nCount = count($strDest); // 발송번호 수

    // 예약설정을 합니다.
    if ($chkSendFlag) {
        $strDate = $R_YEAR.$R_MONTH.$R_DAY.$R_HOUR.$R_MIN;
    } else {
        $strDate = "";
    }

    // 발송하기위해 패킷을 정의합니다.
    $result = $SMS->Add($strDest, $strCallBack, $strCaller, $strURL, $strData, $strDate, $nCount);

    // 패킷 정의의 결과에 따라 발송여부를 결정합니다.
    if ($result) {
        $log = "-----------------------\n";
        $log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
        // 패킷이 정상적이라면 발송에 시도합니다.
        $result = $SMS->Send();
        if ($result) {
            $log .= "SMS 서버에 접속했습니다.\n";
            $success = $fail = 0;
            foreach($SMS->Result as $result) {
                list($phone,$code)=explode(":",$result);
                if (substr($code,0,5)=="Error") {
                    //$log .= "{$phone}로 발송하는데 에러가 발생했습니다.\n";
                    $log .= "전송 실패 ({$phone} 번호확인요망).\n";
                    switch (substr($code,6,2)) {
                        case '02':	 // "02:형식오류"
                            $log .= "형식이 잘못되어 전송이 실패하였습니다.\n";
							$msta2 = "형식이 잘못되어 전송이 실패하였습니다.";
                            break;
                        case '23':	 // "23:인증실패,데이터오류,전송날짜오류"
                            $log .= "데이터를 다시 확인해 주시기바랍니다.\n";
							$msta2 = "데이터를 다시 확인해 주시기바랍니다.";
                            break;
                        case '97':	 // "97:잔여코인부족"
                            $log .= "잔여코인이 부족합니다.\n";
							$msta2 = "잔여코인이 부족합니다.";
                            break;
                        case '98':	 // "98:사용기간만료"
                            $log .= "사용기간이 만료되었습니다.\n";
							$msta2 = "사용기간이 만료되었습니다.";
                            break;
                        case '99':	 // "99:인증실패"
                            $log .= "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.\n";
							$msta2 = "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.";
                            break;
                        default:	 // "미 확인 오류"
                            $log .= "알 수 없는 오류로 전송이 실패하었습니다.\n";
							$msta2 = "(정액제-계약확인)인증 받지 못하였습니다.";
                            break;
                    }
                    $fail++;
                } else {
                    //$log .= $phone."로 전송했습니다. (메시지번호:".$code.")\n";
                    $log .= $phone." 로 전송했습니다.\n";

					$msta2 = "전송성공";
                    $success++;
                }
            }
            //$log .= $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.\n";
            $log .= "전송 성공.\n";

			$sf_cnt2 = $success+$fail;


			if($sf_cnt2 > 1){
				$phone2 = $phone."외";
				$mbum = '1';
			}else{
				$phone2 = $phone;
				$mbum ='3';
			}

			$strData2=iconv("EUC-KR", "UTF-8", $strData);
			$rs = "insert into wb_tb_msg (m_bun,m_num,m_title,m_mark,m_mark2,m_mark3,m_state,m_date)values('".$mbum."','".$phone2."','".$strData2."','".$sf_cnt2."','".$success."','".$fail."','".$msta2."','".$wb_time_ymdhis."')";
			$result_insert = mysql_query($rs);





            $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
        }
        else $log .= "에러: SMS 서버와 통신이 불안정합니다.\n";
    }
	write_log2($_path['data']."log/sms.".date("ym", $wb_server_time), $log);
}

// 핸드폰번호 형식으로 return
function mw_get_hp($hp, $hyphen=1)
{
    if (!mw_is_hp($hp)) return '';

    if ($hyphen) $preg = "$1-$2-$3"; else $preg = "$1$2$3";

    $hp = str_replace('-', '', trim($hp));
    $hp = preg_replace("/^(01[016789])([0-9]{3,4})([0-9]{4})$/", $preg, $hp);

    return $hp;
}

// 핸드폰번호 여부
function mw_is_hp($hp)
{
    $hp = str_replace('-', '', trim($hp));
    if (preg_match("/^(01[016789])([0-9]{3,4})([0-9]{4})$/", $hp))
        return true;
    else
        return false;
}

/**
 * ICODEKOREA.COM 모듈
 *
 * SMS 발송을 관장하는 메인 클래스이다.
 *
 * 접속, 발송, URL발송, 결과등의 실질적으로 쓰이는 모든 부분이 포함되어 있다.
 */
class mwBasicSMS {
	var $icode_id;
	var $icode_pw;
	var $socket_host;
	var $socket_port;
	var $Data = array();
	var $Result = array();

	// 접속을 위해 사용하는 변수를 정리한다.
	function SMS_con($host,$id,$pw,$portcode) {
		if ($portcode == 1) {
			$port=(int)rand(7192,7195);
		} else {
			$port=(int)rand(7196,7199);
		}

		$this->socket_host	= $host;
		$this->socket_port	= $port;
		$this->icode_id		= mwBasicFillSpace($id, 10);
		$this->icode_pw		= mwBasicFillSpace($pw, 10);
	}

	function Init() {
		$this->Data		= "";	// 발송하기 위한 패킷내용이 배열로 들어간다.
		$this->Result	= "";	// 발송결과값이 배열로 들어간다.
	}

	function Add($strDest, $strCallBack, $strCaller, $strURL, $strData, $strDate="", $nCount) {
		$Error = mwBasicCheckCommonTypeDest($strDest, $nCount);
		$Error = mwBasicCheckCommonTypeCallBack($strCallBack);
		$Error = mwBasicCheckCommonTypeDate($strDate);

		$strCallBack	= mwBasicFillSpace($strCallBack,11);
		$strCaller		= mwBasicFillSpace($strCaller,10);
		$strDate		= mwBasicFillSpace($strDate,12);

		for ($i=0; $i<$nCount; $i++) {
			$strDest[$i]	= mwBasicFillSpace($strDest[$i],11);

			if (!$strURL) {
				$strData	= mwBasicFillSpace(mwBasicCutChar($strData,80),80);

				$this->Data[$i]	= '01144 '.$this->icode_id.$this->icode_pw.$strDest[$i].$strCallBack.$strCaller.$strDate.$strData;
			} else {
				$strURL		= mwBasicFillSpace($strURL,50);
				$strData	= mwBasicFillSpace(mwBasicCheckCallCenter($strURL, $strDest[$i], $strData),80);

				$this->Data[$i]	= '05173 '.$this->icode_id.$this->icode_pw.$strDest[$i].$strCallBack.$strURL.$strDate.$strData;
			}
		}
		return true; // 수정대기
	}

	function Send() {
		$fsocket=fsockopen($this->socket_host,$this->socket_port);
		if (!$fsocket) return false;
		set_time_limit(300);

		## php4.3.10일경우
        ## zend 최신버전으로 업해주세요..
        ## 또는 69번째 줄을 $this->Data as $tmp => $puts 로 변경해 주세요.

		foreach($this->Data as $puts) {
			$dest = substr($puts,26,11);
			fputs($fsocket, $puts);
			while(!$gets) {
				$gets = fgets($fsocket,30);
			}
			if (substr($gets,0,19) == "0223  00".$dest)
				$this->Result[] = $dest.":".substr($gets,19,10);
			else
				$this->Result[$dest] = $dest.":Error(".substr($gets,6,2).")";
			$gets = "";
		}
		fclose($fsocket);
		$this->Data = "";
		return true;
	}
}

/**
 * 원하는 문자열의 길이를 원하는 길이만큼 공백을 넣어 맞추도록 합니다.
 *
 * @param	text	원하는 문자열입니다.
 *			size	원하는 길이입니다.
 * @return			변경된 문자열을 넘깁니다.
 */
function mwBasicFillSpace($text,$size) {
	for ($i=0; $i<$size; $i++) $text.=" ";
	$text = substr($text,0,$size);
	return $text;
}


/**
 * 원하는 문자열을 원하는 길에 맞는지 확인해서 조정하는 기능을 합니다.
 *
 * @param	word	원하는 문자열입니다.
 *			cut		원하는 길이입니다.
 * @return			변경된 문자열입니다.
 */
function mwBasicCutChar($word, $cut) {
	$word=substr($word,0,$cut);						// 필요한 길이만큼 취함.
	for ($k=$cut-1; $k>1; $k--) {
		if (ord(substr($word,$k,1))<128) break;		// 한글값은 160 이상.
	}
	$word=substr($word,0,$cut-($cut-$k+1)%2);
	return $word;
}


/**
 * 발송번호의 값이 정확한 값인지 확인합니다.
 *
 * @param	strDest	발송번호 배열입니다.
 *			nCount	배열의 크기입니다.
 * @return			처리결과입니다.
 */
function mwBasicCheckCommonTypeDest($strDest, $nCount) {
	for ($i=0; $i<$nCount; $i++) {
		$strDest[$i]=eregi_replace("[^0-9]","",$strDest[$i]);
		if (strlen($strDest[$i])<10 || strlen($strDest[$i])>11) return "휴대폰 번호가 틀렸습니다";

		$CID=substr($strDest[$i],0,3);
		if ( eregi("[^0-9]",$CID) || ($CID!='010' && $CID!='011' && $CID!='016' && $CID!='017' && $CID!='018' && $CID!='019') ) return "휴대폰 앞자리 번호가 잘못되었습니다";
	}
}


/**
 * 회신번호의 값이 정확한 값인지 확인합니다.
 *
 * @param	strDest	회신번호입니다.
 * @return			처리결과입니다.
 */
function mwBasicCheckCommonTypeCallBack($strCallBack) {
	if (eregi("[^0-9]", $strCallBack)) return "회신 전화번호가 잘못되었습니다";
}


/**
 * 예약날짜의 값이 정확한 값인지 확인합니다.
 *
 * @param	text	원하는 문자열입니다.
 *			size	원하는 길이입니다.
 * @return			처리결과입니다.
 */
function mwBasicCheckCommonTypeDate($strDate) {
	$strDate=eregi_replace("[^0-9]","",$strDate);
	if ($strDate) {
		if (!checkdate(substr($strDate,4,2),substr($strDate,6,2),substr($rsvTime,0,4))) return "예약날짜가 잘못되었습니다";
		if (substr($strDate,8,2)>23 || substr($strDate,10,2)>59) return "예약시간이 잘못되었습니다";
	}
}


/**
 * URL콜백용으로 메세지 크기를 수정합니다.
 *
 * @param	url		URL 내용입니다.
 *			msg		결과메시지입니다.
 *			desk	문자내용입니다.
 */
function mwBasicCheckCallCenter($url, $dest, $data) {
	switch (substr($dest,0,3)) {
		case '010': //20바이트
			return mwBasicCutChar($data,20);
			break;
		case '011': //80바이트
			return mwBasicCutChar($data,80);
			break;
		case '016': // 80바이트
			return mwBasicCutChar($data,80);
			break;
		case '017': // URL 포함 80바이트
			return mwBasicCutChar($data,80 - strlen($url));
			break;
		case '018': // 20바이트
			return mwBasicCutChar($data,20);
			break;
		case '019': // 20바이트
			return mwBasicCutChar($data,20);
			break;
		default:
			return mwBasicCutChar($data,80);
			break;
	}
}

function get_sock($url)
{
    // host 와 uri 를 분리
    if (ereg("http://([a-zA-Z0-9_\-\.]+)([^<]*)", $url, $res)) 
    {
        $host = $res[1];
        $get  = $res[2];
    }

    // 80번 포트로 소캣접속 시도
    $fp = fsockopen ($host, 80, $errno, $errstr, 30);
    if (!$fp) 
    {
        die("$errstr ($errno)\n");
    }
    else
    {
        fputs($fp, "GET $get HTTP/1.0\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "\r\n");

        // header 와 content 를 분리한다.
        while (trim($buffer = fgets($fp,1024)) != "") 
        {
            $header .= $buffer;
        }
        while (!feof($fp))
        {
            $buffer .= fgets($fp,1024);
        }
    }
    fclose($fp);

    // content 만 return 한다.
    return $buffer;
}
?>