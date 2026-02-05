<?

header("Content-Type: text/html; charset=UTF-8");

if($mbnum == "" && $mbcode == ""){
	echo "<script>alert('잘못된 접근입니다.');  window.open('about:blank','_self').close();</script>";
	exit;

}


$site_path='./';
$site_url='./';


include_once($site_path."wb_include/lib.php");




$sql_memts = "select * from wb_tb_member where mb_num='".$mbnum."' and mb_code = '".$mbcode."'";
$result_memts = mysql_query($sql_memts);
$memts_row = mysql_num_rows($result_memts);
$memts = mysql_fetch_array($result_memts);


if($memts_row == "0"){
	echo "<script>alert('잘못된 접근입니다.'); window.open('about:blank','_self').close();</script>";
	break;
}

if($memts_row > "1"){
	echo "<script>alert('잘못된 접근입니다.'); window.open('about:blank','_self').close();</script>";
	break;
}


if($memts_row == "1"){
	if($memts[mb_state] == '1'){
		echo "<script>alert('이미 승인되었습니다.'); self.close();</script>";
		break;
	}


	if($memts[mb_state] == '0'){

		mysql_query("update wb_tb_member set mb_state = '1' where mb_num='".$memts[mb_num]."' and  mb_code = '".$memts[mb_code]."'");
		echo "<script>alert('인증이 완료되었습니다.'); self.close();</script>";		
		break;


	}
}

?>


