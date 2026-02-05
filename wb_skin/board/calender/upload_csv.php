	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
	if($_SERVER['REQUEST_METHOD']=='POST' AND $_POST['mode']=='upload'){
		error_reporting(E_ALL);
		setlocale(LC_CTYPE, "ko_KR.eucKR");
		header("content-type:text/html;charset='utf-8'");
		mysql_connect('localhost','root','hur5305wer');
		mysql_select_db('wbridge_croco');

		if(is_uploaded_file($_FILES['userfile']['tmp_name'])===false){
			echo "<script> alert('파일을 업로드 하지 않았습니다.'); history.back(-1); </script>";
			exit;		
		}

		if(substr(strchr($_FILES['userfile']['name'],'.'),1)!=='csv'){
			echo "<script> alert('csv 파일만 업로드 가능 합니다'); history.back(-1); </script>";
			exit;
		}
		$path ="./upload_data/";
		$file = $path.mktime()."_".$_FILES['userfile']['name'];
		
		move_uploaded_file($_FILES['userfile']['tmp_name'],$file);
		
		
		if(($handle = fopen($file,"r"))!==FALSE){
			while(($data = fgetcsv($handle,1000,","))!==FALSE){
			//print_r($data)."<p>";
			$d_array = explode("-",$data[0]);
			$year = $d_array[0];
			$month = $d_array[1];
			$day = $d_array[2];

			$bd_name = iconv('euc-kr','utf-8',$data[1]);
			$bd_subject = iconv('euc-kr','utf-8',$data[2]);
			$bd_bus = iconv('euc-kr','utf-8',$data[3]);
			$bd_content = iconv('euc-kr','utf-8',$data[4]);

			$regdate = mktime(0,0,0,$month,$day,$year);
			
				if($regdate and $bd_subject and $bd_bus){

					$query ="INSERT INTO wb_tb_bbs_body(gr_num,bbs_db_num,bd_name,mb_num,is_admin,bd_ext5,bd_subject,bd_bus,bd_content)values('1','7','$bd_name','1','1','$regdate','$bd_subject','$bd_bus','$bd_content')";
					
					mysql_query($query);
				}
			}


			echo "<script> 
							alert('업로드가 완료 되었습니다'); 
							location.href='/croco/wb_admin/excel_upload.php';							  
					 </script>";
		}else{ }


		

	}






