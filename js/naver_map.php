<script type="text/javascript">
$(function(){
	initialize_multiMarkers2();
});
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