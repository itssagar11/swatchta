<?php require_once('header.php') ?>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    #myMap{
        width:100%;
        height:400px;
        
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Request
                    </div>
                    <div class="card-body">
                        <div id="donutchart" width="100%" height="40"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Share Location <small> &nbsp &nbsp <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label></small>
                    </div>
                    <div class="card-body">
                        <div id="myMap" >

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                New Request
            </div>

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pending Request
            </div>

            <div class="card-body">
                <div class="card-body">
                    <table class="table table-responsive">
                        <?php

                        $id = $_SESSION["login_user"]["id"];
                        $sql1 = "Select * from service where allocated_to=$id and status=2 ";
                        if (!$result = mysqli_query($conn, $sql1)) {
                            echo mysqli_errno($conn);
                        } else {
                            while ($res = mysqli_fetch_assoc($result)) {



                        ?>
                                <tr>
                                    <td>
                                        Address:- <?php echo $res["address"]; ?>
                                        <br>
                                        <small>Date:- <?php echo $res["date"]; ?></small><br>

                                        Status:
                                        <?php if ($res["status"] == 0) { ?>
                                            <small>
                                                <a class="text-danger">Close </a>
                                            </small>
                                        <?php } else if ($res["status"] == 2) { ?>
                                            <small>
                                                <a class="text-success">Pending </a>
                                            </small>
                                        <?php } ?>
                                        <div style="float:right;">
                                            <small>
                                                <a href="EmpAction.php?id=<?php echo $res['id'] ?>">View </a>
                                            </small>
                                        </div>
                                    </td>

                                </tr>
                        <?php }
                        } ?>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php require_once('footer.php') ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</body>

<script type="text/javascript">
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
    function showPosition(position) {
        markers.setMap(null)
        latt = position.coords.latitude;
        long = position.coords.longitude;
        lattlong = new google.maps.LatLng(latt, long);
       
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
        let id = <?php echo $user['id'] ?>;
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
</script>

</html>