<?php
require_once("../../config/connection.php");

$sql="SELECT *FROM service ";
if(isset($_GET['status'])){
    $con=$_GET["status"];
    $sql.="WHERE status='$con'";
}

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
//   echo $sql;
    echo json_encode($row);
}






?>