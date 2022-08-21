<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="googleMap" style="width:100%;height:100%;"></div>
</body>
<script>
$(document).ready(function() {
        latt=<?php echo $_GET['lat'] ;?>;
        long=<?php echo $_GET['long'] ;?>;
        var lattlong = new google.maps.LatLng(latt, long);   
            var myOptions = {   
                center: lattlong,   
                zoom: 20,   
                mapTypeControl: true,   
                navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL}   
            }   
            var maps = new google.maps.Map(document.getElementById("googleMap"), myOptions);   
            var markers =   
            new google.maps.Marker({position:lattlong, map:maps, title:"Location",  animation:google.maps.Animation.BOUNCE, icon:'images/garbage.png'});   

    });

</script>
</html>