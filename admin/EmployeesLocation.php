=
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="map" style="width: 100%; height: 100%;"></div>
<script>

var x=26.8428986;
var y=75.5664079;

<?php 
if(isset($_GET['lat'])){

?>

  
x=<?php echo $_GET['lat'] ?>;
y=<?php echo $_GET['lon'] ?>;
<?php } ?>





var lattlong = new google.maps.LatLng(x, y);  
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: lattlong,   
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    
    var markerArray=[];





function loc(arr){
    var LocationsForMap = arr;
    
   
    const icon = {
    url: "../images/truck.gif", // url
    scaledSize: new google.maps.Size(80, 80), // scaled size
    origin: new google.maps.Point(10,10), // origin
    anchor:
     new google.maps.Point(0, 0) // anchor
};

 for(i=markerArray.length-1;i>=0;i--){
    markerArray[i].setMap(null);
    markerArray.pop();
 }
    for (i = 0; i < LocationsForMap.length; i++) {  
        console.log(LocationsForMap[i][0])
      marker = new google.maps.Marker({
       
        position: new google.maps.LatLng(LocationsForMap[i][0][1], LocationsForMap[i][0][2]),
        
        map: map,
        icon:icon
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(LocationsForMap[i][0][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      markerArray.push(marker);
    }
}
$(document).ready(function(){

    $.ajax({
        url:'controller/updateEmpLoc.php',
        type:'post',
        success:function(resp){
            obj=JSON.parse(resp);
            // console.log(obj);
            loc(obj);
        }
    })
   
setInterval(function(){
    $.ajax({
        url:'controller/updateEmpLoc.php',
        type:'post',
        success:function(resp){
            obj=JSON.parse(resp);
            loc(obj);
        }
    })

},2000);
})

</script>
</body>
</html>