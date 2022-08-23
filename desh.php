  <?php require_once('header-user.php')?>
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="requestService.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-truck fa-sm text-white-50"></i> Make Pickup Request</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Coins (Balance)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 " id="coin"></div>
                    </div>
                    <div class="col-auto">
                        <i class=" fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Rewards </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                                                            $sql = "SELECT count(id) as c from rewards where owner=$id";
                                                            $res = mysqli_query($conn, $sql);
                                                            if (!$res) {
                                                                echo mysqli_error($conn);
                                                            } else {
                                                                $row = mysqli_fetch_assoc($res);
                                                                echo $row['c'];
                                                            }
                                                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pickup Request (Not yet verified)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
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



                                </div>
                            </div>
                            <div class="col">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-6">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">My Location </h6>
                <div class="dropdown no-arrow">
                   
                    
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                <div id="myMap"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Track Curbside Truck</h6>
                <div class="dropdown no-arrow">
                  
                   
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-6 pb-1">
                <img class="sidebar-card-illustration mb-1" src="img/truck.jpg" alt="..."  ><br>
                <a onclick="getAll()"class=" d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-truck fa-sm text-white-50"></i>Track  Now</a>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Request</h6>
            </div>
           
            <table class="table    " >
            <?php

$id = $_SESSION["login_user"]["id"];
$sql1 = "SELECT * FROM `service` where citizen_id='$id'   ORDER BY id DESC limit 5 ";
if (!$result = mysqli_query($conn, $sql1)) {
    echo mysqli_error($conn);
} else {
    while ($res = mysqli_fetch_assoc($result)) {



?>
 <tr >
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                              
                                                    <small style="float:right;">
                                                        <a href="viewRequest.php?id=<?php echo $res['id'] ?>"> View </a>
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
<!-- /.container-fluid -->

</div>
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
<style> 
  #myMap {
        width: 100%;
        height: 100%;

    }
</style>
<!-- End of Main Content
         
            <?php require("footer-user.php")?>