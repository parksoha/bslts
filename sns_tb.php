<?

if($_SERVER[PATH_INFO]) {
	$arr = explode("/", $_SERVER[PATH_INFO]);

	if($arr[1] == "" || $arr[2] == "") {
		header("location:http://$_SERVER[HTTP_HOST]");
		exit;
	} else {
		$tmp_dir = str_replace("/sns_tb.php", "", $_SERVER[SCRIPT_NAME]);
		header("location:$tmp_dir/wb_board/view.php?bbs_code=$arr[1]&bd_num=$arr[2]");
		exit;
	}
} else {
	header("location:./");
	exit;
}
?>
