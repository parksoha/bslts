<?
	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	$date = mktime();
switch($mode){
	case "insert":
		$query = mysql_query("insert into push_notice set 
															idx ='', 
															p_subject ='$p_subject',
															p_contents ='$p_contents',
															p_date ='$date',
															p_okdate ='',
															p_state ='S',
															p_01 ='',
															p_02 ='',
															p_03 =''
		");
		$return = $query ? 1 : 0;
	break;

	case "modify":
		$query = mysql_query("update push_notice set 
															p_subject ='$p_subject',
															p_contents ='$p_contents',
															p_date ='$date',
															p_state ='S'
												where  idx = $idx
		");
		$return = $query ? 1 : 0;
	break;

	case "delete":
		$query = mysql_query("delete from push_notice where idx = $idx limit 1");
		$return = $query ? 1 : 0;
	break;

	case "send_push":
		mysql_query("update push_notice set p_state='E',p_okdate='$date' where idx = $idx limit 1");
		$query = mysql_query("select p_contents from push_notice where idx = $idx limit 1");
		$asc = mysql_fetch_assoc($query);
		$data = array();
		$sel = mysql_query("select mb_id,deviceuid from wb_tb_member where mb_state='1' and deviceuid !='' and pushserver ='gcm'");
		$data[push_message] = $asc[p_contents];
		echo "<TEXTAREA NAME='' ROWS='30' COLS='40'>";
		while($R = mysql_fetch_assoc($sel)){
			$data[deviceuid] = $R[deviceuid];
			$suc = HN_SEND_PUST($data);
			echo $R[mb_id]." => ".$suc."\r\n";
		}
		echo "</TEXTAREA><br>
			<input type='button' value='확인' onclick=\"location.href='push_notice_list.php';\">
		";
	break;


	case "send_push_test":
		$notice_msg = get_one_fetch("select p_contents from push_notice where idx = $idx limit 1");
		$data[push_message] = $notice_msg[p_contents];
		$R = get_some_fetch("select distinct deviceuid,mb_id from wb_tb_member where mb_state='1' and deviceuid !='' and pushserver ='gcm' ");
		if($R){
			foreach($R as $k){
				$data[deviceuid][] = $k[deviceuid];
			}
		}
	$return_msg = HN_SEND_PUST($data);
	echo "총발송 : ".count($data[deviceuid])."&nbsp;&nbsp;성공 : ".$return_msg[success]."&nbsp;&nbsp;실패 : ".$return_msg[failure]."&nbsp;&nbsp;수신실패 : ".$return_msg[canonical_ids]."<br>";
	echo "<TEXTAREA NAME='' ROWS='30' COLS='40'>";
	if($R){
		foreach($R as $key => $val){
			if($return_msg[results][$key][error]){
				$suc = "디바이스값 오류";
			}else if($return_msg[results][$key][registration_id]){
				$suc = "수신 실패";
			}else{
				$suc = "성공";
			}
			echo $val[mb_id]." => ".$suc."\r\n";
		}
	}
	echo "</TEXTAREA><br>
		<input type='button' value='확인' onclick=\"location.href='push_notice_list.php';\">
	";
	mysql_query("update push_notice set p_state='E',p_okdate='$date' where idx = $idx limit 1");
	break;
}
echo $return;
if (!function_exists('json_decode')){
	function json_decode($json)
	{
		$comment = false;
		$out = '$x=';
		for ($i=0; $i<strlen($json); $i++)
		{
			if (!$comment)
			{
				if (($json[$i] == '{') || ($json[$i] == '[')) $out .= ' array(';
				else if (($json[$i] == '}') || ($json[$i] == ']')) $out .= ')';
				else if ($json[$i] == ':') $out .= '=>';
				else $out .= $json[$i];
			}
			else $out .= $json[$i];
				if ($json[$i] == '"' && $json[($i-1)]!="\\") $comment = !$comment;
		}
		eval($out . ';');
		return $x;
	}
}
function HN_SEND_PUST($data){
	extract($data);
	global $_site_info;
	$headers = array("Content-Type:application/json", "Authorization:key=AIzaSyBL_kFhjrVZ6Z3U_zn0wjuHQseI1aFjy5I";
	$REGID = $deviceuid;
	$MSG = $push_message;
	$arr = array();
	$arr['data'] = array();
	$arr['data']['msg'] = "$MSG";
	$arr['registration_ids'] = array();
	$arr['registration_ids'] = $REGID;
	$arr['data']['url'] = $push_link;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
	$response = curl_exec($ch);
	$response_decode = json_decode($response, true);
	curl_close($ch);
	return $response_decode;
}
?>
