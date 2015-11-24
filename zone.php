<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<style>
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}
#map {
	margin-top: 50px;
	height: 500px;
}
</style>
<script>
var geocoder;
var map;
var polygon;
function initMap() {
	geocoder = new google.maps.Geocoder();
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: {lat: 35.9465, lng: -86.7998},
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var polygonCoords = [
 		{lat: 35.94653550528586, lng: -86.79988861083984},
		{lat: 35.94743881203683, lng: -86.81383609771729},
		{lat: 35.941045957594625, lng: -86.81499481201172},
		{lat: 35.94090697675445, lng: -86.79911613464355}
		];
	
	polygon = new google.maps.Polygon({
		paths: polygonCoords,
		strokeColor: '#FF0000',
 		strokeOpacity: 0.8,
 		strokeWeight: 2,
 		fillColor: '#FF0000',
		fillOpacity: 0.35
	});
	polygon.setMap(map);
	
	var address = "701 coolsprings blvd, 37067";
	
	<?php
	

	if( isset( $_GET['address'] ) ) {
		?>	
		codeAddress("<?php echo $_GET['address']; ?>");
		<?php	
	}
	?>
	
	//codeAddress(address);
	
}
function codeAddress(address) {
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var addressContainsLocation = google.maps.geometry.poly.containsLocation(results[0].geometry.location, polygon);
			if(addressContainsLocation) {
				alert("Address within");
			} else {
				alert("Address not within");
			}
			
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
            	map: map,
            	position: results[0].geometry.location
        	});
		} else {
        	alert("Geocode was not successful for the following reason: " + status);
      	}
	});
}
</script>
</head>

<body>
<div class="container">
	<div class="row" style="margin-top: 20px;">
		<div class="col-sm-12">
        	<form>
            	<div class="form-group">
                	<label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
	<div class="row">
    	<div class="col-sm-12">
        	<div id="map"></div>
		</div>
	</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAe94nBxWFedIz3UzESOxY8ZNblIiXpME0&signed_in=true&callback=initMap"></script>
</body>
</html>