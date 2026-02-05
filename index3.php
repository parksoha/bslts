<?
include("include/header.php");

$markers = Hn_googleMap($_site_info[lat],$_site_info[lng],$_site_info[address],$_site_info[address]);//지도 좌표
?>



        
        
          
       
   
<div class="noti_ban">
	<div class="titsf"><a href="javascript:menu1sub1();"><!--<img src="<?=$site_path?>images/main/con_titlesd.png" style="width:15%;">-->
	<span style="border-top:3px solid #082da8; padding:5px 0 0 0;">BUSINESS</span></a></div>

	<!--<div class="bod_last1">
		<ul>
			<?=rg_lastest('data3','ejoo_gallery_v1_resize',4,40);?>
			
		</ul>
	</div>



	<div class="bod_last2">
		<ul>
			<?=rg_lastest('data3','ejoo_gallery_v1_resize2',4,40);?>
						
		</ul>
	</div>-->
<a href="javascript:menu1sub1();">
	<ul style="font-family:'나눔고딕'; clear:both; float:left; padding:0px 0 5% 0; min-width:300px; margin:0 auto; width:100%;"><li style="float:left; width:20%; padding:0 0px 0 3%; line-height:20px; color:#000000; font-size:1.1em; text-align:center;letter-spacing:-1px; "><img src="/images/m1.gif"><br><b style="font-size:1.3em; color:#1c3070;">인터넷전화</b><br>Centrex <br>VoiP Biz</li>
	<li style="float:left; width:20%; padding:0 0px 0 5%; line-height:20px; color:#000000; font-size:1.1em; text-align:center; letter-spacing:-1px; "><img src="/images/m2.gif">
	<br><b style="font-size:1.3em; color:#1c3070;">일반전화</b><br>DID/DOD <br>지역번호</li>
	<li style="float:left; width:20%; padding:0 0px 0 5%; line-height:20px; color:#000000; font-size:1.1em; text-align:center; letter-spacing:-1px; "><img src="/images/m3.gif">
	<br><b style="font-size:1.3em; color:#1c3070;">지능망</b><br>전국대표번호 050평생번호<br>080착신과금 080수신거부</li>
	<li style="float:left; width:20%;padding:0 0px 0 5%; line-height:20px; color:#000000; font-size:1.1em; text-align:center; letter-spacing:-1px;"><img src="/images/m4.gif">
	<br><b style="font-size:1.3em; color:#1c3070;">기타</b><br>ARS ACS CTI<br>콜센터 프로그램</li></ul>
</a>



	<div class="main_insdu">
		
		
		<div class="call_bansd"><div style="float:left; font-size:18px; color:#ffffff; width:460px; font-family:'나눔고딕'; line-height:30px;padding:20px 0 0 0;"><b style="font-size:25px;">지세븐인터내셔날<i>   For your Life</i></b><br><br>

지세븐인터내셔날은 언제나 최고의 서비스를 제공할 것을   약속드릴 것이며 
그 서비스를 직접 체험해 보시기 바랍니다.
<br><br><b style="font-size:21px;">서비스 문의 전화      <span style="border-radius:8px; background:#f93b46; color:#ffffff; padding:7px 13px;margin-left:10px;">  
010.4668.0607</span></b>
<br><br>
<b style="width:80px; display:inline-block;">F   A   X</b>     <?=$_site_info['admin_fax']?><br>
<b style="width:80px; display:inline-block;">E-mail</b>      <?=$_site_info['admin_email']?><br>
<b style="width:80px; display:inline-block;">T i m e</b>       Mon-Fri 10:00 ~ 17:00</div>

		<!--<img src="<?=$site_path?>images/main/call_bansd.png" style="float:right;">-->


		<div class="map" id="map_canvas" style="width:447px; height:345px; float:right;"></div>
		
		
		
		
		</div>

		<div class="main_insdu2">
			<ul class="main_insdu2_pc">
				<li><a href="javascript:menu4sub1();"><!--<img src="<?=$site_path?>images/main/bod_last_title1.png"-->
				<div style="font-family:'나눔고딕';float:left; margin:20px 0 15px 0; font-size:1.5em; font-weight:bold;">Notice</div>
				<img src="/images/more.gif" style="float:right; padding:20px 0 0 0;"></a></li>
				<div style="background:url('/images/n_bg1.gif') 20px 60px no-repeat; padding:0 0 0 130px;min-height:300px; "><?=rg_lastest('data2','default_ul',7,40);?>	</div>
				
			</ul>

			<ul class="main_insdu2_mo">
				<li><a href="javascript:menu4sub1();"><!--<img src="<?=$site_path?>images/main/bod_last_title1.png"--> <div style="font-family:'나눔고딕';float:left; margin:20px 0 15px 0; font-size:1.5em; font-weight:bold;">Notice</div>
				<img src="/images/more.gif" style="float:right; padding:20px 0 0 0;"></a></li>
				<?=rg_lastest('data2','default_ul',7,40);?>	
				
			</ul>

			<ul style="float:right;" class="main_insdu2_pc">
				<li><a href="javascript:menu4sub2();"><!--<img src="<?=$site_path?>images/main/bod_last_title2.png" -->
