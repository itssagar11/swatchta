

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div id="map" style="width: 100%; height: 100%;"></div>
<script>
id=<?php echo $_GET['id']?>;
var lattlong = new google.maps.LatLng(26.8428986
, 75.5664079);  
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
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
             loc(obj['last_latt'],obj['last_long'],obj['last_location']);
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
console.log(lat,long);
var lattlong = new google.maps.LatLng(lat, long);  
   
      marker = new google.maps.Marker({
       
        position: lattlong,
        
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