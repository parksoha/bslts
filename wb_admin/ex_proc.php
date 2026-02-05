<?
error_reporting(E_ALL);
setlocale(LC_CTYPE, "ko_KR.eucKR");
header("content-type:text/html;charset='utf-8'");

include_once("../wb_include/lib.php");
require_once("admin_chk.php");

if(!empty($csv_file_name))
{
	$csv_file_info=explode(".",$csv_file_name);
	if($csv_file_info[1]!="csv")
	{
		
		echo "<script>alert('csv파일만 업로드 가능합니다.'); location.href='member_list.php';</script>";
		exit;
	}
	$csv_file_name = date("Ymd",time())."_".trim($csv_file_name);
	@move_uploaded_file($csv_file, "../wb_data/csv/$csv_file_name");	//파일복사
	@unlink($csv_file);
}
else
{
	echo "<script>alert('CSV파일이 없습니다.'); location.href='member_list.php';</script>";
	
	exit;
}





$url = "../wb_data/csv/$csv_file_name";
$array = file($url);
for($i=0;$i<count($array);$i++)
{
	if ($length < strlen($array[$i]))
	{
		$length = strlen($array[$i]);
	}
}
unset($array);
$error_occur = false;
$row = 1;
$error_row = 0;
$handle = fopen($url, "r");



while(($data = fgetcsv($handle, $length, ",")) !== FALSE)
{

	$bd_level = iconv('euc-kr','utf-8',$data[0]);


	$i=0;
	if(is_array($_level_info)) 
	foreach($_level_info as $k => $v) {
		$i++;

		if($v==$bd_level){
			$bd_level2 = $k;
		}

	}

	
	$bd_name = iconv('euc-kr','utf-8',$data[1]);
	$bd_num = iconv('euc-kr','utf-8',$data[2]);
	$bd_email = iconv('euc-kr','utf-8',$data[3]);
	

	if($row == 1)	//헤더라인 제거
	{
		$row++;
	}
	else	
	{


		
		$qry = "INSERT INTO wb_tb_member SET ";
		$qry.="mb_level='".addslashes($bd_level2)."',";
		$qry.="mb_email='".addslashes($bd_email)."',";
		$qry.="mb_name='".addslashes($bd_name)."',";
		$qry.="mb_tel2='".addslashes($bd_num)."',";
		$qry.="mb_is_sms='1'";
		
		$result_insert = mysql_query($qry);

		
	
	}
}
echo "<script>alert('등록되었습니다.'); location.href='member_list.php';</script>";


?>