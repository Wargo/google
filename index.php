<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Google Maps JavaScript API Example: Map Markers</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAzr2EBOXUKnm_jVnk0OJI7xSosDVG8KKPE1-m51RBrvYughuyMxQ-i1QfUnH94QxWIa6N4U6MouMmBA"
type="text/javascript"></script>
<script type="text/javascript">

function initialize() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map_canvas"));
		map.setCenter(new GLatLng(37.4419, -122.1419), 13);

		// Add 10 markers to the map at random locations
		var bounds = map.getBounds();
		var southWest = bounds.getSouthWest();
		var northEast = bounds.getNorthEast();
		var lngSpan = northEast.lng() - southWest.lng();
		var latSpan = northEast.lat() - southWest.lat();
		for (var i = 0; i < 10; i++) {
			var point = new GLatLng(southWest.lat() + latSpan * Math.random(),
					southWest.lng() + lngSpan * Math.random());
			//map.addOverlay(new GMarker(point));
			map.addOverlay(createMarker(point, i));
		}
		// Zoom
		map.addControl(new GSmallMapControl());

		// satelite, mapa, etc...
		var mapTypeControl = new GMapTypeControl();
		var topRight = new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(10,10));
		var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,10));
		map.addControl(mapTypeControl, topRight);

	}
}
// Create a base icon for all of our markers that specifies the
// shadow, icon dimensions, etc.
var baseIcon = new GIcon(G_DEFAULT_ICON);
baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
baseIcon.iconSize = new GSize(20, 34);
baseIcon.shadowSize = new GSize(37, 34);
baseIcon.iconAnchor = new GPoint(9, 34);
baseIcon.infoWindowAnchor = new GPoint(9, 2);

// Función add marker
// Creates a marker whose info window displays the letter corresponding
// to the given index.
function createMarker(point, index) {
	// Create a lettered icon for this point using our icon class
	var letter = String.fromCharCode("A".charCodeAt(0) + index);
	var letteredIcon = new GIcon(baseIcon);
	letteredIcon.image = "http://www.google.com/mapfiles/marker" + letter + ".png";

	// Set up our GMarkerOptions object
	markerOptions = { icon:letteredIcon };
	var marker = new GMarker(point, markerOptions);

	GEvent.addListener(marker, "click", function() {
			marker.openInfoWindowHtml("Marker <b>" + letter + "</b>");
			});
	return marker;
}

</script>
</head>

<body onload="initialize()" onunload="GUnload()">
<div id="map_canvas" style="width: 500px; height: 300px"></div>
</body>
</html>

