<?
if (!defined("DB_LIKE")) exit; // 개별 페이지 접근 불가 

// 로그를 파일에 쓴다
function write_log2($file, $log) {
    $fp = fopen($file, "a+");
    ob_start();
    print_r($log);
    $msg = ob_get_contents();
    ob_end_clean();
    fwrite($fp, $msg);
    fclose($fp);
}
?>