<!DOCTYPE html>
<html>
<body>

<h1>Provider Location in Map</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
	var x = {{$latitude}};
	var y = {{$longitude}};
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(x,y),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5LAO2XWTW3gHCtTnIZgBMWef5jJK8TCw&callback=myMap"></script>

</body>
</html>