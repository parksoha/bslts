<?
$site_path='./';
include_once($site_path."wb_include/lib.php");
?>

<html>
<head>
<title><?=$_site_info['site_name']?></title>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<?=$_site_info['site_meta']?>

<link rel="canonical" href="http://<?=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?=$_site_info['site_name']?>">
<meta property="og:description" content="<?=$_site_info['site_naver']?>">
<meta name="description" content="<?=$_site_info['site_naver']?>">

<meta property="og:url" content="http://<?=$_SERVER["HTTP_HOST"]?>">

</head>

<body>

</body>

</html>



<?if($_site_info[site_types] == '1'){	
	rg_href('/index1.php','','');
}else if($_site_info[site_types] == '2'){	

	


$sql = 'SELECT 
			c.code 
		FROM 
			ip2nationCountries c,
			ip2nation i 
		WHERE 
			i.ip < INET_ATON("'.$_SERVER['REMOTE_ADDR'].'") 
			AND 
			c.code = i.country 
		ORDER BY 
			i.ip DESC 
		LIMIT 0,1';

list($countryName) = mysql_fetch_row(mysql_query($sql));


if($countryName=='kr'){
	rg_href('/index2.php','','');
}else if($countryName=='jp'){
	rg_href('/index2_j.php','','');	
}else{
	rg_href('/index2_e.php','','');	
}





}else if($_site_info[site_types] == '3'){	
	rg_href('/index3.php','','');
}else if($_site_info[site_types] == '4'){	
	rg_href('/index4.php','','');
}?>