<div style="font-family:'나눔고딕';float:left; margin:20px 0 15px 0; font-size:1.5em; font-weight:bold;">FAQ</div>
				<img src="/images/more.gif" style="float:right; padding:20px 0 0 0;"></a></li>
				<div style="background:url('/images/n_bg2.gif') 20px 60px no-repeat; padding:0 0 0 130px;min-height:300px; "><?=rg_lastest('data1','default_ul',7,40);?></div>				
				
			</ul>


			<ul style="float:right;" class="main_insdu2_mo">
				<li><a href="javascript:menu4sub2();"><!--<img src="<?=$site_path?>images/main/bod_last_title2.png"-->
				<div style="font-family:'나눔고딕';float:left; margin:20px 0 15px 0; font-size:1.5em; font-weight:bold;">FAQ</div>
				<img src="/images/more.gif" style="float:right; padding:20px 0 0 0;"></a>
				</li>
				
				<?=rg_lastest('data1','default_ul',7,40);?>				
				
			</ul>
		</div>


		<div class="call_bansd2">
		<div style="float:left; font-size:1.2em; color:#ffffff; width:94%; font-family:'나눔고딕'; line-height:120%;padding:20px 3% 30px 3%;
		background:#314564;"><b style="font-size:1.3em;">지세븐인터내셔날<i>   For your Life</i></b><br><br>

지세븐인터내셔날은 언제나 최고의 서비스를 제공할 것을   약속드릴 것이며 
그 서비스를 직접 체험해 보시기 바랍니다.
<br><br><b style="font-size:21px;">서비스 문의 전화      <span style="border-radius:8px; background:#f93b46; color:#ffffff; padding:7px 13px;margin-left:10px;"><a href="tel:01046680607" style="color:#ffffff;">010.4668.0607</a></span></b>
<br><br>
<b style="width:80px; display:inline-block;">F   A   X</b>      <?=$_site_info['admin_fax']?><br>
<b style="width:80px; display:inline-block;">E-mail</b>       <?=$_site_info['admin_email']?><br>
<b style="width:80px; display:inline-block;">T i m e</b>       Mon-Fri 10:00 ~ 17:00</div>

		
		
		</div>





		<div class="call_bansd3">
		<div style="float:left; font-size:1.2em; color:#ffffff; width:94%; font-family:'나눔고딕'; line-height:120%;padding:20px 3% 30px 3%;
		background:#314564;"><b style="font-size:1.3em;">지세븐인터내셔날<i>   For your Life</i></b><br><br>

지세븐인터내셔날은 언제나 최고의 서비스를 제공할 것을   약속드릴 것이며 
그 서비스를 직접 체험해 보시기 바랍니다.
<br><br><b style="font-size:21px;">서비스 문의 전화      <span style="border-radius:8px; background:#f93b46; color:#ffffff; padding:7px 13px;margin-left:10px;">
<a href="tel:01046680607" style="color:#ffffff;">010.4668.0607</a></span></b>
<br><br>
<b style="width:80px; display:inline-block;">F   A   X</b>      <?=$_site_info['admin_fax']?><br>
<b style="width:80px; display:inline-block;">E-mail</b>       <?=$_site_info['admin_email']?><br>
<b style="width:80px; display:inline-block;">T i m e</b>       Mon-Fri 10:00 ~ 17:00</div>
		</div>
	</div>

	





</div>


<script type="text/javascript">
initialize_multiMarkers2();


var map;
var infoWindow; // infoWindow Object를 담을 변수
var markers; // Marker Object를 담을 변수

function initialize_multiMarkers2(){
//var aa= geocoding("서울시 용산구 원효로2가 1번지");
//alert(aa);
var latlng = new google.maps.LatLng(<?=$_site_info[lat]?>,<?=$_site_info[lng]?>); // 중앙지점 좌표값 입력 – 남한산성 로터리
var myOptions = {
zoom: 15,
center:latlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
// map 변수를 위에 광역으로 잡아줬으므로 var map으로 표기하지 않음


//var image = "./btn_map_icon_shop_on.png"; // 새롭게 적용할 아이콘 이미지 *

//var shadow = "./btn_map_icon_shop_on.png"; // 새롭게 적용할 아이콘 이미지의 그림자 *
<?echo $markers;?>
// 마커 생성

for (index in markers) addMarker(markers[index]);

function addMarker(data) {

var marker = new google.maps.Marker({
position: new google.maps.LatLng(data.lat, data.lng),
map: map,
//icon: image,
//shadow: shadow,
title: data.name,
draggable:true, // Bounce

animation: google.maps.Animation.DROP // Bounce
});

var contentString = data.info;

var infowindow = new google.maps.InfoWindow({ content: contentString});

google.maps.event.addListener(marker, "click", function() {

if (marker.getAnimation() != null) { // Bounce

marker.setAnimation(null); 

} else { 

marker.setAnimation(google.maps.Animation.BOUNCE); 

}

infowindow.open(map,marker);
});
}

// 마커들의 위치에 맞게 보는 화면을 꽉차게 해주는 부분
// 마커와 관련 없는 부분이므로 제외해도 상관없음

var bounds = new google.maps.LatLngBounds();
for (index in markers) {
var data = markers[index];
bounds.extend(new google.maps.LatLng(data.lat, data.lng));
}

}

</script>
    


  

    
<?
include($site_path."include/footer3.php");

?>
<div class="new_pop">
<?
include($site_path.'wb_new_win/newwin.inc.php'); //팝업창
?>
</div>
 







	


	
	
	
	
	
		
	
