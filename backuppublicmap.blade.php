<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
      #btn{
        display: block;
        margin: auto;
        width: 40%;
       }
      h3, p{
      text-align:center;
      }
    </style>
  </head>
  <body>
    <h3>Food Truck Public Map Bkcp</h3>
    <div id="map"></div>
    <div id="Long"></div>
    <div id="Lat"></div>
 	<div hidden id="trucks">{{ $trucktoMap }} </div>

      
    <script>
      
//get data from view

var trucks = document.getElementById("trucks").innerHTML;
    document.getElementById("trucks").innerHTML = trucks;

//assemble locations json array
    var jsonprep = '{"truckData":';
    var jsonprep2 = "}";  
    var locations = [
      jsonprep + trucks + jsonprep2
    ];
//document.write(locations);

//store truck data in json array
 var truckobj = JSON.parse(locations);
 
//count number of trucks in json array
 var count = Object.keys(truckobj.truckData).length;
// document.write(count);
 
//intit map   
function initMap() {
  
//request position then calls function successCallback on success
navigator.geolocation.getCurrentPosition(successCallback);
  
//gives position to map and adds marker for users position
  
    function successCallback(position){
        var thislat = position.coords.latitude;
        var thislng = position.coords.longitude;
      
        var location = {lat: thislat, lng: thislng};
         
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: location
        });
            
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
//adds info window to each marker 
var infowindow = new google.maps.InfoWindow();

var marker, i;
var infoContent;
for (i = 0; i < count; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(truckobj.truckData[i].truckLat, truckobj.truckData[i].truckLong),
        map: map
       
      });

//info windows displays on click
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
           infoContent = '<a href="'+ '/profile/' + truckobj.truckData[i].id+'">' + truckobj.truckData[i].name + truckobj.truckData[i].type + '</a>';  
          infowindow.setContent(infoContent);
          infowindow.open(map, marker);
        }
})(marker, i));
  
  
      }

}
}     
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCk6xu9uxbGAiST78y_8__aP78qM6Ctjyw&callback=initMap">
    </script>
  </body>
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

