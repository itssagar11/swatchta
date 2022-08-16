

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap"></script>


</head>
<body>
<div id="map" style="width: 100%; height: 100%;"></div>
<script>
id=<?php echo $_GET['id']?>;
var lattlong = new google.maps.LatLng(28.9255
, 78.2337);  
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 20,
      center: lattlong,   
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    
  function Emplocation(){
    
    $.ajax({
        url:'updateEmployeeLocation.php',
        type:'post',
        data:{id:id},
        success:function(resp){
            
             console.log(resp);
             obj=JSON.parse(resp);
             loc(obj['last_lat'],obj['last_long'],obj['last_location']);
        }
    })
  }





function loc(lat,long,address){
   
    
   
    const icon = {
    url: "../images/truck.gif", // url
    scaledSize: new google.maps.Size(50, 50), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor:
     new google.maps.Point(0, 0) // anchor
};

 
   
      marker = new google.maps.Marker({
       
        position: new google.maps.LatLng(lat, long),
        
        map: map,
        icon:icon
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(address);
          infowindow.open(map, marker);
        }
      })(marker, i));
    
    }

$(document).ready(function(){

Emplocation();
} );
setInterval(function(){
    Emplocation();

},2000);


</script>
</body>
</html>