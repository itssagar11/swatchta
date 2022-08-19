<?php
require_once("config/connection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
  echo "<b> Access Denied<b>";
  print_r($_SESSION["login_user"] . "S");
  die();
  return;
}

$address=$_POST['address'];
$lat=$_POST['lat'];
$lon=$_POST['lon'];
$id=$_POST['id'];
$img= $_POST['img'];
$citizen= $_POST['citizen'];
$sql1="INSERT INTO complete_service (service_id,image,address,lat,lon) VALUES($id,'$img','$address',$lat,$lon)";
if(!mysqli_query($conn,$sql1)){
   echo $mysqli_error($conn); 
}else{
    $sql2="UPDATE service set status=4,remark='Service Completed' where id=$id";
    if(!mysqli_query($conn,$sql2)){
        echo $mysqli_error($conn); 
     }else{
      $sql="INSERT into transection (amount,mode,narration,account_no) VALUES(5,'CREDIT','For Service no $id',$account)";
      if(!mysqli_query($conn,$sql)){
         echo $mysqli_error($conn); 
      }else
        echo 1;
     }
}
?>