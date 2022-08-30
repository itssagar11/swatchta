<script>


 function initMap() {
        // alert("sd");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser. Map related service will not work.");
        }
    }
    var lattlong;
    var latt;
    var long;
var maps;
var icon;
var markers;
var address;
let id= <?php echo $user['id']; ?>;
    function showPosition(position) {
        markers.setMap(null)
        latt = position.coords.latitude;
        long = position.coords.longitude;
        lattlong = new google.maps.LatLng(latt, long);
        const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latt},${long}&key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM`;
      fetch(geocodingUrl)
        .then(response => response.json())
        .then(data => {
          address = data.results[0].formatted_address;
        });
         markers =
            new google.maps.Marker({
                position: lattlong,
                map: maps,
                title: "Location",
                animation: google.maps.Animation.BOUNCE,
                icon: icon
            });
            console.log("SD");

    }
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);


    $(document).ready(function() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition1);
        } else {
            alert("Geolocation is not supported by this browser. Map related service will not work.");
        }
        // initMap();
    })


    function showPosition1(position) {
        latt = position.coords.latitude;
        long = position.coords.longitude;
        lattlong = new google.maps.LatLng(latt, long);
        var myOptions = {
            center: lattlong,
            zoom: 15,
            mapTypeControl: true,
            navigationControlOptions: {
                style: google.maps.NavigationControlStyle.SMALL
            }
        }
         maps = new google.maps.Map(document.getElementById("myMap"), myOptions);
         icon = {
            url: "images/truck.gif", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
         markers =
            new google.maps.Marker({
                position: lattlong,
                map: maps,
                title: "Location",
                animation: google.maps.Animation.BOUNCE,
                icon: icon
            });
      

    }

    function drawChart() {
        let pr;
        let c;
        
        $.ajax({
            url: 'admin/controller/empGraph.php',
            type: 'post',
            async: false,
            data: {
                id: id
            },
            success: function(resp) {
                let obj = JSON.parse(resp);
                console.log(obj)
                pr = obj.pendingReq;
                c = obj.complete;
                a = obj.accept;

            }
        })
        let latt = 0;
        let long = 0;



        var data = google.visualization.arrayToDataTable([
            ['Request', 'Status'],
            ['Pending', pr],
            ['Compete', c],
            ['Accepted', a],

        ]);

        var options = {
            title: 'My Daily Activities',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
    setInterval(initMap,2000);
let flag=0;




setInterval(function(){
if(flag==1){
    $.ajax({
        url:'fireLocation.php',
        type:'post',
        data:{
            lat:latt,
            lon:long,
            address:address,
            id:id
        },
        success:function(resp){
                console.log(address);
        }
    })
}

},2000);


</script>