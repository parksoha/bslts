<?
include_once("../wb_include/lib.php");

if($act == "design_a")
{
	if($part ==1)
	{
		$img_info=@getimagesize($img);
		$img_type=array_pop(explode(".",$img_name));
		if(($img_info[2]!=1) && ($img_info[2]!=2) && ($img_info[2]!=3))
		{
			
			rg_href('','등록가능한 이미지 형식은 gif, jpg, png 입니다.','back');

			exit;
		}
		else
		{		
			$result_logo1 = mysql_query("select * from wb_tb_design where idx='1'");
			$logo1 = mysql_fetch_array($result_logo1);
			$img_name = date("YmdHis")."_".$img_name;			
			@unlink("../wb_data/design/$logo1[logo1]");
			@move_uploaded_file($img, "../wb_data/design/$img_name"); //파일복사	

			$rs->clear();
			$rs->set_table("wb_tb_design");
			$rs->add_field("logo1","$img_name");
			$rs->add_where("idx='1'");
			$rs->update();
			

			

			rg_href('/wb_admin/new_design1.php','등록이 완료되었습니다.','');
		}
	}



	if($part ==2)
	{
		$img_info=@getimagesize($img);
		$img_type=array_pop(explode(".",$img_name));
		if(($img_info[2]!=1) && ($img_info[2]!=2) && ($img_info[2]!=3))
		{
			
			rg_href('','등록가능한 이미지 형식은 gif, jpg, png 입니다.','back');

			exit;
		}
		else
		{		
			$result_logo2 = mysql_query("select * from wb_tb_design where idx='2'");
			$logo2 = mysql_fetch_array($result_logo2);
			$img_name = date("YmdHis")."_".$img_name;			
			@unlink("../wb_data/design/$logo2[logo2]");
			@move_uploaded_file($img, "../wb_data/design/$img_name"); //파일복사	

			$rs->clear();
			$rs->set_table("wb_tb_design");
			$rs->add_field("logo2","$img_name");
			$rs->add_where("idx='2'");
			$rs->update();
			

			

			rg_href('/wb_admin/new_design1.php','등록이 완료되었습니다.','');
		}
	}

}




//이미지롤링업로드
if($act == "design_b")
{
	if($part ==11)
	{
	
		$img_info=@getimagesize($img);
		$img_type=array_pop(explode(".",$img_name));
		$banner_type =$img_info[2];
		if(($img_info[2]!=1) && ($img_info[2]!=2) && ($img_info[2]!=3))
		{
			MsgView("등록가능한 이미지 형식은 gif, jpg, png 입니다.", -1);
			exit;
		}
		else
		{
			$img_name = date("YmdHis")."_".$_FILES['img']['name'];
			@move_uploaded_file($img, "../wb_data/design/$img_name"); //파일복사
			@unlink($img);
		}



		$img_info2=@getimagesize($img2);
		$img_type2=array_pop(explode(".",$img_name2));
		$banner_type2 =$img_info2[2];
		if(($img_info2[2]!=1) && ($img_info2[2]!=2) && ($img_info2[2]!=3))
		{
			MsgView("등록가능한 이미지 형식은 gif, jpg, png 입니다.", -1);
			exit;
		}
		else
		{
			$img_name2 = date("YmdHis")."_".$_FILES['img2']['name'];
			@move_uploaded_file($img2, "../wb_data/design/$img_name2"); //파일복사
			@unlink($img2);
		}




		$up_qry = "insert into wb_tb_design2 (main_img,main_img2,main_url,main_target,orders)values('$img_name','$img_name2','$siteUrl','$siteTarget','$sunwi')";		
		$result_insert = mysql_query($up_qry);
		ReFresh("new_design2.php");

	}


	//삭제, 수정
	if($part ==12)
	{	

		$result_desi = mysql_query("select * from wb_tb_design2 where idx='$idx'");
		$desi = mysql_fetch_array($result_desi);



		if($mode=="edit"){	
			
			$img_info=@getimagesize($img);
			$img_type=array_pop(explode(".",$img_name));			
			$img_name = date("YmdHis")."_".$_FILES['img']['name'];	



			$img_info2=@getimagesize($img2);
			$img_type2=array_pop(explode(".",$img_name2));			
			$img_name2 = date("YmdHis")."_".$_FILES['img2']['name'];	


			if($img != ""){
				@unlink("../wb_data/design/$desi[main_img]");
				@move_uploaded_file($img, "../wb_data/design/$img_name"); //파일복사	

				

				$rs->clear();
				$rs->set_table("wb_tb_design2");
				$rs->add_field("main_img","$img_name");
				
				$rs->add_field("main_url","$siteUrl");
				$rs->add_field("main_target","$siteTarget");
				$rs->add_field("orders","$sunwi");
				$rs->add_where("idx='$idx'");
				$rs->update();
				
			}else if($img2 != ""){
			

				@unlink("../wb_data/design/$desi[main_img2]");
				@move_uploaded_file($img2, "../wb_data/design/$img_name2"); //파일복사	

				$rs->clear();
				$rs->set_table("wb_tb_design2");
				
				$rs->add_field("main_img2","$img_name2");
				$rs->add_field("main_url","$siteUrl");
				$rs->add_field("main_target","$siteTarget");
				$rs->add_field("orders","$sunwi");
				$rs->add_where("idx='$idx'");
				$rs->update();
				
			}else{

				$rs->clear();
				$rs->set_table("wb_tb_design2");		
				$rs->add_field("main_url","$siteUrl");
				$rs->add_field("main_target","$siteTarget");
				$rs->add_field("orders","$sunwi");
				$rs->add_where("idx='$idx'");
				$rs->update();
				
			}
			
			ReFresh("new_design2.php");
		



		}else if($mode=="del"){
			@unlink("../wb_data/design/$desi[main_img]");
			@unlink("../wb_data/design/$desi[main_img2]");
			mysql_query("delete from wb_tb_design2 where idx='".$idx."'");
			ReFresh("new_design2.php");
		}

	}



}
	
?>