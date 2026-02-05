<?

header("Content-Type: text/html; charset=UTF-8");

$site_path='./';
$site_url='./';
include_once($site_path."wb_include/lib.php");
include $site_path."KSPayWebHost.inc";




$sndOrdername = iconv("EUC-KR", "UTF-8", $sndOrdername);
$sndMobile = iconv("EUC-KR", "UTF-8", $sndMobile);
$sndEmail = iconv("EUC-KR", "UTF-8", $sndEmail);

	$rcid       = $_POST["reCommConId"];
	  $rctype     = $_POST["reCommType"];
	  $rhash      = $_POST["reHash"];

	$ipg = new KSPayWebHost($rcid, null);

	$authyn		= "";
	$trno		= "";
	$trddt		= "";
	$trdtm		= "";
	$amt		= "";
	$authno		= "";
	$msg1		= "";
	$msg2		= "";
	$ordno		= "";
	$isscd		= "";
	$aqucd		= "";
	$temp_v		= "";
	$result		= "";

	$resultcd =  "";
	$cbtrno = "";
	$c_date = "";


	//업체에서 추가하신 인자값을 받는 부분입니다
	$a =  $_POST["a"]; 
	$b =  $_POST["b"]; 
	$c =  $_POST["c"]; 
	$d =  $_POST["d"];


	if ($ipg->kspay_send_msg("1"))
	{
		$authyn	 = $ipg->kspay_get_value("authyn");
		$trno	 = $ipg->kspay_get_value("trno"  );
		$trddt	 = $ipg->kspay_get_value("trddt" );
		$trdtm	 = $ipg->kspay_get_value("trdtm" );
		$amt	 = $ipg->kspay_get_value("amt"   );
		$authno	 = $ipg->kspay_get_value("authno");
		$msg1	 = $ipg->kspay_get_value("msg1"  );
		$msg2	 = $ipg->kspay_get_value("msg2"  );
		$ordno	 = $ipg->kspay_get_value("ordno" );
		$isscd	 = $ipg->kspay_get_value("isscd" );
		$aqucd	 = $ipg->kspay_get_value("aqucd" );
		$temp_v	 = "";
		$result	 = $ipg->kspay_get_value("result");

		$cbtrno	 = $ipg->kspay_get_value("cbtrno");

		$c_date = mktime();

		if (!empty($msg1)) $msg1 = iconv("EUC-KR","UTF-8", $msg1);
		if (!empty($msg2)) $msg2 = iconv("EUC-KR","UTF-8", $msg2);
		

		if (!empty($authyn) && 1 == strlen($authyn))
		{
			if ($authyn == "O")
			{
				$resultcd = "0000";
				$res = mysql_query("insert into wb_tb_card set
				authyn='$authyn',
				resultcd='$resultcd',
				ordno='$ordno',
				amt='$amt',
				trno='$trno',
				trddt='$trddt',
				trdtm='$trdtm',
				authno='$authno',
				isscd='$isscd',
				aqucd='$aqucd',
				msg1='$msg1',
				msg2='$msg2',
				cbtrno='$cbtrno',
				result='$result',
				c_date='$c_date',
				sndOrdername='$sndOrdername',
				sndEmail='$sndEmail',
				sndMobile='$sndMobile'
				");


				// 주문코드
				$tradecode = $ordno;

				// 결제금액
				$pG_payM = $amt;

				// 결제방법
				if(substr($result, 0, 1) == "1" || substr($result, 0, 1) == "I") {
					$payMethod = "card";
				} elseif(substr($result, 0, 1) == "2") {
					$payMethod = "iche";
					$bankInfo = Find_Bank($authno);
				} elseif(substr($result, 0, 1) == "6") {
					$payMethod = "cyber";
					$bankInfo = Find_Bank($authno)." ".$isscd;
				} elseif(substr($result, 0, 1) == "M") {
					$payMethod = "hand";
					$bankInfo = Find_Bank($authno)." ".$isscd;
				}


				

				include("./card_sms.php");
				



				echo "<script>alert('결제를 성공 하셨습니다.');window.close();</script>";
				//OnlyMsgView('결제를 성공 하셨습니다.');
			} else {
				$resultcd = trim($authno);
				$res = mysql_query("insert into wb_tb_card set
				authyn='$authyn',
				resultcd='$resultcd',
				ordno='$ordno',
				amt='$amt',
				trno='$trno',
				trddt='$trddt',
				trdtm='$trdtm',
				authno='$authno',
				isscd='$isscd',
				aqucd='$aqucd',
				msg1='$msg1',
				msg2='$msg2',
				cbtrno='$cbtrno',
				result='$result',
				c_date='$c_date',
				sndOrdername='$sndOrdername',
				sndEmail='$sndEmail',
				sndMobile='$sndMobile'
				");
				echo "<script>alert('결제를 실패 하셨습니다.');window.close();</script>";
				//MsgViewHref('결제를 실패 하셨습니다.','card.php');
				exit;
			}

			//$ipg->kspay_send_msg("3"); // 정상처리가 완료되었을 경우 호출합니다.(이 과정이 없으면 일시적으로 kspay_send_msg("1")을 호출하여 거래내역 조회가 가능합니다.)
		} else {
			echo "<script>alert('결제를 실패 하셨습니다.');window.close();</script>";
			//MsgViewHref('결제를 실패 하셨습니다.','card.php');
			exit;
		}
	}
	?>