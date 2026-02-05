<?
FUNCTION thumbnailImageCreate($image_path, $save_path, $max_with_size=150, $max_height_size=150, $waterMakeImagePath="", $save_format="jpg", $background_color="WHITE", $image_quality=300){

		$image_path_size_info=getimagesize($image_path);

		if($image_path_size_info[0] > $image_path_size_info[1]){
				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = @($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = @($image_path_size_info[1] / $save_path_height_size_divided);
						
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
				
		}else if($image_path_size_info[0] == $image_path_size_info[1]){

				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = ($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = ($image_path_size_info[1] / $save_path_height_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}else{
				if($image_path_size_info[1] > $max_height_size){
						$save_path_height_size = $max_height_size;
						$save_path_width_size_divided = @($image_path_size_info[1] / $save_path_height_size);
						$save_path_width_size = @($image_path_size_info[0] / $save_path_width_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}
		

		$save_image=ImageCreateTrueColor($save_path_width_size-1, $save_path_height_size-1);
		
		switch($image_path_size_info[2]){
				case 1 :
							$source_image=ImageCreateFromGIF($image_path);
							$source_format="gif";
							break;
				case 2 :
							$source_image=ImageCreateFromJPEG($image_path);
							$source_format="jpg";
							break;
				case 3 :
							$source_image=ImageCreateFromPNG($image_path);
							$source_format="png";
							break;
				default :
							return array(0, $source_format, "!!! 원본이미지가 GIF, JPG, PNG 포맷 방식이 아s니어서 이미지 정보를 읽어올 수 없습니다. !!!");
		}
		
		$save_path_width_size = round($save_path_width_size);
		$save_path_height_size = round($save_path_height_size);
		
		
		if(ImageCopyResampled($save_image ,$source_image, 0, 0, 0, 0, $save_path_width_size, $save_path_height_size, ImageSX($source_image), ImageSY($source_image))){
				switch($save_format){
						case "jpg"	:
						case "jpeg"	:
						case "JPG"	:
						case "JPEG"	:
										if(ImageJPEG($save_image, $save_path, $image_quality)){
												if($waterMakeImagePath){
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG 포맷 이미지 생성 - 워터마크처리");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG 포맷 이미지 생성에 실패 했습니다 - 원인 : 워커마크처리오류. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG 포맷 이미지 생성");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG 포맷 이미지 생성에 실패 했습니다. !!!");
										}
								break;
								
						case "png"	:
						case "PNG"	:
										if(ImagePNG($save_image, $save_path, $image_quality)){
												if($waterMakeImagePath){
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG 포맷 이미지 생성 - 워터마크처리");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG 포맷 이미지 생성에 실패 했습니다 - 원인 : 워커마크처리오류. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG 포맷 이미지 생성");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG 포맷 이미지 생성에 실패 했습니다. !!!");
										}
								break;
						case "gif";
						case "GIF";
										if(ImageGIF($save_image, $save_path, $image_quality)){
												if($waterMakeImagePath){
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF 포맷 이미지 생성 - 워터마크처리");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF 포맷 이미지 생성에 실패 했습니다 - 원인 : 워커마크처리오류. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF 포맷 이미지 생성");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF 포맷 이미지 생성에 실패 했습니다. !!!");
										}
								break;
						default :
								return array(0, $source_format, "!!! 입력하신 포맷 이미지는 지원되지 않습니다. !!!");
				}
		}else{
				return array(0, $source_format, "!!! ImageCopyResized 함수 수행시 에러가 발생했습니다. !!!");
		}
}

FUNCTION imageWaterMaking($ARGimagePath, $ARGwaterMakeSourceImage, $ARGimageQuality = 70){
		$getSourceImageInfo = GETIMAGESIZE($ARGimagePath);
		if(!$getSourceImageInfo[0]){
				return ARRAY(0, "!!! 원본 이미지가 존재하지 않습니다. !!!");
		}
		$getwaterMakeSourceImageInfo = GETIMAGESIZE($ARGwaterMakeSourceImage);
		if(!$getwaterMakeSourceImageInfo[0]){
				return ARRAY(0, "!!! 워터마크 이미지가 존재하지 않습니다. !!!");
		}

		switch($getSourceImageInfo[2]){
				case 1 :	
							$sourceImage = IMAGECREATEFROMGIF($ARGimagePath);
							break;
				case 2 :	
							$sourceImage = IMAGECREATEFROMJPEG($ARGimagePath);
							break;
				case 3 :	
							$sourceImage = IMAGECREATEFROMPNG($ARGimagePath);
							break;
				default :	
							return array(0, "!!! 원본이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!");
		}
		

		switch($getwaterMakeSourceImageInfo[2]){
				case 1 :	
							$waterMakeSourceImage = IMAGECREATEFROMGIF($ARGwaterMakeSourceImage);
							break;
				case 2 :	
							$waterMakeSourceImage = IMAGECREATEFROMJPEG($ARGwaterMakeSourceImage);
							break;
				case 3 :	
							$waterMakeSourceImage = IMAGECREATEFROMPNG($ARGwaterMakeSourceImage);
							break;
				default :	
							return array(0, "!!! 워터마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!");
		}
		
		
		$waterMakePositionWidth = ($getSourceImageInfo[0] - $getwaterMakeSourceImageInfo[0]) / 2;
		$waterMakePositionHeight = ($getSourceImageInfo[1] - $getwaterMakeSourceImageInfo[1]) / 2;
		
		IMAGECOPYRESIZED($sourceImage, $waterMakeSourceImage, $waterMakePositionWidth, $waterMakePositionHeight, 0, 0, ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage), ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage));

		switch($getSourceImageInfo[2]){
				case 1 :	
							if(IMAGEGIF($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "GIF 형식 워터마크 이미지가 처리 되었습니다.");
							}else{
									return ARRAY(0, "GIF 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다.");
							}
							break;
				case 2 :	
							if(IMAGEJPEG($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "JPG 형식 워터마크 이미지가 처리 되었습니다.");
							}else{
									return ARRAY(0, "JPG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다.");
							}
							break;
				case 3 :	
							if(IMAGEPNG($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "PNG 형식 워터마크 이미지가 처리 되었습니다.");
							}else{
									return ARRAY(0, "PNG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다.");
							}
							break;
				default :	
							return ARRAY(0, "!!! 원본마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!");
		}
}
?>