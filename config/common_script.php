<script>

    function addToCoodinates(address,lat,long){
    
        const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM`;
        fetch(geocodingUrl)
    .then(response => response.json())
    .then(data => {
       lat = data.results[0].geometry.location.lat;
       long = data.results[0].geometry.location.lng;
      
    })
 
    }
</script>