
<script type="text/javascript" src="<?=$site_path?>js/jssor.slider-25.2.0.min.js"></script>



<script>
	jQuery(document).ready(function ($) {

		var _CaptionTransitions = [{ $Duration: 1200, $Opacity: 2 }];

		var options = {
			$FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
			$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
			$AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
			$PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

			$ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
			//$SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
			$SlideDuration: 800,                               //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
			$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
			//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
			//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
			$SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
			$DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
			$ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
			$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
			$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
			$DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

			$SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
				$Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
				$Transitions: _CaptionTransitions,            //[Required] An array of slideshow transitions to play slideshow
				$TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
				$ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
			},


			
		   

		   

			 $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
				$Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
				$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: 0,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
				$Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
				$Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
				$SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
				$SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
				$Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
			},

			$ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
				$Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
				$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
				$Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
			}
		};

		var jssor_slider1 = new $JssorSlider$("slider1_container", options);

		//responsive code begin
		//remove responsive code if you don't want the slider to scale along with window
		function ScaleSlider() {
			var windowWidth = $(window).width();
			

			if (windowWidth) {
				var windowHeight = $(window).height();
				var originalWidth = jssor_slider1.$OriginalWidth();
				var originalHeight = jssor_slider1.$OriginalHeight();
				
				var bodyWidth = document.body.clientWidth;

				if (windowWidth < 1024) {
					
					jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1024));
					
				}
				else {
					
					jssor_slider1.$ScaleWidth(Math.max(bodyWidth, 2000));					
					
				}
			}
			else
				window.setTimeout(ScaleSlider, 30);
		}

		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
		//responsive code end



	});


</script>
        



<?if($bodyClass=="Main"){	

	
?>



<div style="width:100%; height:auto; float:left;">
<div class="foscreen4">
	<div class="foscreen1">
		
		<div id="slider1_container" class="foscreen2">

		   
		
			<div u="slides" class="foscreen3">


				<?
				$sql_mairo = "select * from wb_tb_design2 order by orders asc";
				$result_mairo = mysql_query($sql_mairo);
				
				while($mairo = mysql_fetch_array($result_mairo)){
					$y++;
				?>

					
					<div style="width:100%; height:auto; float:left;">
						
						

						<div class="imgbigsd">
						<img src="<?=$site_path?>wb_data/design/<?=$mairo[main_img]?>" width="100%" alt="" />
						</div>

						<div class="imgsmasd">
						<img src="<?=$site_path?>wb_data/design/<?=$mairo[main_img2]?>" width="100%" alt="" />	
						</div>
						
					</div>


					
				

					
						
				<?}?>
				
			   
			</div>

			
			
			<span u="arrowleft" id="leftsd"></span>
			<span u="arrowright" id="rightsd"></span>	

		   
		</div>

		
	</div>

		<!--img src="../images/main/a_lefts.png" onclick="$('#leftsd').trigger('click');" style="position:absolute; left:10px; top:140px; cursor:pointer; z-index:9999999999999;">
		<img src="../images/main/a_rights.png" onclick="$('#rightsd').trigger('click');" style="position:absolute; right:10px; top:140px; cursor:pointer; z-index:9999999999999;"-->
	
</div>

</div>








<?}else{?>

<div class="s2">
	<div style="background:#01468b url('/images/sub01_top.png') center bottom no-repeat; height:246px; margin-top:87px; ">
	  <div style="text-align:left; width:100%; margin:0 auto; font-size:29px; color:#636363;">
			<div style="clear:both; float:left; padding:70px 0 0 10%;">
				Leading Total Solution<br>
				<b style=" font-size:32px; color:#000000; ">Busung L.T.S</b>
			</div>
		</div>
	</div>
</div>

<div class="s3">
	<div style="background:#01468b url('/images/sub01_top.png') center bottom no-repeat; height:246px; margin-top:87px;">
		<div style="text-align:left; width:1024px; margin:0 auto; font-size:29px; color:#636363;">
			<div style="clear:both; float:left; padding:50px 0 0 50px;">
				Leading Total Solution<br>
				<b style=" font-size:32px; color:#000000; ">Busung L.T.S</b>
			</div>
		</div>
	</div>
</div>


<?}?>