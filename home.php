<?php require_once('userHeader.php') ?>
<style>
    #myMap {
        width: 100%;
        height: 400px;

    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">My Coins <h3 id="coin"></h3>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="reward.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Coupan <h3><?php
                                                            $sql = "SELECT count(id) as c from rewards where owner=$id";
                                                            $res = mysqli_query($conn, $sql);
                                                            if (!$res) {
                                                                echo mysqli_error($conn);
                                                            } else {
                                                                $row = mysqli_fetch_assoc($res);
                                                                echo $row['c'];
                                                            }
                                                            ?></h3>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="reward.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Request<h3>
                                <?php
                                $sql = "SELECT count(id) as c from service where citizen_id=$id and status=1";
                                $res = mysqli_query($conn, $sql);
                                if (!$res) {
                                    echo mysqli_error($conn);
                                } else {
                                    $row = mysqli_fetch_assoc($res);
                                    echo $row['c'];
                                }


                                ?>
                            </h3>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="myrequest.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                   
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Where I'm <a class="btn  btn-danger" onclick="getAll()">Truck Near Me</a>
                            </div>
                            <div class="card-body">
                                <div id="myMap"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Recent Request
                            <div class="" style="float:right;">
                                <a href="requestService.php" class="btn btn-primary btn-sm">Make New Request</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <?php

                                $id = $_SESSION["login_user"]["id"];
                                $sql1 = "SELECT * FROM `service` where citizen_id='$id' limit 5";
                                if (!$result = mysqli_query($conn, $sql1)) {
                                    echo mysqli_errno($conn);
                                } else {
                                    while ($res = mysqli_fetch_assoc($result)) {



                                ?>
                                        <tr>
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                                    <?php if ($res["status"] == 1 && $res["status"] == 2 ) { ?>

                                                        <small>
                                                            <a class="btn btn-sm btn-warning" href="widraw.php?id=<?php echo  $res["status"]  ?>">Widthdraw </a>
                                                        </small>|
                                                    <?php } else if ($res["status"] == 0) { ?>
                                                        <small>
                                                            <a class="btn  btn-link">Widthdraw </a>
                                                        </small>
                                                    <?php }else{ ?>
                                                    <small>
                                                        <a href="viewRequest.php?id=<?php echo $res['id'] ?>"> View </a>
                                                    </small>
                                                    <?php }?>
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
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

</body>

<script>
    let latt;
    let long;
    $(document).ready(function() {
        $.ajax({
            url: 'balance.php',
            type: 'post',
            success: function(resp) {
                $('#coin').text(resp);
            }
        })


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition1);
        } else {
            alert("Geolocation is not supported by this browser. Map related service will not work.");
        }
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
        
         markers =
            new google.maps.Marker({
                position: lattlong,
                map: maps,
                title: "You are here",
                animation: google.maps.Animation.BOUNCE,
               
            });
      

    }
    function getAll(){
        window.location.href=`admin/EmployeesLocation.php?lat=${latt}&lon=${long}`;
    }

</script>

</html>