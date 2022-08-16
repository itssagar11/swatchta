<?php
require_once("config/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    echo "<b> Access Denied<b>";
    print_r($_SESSION["login_user"] . "S");
    die();
    return;
}
$user = $_SESSION["login_user"];
$id = $_GET["id"];
$sql = "SELECT * from service where id=$id";
if (!$res = mysqli_query($conn, $sql)) {
    echo mysqli_errno($conn);
} else {
    $row = mysqli_fetch_assoc($res);
}
?>

<html>
<?php require_once("config/head.php") ?>

<body>

    <h4>Address<p><?php echo $row["address"] ?></p>
    </h4>
    <div id="googleMap" style="width:350px;height:400px;"></div>
    <h4>Contact<p><?php echo $row["contact"] ?></p>
    </h4>
    <img src="../<?php echo $row['image'] ?>">
    <p> Status: <?php
                                                        if (htmlentities($row['status']) == 1) {
                                                            echo "New Request.Yet to verified";
                                                        } else if (htmlentities($row['status']) == 0) {
                                                            echo "Request Discart";
                                                        } else if (htmlentities($row['status']) == 2) {
                                                            $emp = $row['allocated_to'];
                                                            $query = "Select * from employee_info where id=$emp";

                                                            if (!$rslt = mysqli_query($conn, $query)) {
                                                                echo  mysqli_error($conn);
                                                            } else {
                                                                $row2 = mysqli_fetch_assoc($rslt);
                                                                echo "Allocated to " . $row2['name'];
                                                            }
                                                        }else if(htmlentities($row['status']) == 4){
                                                            echo "Completed";
                                                        }




                                                        ?></p>
    <h5>Remark:</h5>
    <p><?php echo $row['remark'] ?></p>
    


</body>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap"></script>
<script>
    $(document).ready(function() {
        latt=<?php echo $row['latt'] ;?>;
        long=<?php echo $row['lon'] ;?>;
        var lattlong = new google.maps.LatLng(latt, long);   
            var myOptions = {   
                center: lattlong,   
                zoom: 15,   
                mapTypeControl: true,   
                navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL}   
            }   
            var maps = new google.maps.Map(document.getElementById("googleMap"), myOptions);   
            var markers =   
            new google.maps.Marker({position:lattlong, map:maps, title:"You are here!"});   

    })
</script>

</html>