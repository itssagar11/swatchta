<?php
require_once("config/connection.php");
$lat=$_POST['lat'];
$lan=$_POST['lon'];
$address=$_POST['address'];
$id=$_POST['id'];
$time=time() ;
$sql="UPDATE employee_info set last_latt=$lat,last_long=$lan,last_location='$address',lat_active_time=$time where id=$id";
if(!mysqli_query($conn,$sql)){
   echo  mysqli_error($conn);
}else{
    echo 1;
}



?>