<?
$wb_server_time  = time();
$wb_time_ymd = date("Y-m-d", $wb_server_time);
$wb_time_his = date("H:i:s", $wb_server_time);
$wb_time_ymdhis = date("Y-m-d H:i:s", $wb_server_time);
$_path['sms'] = '../wb_data/';



	//  smsWorld SMS 전송 PHP-API Test Sample
	require_once("class.sms.php");
    include_once("sms.log.php");

	if($SMS_PART == "member_join")
	{
		//회원가입
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		if($sms[bSend1])
		{
			$msg = str_replace("__NAME",$name,$sms[msg1]);
			$msg = str_replace("__USERID",$userid,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$hand = str_replace("-","",$hand);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		if($sms[bSend2])
		{
			$msg = str_replace("__NAME",$name,$sms[msg2]);
			$msg = str_replace("__USERID",$userid,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$result = $SMS->Add($retel,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
	}
	else if($SMS_PART == "trade")
	{
		//상품주문
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		$SMS_WRITEDAY = date("m월 d일");
		if($payMethod=="card") $SMS_PAYMETHOD = "카드결제";
		else $SMS_PAYMETHOD = "무통장입금";
		if($sms[bSend3])
		{
			$msg = str_replace("__NAME",		$temp_row[name],	$sms[msg3]);
			$msg = str_replace("__WRITEDAY",	$SMS_WRITEDAY,		$msg);
			$msg = str_replace("__GOODS",		$SMS_GOODS,			$msg);
			$msg = str_replace("__PAYMETHOD",	$SMS_PAYMETHOD,		$msg);
			$msg = str_replace("__PRICE",		$payM,				$msg);
			$msg = str_replace("__CNT",			$SMS_CNT,			$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$temp_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		if($sms[bSend4])
		{
			$msg = str_replace("__NAME",$temp_row[name],$sms[msg4]);
			$msg = str_replace("__WRITEDAY",$SMS_WRITEDAY,$msg);
			$msg = str_replace("__GOODS",$SMS_GOODS,$msg);
			$msg = str_replace("__PAYMETHOD",$SMS_PAYMETHOD,$msg);
			$msg = str_replace("__PRICE",$payM,$msg);
			$msg = str_replace("__CNT",$SMS_CNT,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$result = $SMS->Add($retel,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
	}
	else if($SMS_PART == "cancel")
	{
		//주문취소
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		$SMS_WRITEDAY = date("m월 d일");
		if($payMethod=="card") $SMS_PAYMETHOD = "카드결제";
		else if($payMethod=="hpp") $SMS_PAYMETHOD = "핸드폰";
		else if($payMethod=="iche") $SMS_PAYMETHOD = "계좌이체";
		else if($payMethod=="bank") $SMS_PAYMETHOD = "무통장입금";
		if($sms[bSend8])
		{
			$msg = str_replace("__NAME",		$temp_row[name],	$sms[msg8]);
			$msg = str_replace("__GOODS",		$SMS_GOODS,			$msg);
			$msg = str_replace("__PAYMETHOD",	$SMS_PAYMETHOD,		$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$temp_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
	}
	else if($SMS_PART == "send")
	{
		//상품배송
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$SMS_SENDDAY = date("m월 d일");
		if($sms[bSend5])
		{
			$msg = str_replace("__NAME",		$trade_row[name],	$sms[msg5]);
			$msg = str_replace("__TRANSNUM",	$trans_num,	$msg);
			$msg = str_replace("__GOODS",		StringCut($goods_row[name],20),	$msg);
			$msg = str_replace("__SENDDAY",		$SMS_SENDDAY,		$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$trade_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			
			$result = $SMS->Send();
		
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
	}	
	else if($SMS_PART=="goods_send"){

		// 검색된 회원만 보내기
		$SMS = new SMS($_site_info[sms_id],$_site_info[sms_pass],1);
		$adminTel = str_replace("-","",$_site_info[sms_from]);
		$strData = iconv("utf-8","euc-kr",$strData);
		$temp = explode("/",$add_ary);

		$modu=count($temp);	

		for ($i=0; $i<count($temp); $i++)
		{
			if($temp[$i] && strlen($temp[$i]) == 11 )
			{
				$hand = $temp[$i];
				$result = $SMS->Add($hand,$adminTel,"",$strData,"");				
			}	

			/*
			$log .= "-----------------------\n";
			$log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
			$log .= "SMS 서버에 접속했습니다.\n";

			*/
			$result2 = $SMS->Send();	
			$success = $fail = 0;			
			
			if(!empty($SMS->Result)) {
				foreach($SMS->Result as $result2){	
					list($phone,$code)=explode(":",$result2);
					if ($code=="Error")
					{
						//$log .= "전송 실패 ({$phone} 번호확인요망).\n";
						$fail++;								
					}
					else
					{
						//$log .= $phone." 로 전송했습니다.\n";
						$success++;								
					}
				}
			}
			//$log .=$temp[$i]."로 전송했습니다.\n";
			
			if($success=="0"){
				//$log .= "전송실패\n";
				$fal++;
			}else{
				//$log .= "전송성공\n";
				$succ++;
				
			}					
			//$log .= $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.\n";
			//$log .="전송성공.\n";
			
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.

		}

		if($fal==""){
			$fal_o="0";
		}else{
			$fal_o=$fal;
		}

		if($succ==""){
			$succ_o="0";
		}else{
			$succ_o=$succ;
		}

		$log .= "-----------------------\n";
		$log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
		$log .= "SMS 서버에 접속했습니다.\n";
		$log .= "총".$modu."건 전송 했으며, ".$fal_o."건 전송실패 하였습니다.\n";
		$log .= $succ_o."건 전송 성공\n";		

}
	else if($SMS_PART=="allmember")
	{
		//회원전체 보내기 (SMS수신동의한 회원만) 
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$qry = "select * from member where bSms='y' and hand<>''";
		$qry_result = $MySQL->query($qry);
		while($row = mysql_fetch_array($qry_result))
		{
			$hand = str_replace("-","",$row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$strData,"");
		}
		//echo "<HR>";
		$log = "-----------------------\n";
        $log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
		$result = $SMS->Send();

		if ($result)
		{
			//echo "SMS 서버에 접속했습니다.<br>";
			 $log .= "SMS 서버에 접속했습니다.\n";

			$success = $fail = 0;
			foreach($SMS->Result as $result)
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$log .= "전송 실패 ({$phone} 번호확인요망).\n";
					$fail++;
				}
				else
				{
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					$log .= $phone." 로 전송했습니다.\n";
					$success++;
				}
			}
			//echo $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
			$log .= $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.\n";
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		else 
			//echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
			$log .= "에러: SMS 서버와 통신이 불안정합니다.\n";
	}
	else if($SMS_PART=="selected_member")
	{
		// 검색된 회원만 보내기
		$SMS = new SMS($_site_info[sms_id],$_site_info[sms_pass],1);
		$adminTel = str_replace("-","",$_site_info[sms_from]);
		$temp = explode("/",$idx_arr);
		for ($i=0; $i<count($temp); $i++)
		{
			$res = mysql_query("select * from wb_tb_member where mb_num = '".$temp[$i]."' ");
			$asc = mysql_fetch_assoc($res);
			if($asc[mb_tel2])
			{
				$hand = str_replace("-","",$asc[mb_tel2]);
				$result = $SMS->Add($hand,$adminTel,"",$strData,"");
			}
		}
		
		echo "<HR>";
		$result = $SMS->Send();
		if ($result)
		{
			//echo "SMS 서버에 접속했습니다.<br>";
			$log .= "SMS 서버에 접속했습니다.\n";
			$success = $fail = 0;
			foreach($SMS->Result as $result) 
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					 $log .= "전송 실패 ({$phone} 번호확인요망).\n";
					$fail++;
				}
				else
				{
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					 $log .= $phone." 로 전송했습니다.\n";
					$success++;
				}
			}
			//echo $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
			$log .= $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.\n";
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		else 
			//echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
		$log .= "에러: SMS 서버와 통신이 불안정합니다.\n";

		
	}
	else if($SMS_PART=="permember")
	{
		// 회원개인 보내기
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$result = $SMS->Add($hand,$adminTel,"",$strData,"");
		if ($result) echo $result; else //echo "일반메시지 입력 성공<BR>";
		//echo "<HR>";
		 $log = "-----------------------\n";
		 $log .= "$wb_time_ymdhis : 일반메시지 입력 성공\n";
		$result = $SMS->Send();
		if ($result)
		{
			//echo "SMS 서버에 접속했습니다.<br>";
			$log .= "SMS 서버에 접속했습니다.\n";
			$success = $fail = 0;
			foreach($SMS->Result as $result)
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$log .= "전송 실패 ({$phone} 번호확인요망).\n";
					$fail++;
				}
				else
				{
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					 $log .= $phone." 로 전송했습니다.\n";
					$success++;
				}
			}
			//echo $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
			$log .= $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.\n";
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		//else echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
		else $log .= "에러: SMS 서버와 통신이 불안정합니다.\n";
	}

	write_log($_path['sms']."log/sms.".date("ym", $wb_server_time), $log);

?>