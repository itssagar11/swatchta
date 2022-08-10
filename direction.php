<?php
require_once("config/connection.php");
session_start();
if (!isset($_SESSION["login_user"]) || $_SESSION["login_user"]["role"] != 2) {
    echo "<b> Access Denied<b>";
    // print_r($_SESSION["login_user"] . "S");
    die();
    return;
}
$user = $_SESSION["login_user"];
$id = $_GET["id"];
$sql = "SELECT * FROM service where id=$id";
if (!$result = mysqli_query($conn, $sql)) {
    echo mysqli_errno($conn);
} else {
    $res = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html>
<?php require_once("config/head.php"); ?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Directions Service</title>
<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 0px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto', 'sans-serif';
        line-height: 0px;
        padding-left: opx;
    }
</style>

<body>
    <div id="floating-panel">
        <button id="getdir" class="btn btn-primary">Direction</button>
    </div>
    <div id="map"></div>

</body>



<script>
    let lat = <?php echo $res["latt"]; ?>;
    let lon = <?php echo $res["lon"]; ?>;
    let mylat=0;
    let mylon=0;
    $(document).ready(function() {
      getmyloc();
     
    })

    function getmyloc(){
        var optn = {  
enableHighAccuracy: true,  
            timeout: Infinity,  
            maximumAge: 0     
        };  
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position)=>{
            mylat=position.coords.latitude;
            mylon=position.coords.longitude;
             console.log(mylat);
        });
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
      console.log("sd");
    }
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {
                lat: lat,
                lng: lon
            }
        });

        directionsDisplay.setMap(map);

        function onChangeHandler() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('getdir').addEventListener('click', onChangeHandler);

    }
  

    function showPosition(position) {
     
        
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
       
        var lattlong = new google.maps.LatLng(lat, lon);
        var srclattlong = new google.maps.LatLng(mylat, mylon);
        directionsService.route({
            origin: srclattlong,
            destination: lattlong,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        initMap();


    })

    function showPosition(position) {

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap">
</script>

</html>