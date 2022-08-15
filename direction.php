




<?php require_once("header.php"); ?>

<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      .head{
    
    padding: 5px;
 }
  #map{
    z-index: 0.5;
    margin-top: 100px;
    width:100%;
    height: 600px;;
  }
</style>



<body>
    <div id="layoutSidenav_content">
        <main>
            <div class="head">
                <div style="display:flex; ">
                <button id="getdir" class="btn btn-primary">Get Direction</button> <span><?php echo $_GET['address']?></span>  <br>
               <br> <p><b>Distance:</b><span id="dis"></span></p><br>
                <p><b>Time:</b><span id="time"></span></p>
            </div>
            
            <div id="map"></div>
            </div>
           
 
  
   
    
   
    </main>
    </div>



</body>

<script>
    let lat = <?php echo $_GET["lat"]; ?>;
    let lon = <?php echo $_GET["long"]; ?>;
    let mylat=0;
    let mylon=0;
    var lattlong;
    let directionsService;
    let directionsDisplay;
    $(document).ready(function() {
      getmyloc();
      lattlong= new google.maps.LatLng(lat, lon);
     
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
         directionsService = new google.maps.DirectionsService;
         directionsDisplay = new google.maps.DirectionsRenderer;
         directionsDisplay.setDirections()
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 20,
            center: {
                lat: lat,
                lng: lon
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,  
                navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL}   
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
        var srclattlong = new google.maps.LatLng(mylat, mylon);
        directionsService.route({
            origin: srclattlong,
            destination: lattlong,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                $('#dis').html(response.routes[0].legs[0].distance['text']);
                $('#time').html(response.routes[0].legs[0].duration['text']);
                console.log(response.routes[0].legs[0].distance['text']);

                directionsDisplay.setDirections(response);
            } else {
                window.alert('Please Wait While Fetching Your Location' + status);
            }
        });
    } 
    
    // setInterval(getmyloc,1000);
    // setInterval(calculateAndDisplayRoute,2000);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap">
</script>

</html>
